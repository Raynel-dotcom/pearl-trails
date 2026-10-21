<?php

namespace App\Services;

use App\Models\Destination;

class CostService
{
    /**
     * Calculate cost for a destination given origin, days, and style.
     */
    public function calculateCost(string $origin, Destination $destination, int|string $days, string $style): array
    {
        // 1. Resolve days
        $days = $this->resolveDays($days);

        // 2. Resolve origin coordinates
        $origins = config('explore.origins', []);
        $originCoords = $origins[$origin] ?? $origins['Other'] ?? ['lat' => 0.35, 'lon' => 32.58];

        // 3. Distance & travel hours
        $distKm = $this->haversine($originCoords['lat'], $originCoords['lon'], $destination->lat, $destination->lon) * 1.3;
        $hours = $distKm / 55.0;

        // 4. Style multipliers
        $multipliers = config('explore.style_multipliers', []);
        $styleMult = $multipliers[$style] ?? $multipliers['Moderate'] ?? ['transport' => 1.5, 'food' => 1.0, 'activities' => 1.0];

        // Transport: max(15000, dist_km x 700 x transportMult) + local_transport x days
        $transportBase = max(15000, $distKm * 700 * $styleMult['transport']);
        $transport = $transportBase + ($destination->local_transport_cost * $days);

        // Nights & Accommodation: nights = days <= 1 ? 0 : days - 1; accommodation = nights x accommodation_costs[style]
        $nights = $days <= 1 ? 0 : $days - 1;
        $accommodationCosts = $destination->accommodation_costs ?? [];
        $nightCost = $accommodationCosts[$style] ?? ($accommodationCosts['Moderate'] ?? 150000);
        $accommodation = $nights * $nightCost;

        // Food: food_cost x foodMult x days
        $food = $destination->food_cost * $styleMult['food'] * $days;

        // Activities: activity_cost x actMult x min(days, rec_days) / rec_days
        $recDays = max(1, $destination->rec_days ?: 1);
        $actRatio = min($days, $recDays) / $recDays;
        $activities = $destination->activity_cost * $styleMult['activities'] * $actRatio;

        // Misc: 10% of sum; total = sum + misc
        $sum = $transport + $accommodation + $food + $activities;
        $misc = 0.10 * $sum;
        $total = $sum + $misc;

        return [
            'dist_km' => round($distKm, 1),
            'hours' => round($hours, 1),
            'transport' => (int) round($transport),
            'accommodation' => (int) round($accommodation),
            'food' => (int) round($food),
            'activities' => (int) round($activities),
            'misc' => (int) round($misc),
            'total' => (int) round($total),
            'nights' => $nights,
            'days' => $days,
            'style' => $style,
            'origin' => $origin,
        ];
    }

    /**
     * Map time string or int to number of days.
     * 1 day = 1, Weekend = 2, 3 days = 3, 5 days = 5, 7+ days = 7
     */
    public function resolveDays(int|string $days): int
    {
        if (is_numeric($days)) {
            return (int) $days;
        }

        $map = config('explore.time_options', [
            '1 day'    => 1,
            'Weekend'  => 2,
            '3 days'   => 3,
            '5 days'   => 5,
            '7+ days'  => 7,
        ]);

        return $map[$days] ?? 3;
    }

    /**
     * Calculate great circle distance between two points in kilometers.
     */
    protected function haversine(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}

<?php

namespace App\Services;

use App\Models\Destination;
use Illuminate\Support\Collection;

class RecommendationService
{
    public function __construct(
        protected CostService $costService,
        protected CurrencyService $currencyService
    ) {}

    /**
     * Rank all destinations based on user quiz inputs.
     */
    public function getRecommendations(array $params): array
    {
        $origin = $params['origin'] ?? 'Kampala';
        $days = $this->costService->resolveDays($params['days'] ?? 3);
        $style = $params['style'] ?? 'Moderate';
        $group = $params['group'] ?? 'Friends';
        $selectedInterests = (array) ($params['interests'] ?? []);
        $preference = $params['preference'] ?? 'Adventurous';
        $budgetUgx = (int) ($params['budget_ugx'] ?? 500000);

        $destinations = Destination::all();
        $scored = [];

        foreach ($destinations as $dest) {
            $costData = $this->costService->calculateCost($origin, $dest, $days, $style);
            $scores = $this->calculateScores($dest, $costData, $budgetUgx, $days, $group, $style, $selectedInterests, $preference);
            
            $totalScore = (int) round(array_sum($scores));
            $totalScore = max(0, min(100, $totalScore));

            $bullets = $this->generateWhyBullets($dest, $costData, $budgetUgx, $days, $group, $style, $selectedInterests, $preference);

            $scored[] = [
                'destination' => $dest,
                'score' => $totalScore,
                'sub_scores' => $scores,
                'cost' => $costData,
                'is_within_budget' => $costData['total'] <= $budgetUgx,
                'budget_diff' => $budgetUgx - $costData['total'],
                'why_bullets' => $bullets,
            ];
        }

        // Sort descending by score, then ascending by cost
        usort($scored, function ($a, $b) {
            if ($b['score'] === $a['score']) {
                return $a['cost']['total'] <=> $b['cost']['total'];
            }
            return $b['score'] <=> $a['score'];
        });

        // Top choice check for cheaper alternative
        $cheaperAlternative = null;
        if (!empty($scored) && !$scored[0]['is_within_budget']) {
            foreach ($scored as $candidate) {
                if ($candidate['destination']->id !== $scored[0]['destination']->id && $candidate['is_within_budget']) {
                    $cheaperAlternative = $candidate;
                    break;
                }
            }
        }

        return [
            'top_recommendations' => array_slice($scored, 0, 3),
            'all_recommendations' => $scored,
            'cheaper_alternative' => $cheaperAlternative,
            'params' => [
                'origin' => $origin,
                'days' => $days,
                'style' => $style,
                'group' => $group,
                'interests' => $selectedInterests,
                'preference' => $preference,
                'budget_ugx' => $budgetUgx,
            ],
        ];
    }

    /**
     * Calculate 6 sub-scores totaling up to 100 points.
     */
    public function calculateScores(
        Destination $dest,
        array $costData,
        int $budgetUgx,
        int $days,
        string $group,
        string $style,
        array $selectedInterests,
        string $preference
    ): array {
        $cost = $costData['total'];

        // 1. Budget 25: if cost <= budget then 25, else 25 x max(0, 1 - (cost/budget - 1) x 1.5)
        if ($cost <= $budgetUgx) {
            $budgetScore = 25.0;
        } else {
            $overRatio = ($cost / max(1, $budgetUgx)) - 1.0;
            $budgetScore = 25.0 * max(0.0, 1.0 - ($overRatio * 1.5));
        }

        // 2. Interests 25: 25 x (0.8 x matchedInterests/selectedInterests + 0.2 x (trip preference in destination's preferred types ? 1 : 0)); if no interests selected, fraction = 0.5
        $destInterests = $dest->interests ?? [];
        $prefTypes = $dest->preferred_trip_types ?? [];
        $prefMatch = in_array($preference, $prefTypes, true) ? 1.0 : 0.0;

        if (empty($selectedInterests)) {
            $interestsScore = 25.0 * 0.5;
        } else {
            $matchedCount = count(array_intersect($selectedInterests, $destInterests));
            $interestRatio = $matchedCount / max(1, count($selectedInterests));
            $fraction = (0.8 * $interestRatio) + (0.2 * $prefMatch);
            $interestsScore = 25.0 * $fraction;
        }

        // 3. Time 20: dd = days < min ? min - days : days > max ? days - max : 0; score = max(0, 20 - dd x (days < min ? 6 : 3))
        $min = $dest->min_days ?: 1;
        $max = $dest->max_days ?: 7;
        if ($days < $min) {
            $dd = $min - $days;
            $timePenalty = $dd * 6;
        } elseif ($days > $max) {
            $dd = $days - $max;
            $timePenalty = $dd * 3;
        } else {
            $dd = 0;
            $timePenalty = 0;
        }
        $timeScore = (float) max(0, 20 - $timePenalty);

        // 4. Distance 10: 10 x max(0, 1 - hours / cap), cap = 4 if days <= 1, 7 if days <= 3, else 12
        if ($days <= 1) {
            $cap = 4.0;
        } elseif ($days <= 3) {
            $cap = 7.0;
        } else {
            $cap = 12.0;
        }
        $hours = $costData['hours'];
        $distScore = 10.0 * max(0.0, 1.0 - ($hours / $cap));

        // 5. Group 10 if the group is allowed, else 3
        $destGroups = $dest->groups ?? [];
        $groupScore = in_array($group, $destGroups, true) ? 10.0 : 3.0;

        // 6. Style 10 exact match, 5 if adjacent style (Budget-Moderate, Moderate-Luxury), else 0
        $destStyles = $dest->styles ?? [];
        if (in_array($style, $destStyles, true)) {
            $styleScore = 10.0;
        } else {
            // Adjacent style check
            $adjacentMap = [
                'Budget' => ['Moderate'],
                'Moderate' => ['Budget', 'Luxury'],
                'Luxury' => ['Moderate'],
            ];
            $isAdjacent = false;
            foreach ($adjacentMap[$style] ?? [] as $adj) {
                if (in_array($adj, $destStyles, true)) {
                    $isAdjacent = true;
                    break;
                }
            }
            $styleScore = $isAdjacent ? 5.0 : 0.0;
        }

        return [
            'budget'   => round($budgetScore, 1),
            'interests'=> round($interestsScore, 1),
            'time'     => round($timeScore, 1),
            'distance' => round($distScore, 1),
            'group'    => round($groupScore, 1),
            'style'    => round($styleScore, 1),
        ];
    }

    /**
     * Generate why we recommend it bullets.
     */
    protected function generateWhyBullets(
        Destination $dest,
        array $costData,
        int $budgetUgx,
        int $days,
        string $group,
        string $style,
        array $selectedInterests,
        string $preference
    ): array {
        $bullets = [];
        $diff = $budgetUgx - $costData['total'];

        // 1. Budget fit bullet
        if ($diff >= 0) {
            $formattedLeft = $this->currencyService->format($diff, 'UGX');
            $bullets[] = "Comfortably within your budget with approx. {$formattedLeft} remaining for extras.";
        } else {
            $formattedOver = $this->currencyService->format(abs($diff), 'UGX');
            $bullets[] = "Estimated to exceed your target budget by approx. {$formattedOver}.";
        }

        // 2. Time suitability
        if ($days >= $dest->min_days && $days <= $dest->max_days) {
            $bullets[] = "Ideal for your {$days}-day timeframe (recommended: {$dest->rec_days} days).";
        } elseif ($days < $dest->min_days) {
            $bullets[] = "A brisk itinerary; {$dest->name} is best appreciated in at least {$dest->min_days} days.";
        } else {
            $bullets[] = "Offers plenty of sights for a relaxing {$days}-day stay without rushing.";
        }

        // 3. Matched interests
        $destInterests = $dest->interests ?? [];
        $matched = array_intersect($selectedInterests, $destInterests);
        if (!empty($matched)) {
            $bullets[] = "Matches your passion for " . implode(', ', array_slice($matched, 0, 3)) . ".";
        }

        // 4. Group & Style
        $bullets[] = "Welcomes {$group} travelers with authentic {$style} lodging choices.";

        // 5. Trip type preference
        $prefTypes = $dest->preferred_trip_types ?? [];
        if (in_array($preference, $prefTypes, true)) {
            $bullets[] = "Renowned for {$preference} vibes that align with your travel aspirations.";
        }

        return $bullets;
    }
}

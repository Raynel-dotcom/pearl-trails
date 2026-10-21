<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'region',
        'lat',
        'lon',
        'description',
        'attractions',
        'activities',
        'interests',
        'styles',
        'groups',
        'difficulty',
        'best_time',
        'min_days',
        'max_days',
        'rec_days',
        'accommodation_costs',
        'food_cost',
        'activity_cost',
        'local_transport_cost',
        'preferred_trip_types',
        'hotel_names',
        'tips',
        'safety',
        'gradient_from',
        'gradient_to',
        'image_path',
    ];

    protected $casts = [
        'lat' => 'float',
        'lon' => 'float',
        'attractions' => 'array',
        'activities' => 'array',
        'interests' => 'array',
        'styles' => 'array',
        'groups' => 'array',
        'accommodation_costs' => 'array',
        'preferred_trip_types' => 'array',
        'hotel_names' => 'array',
        'min_days' => 'integer',
        'max_days' => 'integer',
        'rec_days' => 'integer',
        'food_cost' => 'integer',
        'activity_cost' => 'integer',
        'local_transport_cost' => 'integer',
    ];

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function stays()
    {
        return $this->hasMany(Place::class)->where('category', 'stay');
    }

    public function eatPlaces()
    {
        return $this->hasMany(Place::class)->where('category', 'eat');
    }

    public function recreationPlaces()
    {
        return $this->hasMany(Place::class)->where('category', 'recreation');
    }

    public function visitPlaces()
    {
        return $this->hasMany(Place::class)->where('category', 'visit');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function savedTrips()
    {
        return $this->hasMany(SavedTrip::class);
    }

    public function getEstimatedCostFromKampalaAttribute(): int
    {
        // "From UGX X" (budget style, min days from Kampala)
        $costService = app(\App\Services\CostService::class);
        $cost = $costService->calculateCost('Kampala', $this, $this->min_days, 'Budget');
        return $cost['total'];
    }
}

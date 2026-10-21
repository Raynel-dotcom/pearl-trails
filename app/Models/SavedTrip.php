<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'destination_id',
        'days',
        'style',
        'total_ugx',
        'details',
    ];

    protected $casts = [
        'days' => 'integer',
        'total_ugx' => 'integer',
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

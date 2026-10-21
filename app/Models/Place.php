<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'category',
        'name',
        'price_ugx',
        'unit',
        'type',
        'description',
    ];

    protected $casts = [
        'price_ugx' => 'integer',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

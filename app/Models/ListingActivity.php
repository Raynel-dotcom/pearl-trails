<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'name',
        'fee_ugx',
    ];

    protected $casts = [
        'fee_ugx' => 'integer',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}

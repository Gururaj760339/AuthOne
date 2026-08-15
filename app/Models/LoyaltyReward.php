<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyReward extends Model
{
    protected $fillable = [
        'name',
        'description',
        'points_required',
        'discount_percentage',
        'discount_amount',
        'coupon_code',
        'usage_limit',
        'used_count',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'status' => 'boolean',
    ];
}
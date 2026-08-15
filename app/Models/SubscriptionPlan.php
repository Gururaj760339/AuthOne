<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'duration_days',
        'discount_percentage',
        'roadside_discount',
        'car_wash_discount',
        'rental_discount',
        'priority_booking',
        'free_inspection',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'roadside_discount' => 'decimal:2',
        'car_wash_discount' => 'decimal:2',
        'rental_discount' => 'decimal:2',

        'priority_booking' => 'boolean',
        'free_inspection' => 'boolean',
        'status' => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
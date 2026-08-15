<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'fuel_partner_id',
        'driver_id',
        'fuel_type',
        'requested_quantity',
        'delivered_quantity',
        'fuel_price',
        'fuel_cost',
        'delivery_fee',
        'emergency_fee',
        'subtotal',
        'platform_fee',
        'total_amount',
        'latitude',
        'longitude',
        'delivery_address',
        'otp',
        'status',
        'accepted_at',
        'arrived_at',
        'completed_at',
    ];

    protected $casts = [
        'requested_quantity' => 'decimal:2',
        'delivered_quantity' => 'decimal:2',
        'fuel_price' => 'decimal:2',
        'fuel_cost' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'emergency_fee' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'accepted_at' => 'datetime',
        'arrived_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function partner()
    {
        return $this->belongsTo(
            FuelPartner::class,
            'fuel_partner_id'
        );
    }

    public function driver()
    {
        return $this->belongsTo(
            User::class,
            'driver_id'
        );
    }
}
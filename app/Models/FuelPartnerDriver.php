<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelPartnerDriver extends Model
{
    protected $fillable = [
        'user_id',
        'fuel_partner_id',
        'driver_name',
        'phone',
        'license_number',
        'license_expiry',
        'national_id',
        'vehicle_number',
        'vehicle_type',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fuel Partner
    |--------------------------------------------------------------------------
    */

    public function fuelPartner()
    {
        return $this->belongsTo(
            FuelPartner::class,
            'fuel_partner_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fuel Delivery Requests
    |--------------------------------------------------------------------------
    */

    public function requests()
    {
        return $this->hasMany(
            FuelRequest::class,
            'driver_id'
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'license_number',
        'license_expiry',
        'phone',
        'email',
        'address',
        'city',
        'latitude',
        'longitude',
        'commission_rate',
        'status',
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'commission_rate' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(FuelRequest::class);
    }

    public function drivers()
    {
        return $this->hasMany(FuelPartnerDriver::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'iso3',
        'phone_code',
        'currency_code',
        'currency_symbol',
        'default_locale',
        'timezone',
        'region',
        'vat_rate',
        'is_active',
    ];

    protected $casts = [
        'vat_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function spareParts()
    {
        return $this->hasMany(SparePart::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
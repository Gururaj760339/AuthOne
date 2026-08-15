<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $guarded = [];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function rentalBookings()
    {
        return $this->hasMany(RentalBooking::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function p2pBookings()
    {
        return $this->hasMany(P2PBooking::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

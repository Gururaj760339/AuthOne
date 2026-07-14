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
}

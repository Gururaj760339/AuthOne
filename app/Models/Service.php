<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}

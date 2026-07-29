<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
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
}

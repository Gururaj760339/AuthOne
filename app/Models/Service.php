<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = [];

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function CarImages()
    {
        return $this->hasMany(CarImage::class);
    }

    function financeRequests()
    {
        return $this->hasMany(FinanceRequests::class);
    }

    function rental()
    {
        return $this->hasOne(Rental::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}

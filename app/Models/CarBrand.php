<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    protected $guarded = [];

    public function cars(){
        return $this->hasMany(Car::class, 'brand_id');
    }
}

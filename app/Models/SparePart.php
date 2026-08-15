<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $guarded = [];

    public function sparePartImages()
    {
        return $this->hasMany(SparePartImage::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function sparePartsCategory()
    {
        return $this->belongsTo(SparePartCategory::class, 'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartCategory extends Model
{
    protected $guarded = [];

    public function spareParts(){
        return $this->hasMany(SparePart::class, 'category_id');
    }
}

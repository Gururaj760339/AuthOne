<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartImage extends Model
{
    protected $guarded = [];
    
    public function sparePart(){
        return $this->belongsTo(SparePart::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarWarranty extends Model
{
    protected $guarded = [];
    
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function importRequest()
    {
        return $this->belongsTo(ImportRequest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

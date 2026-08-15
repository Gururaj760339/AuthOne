<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadsideProvider extends Model
{
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function requests(){
        return $this->hasMany(RoadsideRequest::class, 'provider_id');
    }
}

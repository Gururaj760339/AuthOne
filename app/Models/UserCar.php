<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCar extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function p2pBookings()
    {
        return $this->hasMany(P2PBooking::class, 'car_id');
    }

    public function importFinanceRequests()
    {
        return $this->hasMany(ImportFinanceRequest::class, 'car_id');
    }
}

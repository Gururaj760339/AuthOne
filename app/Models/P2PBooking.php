<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class P2PBooking extends Model
{
    protected $table = 'p2p_bookings';
    protected $guarded = [];
    
    public function car()
    {
        return $this->belongsTo(UserCar::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }
}

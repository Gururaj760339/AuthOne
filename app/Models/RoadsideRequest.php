<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadsideRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'accepted_at' => 'datetime',
        'on_the_way_at' => 'datetime',
        'arrived_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'vehicle_id');
    }

    public function provider()
    {
        return $this->belongsTo(RoadsideProvider::class, 'provider_id');
    }
}

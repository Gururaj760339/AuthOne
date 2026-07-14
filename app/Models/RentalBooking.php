<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalBooking extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}

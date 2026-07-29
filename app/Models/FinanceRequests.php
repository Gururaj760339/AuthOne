<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceRequests extends Model
{
    protected $guarded = [];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function financePartner()
    {
        return $this->belongsTo(FinancePartner::class);
    }
}

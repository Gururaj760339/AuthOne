<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancePartner extends Model
{
    protected $guarded = [];
    
    public function financeRequests()
    {
        return $this->hasMany(FinanceRequests::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

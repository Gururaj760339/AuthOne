<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'type',
        'description',
        'reward_id',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(LoyaltyReward::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
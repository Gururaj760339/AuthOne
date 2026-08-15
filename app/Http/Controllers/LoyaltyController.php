<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyPoint;
use App\Models\LoyaltyReward;
use App\Models\LoyaltyTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoyaltyController extends Controller
{
    /**
     * Customer loyalty dashboard
     */
    public function customerLoyaltyDashboard()
    {
        $user = Auth::user();

        $loyalty = LoyaltyPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0]
        );

        $rewards = LoyaltyReward::where('status', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhereDate('expires_at', '>=', now());
            })
            ->orderBy('points_required')
            ->get();

        $transactions = LoyaltyTransaction::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view(
            'customer.loyalty.rewards.show',
            compact(
                'loyalty',
                'rewards',
                'transactions'
            )
        );
    }

    /**
     * Redeem reward
     */
    public function redeemReward($id)
    {
        $user = Auth::user();

        $reward = LoyaltyReward::where('status', true)
            ->findOrFail($id);

        if (
            $reward->expires_at &&
            $reward->expires_at->isPast()
        ) {
            return back()->with(
                'error',
                'This reward has expired.'
            );
        }

        if (
            $reward->usage_limit !== null &&
            $reward->used_count >= $reward->usage_limit
        ) {
            return back()->with(
                'error',
                'This reward is no longer available.'
            );
        }

        $loyalty = LoyaltyPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0]
        );

        if ($loyalty->points < $reward->points_required) {
            return back()->with(
                'error',
                'You do not have enough points.'
            );
        }

        DB::transaction(function () use (
            $loyalty,
            $reward,
            $user
        ) {

            $loyalty->decrement(
                'points',
                $reward->points_required
            );

            $reward->increment('used_count');

            LoyaltyTransaction::create([
                'user_id' => $user->id,
                'points' => -$reward->points_required,
                'type' => 'redeemed',
                'description' =>
                    'Redeemed reward: ' . $reward->name,
                'reward_id' => $reward->id,
            ]);
        });

        return back()->with(
            'success',
            'Reward redeemed successfully!'
        );
    }
}
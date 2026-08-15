<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyReward;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoyaltyRewardController extends Controller
{
    public function showReward()
    {
        $rewards = LoyaltyReward::latest()->paginate(15);

        return view(
            'admin.reward.show',
            compact('rewards')
        );
    }

    public function createLoyaltyReward()
    {
        return view('admin.reward.create');
    }

    public function storeLoyaltyReward(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'points_required' =>
                'required|integer|min:1',

            'discount_percentage' =>
                'nullable|numeric|min:0|max:100',

            'discount_amount' =>
                'nullable|numeric|min:0',

            'usage_limit' =>
                'nullable|integer|min:1',

            'expires_at' =>
                'nullable|date',
        ]);

        LoyaltyReward::create([
            'name' => $request->name,

            'description' =>
                $request->description,

            'points_required' =>
                $request->points_required,

            'discount_percentage' =>
                $request->discount_percentage,

            'discount_amount' =>
                $request->discount_amount,

            'coupon_code' =>
                'AUTO-' . strtoupper(Str::random(8)),

            'usage_limit' =>
                $request->usage_limit,

            'expires_at' =>
                $request->expires_at,

            'status' => true,
        ]);

        return redirect()
            ->route('admin.loyalty.rewards.index')
            ->with(
                'success',
                'Reward created successfully.'
            );
    }

    public function editLoyaltyReward($id)
    {
        $reward = LoyaltyReward::findOrFail($id);

        return view(
            'admin.reward.edit',
            compact('reward')
        );
    }

    public function updateLoyaltyReward(
        Request $request,
        $id
    ) {
        $reward = LoyaltyReward::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'points_required' =>
                'required|integer|min:1',

            'discount_percentage' =>
                'nullable|numeric|min:0|max:100',

            'discount_amount' =>
                'nullable|numeric|min:0',

            'usage_limit' =>
                'nullable|integer|min:1',

            'expires_at' =>
                'nullable|date',

            'status' =>
                'required|boolean',
        ]);

        $reward->update([
            'name' => $request->name,

            'description' =>
                $request->description,

            'points_required' =>
                $request->points_required,

            'discount_percentage' =>
                $request->discount_percentage,

            'discount_amount' =>
                $request->discount_amount,

            'usage_limit' =>
                $request->usage_limit,

            'expires_at' =>
                $request->expires_at,

            'status' =>
                $request->status,
        ]);

        return redirect()
            ->route('admin.loyalty.rewards.index')
            ->with(
                'success',
                'Reward updated successfully.'
            );
    }

    public function destroyLoyaltyReward($id)
    {
        $reward = LoyaltyReward::findOrFail($id);

        $reward->delete();

        return back()->with(
            'success',
            'Reward deleted successfully.'
        );
    }
}
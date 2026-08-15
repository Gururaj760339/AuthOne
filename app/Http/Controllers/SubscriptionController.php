<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Show all VIP plans
     */
    public function index()
    {
        $plans = SubscriptionPlan::where('status', true)
            ->orderBy('price')
            ->get();

        $activeSubscription = Auth::user()
            ->activeSubscription;

        return view(
            'customer.subscriptions.plan.index',
            compact(
                'plans',
                'activeSubscription'
            )
        );
    }


    /**
     * Show single plan
     */
    public function show($id)
    {
        $plan = SubscriptionPlan::where('status', true)
            ->findOrFail($id);

        return view(
            'customer.subscriptions.plan.index',
            compact('plan')
        );
    }


    /**
     * Subscribe to plan
     */
    public function subscribe(Request $request, $id)
    {
        $user = Auth::user();

        $plan = SubscriptionPlan::where('status', true)
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Check existing active subscription
        |--------------------------------------------------------------------------
        */

        $existingSubscription = $user->activeSubscription;

        if ($existingSubscription) {

            return back()->with(
                'error',
                'You already have an active VIP membership.'
            );
        }


        DB::beginTransaction();

        try {

            $startsAt = now();

            $endsAt = now()->addDays(
                $plan->duration_days
            );

            $subscription = Subscription::create([

                'user_id' => $user->id,

                'subscription_plan_id' =>
                $plan->id,

                'status' => 'pending',

                'starts_at' =>
                $startsAt,

                'ends_at' =>
                $endsAt,

                'auto_renew' => false,

                /*
                 * Later Stripe / PayTabs
                 * payment ID will be stored here.
                 */
                'payment_id' => null,
            ]);

            DB::commit();

            return redirect()
                ->route('payment.choose.subscription', $subscription->id);

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Something went wrong. Please try again.'
                );
        }
    }


    /**
     * Cancel subscription
     */
    public function cancel($id)
    {
        $user = Auth::user();

        $subscription = Subscription::where(
            'user_id',
            $user->id
        )
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();


        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'auto_renew' => false,
        ]);


        return back()->with(
            'success',
            'Your VIP membership has been cancelled.'
        );
    }


    /**
     * My subscriptions
     */
    public function mySubscriptions()
    {
        $subscriptions = Subscription::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view(
            'customer.subscriptions.my',
            compact('subscriptions')
        );
    }
}

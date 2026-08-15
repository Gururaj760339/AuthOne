<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FinanceRequests;
use App\Models\ImportRequest;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalBooking;
use App\Models\Service;
use App\Notifications\FinancePaymentNotification;
use App\Notifications\ImportPaymentNotification;
use App\Notifications\RentalBookingConfirmedNotification;
use App\Notifications\RentalPaymentNotification;
use App\Notifications\servicePaymentNotification;
use App\Models\CarWarranty;
use App\Models\LoyaltyPoint;
use App\Models\LoyaltyTransaction;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\WarrantyPlan;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function choosePaymentFinance($id)
    {
        $finance = FinanceRequests::findOrFail($id);

        return view('customer_payment.choose_payment_finance', compact('finance'));
    }

    public function choosePaymentService()
    {
        return view('customer_payment.choose_payment_service');
    }

    public function choosePaymentCarRental($rentalId, $rentalBookingId)
    {
        $rental = Rental::findOrFail($rentalId);
        $rentalBooking = RentalBooking::findOrFail($rentalBookingId);

        return view('customer_payment.choose_payment_car_rental', compact('rental', 'rentalBooking'));
    }

    public function choosePaymentCarImport($id)
    {
        $carImport = ImportRequest::findOrFail($id);

        return view('customer_payment.choose_payment_car_import', compact('carImport'));
    }

    public function choosePaymentWarrantyExtended($warrantyId, $planId)
    {
        return view('customer_payment.choose_payment_warranty_extended', compact('warrantyId', 'planId'));
    }

    public function choosePaymentSubscription($id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('customer_payment.choose_payment_subscription', compact('subscription'));
    }

    public function stripeRentalCheckout($type, $rentalId, $rentalBookingId)
    {
        switch ($type) {
            case 'rental':

                $rental = Rental::findOrFail($rentalId);
                $rentalBooking = RentalBooking::findOrFail($rentalBookingId);

                $total_rental_days = Carbon::parse($rentalBooking->pickup_date)->diffInDays(Carbon::parse($rentalBooking->return_date)) + 1;
                $amount = $rental->price_per_day * $total_rental_days;


                break;

            default:

                abort(404);
        }

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => $type,
            'reference_id' => $rentalBooking->id,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        $currency = strtolower(
            auth()->user()->country->currency_code ?? 'AED'
        );

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => ucfirst($type) . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', [$payment->id, $amount]),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    public function stripeCheckoutService()
    {
        $amount = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->where('bookings.user_id', auth()->id())
            ->where('bookings.status', 'Pending')
            ->sum('services.price');


        $referenceId = rand(100000, 999999);
        $user = auth()->user();

        $subscription = $user->activeSubscription;

        $discount = 0;

        if ($subscription) {
            $discount = (
                $amount *
                $subscription->plan->discount_percentage
            ) / 100;
        }

        $finalAmount = $amount - $discount;

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => 'service',
            'reference_id' => $referenceId,
            'final_amount' => $finalAmount,
            'amount' => $amount,
            'vip_discount' => $discount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        Booking::where('user_id', Auth::user()->id)
            ->update(['status' => 'Confirmed']);

        //dd(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $currency = auth()->user()->country->currency_code ?? 'AED';

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => ucfirst('service') . ' Payment',
                    ],
                    'unit_amount' => (int) ($finalAmount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', [$payment->id, $amount]),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    // Stripe Checkout
    public function stripeCheckoutSparePart($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $amount = $order->subtotal;

        $referenceId = rand(100000, 999999);


        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => 'spare_part',
            'reference_id' => $referenceId,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        //dd(env('STRIPE_SECRET'));
        
        $currency = auth()->user()->country->currency_code ?? 'AED';

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => ucfirst('service') . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('spare_parts.stripe.success', [$payment->id, $orderId]),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    // Payment Success
    public function StripeSuccessSparePart($paymentId, $orderId)
    {
        $payment = Payment::findOrFail($paymentId);

        $payment->update([
            'payment_method' => 'stripe',
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $order = Order::findOrFail($orderId);

        $order->update([
            'payment_status' => 'paid'
        ]);

        $points = floor($order->subtotal);

        $loyalty = LoyaltyPoint::firstOrCreate(
            ['user_id' => $order->user_id],
            ['points' => 0]
        );

        $loyalty->increment('points', $points);

        LoyaltyTransaction::create([
            'user_id' => $order->user_id,
            'points' => $points,
            'type' => 'earned',
            'description' => 'Points earned from order #' . $order->id,
            'order_id' => $order->id,
        ]);


        return redirect()
            ->route('customer.order.success', $orderId)
            ->with('success', 'Payment completed successfully.');
    }

    // Stripe Checkout
    public function stripeCheckout($type, $id)
    {
        switch ($type) {

            case 'finance':

                $request = FinanceRequests::findOrFail($id);

                $amount = $request->down_payment;

                break;

            case 'import':

                $request = ImportRequest::findOrFail($id);

                $amount = $request->budget;

                break;
            case 'service':

                $request = Service::findOrFail($id);

                $amount = $request->price;

                break;

            default:

                abort(404);
        }

        if ($type === 'service') {
            $user = auth()->user();

            $subscription = $user->activeSubscription;

            $discount = 0;

            if ($subscription) {
                $discount = (
                    $amount *
                    $subscription->plan->discount_percentage
                ) / 100;
            }

            $finalAmount = $amount - $discount;

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'payment_for' => $type,
                'reference_id' => $request->id,
                'final_amount' => $finalAmount,
                'amount' => $amount,
                'vip_discount' => $discount,
                'payment_method' => 'stripe',
                'status' => 'pending',
            ]);
        } else {
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'payment_for' => $type,
                'reference_id' => $request->id,
                'final_amount' => $amount,
                'amount' => $amount,
                'vip_discount' => 0,
                'payment_method' => 'stripe',
                'status' => 'pending',
            ]);
        }


        //dd(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $currency = auth()->user()->country->currency_code ?? 'AED';

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => ucfirst($type) . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', [$payment->id, $amount]),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    public function stripeCheckoutWarrantyExtended($warrantyId, $planId)
    {
        //dd('Controller Hit', $warrantyId, $planId);
        $plan = WarrantyPlan::findOrFail($planId);
        $amount = $plan->price;
        $referenceId = rand(100000, 999999);

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => 'warranty_extended',
            'reference_id' => $referenceId,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $currency = auth()->user()->country->currency_code ?? 'AED';

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => 'Extended Warranty Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('warranty.stripe.success', [
                'paymentId' => $payment->id,
                'warrantyId' => $warrantyId,
                'planId' => $planId,
            ]),
            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    public function stripeCheckoutSubscription($subscriptionId)
    {
        $subscription = Subscription::where('id', $subscriptionId)->first();
        $subscriptionPlan = SubscriptionPlan::where('id', $subscription->subscription_plan_id)->first();
        $amount = $subscriptionPlan->price;

        $referenceId = rand(100000, 999999);


        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => 'subscription',
            'reference_id' => $referenceId,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        //dd(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $currency = auth()->user()->country->currency_code ?? 'AED';

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => ucfirst('service') . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success.subscription', [$payment->id, $subscriptionId]),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }

    // Payment Success
    public function subscriptionStripeSuccess($paymentId, $subscriptionId)
    {
        $payment = Payment::findOrFail($paymentId);

        $payment->update([
            'payment_method' => 'stripe',
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $subscription = Subscription::findOrFail($subscriptionId);
        //dd('complete');

        $subscription->update([
            'payment_id' => $paymentId,
            'status' => 'active'
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Payment completed successfully.');
    }

    // Payment Success
    public function warrantyStripeSuccess($paymentId, $warrantyId, $planId)
    {
        $payment = Payment::findOrFail($paymentId);

        $payment->update([
            'payment_method' => 'stripe',
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $warranty = CarWarranty::findOrFail($warrantyId);
        $plan = WarrantyPlan::findOrFail($planId);

        $warranty->update([
            'warranty_plan_id' => $planId,

            'end_date' => Carbon::parse($warranty->end_date)
                ->addMonths($plan->duration_months),

            'duration_months' => $warranty->duration_months + $plan->duration_months,

            'max_km' => $plan->max_km,

            'type' => 'Extended',
        ]);

        $points = floor($plan->price);

        $loyalty = LoyaltyPoint::firstOrCreate(
            ['user_id' => $warranty->user_id],
            ['points' => 0]
        );

        $loyalty->increment('points', $points);

        LoyaltyTransaction::create([
            'user_id' => $warranty->user_id,
            'points' => $points,
            'type' => 'earned',
            'description' => 'Points earned from order #'
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Payment completed successfully.');
    }


    // Payment Success
    public function stripeSuccess($id, $amount)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_method' => 'stripe',
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $user = $payment->user;

        switch ($payment->payment_for) {

            case 'service':

                $booking = Booking::with('service')
                    ->find($payment->reference_id);

                if ($booking) {
                    $user->notify(new ServicePaymentNotification($booking, $payment));
                }

                break;

            case 'finance':

                $finance = FinanceRequests::find($payment->reference_id);

                if ($finance) {

                    // $finance->update([
                    //     'status' => 'Approved',
                    // ]);

                    $user->notify(new FinancePaymentNotification($finance, $payment));
                }

                break;

            case 'import':

                $import = ImportRequest::find($payment->reference_id);

                if ($import) {
                    $user->notify(new ImportPaymentNotification($import, $payment));
                }

                break;

            case 'rental':

                $rental = RentalBooking::find($payment->reference_id);

                if ($rental) {
                    $user->notify(new RentalPaymentNotification($rental, $payment));
                }

                return redirect()
                    ->route('rental.contract.show', $rental->id)
                    ->with('success', 'Payment completed successfully.');

                break;
        }


        $points = floor($amount);

        $userId = Auth::user()->id;
        $loyalty = LoyaltyPoint::firstOrCreate(
            ['user_id' => $userId],
            ['points' => 0]
        );

        $loyalty->increment('points', $points);

        LoyaltyTransaction::create([
            'user_id' => $userId,
            'points' => $points,
            'type' => 'earned',
            'description' => 'Points earned from order #'
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Payment completed successfully.');
    }

    // Payment Cancel
    public function stripeCancel($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->back()
            ->with('error', 'Payment was cancelled.');
    }
}

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

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => ucfirst($type) . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', $payment->id),

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


        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => 'service',
            'reference_id' => $referenceId,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        Booking::where('user_id', Auth::user()->id)
        ->update(['status' => 'Confirmed']);

        //dd(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => ucfirst('service') . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', $payment->id),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
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

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'payment_for' => $type,
            'reference_id' => $request->id,
            'amount' => $amount,
            'payment_method' => 'stripe',
            'status' => 'pending',
        ]);

        //dd(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => ucfirst($type) . ' Payment',
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('stripe.success', $payment->id),

            'cancel_url' => route('stripe.cancel', $payment->id),
        ]);

        return redirect($session->url);
    }


    // Payment Success
    public function stripeSuccess($id)
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

                    $finance->update([
                        'status' => 'Approved',
                    ]);

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

<?php

namespace App\Http\Controllers;

use App\Models\P2PBooking;
use App\Models\UserCar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Setting;

class P2PBookingController extends Controller
{
    public function createBooking($id)
    {
        $car = UserCar::with('user')
            ->where('status', 'approved')
            ->where('is_available', 1)
            ->findOrFail($id);

        $setting = Setting::first();
        $faqs = Faq::limit(3)->get();

        return view('booking.p2p_booking_create', compact(
            'car',
            'setting',
            'faqs'
        ));
    }

    public function storeBooking(Request $request, $carId)
    {
        $car = UserCar::findOrFail($carId);

        $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date'
        ]);

        $days = Carbon::parse($request->pickup_date)
            ->diffInDays($request->return_date);

        $total = $days * $car->price_per_day;

        P2PBooking::create([
            'car_id' => $car->id,
            'owner_id' => $car->user_id,
            'renter_id' => auth()->id(),
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'price_per_day' => $car->price_per_day,
            'days' => $days,
            'total_amount' => $total
        ]);

        return back()->with('success', 'Booking request sent.');
    }

    public function rentalRequests()
    {
        $bookings = P2PBooking::with(['car', 'user'])
            ->whereHas('car', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('customer.p2p.rental_requests', compact('bookings'));
    }

    public function updateRentalStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed,cancelled',
        ]);

        $booking = P2PBooking::whereHas('car', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Booking status updated successfully.');
    }
}

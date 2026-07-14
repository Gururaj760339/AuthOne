<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalBooking;
use Illuminate\Http\Request;

class RentalBookingController extends Controller
{

    public function singleRentalBookingCreate($id)
    {
        $rental = Rental::with('car')->findOrFail($id);

        return view('rental_booking.rental_booking_create', compact('rental'));
    }

    public function rentalBookingCreate()
    {
        $rentals = Rental::with('car')->get();

        return view('rental_booking.rental_car_booking_form', compact('rentals'));
    }


    public function customerRentalBookingStore(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        RentalBooking::create([
            'user_id' => auth()->id(),
            'rental_id' => $request->rental_id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Rental booking submitted successfully.');
    }

    public function adminRentalBookingShow()
    {
        $bookings = RentalBooking::with([
            'user',
            'rental.car'
        ])->latest()->get();

        return view('admin.rental_booking.rental_booking_show', compact('bookings'));
    }

    public function adminRentalBookinStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $booking = RentalBooking::findOrFail($id);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function adminRentalBookinDelete($id)
    {
        $booking = RentalBooking::findOrFail($id);

        $booking->delete();

        return back()->with('success', 'Booking deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use App\Models\Rental;
use App\Models\RentalBooking;
use App\Notifications\RentalBookingConfirmedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $kyc = KycVerification::where('user_id', Auth::id())->first();

        if (!$kyc) {

            return redirect()
                ->route('customer.create.kyc')
                ->with('error', 'Please complete your KYC verification before booking.');
        }

        if ($kyc->status != 'verified') {

            return redirect()
                ->route('customer.profile')
                ->with('error', 'Your KYC is not verified yet.');
        }

        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        $rentalBooking = RentalBooking::create([
            'user_id' => auth()->id(),
            'rental_id' => $request->rental_id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'status' => 'Pending',
        ]);

        $user = Auth::user();

        $user->notify(new RentalBookingConfirmedNotification($rentalBooking));

        return redirect()->route('payment.choose.car.rental', ['rentalId' => $request->rental_id, 'rentalBookingId' => $rentalBooking->id]);
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

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Notifications\ServiceBookingConfirmedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function showBooking()
    {
        $bookings = Booking::with(['user', 'service'])
            ->latest()
            ->get();

        return view('booking.admin_booking_show', compact('bookings'));
    }


    public function MaintenanceBookingCreate()
    {
        $services = Service::whereHas('serviceCategory', function($query){
            $query->where('slug', 'workshops-maintenance');
        })->get();

        return view('booking.booking_create', compact('services'));
    }

    public function CarWashBookingCreate()
    {
        $services = Service::whereHas('serviceCategory', function($query){
            $query->where('slug', 'car-wash-services');
        })->get();

        return view('booking.booking_create', compact('services'));
    }

    public function singleServiceCreate($slug)
    {
        $services = Service::where('slug', $slug)->get();

        return view('booking.booking_create', compact('services'));
    }

    public function BookingStore(Request $request)
    {
        $request->validate([
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'notes'        => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $booking = Booking::create([
            'user_id'       => Auth::id(),
            'service_id'    => $request->service_id,
            'booking_date'  => $request->booking_date,
            'booking_time'  => $request->booking_time,
            'status'        => 'pending',
            'notes'         => $request->notes,
        ]);

        //dd(config('services.twilio'));

        $booking->load('service');

        $user->notify(new ServiceBookingConfirmedNotification($booking));

        return redirect()->route('payment.choose.service', $request->service_id);
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Booking status updated successfully.');
    }

    // Delete Booking
    public function bookingDelete($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        return back()->with('success', 'Booking deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Faq;
use App\Models\Rental;
use App\Models\RentalBooking;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function showAdminRental()
    {
        $rentals = Rental::with('car')->latest()->get();

        return view('admin.rentals.admin_rental_show', compact('rentals'));
    }

    public function showVendorRental()
    {
        $rentals = Rental::with('car')
        ->where('vendor_id', Auth::user()->vendor->id)
        ->latest()->get();

        return view('admin.rentals.admin_rental_show', compact('rentals'));
    }

    public function customerRentalShow()
    {
        $rentals = Rental::with('car')->where('available', 1)->latest()->get();
        $rental_booking = RentalBooking::where('status', 'Completed')->first();
        $faqs = Faq::limit(3)->get();
        $setting = Setting::first();

        return view('car_rental', compact('setting', 'faqs', 'rental_booking', 'rentals'));
    }

    public function retalCreate()
    {
        $cars = Car::all();

        return view('admin.rentals.admin_rental_create', compact('cars'));
    }


    public function rentalStore(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'required|numeric|min:0',
            'price_per_month' => 'required|numeric|min:0',
            'available' => 'required|boolean',
        ]);

        Rental::create([
            'car_id' => $request->car_id,
            'price_per_day' => $request->price_per_day,
            'price_per_week' => $request->price_per_week,
            'price_per_month' => $request->price_per_month,
            'available' => $request->available,
            'vendor_id' => Auth::user()->vendor->id
        ]);

        return redirect()
            ->route('vendor.rental')
            ->with('success', 'Rental added successfully.');
    }


    public function rentalEdit($id)
    {
        $rental = Rental::findOrFail($id);

        $cars = Car::all();

        return view('admin.rentals.admin_rental_edit', compact('rental', 'cars'));
    }


     public function rentalUpdate(Request $request, $id)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'required|numeric|min:0',
            'price_per_month' => 'required|numeric|min:0',
            'available' => 'required|boolean',
        ]);

        $rental = Rental::findOrFail($id);

        $rental->update([
            'car_id' => $request->car_id,
            'price_per_day' => $request->price_per_day,
            'price_per_week' => $request->price_per_week,
            'price_per_month' => $request->price_per_month,
            'available' => $request->available,
        ]);

        return redirect()
            ->route('admin.rental')
            ->with('success', 'Rental updated successfully.');
    }


    // Delete Rental
    public function RentalDestroy($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->delete();

        return redirect()
            ->route('admin.rental')
            ->with('success', 'Rental deleted successfully.');
    }
}

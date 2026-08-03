<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PriceEstimationController extends Controller
{
    public function repairPage()
    {
        $services = Service::all();

        return view('estimation_price.repair', compact('services'));
    }
    /**
     * Repair Price Estimation
     */
    public function repair(Request $request)
    {
        $request->validate([
            'service_id'      => 'required|exists:services,id',
            'parts_price'     => 'required|numeric|min:0',
            'labor_cost'      => 'required|numeric|min:0',
            'location_charge' => 'nullable|numeric|min:0',
        ]);

        $service = Service::findOrFail($request->service_id);

        $locationCharge = $request->location_charge ?? 0;

        $estimatedPrice = $service->price
            + $request->parts_price
            + $request->labor_cost
            + $locationCharge;

        return response()->json([
            'service' => $service->title,
            'estimated_price' => $estimatedPrice,
        ]);
    }

    /**
     * Rental Price Estimation
     */
    public function rental(Request $request)
    {
        $request->validate([
            'rental_id'    => 'required|exists:rentals,id',
            'pickup_date'  => 'required|date',
            'return_date'  => 'required|date|after:pickup_date',
            'insurance'    => 'nullable|numeric|min:0',
            'extra_charge' => 'nullable|numeric|min:0',
        ]);

        $rental = Rental::findOrFail($request->rental_id);

        $days = Carbon::parse($request->pickup_date)
            ->diffInDays(Carbon::parse($request->return_date));

        $insurance = $request->insurance ?? 0;
        $extra = $request->extra_charge ?? 0;

        $estimatedPrice = ($rental->price_per_day * $days)
            + $insurance
            + $extra;

        return response()->json([
            'days' => $days,
            'price_per_day' => $rental->price_per_day,
            'estimated_price' => $estimatedPrice,
        ]);
    }

    public function rentalPage()
    {
        $rentals = Rental::with('car')->get();

        return view('estimation_price.rental', compact('rentals'));
    }

    /**
     * Import Price Estimation
     */
    public function import(Request $request)
    {
        $request->validate([
            'car_price'        => 'required|numeric|min:0',
            'shipping_cost'    => 'required|numeric|min:0',
            'customs_duty'     => 'required|numeric|min:0',
            'vat'              => 'required|numeric|min:0',
            'registration_fee' => 'required|numeric|min:0',
        ]);

        $estimatedPrice = $request->car_price
            + $request->shipping_cost
            + $request->customs_duty
            + $request->vat
            + $request->registration_fee;

        return response()->json([
            'estimated_price' => $estimatedPrice,
        ]);
    }
}

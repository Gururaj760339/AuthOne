<?php

namespace App\Http\Controllers;

use App\Models\FuelPartner;
use App\Models\FuelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelDeliveryController extends Controller
{
    public function create()
    {
        return view('customer.fuel_delivery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fuel_type' => [
                'required',
                'in:petrol_91,petrol_95,petrol_98,diesel'
            ],
            'requested_quantity' => [
                'required',
                'numeric',
                'min:1',
                'max:500'
            ],
            'delivery_fee' => [
                'required',
                'numeric',
                'min:0'
            ],
            'emergency_fee' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'latitude' => [
                'nullable',
                'numeric'
            ],
            'longitude' => [
                'nullable',
                'numeric'
            ],
            'delivery_address' => [
                'required',
                'string',
                'max:1000'
            ],
        ]);

        $quantity = $validated['requested_quantity'];

        /*
        |--------------------------------------------------------------------------
        | Find available fuel partner
        |--------------------------------------------------------------------------
        */

        $partner = FuelPartner::where(
            'status',
            'approved'
        )
            ->orderByRaw(
                "ABS(latitude - ?) + ABS(longitude - ?)",
                [
                    $validated['latitude'] ?? 0,
                    $validated['longitude'] ?? 0
                ]
            )
            ->first();

        if (!$partner) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'No fuel delivery partner is currently available.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Fuel price
        |--------------------------------------------------------------------------
        */

        $fuelPrice = 0;

        // dynamic fuel price।

        $fuelCost = $quantity * $fuelPrice;

        $deliveryFee = $validated['delivery_fee'];

        $emergencyFee = $validated['emergency_fee'] ?? 0;

        $subtotal =
            $fuelCost +
            $deliveryFee +
            $emergencyFee;

        /*
        |--------------------------------------------------------------------------
        | AutoOne platform fee = 10%
        |--------------------------------------------------------------------------
        */

        $platformFee = $subtotal * 0.10;

        $totalAmount = $subtotal;

        /*
        |--------------------------------------------------------------------------
        | Generate OTP
        |--------------------------------------------------------------------------
        */

        $otp = random_int(1000, 9999);

        $fuelRequest = FuelRequest::create([
            'customer_id' => Auth::id(),

            'fuel_partner_id' => $partner->id,

            'fuel_type' =>
            $validated['fuel_type'],

            'requested_quantity' =>
            $quantity,

            'fuel_price' =>
            $fuelPrice,

            'fuel_cost' =>
            $fuelCost,

            'delivery_fee' =>
            $deliveryFee,

            'emergency_fee' =>
            $emergencyFee,

            'subtotal' =>
            $subtotal,

            'platform_fee' =>
            $platformFee,

            'total_amount' =>
            $totalAmount,

            'latitude' =>
            $validated['latitude'] ?? null,

            'longitude' =>
            $validated['longitude'] ?? null,

            'delivery_address' =>
            $validated['delivery_address'],

            'otp' =>
            $otp,

            'status' =>
            'searching',
        ]);

        return redirect()
            ->route(
                'fuel.delivery.show',
                $fuelRequest->id
            )
            ->with(
                'success',
                'Fuel delivery request created successfully.'
            );
    }

    public function show($id)
    {
        $fuelRequest = FuelRequest::with([
            'customer',
            'partner',
            'driver'
        ])->findOrFail($id);

        return view(
            'customer.fuel_delivery.details',
            compact('fuelRequest')
        );
    }

    public function myRequests()
    {
        $requests = FuelRequest::where(
            'customer_id',
            Auth::id()
        )
            ->latest()
            ->paginate(15);

        return view(
            'customer.fuel_delivery.show',
            compact('requests')
        );
    }
}

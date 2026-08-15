<?php

namespace App\Http\Controllers;

use App\Models\FuelPartner;
use App\Models\FuelPartnerDriver;
use App\Models\FuelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelPartnerDashboardController extends Controller
{
    private function partner()
    {
        return FuelPartner::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
    }

    public function dashboard()
    {
        $partner = $this->partner();

        $totalRequests = $partner->requests()->count();

        $pendingRequests = $partner->requests()
            ->whereIn('status', [
                'searching',
                'assigned',
                'accepted'
            ])
            ->count();

        $completedRequests = $partner->requests()
            ->where('status', 'completed')
            ->count();

        $totalRevenue = $partner->requests()
            ->where('status', 'completed')
            ->sum('subtotal');

        /*
        |--------------------------------------------------------------------------
        | AutoOne platform fee = 10%
        |--------------------------------------------------------------------------
        */

        $totalPlatformFee = $partner->requests()
            ->where('status', 'completed')
            ->sum('platform_fee');

        $netEarnings =
            $totalRevenue -
            $totalPlatformFee;

        return view(
            'fuel_partner.dashboard',
            compact(
                'partner',
                'totalRequests',
                'pendingRequests',
                'completedRequests',
                'totalRevenue',
                'totalPlatformFee',
                'netEarnings'
            )
        );
    }

    public function requests()
    {
        $partner = $this->partner();


        /*
    |--------------------------------------------------------------------------
    | Fuel Requests
    |--------------------------------------------------------------------------
    */

        $requests = $partner->requests()
            ->with('customer')
            ->latest()
            ->paginate(10);


        /*
    |--------------------------------------------------------------------------
    | This Partner's Drivers
    |--------------------------------------------------------------------------
    */

        $drivers = FuelPartnerDriver::where(
            'fuel_partner_id',
            $partner->id
        )
            ->whereIn('status', [
                'approved',
                'active'
            ])
            ->with('user')
            ->orderBy('driver_name')
            ->get();


        return view(
            'fuel_partner.request',
            compact(
                'partner',
                'requests',
                'drivers'
            )
        );
    }

    public function accept($id)
    {
        $partner = $this->partner();

        $request = $partner->requests()
            ->where('id', $id)
            ->firstOrFail();

        if ($request->status !== 'searching') {
            return back()->with(
                'error',
                'This request is no longer available.'
            );
        }

        $request->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return back()->with(
            'success',
            'Fuel request accepted.'
        );
    }

    public function reject($id)
    {
        $partner = $this->partner();

        $request = $partner->requests()
            ->where('id', $id)
            ->firstOrFail();

        $request->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Fuel request rejected.'
        );
    }

    public function assignDriver(Request $request, $id) {
        $partner = $this->partner();


        /*
    |--------------------------------------------------------------------------
    | Validate driver
    |--------------------------------------------------------------------------
    */

        $validated = $request->validate([
            'driver_id' => [
                'required',
                'exists:users,id',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Get Fuel Request
    |--------------------------------------------------------------------------
    |
    | Only requests belonging to this Fuel Partner
    |
    */

        $fuelRequest = $partner->requests()
            ->where('id', $id)
            ->firstOrFail();


        /*
    |--------------------------------------------------------------------------
    | Get Driver
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | Driver must belong to this Fuel Partner.
    |
    */

        $driver = FuelPartnerDriver::where(
            'fuel_partner_id',
            $partner->id
        )
            ->where(
                'user_id',
                $validated['driver_id']
            )
            ->whereIn('status', [
                'approved',
                'active'
            ])
            ->first();


        /*
    |--------------------------------------------------------------------------
    | Driver not found
    |--------------------------------------------------------------------------
    */

        if (!$driver) {

            return back()->with(
                'error',
                'Invalid driver. This driver does not belong to your fuel partner or is not active.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | Assign Driver
    |--------------------------------------------------------------------------
    */

        $fuelRequest->update([

            'driver_id' =>
            $driver->id,

            'status' =>
            'driver_assigned',

        ]);


        return back()->with(
            'success',
            'Driver assigned successfully.'
        );
    }

    public function complete(Request $request, $id) {
        $partner = $this->partner();

        $fuelRequest = $partner->requests()
            ->where('id', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'delivered_quantity' =>
            'required|numeric|min:0.1',
        ]);

        $fuelRequest->update([
            'delivered_quantity' =>
            $validated['delivered_quantity'],

            'status' => 'completed',

            'completed_at' => now(),
        ]);

        return back()->with(
            'success',
            'Fuel delivery completed successfully.'
        );
    }
}

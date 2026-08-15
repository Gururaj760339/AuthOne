<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelPartnerDriver;
use App\Models\FuelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelDriverDashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get Logged-in Driver
    |--------------------------------------------------------------------------
    */

    private function driver()
    {
        return FuelPartnerDriver::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
    }


    /*
    |--------------------------------------------------------------------------
    | Driver Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $driver = $this->driver();

        $totalDeliveries = $driver->requests()->count();

        $pendingDeliveries = $driver->requests()
            ->whereIn('status', [
                'driver_assigned',
                'on_the_way',
                'arrived',
                'fuel_delivering',
            ])
            ->count();

        $completedDeliveries = $driver->requests()
            ->where('status', 'completed')
            ->count();

        $cancelledDeliveries = $driver->requests()
            ->whereIn('status', [
                'cancelled',
                'rejected',
                'failed',
            ])
            ->count();

        $recentDeliveries = $driver->requests()
            ->latest()
            ->take(5)
            ->get();

        return view(
            'fuel_driver.dashboard',
            compact(
                'driver',
                'totalDeliveries',
                'pendingDeliveries',
                'completedDeliveries',
                'cancelledDeliveries',
                'recentDeliveries'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | All Deliveries
    |--------------------------------------------------------------------------
    */

    public function deliveries()
    {
        $driver = $this->driver();

        $deliveries = $driver->requests()
            ->with('customer')
            ->latest()
            ->paginate(10);

        return view(
            'fuel_driver.delivery.show',
            compact(
                'driver',
                'deliveries'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delivery Details
    |--------------------------------------------------------------------------
    */

    public function showDelivery($id)
    {
        $driver = $this->driver();

        $delivery = $driver->requests()
            ->with('customer')
            ->where('id', $id)
            ->firstOrFail();

        return view(
            'fuel_driver.delivery.details',
            compact(
                'driver',
                'delivery'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Delivery Status
    |--------------------------------------------------------------------------
    */

    public function updateDeliveryStatus(Request $request, $id) {
        $driver = $this->driver();

        $delivery = $driver->requests()
            ->where('id', $id)
            ->firstOrFail();


        $validated = $request->validate([
            'status' => [
                'required',
                'in:on_the_way,arrived,fuel_delivering,completed,cancelled,rejected,failed'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Prevent Invalid Status Changes
        |--------------------------------------------------------------------------
        */

        $currentStatus = $delivery->status;

        $newStatus = $validated['status'];


        $allowedTransitions = [

            'driver_assigned' => [
                'on_the_way',
                'cancelled',
                'failed',
            ],

            'on_the_way' => [
                'arrived',
                'cancelled',
                'failed',
            ],

            'arrived' => [
                'fuel_delivering',
                'cancelled',
                'failed',
            ],

            'fuel_delivering' => [
                'completed',
                'failed',
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | Check Transition
        |--------------------------------------------------------------------------
        */

        if (
            !isset($allowedTransitions[$currentStatus]) ||
            !in_array(
                $newStatus,
                $allowedTransitions[$currentStatus]
            )
        ) {

            return back()->with(
                'error',
                'This status update is not allowed.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $delivery->update([
            'status' => $newStatus,
        ]);


        return back()->with(
            'success',
            'Delivery status updated successfully.'
        );
    }
}

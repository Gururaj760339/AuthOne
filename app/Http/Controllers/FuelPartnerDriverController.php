<?php

namespace App\Http\Controllers;

use App\Models\FuelPartner;
use App\Models\FuelPartnerDriver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuelPartnerDriverController extends Controller
{
    /**
     * Get logged-in fuel partner
     */
    private function partner()
    {
        return FuelPartner::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
    }


    /**
     * Driver List
     */
    public function index()
    {
        $partner = $this->partner();

        $drivers = FuelPartnerDriver::where(
            'fuel_partner_id',
            $partner->id
        )
            ->with('user')
            ->latest()
            ->paginate(10);

        return view(
            'fuel_partner.driver.show',
            compact(
                'partner',
                'drivers'
            )
        );
    }


    /**
     * Add Driver Form
     */
    public function create()
    {
        $partner = $this->partner();

        return view(
            'fuel_partner.driver.create',
            compact('partner')
        );
    }


    /**
     * Store Driver
     */
    public function store(Request $request)
    {
        $partner = $this->partner();

        $validated = $request->validate([

            // ================================
            // USER + DRIVER COMMON DATA
            // ================================

            'driver_name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'phone' => [
                'required',
                'string',
                'max:30'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],


            // ================================
            // DRIVER DATA
            // ================================

            'license_number' => [
                'nullable',
                'string',
                'max:100'
            ],

            'license_expiry' => [
                'nullable',
                'date'
            ],

            'national_id' => [
                'nullable',
                'string',
                'max:100'
            ],

            'vehicle_number' => [
                'nullable',
                'string',
                'max:100'
            ],

            'vehicle_type' => [
                'nullable',
                'string',
                'max:100'
            ],

        ]);


        DB::transaction(function () use (
            $validated,
            $partner
        ) {

            // =========================================
            // 1. CREATE USER
            // =========================================

            $user = User::create([

                'name' =>
                $validated['driver_name'],

                'email' =>
                $validated['email'],

                'phone' =>
                $validated['phone'],

                'password' =>
                Hash::make(
                    $validated['password']
                ),

                'role' =>
                'fuel_driver',

            ]);


            // =========================================
            // 2. CREATE FUEL PARTNER DRIVER
            // =========================================

            FuelPartnerDriver::create([

                'user_id' =>
                $user->id,

                'fuel_partner_id' =>
                $partner->id,

                'driver_name' =>
                $validated['driver_name'],

                'phone' =>
                $validated['phone'],

                'license_number' =>
                $validated['license_number']
                    ?? null,

                'license_expiry' =>
                $validated['license_expiry']
                    ?? null,

                'national_id' =>
                $validated['national_id']
                    ?? null,

                'vehicle_number' =>
                $validated['vehicle_number']
                    ?? null,

                'vehicle_type' =>
                $validated['vehicle_type']
                    ?? null,

                'status' =>
                'pending',

            ]);
        });


        return redirect()
            ->route(
                'fuel.partner.drivers.index'
            )
            ->with(
                'success',
                'Delivery driver added successfully.'
            );
    }


    /**
     * Delete Driver
     */
    public function destroy($id)
    {
        $partner = $this->partner();

        $driver = FuelPartnerDriver::where(
            'fuel_partner_id',
            $partner->id
        )->findOrFail($id);

        DB::transaction(function () use ($driver) {

            $userId = $driver->user_id;

            /*
            |--------------------------------------------------------------------------
            | Delete Driver
            |--------------------------------------------------------------------------
            */

            $driver->delete();

            /*
            |--------------------------------------------------------------------------
            | Delete User Account
            |--------------------------------------------------------------------------
            |
            | আপনার migration-এ user_id cascadeOnDelete আছে,
            | কিন্তু এখানে explicitly user delete করছি।
            |
            */

            User::where(
                'id',
                $userId
            )->delete();
        });


        return redirect()
            ->route('fuel.partner.drivers.index')
            ->with(
                'success',
                'Delivery driver deleted successfully.'
            );
    }


    /**
     * Update Driver Status
     */
    public function updateStatus(
        Request $request,
        $id
    ) {
        $partner = $this->partner();

        $validated = $request->validate([

            'status' => [
                'required',
                'in:pending,approved,active,inactive,suspended'
            ],

        ]);


        $driver = FuelPartnerDriver::where(
            'fuel_partner_id',
            $partner->id
        )->findOrFail($id);


        $driver->status =
            $validated['status'];


        if (
            $validated['status'] === 'approved' ||
            $validated['status'] === 'active'
        ) {
            $driver->approved_at = now();
        }


        $driver->save();


        return back()->with(
            'success',
            'Driver status updated successfully.'
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FuelPartner;
use Illuminate\Http\Request;

class FuelPartnerController extends Controller
{
    //admin panel
    public function index()
    {
        $partners = FuelPartner::with('user')
            ->latest()
            ->paginate(15);

        return view(
            'admin.fuel_partners.show',
            compact('partners')
        );
    }

    public function show($id)
    {
        $partner = FuelPartner::with('user')
            ->findOrFail($id);

        return view(
            'admin.fuel_partners.details',
            compact('partner')
        );
    }

    public function approve($id)
    {
        $partner = FuelPartner::findOrFail($id);

        $partner->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Fuel partner approved successfully.'
        );
    }

    public function reject($id)
    {
        $partner = FuelPartner::findOrFail($id);

        $partner->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Fuel partner rejected.'
        );
    }

    public function suspend($id)
    {
        $partner = FuelPartner::findOrFail($id);

        $partner->update([
            'status' => 'suspended',
        ]);

        return back()->with(
            'success',
            'Fuel partner suspended.'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarWarranty;
use Illuminate\Support\Facades\Auth;

class CustomerWarrantyController extends Controller
{
    public function customerWarranties()
    {
        $warranties = CarWarranty::with([
                'car.carBrand',
                'importRequest'
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.warrenty', compact('warranties'));
    }
}
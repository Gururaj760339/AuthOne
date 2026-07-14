<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\Service;
use App\Models\RentalBooking;
use App\Models\FinanceRequests;
use App\Models\ImportRequest;
use App\Models\Contact;
use App\Models\Setting;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $setting = Setting::first();

        $totalCars = Car::count();
        $totalBrands = CarBrand::count();
        $totalServices = Service::count();
        $totalBookings = Booking::count();
        $totalRentalBookings = RentalBooking::count();
        $totalFinanceRequests = FinanceRequests::count();
        $totalImportRequests = ImportRequest::count();
        $totalContacts = Contact::count();

        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $latestFinanceRequests = FinanceRequests::with('car')
            ->latest()
            ->take(5)
            ->get();

        $latestImportRequests = ImportRequest::latest()
            ->take(5)
            ->get();

        return view('admin.admin_dashboard', compact(
            'setting',
            'totalCars',
            'totalBrands',
            'totalServices',
            'totalBookings',
            'totalRentalBookings',
            'totalFinanceRequests',
            'totalImportRequests',
            'totalContacts',
            'recentBookings',
            'latestFinanceRequests',
            'latestImportRequests'
        ));
    }
}

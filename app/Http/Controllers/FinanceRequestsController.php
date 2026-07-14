<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\FinanceRequests;
use App\Models\Setting;
use Illuminate\Http\Request;

class FinanceRequestsController extends Controller
{
    public function financeRequest()
    {
        $cars = Car::where('status', 1)->get();

        return view('finance.apply_finance', compact('cars'));
    }

    public function singleFinanceRequest($slug)
    {
        $cars = Car::where('slug', $slug)->get();

        $setting = Setting::first();

        return view('finance.apply_finance', compact('setting', 'cars'));
    }

    public function financeStore(Request $request)
    {
        $request->validate([
            'car_id'         => 'required|exists:cars,id',
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'salary'         => 'required|numeric|min:0',
            'employment'     => 'required|string|max:255',
            'down_payment'   => 'required|numeric|min:0',
        ]);

        FinanceRequests::create([
            'user_id'        => auth()->id(),
            'car_id'         => $request->car_id,
            'full_name'      => $request->full_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'salary'         => $request->salary,
            'employment'     => $request->employment,
            'down_payment'   => $request->down_payment,
            'status'         => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Finance request submitted successfully.');
    }

    public function AdminFinanceRequests()
    {
        $financeRequests = FinanceRequests::with('car')
            ->latest()
            ->get();

        return view('admin.finance_request.finance_request_show', compact('financeRequests'));
    }

    public function financeRequestStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $finance = FinanceRequests::findOrFail($id);

        $finance->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status updated successfully.');
    }


    public function financeRequestDelete($id)
    {
        FinanceRequests::findOrFail($id)->delete();

        return back()->with('success', 'Finance request deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\FinancePartner;
use App\Models\FinanceRequests;
use App\Models\Payment;
use App\Models\Setting;
use App\Notifications\FinanceRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceRequestsController extends Controller
{
    public function financeRequest()
    {
        $countryId = auth()->user()->country_id;
        $cars = Car::where('status', 1)
            ->where('country_id', $countryId)
            ->get();
        $partners = FinancePartner::get();

        return view('finance.apply_finance', compact('cars', 'partners'));
    }

    public function singleFinanceRequest($slug)
    {
        $cars = Car::where('slug', $slug)->get();
        $partners = FinancePartner::get();

        return view('finance.apply_finance', compact('cars', 'partners'));
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


        $finance = FinanceRequests::create([
            'user_id' => auth()->id(),
            'partner_id' => $request->finance_partner_id,
            'car_id' => $request->car_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'employment' => $request->employment,
            'down_payment' => $request->down_payment,
            'status' => 'Pending',
        ]);

        $user = Auth::user();

        $user->notify(new FinanceRequestNotification($finance));

        return redirect()->route('payment.choose.finance', $finance->id);
        //return redirect()->route('customer.cars');
    }

    public function AdminFinanceRequests()
    {
        $financeRequests = FinanceRequests::with('car')
            ->latest()
            ->get();

        return view('admin.finance_request.finance_request_show', compact('financeRequests'));
    }

    public function vendorFinanceRequests()
    {
        $financeRequests = FinanceRequests::with('car')
            ->whereHas('car', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })
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


    public function financeCalculate(Request $request)
    {
        $request->validate([
            'car_price' => 'required|numeric|min:1',
            'down_payment' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'months' => 'required|numeric|min:1',
        ]);

        $loan = $request->car_price - $request->down_payment;

        if ($loan <= 0) {
            return back()->withErrors([
                'car_price' => 'Down payment cannot be greater than or equal to car price.'
            ])->withInput();
        }

        $r = ($request->interest_rate / 100) / 12;

        if ($r == 0) {
            $emi = $loan / $request->months;
        } else {
            $emi = ($loan * $r * pow(1 + $r, $request->months))
                / (pow(1 + $r, $request->months) - 1);
        }

        $totalPayment = $emi * $request->months;
        $totalInterest = $totalPayment - $loan;

        $result = [
            'loan_amount' => number_format($loan, 2) . ' USD',
            'monthly_emi' => number_format($emi, 2) . ' USD',
            'total_interest' => number_format($totalInterest, 2) . ' USD',
            'total_payment' => number_format($totalPayment, 2) . ' USD',
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'loan_amount' => number_format($loan, 2) . ' USD',
                'monthly_emi' => number_format($emi, 2) . ' USD',
                'total_interest' => number_format($totalInterest, 2) . ' USD',
                'total_payment' => number_format($totalPayment, 2) . ' USD',
            ]
        ]);
    }
}

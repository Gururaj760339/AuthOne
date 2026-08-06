<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\FinancePartner;
use App\Models\ImportFinanceRequest;
use App\Models\ImportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ImportRequestNotification;

class ImportFinanceRequestController extends Controller
{
    public function CustomerImportFinanceCreate($importRequestId)
    {
        $importRequest = ImportRequest::with('car')->findOrFail($importRequestId);
        $car = $importRequest->car;

        $financePartners = FinancePartner::where('status', 1)->get();

        $loanAmount = $car->price - $importRequest->budget;

        return view(
            'import_request.import_finance_request',
            compact(
                'importRequest',
                'car',
                'financePartners',
                'loanAmount'
            )
        );
    }

    public function customerImportFinanceStore(Request $request)
    {
        $request->validate([
            'import_request_id' => 'required|exists:import_requests,id',
            'finance_partner_id' => 'required|exists:finance_partners,id',
            'loan_duration' => 'required|integer',
            'remarks' => 'nullable|string',
        ]);

        $importRequest = ImportRequest::findOrFail($request->import_request_id);

        $car = Car::findOrFail($importRequest->car_id);

        $monthlyPayment = ($car->price - $importRequest->budget) / $request->loan_duration;

        ImportFinanceRequest::create([

            'user_id' => Auth::id(),

            'import_request_id' => $importRequest->id,

            'finance_partner_id' => $request->finance_partner_id,

            'car_price' => $car->price,

            'loan_amount' => $car->price - $importRequest->budget,

            'down_payment' => $importRequest->budget,

            'loan_duration' => $request->loan_duration,

            'remarks' => $request->remarks,

            'monthly_payment' => $monthlyPayment,

            'status' => 'pending',
        ]);

        $user = Auth::user();
        $user->notify(new ImportRequestNotification($importRequest));

        return redirect()->route('payment.choose.car.import', $importRequest);
    }
}

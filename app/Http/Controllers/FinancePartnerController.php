<?php

namespace App\Http\Controllers;

use App\Models\FinancePartner;
use Illuminate\Http\Request;
use App\Models\FinanceRequests;
use App\Models\User;

class FinancePartnerController extends Controller
{
    public function financePartnerdashboard()
    {
        $partner = auth()->user()->financePartner;

        $requests = FinanceRequests::where(
            'partner_id',
            $partner->id
        )->latest()->get();


        return view(
            'finance_partner.finance_partner_dashboard',
            compact('requests', 'partner')
        );
    }


    public function showFinancePartner()
    {

        $partners = FinancePartner::with('user')
            ->whereNotNull('user_id')
            ->latest()
            ->get();


        return view(
            'admin.finance_partner.show_finance_partner',
            compact('partners')
        );
    }

    public function addFinancePartnerFrom()
    {

        // only finance partner role users
        $users = User::where('role', 'finance_partner')
            ->get();


        // default bank list
        $banks = FinancePartner::whereNull('user_id')
            ->get();


        return view(
            'admin.finance_partner.add_finance_partner_form',
            compact('users', 'banks')
        );
    }


    public function financePartnerStore(Request $request)
    {
        $request->validate([

            'user_id' => 'required',
            'bank_id' => 'required',

        ]);

        FinancePartner::where(
            'id',
            $request->bank_id
        )
            ->update([

                'user_id' => $request->user_id

            ]);

        return redirect()
            ->route('admin.finance.partner')
            ->with(
                'success',
                'Finance Partner Assigned Successfully'
            );
    }

    public function financePartnerDestroy($id)
    {
        $partner = FinancePartner::findOrFail($id);


        $partner->update([
            'user_id' => null
        ]);


        return redirect()
            ->route('admin.finance.partner')
            ->with(
                'success',
                'Finance Partner Removed Successfully'
            );
    }

    public function financeRequests()
    {
        $partner = FinancePartner::where('user_id', auth()->id())->firstOrFail();

        $requests = FinanceRequests::with([
            'user',
            'car.carBrand'
        ])
            ->where('partner_id', $partner->id)
            ->latest()
            ->paginate(10);

        return view('finance_partner.show_finance_partner_request', compact('partner', 'requests'));
    }

    public function approveFinanceRequest($id)
    {
        $request = FinanceRequests::findOrFail($id);

        $request->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Finance request approved successfully.');
    }

    public function rejectFinanceRequest($id)
    {
        $request = FinanceRequests::findOrFail($id);

        $request->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Finance request rejected successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKycController extends Controller
{
    /**
     * All KYC List
     */
    public function showKycs()
    {
        $kycs = KycVerification::with('user')
            ->latest()
            ->paginate(15);

        return view('admin.kyc.show_kycs', compact('kycs'));
    }

    /**
     * Show Single KYC
     */
    public function showKyc($id)
    {
        $kyc = KycVerification::with('user')->findOrFail($id);

        return view('admin.kyc.show_kyc', compact('kyc'));
    }

    /**
     * Approve KYC
     */
    public function approveKyc($id)
    {
        $kyc = KycVerification::findOrFail($id);

        $kyc->status = 'verified';
        $kyc->verified_by = Auth::id();
        $kyc->verified_at = now();
        $kyc->rejection_reason = null;

        $kyc->save();

        return redirect()
            ->route('admin.kycs.show')
            ->with('success', 'KYC verified successfully.');
    }

    /**
     * Reject KYC
     */
    public function rejectKyc(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $kyc = KycVerification::findOrFail($id);

        $kyc->status = 'rejected';
        $kyc->verified_by = Auth::id();
        $kyc->verified_at = now();
        $kyc->rejection_reason = $request->rejection_reason;

        $kyc->save();

        return redirect()
            ->route('admin.kycs.show', $id)
            ->with('success', 'KYC rejected successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KycVerificationController extends Controller
{
    /**
     * Show KYC form
     */
    public function createKyc()
    {
        $kyc = KycVerification::where('user_id', Auth::id())->first();

        return view('customer.kyc.create_kyc', compact('kyc'));
    }

    /**
     * Store KYC
     */
    public function storeKyc(Request $request)
    {
        $request->validate([
            'driver_license_front' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'driver_license_back'  => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'national_id'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'passport'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'selfie'               => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if (KycVerification::where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already submitted your KYC.');
        }

        $kyc = new KycVerification();

        $kyc->user_id = Auth::id();

        $kyc->driver_license_front = $request
            ->file('driver_license_front')
            ->store('kyc/licenses', 'public');

        $kyc->driver_license_back = $request
            ->file('driver_license_back')
            ->store('kyc/licenses', 'public');

        if ($request->hasFile('national_id')) {
            $kyc->national_id = $request
                ->file('national_id')
                ->store('kyc/national_ids', 'public');
        }

        if ($request->hasFile('passport')) {
            $kyc->passport = $request
                ->file('passport')
                ->store('kyc/passports', 'public');
        }

        if ($request->hasFile('selfie')) {
            $kyc->selfie = $request
                ->file('selfie')
                ->store('kyc/selfies', 'public');
        }

        $kyc->status = 'pending';

        $kyc->save();

        return redirect()
            ->back()
            ->with('success', 'KYC submitted successfully. Please wait for admin approval.');
    }

    /**
     * View own KYC
     */
    public function showKyc()
    {
        $kyc = KycVerification::where('user_id', Auth::id())->first();

        if (!$kyc) {
            return "No KYC Found";
        }

        return view('customer.kyc.show_kyc', compact('kyc'));
    }

    /**
     * Delete KYC (only if pending/rejected)
     */
    public function destroyKyc()
    {
        $kyc = KycVerification::where('user_id', Auth::id())->firstOrFail();

        if ($kyc->status == 'verified') {
            return back()->with('error', 'Verified KYC cannot be deleted.');
        }

        foreach (
            [
                'driver_license_front',
                'driver_license_back',
                'national_id',
                'passport',
                'selfie'
            ] as $file
        ) {
            if ($kyc->$file && Storage::disk('public')->exists($kyc->$file)) {
                Storage::disk('public')->delete($kyc->$file);
            }
        }

        $kyc->delete();

        return back()->with('success', 'KYC deleted successfully.');
    }
}

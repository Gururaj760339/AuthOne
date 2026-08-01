<?php

namespace App\Http\Controllers;

use App\Models\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserVerificationController extends Controller
{
    // Verification Form
    public function createVerification()
    {
        return view('customer.verification.create');
    }

    // Submit Verification
    public function storeVerification(Request $request)
    {
        $oldVerification = UserVerification::where('user_id', auth()->id())->first();

        if ($oldVerification) {

            if ($oldVerification->status == 'approved') {
                return back()->with('error', 'Your account is already verified.');
            }

            Storage::disk('public')->delete([
                $oldVerification->nid_front_image,
                $oldVerification->nid_back_image,
                $oldVerification->driving_license_image,
                $oldVerification->selfie_image,
            ]);

            $oldVerification->delete();
        }

        $request->validate([
            'nid_number' => 'required|unique:user_verifications,nid_number',
            'nid_front_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nid_back_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'driving_license_number' => 'required|unique:user_verifications,driving_license_number',
            'driving_license_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'selfie_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $verification = new UserVerification();

        $verification->user_id = auth()->id();
        $verification->nid_number = $request->nid_number;
        $verification->driving_license_number = $request->driving_license_number;

        $verification->nid_front_image = $request->file('nid_front_image')
            ->store('verifications/nid', 'public');

        $verification->nid_back_image = $request->file('nid_back_image')
            ->store('verifications/nid', 'public');

        $verification->driving_license_image = $request->file('driving_license_image')
            ->store('verifications/license', 'public');

        if ($request->hasFile('selfie_image')) {
            $verification->selfie_image = $request->file('selfie_image')
                ->store('verifications/selfie', 'public');
        }

        $verification->status = 'pending';
        $verification->save();

        return redirect()->back()->with('success', 'Verification submitted successfully.');
    }

    // Admin Pending List
    public function UserVerificationList()
    {
        $verifications = UserVerification::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.verification.all_users', compact('verifications'));
    }

    public function singleUserVerificationList($id)
    {
        $verification = UserVerification::with('user')->findOrFail($id);

        return view('admin.verification.single_user', compact('verification'));
    }

    // Admin Approve
    public function approveUser($id)
    {
        $verification = UserVerification::findOrFail($id);

        $verification->update([
            'status' => 'approved',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'User verified successfully.');
    }

    // Admin Reject
    public function rejectUser(Request $request, $id)
    {
        $verification = UserVerification::findOrFail($id);

        $verification->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
        ]);

        return redirect()->back()->with('success', 'Verification rejected.');
    }
}

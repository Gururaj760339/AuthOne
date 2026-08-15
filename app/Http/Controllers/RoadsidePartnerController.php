<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RoadsideProvider;
use App\Models\RoadsideService;
use App\Models\RoadsideAssistance;
use App\Models\RoadsideRequest;

class RoadsidePartnerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Partner Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Find Roadside Provider
        |--------------------------------------------------------------------------
        */

        $provider = RoadsideProvider::where('user_id', $user->id)->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | New Requests
        |--------------------------------------------------------------------------
        */

        $newRequests = RoadsideRequest::where('provider_id', $provider->id)
            ->whereIn('status', ['pending', 'searching'])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Active Requests
        |--------------------------------------------------------------------------
        */

        $activeRequests = RoadsideRequest::where('provider_id', $provider->id)
            ->whereIn('status', [
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Completed Requests
        |--------------------------------------------------------------------------
        */

        $completedRequests = RoadsideRequest::where('provider_id', $provider->id)
            ->where('status', 'completed')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Earnings
        |--------------------------------------------------------------------------
        */

        $totalEarnings = RoadsideRequest::where('provider_id', $provider->id)
            ->where('status', 'completed')
            ->sum('final_cost');

        /*
        |--------------------------------------------------------------------------
        | Recent Requests
        |--------------------------------------------------------------------------
        */

        $requests = RoadsideRequest::with('user')
            ->where('provider_id', $provider->id)
            ->whereIn('status', [
                'pending',
                'searching',
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Active Services
        |--------------------------------------------------------------------------
        */

        $activeServices = RoadsideRequest::with('user')
            ->where('provider_id', $provider->id)
            ->whereIn('status', [
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('Roadside_partner.dashboard', compact(
            'provider',
            'newRequests',
            'activeRequests',
            'completedRequests',
            'totalEarnings',
            'requests',
            'activeServices'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Availability
    |--------------------------------------------------------------------------
    */

    public function toggleAvailability()
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $provider->is_available = !$provider->is_available;

        $provider->save();

        return back()->with(
            'success',
            $provider->is_available
                ? 'You are now available for roadside requests.'
                : 'You are now offline.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | New Requests
    |--------------------------------------------------------------------------
    */

    public function requests()
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $requests = RoadsideRequest::with('user')
            ->where(function ($query) use ($provider) {

                $query->whereNull('provider_id')
                    ->orWhere('provider_id', $provider->id);
            })
            ->whereIn('status', [
                'pending',
                'searching'
            ])
            ->latest()
            ->paginate(10);

        return view(
            'roadside_partner.requests',
            compact('provider', 'requests')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Request Details
    |--------------------------------------------------------------------------
    */

    public function showRequest($id)
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $request = RoadsideRequest::with([
            'user'
        ])->findOrFail($id);

        return view('roadside_partner.request-details', compact('provider', 'request'));
    }


    /*
    |--------------------------------------------------------------------------
    | Accept Roadside Request
    |--------------------------------------------------------------------------
    */

    public function accept($id)
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Provider Must Be Available
        |--------------------------------------------------------------------------
        */

        if (!$provider->is_available) {

            return back()->with(
                'error',
                'You are currently offline. Please become available first.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Request
        |--------------------------------------------------------------------------
        */

        $roadsideRequest = RoadsideRequest::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Prevent Already Accepted Request
        |--------------------------------------------------------------------------
        */


        //dd('complete');

        if (
            $roadsideRequest->provider_id == null ||
            !in_array($roadsideRequest->status, [
                'pending',
                'searching'
            ])
        ) {

            return back()->with(
                'error',
                'This roadside request is no longer available.'
            );
        }



        /*
        |--------------------------------------------------------------------------
        | Assign Provider
        |--------------------------------------------------------------------------
        */

        $roadsideRequest->provider_id = $provider->id;
        $roadsideRequest->status = 'accepted';
        $roadsideRequest->accepted_at = now();

        $roadsideRequest->save();

        return redirect()
            ->route(
                'partner.roadside.requests',
                $roadsideRequest->id
            )
            ->with(
                'success',
                'Roadside assistance request accepted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Active Services
    |--------------------------------------------------------------------------
    */

    public function activeServices()
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $services = RoadsideRequest::with('user')
            ->where('provider_id', $provider->id)
            ->whereIn('status', [
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->latest()
            ->paginate(10);

        return view(
            'roadside_partner.active-services',
            compact('provider', 'services')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Request Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        // Get logged-in roadside provider
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();


        /*
    |--------------------------------------------------------------------------
    | Validate Status
    |--------------------------------------------------------------------------
    */

        $validated = $request->validate([
            'status' => 'required|in:on_the_way,arrived,in_progress,completed',

            // Only required when completing the job
            'amount' => 'nullable|numeric|min:0',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Only Provider's Own Request
    |--------------------------------------------------------------------------
    */

        $roadsideRequest = RoadsideRequest::where(
            'provider_id',
            $provider->id
        )->findOrFail($id);


        $currentStatus = $roadsideRequest->status;

        $newStatus = $validated['status'];


        /*
    |--------------------------------------------------------------------------
    | Allowed Status Flow
    |--------------------------------------------------------------------------
    |
    | accepted
    |    ↓
    | on_the_way
    |    ↓
    | arrived
    |    ↓
    | in_progress
    |    ↓
    | completed
    |
    */

        $allowedTransitions = [

            'accepted' => [
                'on_the_way',
            ],

            'on_the_way' => [
                'arrived',
            ],

            'arrived' => [
                'in_progress',
            ],

            'in_progress' => [
                'completed',
            ],

        ];


        /*
    |--------------------------------------------------------------------------
    | Check Status Transition
    |--------------------------------------------------------------------------
    */

        if (
            !isset($allowedTransitions[$currentStatus]) ||
            !in_array(
                $newStatus,
                $allowedTransitions[$currentStatus],
                true
            )
        ) {

            return back()->with(
                'error',
                "Cannot change status from {$currentStatus} to {$newStatus}."
            );
        }


        /*
    |--------------------------------------------------------------------------
    | Completed - Amount Required
    |--------------------------------------------------------------------------
    */

        if ($newStatus === 'completed') {

            if (
                !isset($validated['amount']) ||
                $validated['amount'] === null
            ) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Please enter the final service amount.'
                    );
            }


            $amount = $validated['amount'];

            // Example: AutoOne commission = 10%
            $platformFee = $amount * 0.10;

            //$providerAmount = $amount - $platformFee;


            $roadsideRequest->estimated_cost = $amount;

            //$roadsideRequest->platform_fee = $platformFee;

            $roadsideRequest->final_cost = $platformFee + $amount;
        }


        /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

        $roadsideRequest->status = $newStatus;


        /*
    |--------------------------------------------------------------------------
    | Update Timestamp
    |--------------------------------------------------------------------------
    */

        switch ($newStatus) {

            case 'on_the_way':

                $roadsideRequest->on_the_way_at = now();

                break;


            case 'arrived':

                $roadsideRequest->arrived_at = now();

                break;


            case 'in_progress':

                $roadsideRequest->started_at = now();

                break;


            case 'completed':

                $roadsideRequest->completed_at = now();

                break;
        }


        /*
    |--------------------------------------------------------------------------
    | Save
    |--------------------------------------------------------------------------
    */

        $roadsideRequest->save();


        /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

        return back()->with(
            'success',
            'Service status updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Completed Services
    |--------------------------------------------------------------------------
    */

    public function completedServices()
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $services = RoadsideRequest::with('user')
            ->where('provider_id', $provider->id)
            ->where('status', 'completed')
            ->latest('completed_at')
            ->paginate(15);

        return view(
            'roadside_partner.completed-services',
            compact('provider', 'services')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Earnings
    |--------------------------------------------------------------------------
    */

    public function earnings()
    {
        $provider = RoadsideProvider::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Total Earnings
        |--------------------------------------------------------------------------
        */

        $totalEarnings = RoadsideRequest::where(
            'provider_id',
            $provider->id
        )
            ->where('status', 'completed')
            ->sum('final_cost');

        /*
        |--------------------------------------------------------------------------
        | Monthly Earnings
        |--------------------------------------------------------------------------
        */

        $monthlyEarnings = RoadsideRequest::where(
            'provider_id',
            $provider->id
        )
            ->where('status', 'completed')
            ->whereMonth(
                'completed_at',
                now()->month
            )
            ->whereYear(
                'completed_at',
                now()->year
            )
            ->sum('final_cost');

        /*
        |--------------------------------------------------------------------------
        | Completed Services Count
        |--------------------------------------------------------------------------
        */

        $completedServices = RoadsideRequest::where(
            'provider_id',
            $provider->id
        )
            ->where('status', 'completed')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Earnings History
        |--------------------------------------------------------------------------
        */

        $earnings = RoadsideRequest::where(
            'provider_id',
            $provider->id
        )
            ->where('status', 'completed')
            ->latest('completed_at')
            ->paginate(15);

        return view(
            'roadside_partner.earnings',
            compact(
                'provider',
                'totalEarnings',
                'monthlyEarnings',
                'completedServices',
                'earnings'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Partner List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = RoadsideProvider::with('user');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Verification Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('verification')) {

            if ($request->verification === 'verified') {

                $query->where('is_verified', true);
            } elseif ($request->verification === 'pending') {

                $query->where('is_verified', false);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Availability Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('availability')) {

            if ($request->availability === 'available') {

                $query->where('is_available', true);
            } elseif ($request->availability === 'offline') {

                $query->where('is_available', false);
            }
        }


        $partners = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalPartners = RoadsideProvider::count();

        $verifiedPartners = RoadsideProvider::where(
            'is_verified',
            true
        )->count();

        $pendingPartners = RoadsideProvider::where(
            'is_verified',
            false
        )->count();

        $availablePartners = RoadsideProvider::where(
            'is_available',
            true
        )->count();

        $offlinePartners = RoadsideProvider::where(
            'is_available',
            false
        )->count();


        return view(
            'admin.roadside.partner.show',
            compact(
                'partners',
                'totalPartners',
                'verifiedPartners',
                'pendingPartners',
                'availablePartners',
                'offlinePartners'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Partner Details
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $partner = RoadsideProvider::with([
            'user'
        ])->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Request Statistics
        |--------------------------------------------------------------------------
        */

        $totalRequests = $partner->requests()->count();

        $completedRequests = $partner->requests()
            ->where('status', 'completed')
            ->count();

        $activeRequests = $partner->requests()
            ->whereIn('status', [
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->count();

        $cancelledRequests = $partner->requests()
            ->where('status', 'cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

        // $totalEarnings = $partner->requests()
        //     ->where('status', 'completed')
        //     ->sum('final_cost');


        $totalRevenue = $partner->requests()
            ->where('status', 'completed')
            ->sum('final_cost');

        $totalEarnings = $partner->requests()
            ->where('status', 'completed')
            ->sum('estimated_cost');

        $totalPlatformFee = $totalRevenue - $totalEarnings;

        

        // $totalRevenue = $partner->requests()
        //     ->where('status', 'completed')
        //     ->sum('estimated_cost');


        // $totalPlatformFee = $partner->requests()
        //     ->where('status', 'completed')
        //     ->sum('platform_fee');


        return view(
            'admin.roadside.partner.details',
            compact(
                'partner',
                'totalRequests',
                'completedRequests',
                'activeRequests',
                'cancelledRequests',
                'totalEarnings',
                'totalRevenue',
                'totalPlatformFee'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Approve Partner
    |--------------------------------------------------------------------------
    */

    public function approve($id)
    {
        $partner = RoadsideProvider::findOrFail($id);


        $partner->update([
            'is_verified' => true,
            'is_available' => true,
        ]);


        return back()->with(
            'success',
            'Roadside partner approved successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Reject / Unverify Partner
    |--------------------------------------------------------------------------
    */

    public function reject($id)
    {
        $partner = RoadsideProvider::findOrFail($id);


        $partner->update([
            'is_verified' => false,
            'is_available' => false,
        ]);


        return back()->with(
            'success',
            'Roadside partner rejected successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Activate Partner
    |--------------------------------------------------------------------------
    */

    public function activate($id)
    {
        $partner = RoadsideProvider::findOrFail($id);


        if (!$partner->is_verified) {

            return back()->with(
                'error',
                'Verify the partner before activating.'
            );
        }


        $partner->update([
            'is_available' => true,
        ]);


        return back()->with(
            'success',
            'Roadside partner activated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Deactivate Partner
    |--------------------------------------------------------------------------
    */

    public function deactivate($id)
    {
        $partner = RoadsideProvider::findOrFail($id);


        $partner->update([
            'is_available' => false,
        ]);


        return back()->with(
            'success',
            'Roadside partner deactivated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Partner
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $partner = RoadsideProvider::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Prevent Delete If Active Requests Exist
        |--------------------------------------------------------------------------
        */

        $activeRequests = $partner->requests()
            ->whereIn('status', [
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress'
            ])
            ->exists();


        if ($activeRequests) {

            return back()->with(
                'error',
                'This partner has active roadside requests. '
                    . 'Complete them before deleting the partner.'
            );
        }


        $partner->delete();


        return redirect()
            ->route('admin.roadside.partners.index')
            ->with(
                'success',
                'Roadside partner deleted successfully.'
            );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\RoadsideProvider;
use App\Models\RoadsideRequest;
use Illuminate\Http\Request;

class RoadsideRequestController extends Controller
{

    public function location()
    {
        return view('customer.roadside.location');
    }

    public function showProvider(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $providers = RoadsideProvider::where('is_available', true)
            ->where('is_verified', true)

            // Provider location must exist
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')

            ->select('roadside_providers.*')

            ->selectRaw(
                '(6371 * acos(
                cos(radians(?))
                * cos(radians(latitude))
                * cos(radians(longitude) - radians(?))
                + sin(radians(?))
                * sin(radians(latitude))
            )) AS distance',
                [
                    $latitude,
                    $longitude,
                    $latitude
                ]
            )

            ->orderBy('distance', 'asc')
            ->limit(5)
            ->get();

        return view(
            'customer.roadside.service',
            compact(
                'providers',
                'latitude',
                'longitude'
            )
        );
    }


    public function createRequest(Request $request, $providerId)
    {
        // Selected provider
        $provider = RoadsideProvider::where('id', $providerId)
            ->where('is_available', true)
            ->where('is_verified', true)
            ->firstOrFail();

        // Customer GPS location
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $vehicles = Car::with('carBrand')->get();

        return view(
            'customer.roadside.request',
            compact(
                'provider',
                'latitude',
                'longitude',
                'vehicles'
            )
        );
    }


    public function roadsideRequestStore(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'nullable|exists:roadside_providers,id',
            'vehicle_id' => 'nullable|exists:cars,id',
            'assistance_type' => 'required|in:flat_tire,battery,fuel_delivery,engine_problem,lockout,accident,towing,other',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'nullable|string',
            'priority' => 'required|in:normal,urgent,emergency',
        ]);

        $roadside = RoadsideRequest::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $validated['vehicle_id'] ?? null,
            'assistance_type' => $validated['assistance_type'],
            'description' => $validated['description'] ?? null,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'address' => $validated['address'] ?? null,
            'priority' => $validated['priority'],
            'status' => 'pending',
            'provider_id' => $validated['provider_id']
        ]);

        return redirect()->route('customer.profile');
    }


    public function index(Request $request)
    {
        $query = RoadsideRequest::with([
            'user',
            'provider'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('vehicle_number', 'like', "%{$search}%")
                    ->orWhere('service', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Requests
        |--------------------------------------------------------------------------
        */

        $requests = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalRequests = RoadsideRequest::count();

        $pendingRequests = RoadsideRequest::where(
            'status',
            'pending'
        )->count();

        $acceptedRequests = RoadsideRequest::where(
            'status',
            'accepted'
        )->count();

        $activeRequests = RoadsideRequest::whereIn(
            'status',
            [
                'on_the_way',
                'arrived',
                'in_progress'
            ]
        )->count();

        $completedRequests = RoadsideRequest::where(
            'status',
            'completed'
        )->count();


        return view(
            'admin.roadside.request.show',
            compact(
                'requests',
                'totalRequests',
                'pendingRequests',
                'acceptedRequests',
                'activeRequests',
                'completedRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Request Details
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $roadsideRequest = RoadsideRequest::with([
            'user',
            'provider'
        ])->findOrFail($id);


        return view(
            'admin.roadside.request.details',
            compact('roadsideRequest')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Cancel Request
    |--------------------------------------------------------------------------
    */

    public function cancel($id)
    {
        $roadsideRequest = RoadsideRequest::findOrFail($id);


        if ($roadsideRequest->status === 'completed') {

            return back()->with(
                'error',
                'Completed request cannot be cancelled.'
            );
        }


        $roadsideRequest->update([
            'status' => 'cancelled'
        ]);


        return back()->with(
            'success',
            'Roadside request cancelled successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Request
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $roadsideRequest = RoadsideRequest::findOrFail($id);

        $roadsideRequest->delete();


        return redirect()
            ->route('admin.roadside.requests.index')
            ->with(
                'success',
                'Roadside request deleted successfully.'
            );
    }
}

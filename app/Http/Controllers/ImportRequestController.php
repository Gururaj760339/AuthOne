<?php

namespace App\Http\Controllers;

use App\Models\ImporteRequest;
use App\Models\ImportRequest;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\ImportRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ShippoService;
use App\Models\Car;
use App\Models\CarWarranty;
use Carbon\Carbon;

class ImportRequestController extends Controller
{
    public function customerImporteRequestCreate()
    {
        $users = User::all();
        $cars = Car::all();

        return view('import_request.import_request_create', compact('users', 'cars'));
    }



    public function customerImporteRequestStore(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'car_id' => 'required|exists:cars,id',
            'down_payment' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $car = Car::where('id', $request->car_id)->first();

        $importRequest = ImportRequest::create([
            'user_id' => Auth::id(),
            'country' => $request->country,
            //'car_name' => $car->name,
            'car_id' => $request->car_id,
            'budget' => $request->down_payment,
            'notes' => $request->notes,
            'status' => 'Pending',
        ]);



        if ($request->down_payment < $car->price) {

            return redirect()->route(
                'customer.import.finance.create',
                $importRequest->id
            );
        }
    }

    public function customerShowImporte()
    {
        $requests = ImportRequest::where('status', 'Completed')
            ->latest()
            ->get();

        $import_requests = ImportRequest::where('status', 'Completed')
            ->latest()
            ->first();

        // Recommended Import Requests
        $recommendedImports = ImportRequest::where('status', 'Completed')
            ->latest()
            ->take(4)
            ->get();

        $setting = Setting::first();

        return view('import_request.car_imports', compact(
            'setting',
            'requests',
            'import_requests',
            'recommendedImports'
        ));
    }

    public function adminImportRequestShow()
    {
        $requests = ImportRequest::latest()->get();

        return view('admin.import_request.admin_import_request_show', compact('requests'));
    }


    public function adminImportRequestUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $importRequest = ImportRequest::with('car')->findOrFail($id);

        $importRequest->status = $request->status;
        $importRequest->save();

        // Warranty Create After Delivery
        if ($request->status == 'Delivered') {

            $exists = CarWarranty::where('import_request_id', $importRequest->id)->exists();

            if (!$exists) {

                CarWarranty::create([
                    'user_id' => $importRequest->user_id,
                    'car_id' => $importRequest->car_id,
                    'import_request_id' => $importRequest->id,

                    'start_date' => now(),

                    'end_date' => Carbon::now()->addMonths(
                        $importRequest->car->manufacturer_warranty_months
                    ),

                    'duration_months' => $importRequest->car->manufacturer_warranty_months,

                    'max_km' => $importRequest->car->manufacturer_warranty_km,

                    'type' => 'Manufacturer',

                    'status' => 'Active',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Status Updated Successfully.');
    }

    public function adminImportRequestDestroy($id)
    {
        $importRequest = ImportRequest::findOrFail($id);

        $importRequest->delete();

        return redirect()->back()->with('success', 'Request Deleted Successfully.');
    }

    public function customerProfileImportRequests()
    {
        $importRequests = ImportRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.import_request', compact('importRequests'));
    }


    protected ShippoService $shippo;

    public function __construct(ShippoService $shippo)
    {
        $this->shippo = $shippo;
    }

    /**
     * Create Shipment
     */
    public function shipment($id)
    {
        try {

            //dd('Step 1');

            $importRequest = ImportRequest::findOrFail($id);

            //dd('Step 2');

            $rate = $this->shippo->createShipment($id);

            //dd($rate);

            $transaction = $this->shippo->createTransaction(
                $rate['object_id'],
                $importRequest,
                $rate['provider']
            );

            //dd($transaction);

            $this->shippo->saveTracking($importRequest, $transaction);

            return back()->with('success', 'Shipment created successfully.');
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }

    /**
     * Update Tracking Status
     */
    public function tracking($id)
    {
        try {

            $importRequest = ImportRequest::findOrFail($id);

            //dd($importRequest->carrier, $importRequest->tracking_number);

            $status = $this->shippo->getTracking(
                $importRequest->carrier,
                $importRequest->tracking_number
            );

            $importRequest->update([
                'tracking_status' => $status['tracking_status']['status'] ?? 'Unknown',
            ]);

            return back()->with('success', 'Tracking updated successfully.');
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }
}

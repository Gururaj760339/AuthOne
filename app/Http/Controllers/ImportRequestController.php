<?php

namespace App\Http\Controllers;

use App\Models\ImporteRequest;
use App\Models\ImportRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportRequestController extends Controller
{
    public function customerImporteRequestCreate()
    {
        $users = User::all();

        return view('import_request.import_request_create', compact('users'));
    }


    public function customerImporteRequestStore(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'car_name' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        ImportRequest::create([
            'user_id' => Auth::id(),
            'country' => $request->country,
            'car_name' => $request->car_name,
            'budget' => $request->budget,
            'notes' => $request->notes,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Import request submitted successfully.');
    }

    public function customerShowImporte()
    {
        $requests = ImportRequest::where('status', 'Completed')->get();
        $import_requests = ImportRequest::where('status', 'Completed')->first();
        $setting = Setting::first();

        return view('import_request.car_imports', compact('import_requests', 'setting', 'requests'));
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

        $importRequest = ImportRequest::findOrFail($id);

        $importRequest->status = $request->status;
        $importRequest->save();

        return redirect()->back()->with('success', 'Status Updated Successfully.');
    }

    public function adminImportRequestDestroy($id)
    {
        $importRequest = ImportRequest::findOrFail($id);

        $importRequest->delete();

        return redirect()->back()->with('success', 'Request Deleted Successfully.');
    }
}

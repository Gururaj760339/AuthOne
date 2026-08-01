<?php

namespace App\Http\Controllers;

use App\Models\UserCar;
use Illuminate\Http\Request;
use App\Models\UserVerification;
use Illuminate\Support\Facades\Storage;

class P2PCarController extends Controller
{

    // customer section
    public function showCars()
    {
        $verification = UserVerification::where('user_id', auth()->id())->first();

        if ($verification) {

            if ($verification->status == 'pending') {
                return view('customer.verification.pending', compact('verification'));
            }

            if ($verification->status == 'rejected') {
                return view('customer.verification.reject', compact('verification'));
            }
        }

        if (!$verification) {
            return redirect()
                ->route('p2p.verifications.create')
                ->with('error', 'Please verify your account first.');
        }

        $cars = UserCar::where('status', 'approved')
            ->where('is_available', 1)
            ->latest()
            ->paginate(6);

        return view('customer.p2p.show_cars', compact('cars'));
    }

    public function carCreate()
    {
        return view('customer.p2p.car_create');
    }

    public function storeCar(Request $request)
    {
        $verifications = UserVerification::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->first();

        if (!$verifications) {
            return back()->with('error', 'Only verified users can list cars.');
        }

        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'registration_no' => 'required|unique:user_cars',
            'price_per_day' => 'required|numeric',
            'main_image' => 'nullable|image'
        ]);

        $image = null;

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image')
                ->store('p2p', 'public');
        }

        UserCar::create([
            'user_id' => auth()->id(),
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'registration_no' => $request->registration_no,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
            'color' => $request->color,
            'fuel_type' => $request->fuel_type,
            'main_image' => $image,
            'status' => 'pending'
        ]);

        return redirect()->route('p2p.cars.show')
            ->with('success', 'Car submitted for approval.');
    }

    public function carDestroy($id)
    {
        $car = UserCar::findOrFail($id);

        if ($car->user_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($car->main_image && Storage::disk('public')->exists($car->main_image)) {
            Storage::disk('public')->delete($car->main_image);
        }

        $car->delete();

        return redirect()
            ->route('p2p.cars.show')
            ->with('success', 'Car deleted successfully.');
    }

    // admin section

     public function showAdminAllCars()
    {
        $cars = UserCar::with('user')
                    ->latest()
                    ->get();

        return view('admin.p2p.all_cars', compact('cars'));
    }

    // Single Car Details
    public function showAdminSingleCar($id)
    {
        $car = UserCar::with('user')->findOrFail($id);

        return view('admin.p2p.single_car', compact('car'));
    }

    // Approve Car
    public function approveAdminCar($id)
    {
        $car = UserCar::findOrFail($id);

        $car->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('admin.p2p.cars.show')
            ->with('success', 'Car approved successfully.');
    }

    // Reject Car
    public function rejectAdminCar(Request $request, $id)
    {

        $car = UserCar::findOrFail($id);

        $car->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.p2p.cars.show')
            ->with('success', 'Car rejected successfully.');
    }
}

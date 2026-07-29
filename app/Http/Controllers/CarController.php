<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\FinanceRequests;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public function vehicleDetails($slug)
    {
        $car = Car::with(['carBrand', 'CarImages'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $relatedCars = Car::where('brand_id', $car->brand_id)
            ->where('id', '!=', $car->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        $setting = Setting::first();

        return view('vehicle_details', compact('setting', 'car', 'relatedCars'));
    }

    public function showAdminCar()
    {
        $cars = Car::with('CarBrand')->latest()->get();

        return view('admin.car.car_show', compact('cars'));
    }

    public function showVendorCar()
    {
        $cars = Car::with('CarBrand')
            ->where('vendor_id', Auth::user()->vendor->id)
            ->latest()->get();

        return view('admin.car.car_show', compact('cars'));
    }


    public function carCustomerShow()
    {
        $brands = CarBrand::orderBy('name')->get();

        $cars = Car::with('CarBrand')
            ->latest()
            ->paginate(9);

        $finance = FinanceRequests::where('status', 'Approved')->first();

        $setting = Setting::first();

        $featuredCars = Car::latest()->take(6)->get();

        return view('buy_&_finance_cars', compact(
            'setting',
            'finance',
            'cars',
            'brands',
            'featuredCars'
        ));
    }

    public function customerCarFilter(Request $request)
    {
        $query = Car::with('CarBrand')
            ->where('status', 1);

        // Brand Filter
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Fuel Filter
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Condition Filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Minimum Price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Maximum Price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $cars = $query->latest()->paginate(12);

        $brands = CarBrand::orderBy('name')->get();

        $finance = FinanceRequests::where('status', 'Approved')->first();

        $setting = Setting::first();

        $featuredCars = Car::latest()->take(6)->get();

        return view('buy_&_finance_cars', compact('finance', 'setting', 'cars', 'brands', 'featuredCars'));
    }

    public function carAddForm()
    {
        $brands = CarBrand::with('cars')->orderBy('name')->get();

        return view('admin.car.add_car', compact('brands'));
    }

    public function Carstore(Request $request)
    {
        $request->validate([
            'brand_id'      => 'required|exists:car_brands,id',
            'title'         => 'required|max:255',
            'price'         => 'required|numeric',
            'year'          => 'required|digits:4',
            'fuel_type'     => 'required',
            'transmission'  => 'required',
            'mileage'       => 'required|numeric',
            'engine'        => 'required|max:100',
            'horsepower'    => 'required|max:100',
            'color'         => 'required|max:100',
            'condition'     => 'required',
            'description'   => 'required',
            'thumbnail'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail')
                ->store('cars', 'public');
        }

        Car::create([
            'brand_id'      => $request->brand_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . time(),
            'price'         => $request->price,
            'year'          => $request->year,
            'fuel_type'     => $request->fuel_type,
            'transmission'  => $request->transmission,
            'mileage'       => $request->mileage,
            'engine'        => $request->engine,
            'horsepower'    => $request->horsepower,
            'color'         => $request->color,
            'condition'     => $request->condition,
            'description'   => $request->description,
            'thumbnail'     => $image,
            'vendor_id'     => Auth::user()->vendor->id
        ]);

        return redirect()
            ->route('vendor.cars')
            ->with('success', 'Car Added Successfully.');
    }

    public function carEdit($id)
    {
        $car = Car::findOrFail($id);
        $brands = CarBrand::orderBy('name')->get();

        return view('admin.car.edit_car', compact('car', 'brands'));
    }


    public function updateCar(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand_id'      => 'required|exists:car_brands,id',
            'title'         => 'required|max:255',
            'price'         => 'required|numeric',
            'year'          => 'required|digits:4',
            'fuel_type'     => 'required',
            'transmission'  => 'required',
            'mileage'       => 'required|numeric',
            'engine'        => 'required|max:100',
            'horsepower'    => 'required|max:100',
            'color'         => 'required|max:100',
            'condition'     => 'required',
            'description'   => 'required',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = $car->thumbnail;

        if ($request->hasFile('thumbnail')) {

            if ($car->thumbnail && Storage::disk('public')->exists($car->thumbnail)) {
                Storage::disk('public')->delete($car->thumbnail);
            }

            $image = $request->file('thumbnail')->store('cars', 'public');
        }

        $car->update([
            'brand_id'      => $request->brand_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'price'         => $request->price,
            'year'          => $request->year,
            'fuel_type'     => $request->fuel_type,
            'transmission'  => $request->transmission,
            'mileage'       => $request->mileage,
            'engine'        => $request->engine,
            'horsepower'    => $request->horsepower,
            'color'         => $request->color,
            'condition'     => $request->condition,
            'description'   => $request->description,
            'thumbnail'     => $image,
        ]);

        return redirect()
            ->route('vendor.cars')
            ->with('success', 'Car Updated Successfully.');
    }

    public function carUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $car = Car::findOrFail($id);

        $car->status = $request->status;
        $car->save();

        return back()->with('success', 'Status Updated Successfully');
    }

    public function deleteCar($id)
    {
        $car = Car::findOrFail($id);

        // Delete thumbnail if exists
        if ($car->thumbnail && Storage::disk('public')->exists($car->thumbnail)) {
            Storage::disk('public')->delete($car->thumbnail);
        }

        // Delete car
        $car->delete();

        return redirect()
            ->route('admin.cars')
            ->with('success', 'Car Deleted Successfully.');
    }
}

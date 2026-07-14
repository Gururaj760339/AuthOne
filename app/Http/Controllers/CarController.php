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

        return view('vehicle_details', compact('car', 'relatedCars'));
    }

    public function carShow()
    {
        $cars = Car::with('CarBrand')->latest()->get();

        return view('admin.car.car_show', compact('cars'));
    }

    public function carCustomerShow()
    {
        $cars = Car::with('CarBrand')->latest()->get();
        $finance = FinanceRequests::where('status', 'Approved')->first();
        $setting = Setting::first();

        return view('buy_&_finance_cars', compact('setting', 'finance', 'cars'));
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
            'status'        => 'required'
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
            'status'        => $request->status,
        ]);

        return redirect()
            ->route('admin.cars')
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
            'status'        => 'required'
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
            'status'        => $request->status,
        ]);

        return redirect()
            ->route('admin.cars')
            ->with('success', 'Car Updated Successfully.');
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

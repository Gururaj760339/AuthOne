<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function addCarBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:car_brands,name',
            'country' => 'required|string|max:100',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $logoName = null;

        if ($request->hasFile('logo')) {

            $logoName = time() . '.' . $request->logo->extension();

            $logourl = $request->file('logo')->store('images', 'public');
        }

        CarBrand::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'logo' => $logourl,
            'country' => $request->country,
        ]);

        return redirect()
            ->route('admin.car.brand.show')
            ->with('success', 'Brand added successfully.');
    }


    public function showCarBrand()
    {
        $brands = CarBrand::latest()->get();

        return view('admin.car_brand.car_brand_show', compact('brands'));
    }

    public function deleteCarBrand($id)
    {
        $brand = CarBrand::findOrFail($id);

        // Delete logo from storage (if exists)
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()
            ->route('admin.car.brand.show')
            ->with('success', 'Car Brand deleted successfully.');
    }

    public function editCarBrand($id)
    {
        $brand = CarBrand::findOrFail($id);

        return view('admin.car_brand.car_brand_edit', compact('brand'));
    }

    public function updateCarBrand(Request $request, $id)
    {
        $brand = CarBrand::findOrFail($id);

        $request->validate([
            'name'    => 'required|max:255|unique:car_brands,name,' . $brand->id,
            'country' => 'required|max:100',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload New Logo
        if ($request->hasFile('logo')) {

            if ($brand->logo && File::exists(public_path($brand->logo))) {
                File::delete(public_path($brand->logo));
            }

            $image = $request->file('logo');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/brands'), $imageName);

            $brand->logo = 'uploads/brands/' . $imageName;
        }

        $brand->name = $request->name;
        $brand->country = $request->country;
        $brand->slug = Str::slug($request->name);

        $brand->save();

        return redirect()->route('admin.car.brand.show', $brand->id)
            ->with('success', 'Brand updated successfully.');
    }
}

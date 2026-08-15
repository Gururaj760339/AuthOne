<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\SparePartCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SparePartController extends Controller
{
    public function showCustomerSparePart(Request $request)
    {
        $countryId = auth()->user()->country_id;
        $categories = SparePartCategory::orderBy('name')->get();

        $setting = Setting::first();

        $query = SparePart::with('sparePartsCategory')
            ->where('country_id', $countryId)
            ->where('status', 'Available')
            ->where('stock', '>', 0);

        // Search by car model
        if ($request->filled('car_model')) {

            $carModel = $request->car_model;

            $query->where(function ($q) use ($carModel) {

                $q->where('model', 'LIKE', '%' . $carModel . '%')
                    ->orWhere('name', 'LIKE', '%' . $carModel . '%')
                    ->orWhere('brand', 'LIKE', '%' . $carModel . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {

            $query->where('category_id', $request->category);
        }

        $spareParts = $query
            ->latest()
            ->get();

        return view('spare_parts.show', compact(
            'categories',
            'spareParts',
            'setting'
        ));
    }

    public function showCustomerSparePartDetails($id)
    {
        $countryId = auth()->user()->country_id;
        $part = SparePart::with([
            'sparePartsCategory',
            'sparePartImages'
        ])
            ->where('status', 'Available')
            ->where('country_id', $countryId)
            ->findOrFail($id);

        return view('spare_parts.show_details', compact('part'));
    }


    public function showSparePart()
    {
        $parts = SparePart::where('vendor_id', Auth::id())
            ->latest()
            ->get();

        return view('vendor.spare_parts.show', compact('parts'));
    }

    public function createSparePart()
    {
        $categories = SparePartCategory::orderBy('name')->get();

        return view('vendor.spare_parts.create', compact('categories'));
    }

    public function storeSparePart(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:spare_part_categories,id',
            'name' => 'required|max:255',
            'brand' => 'nullable|max:255',
            'model' => 'nullable|max:255',
            'part_number' => 'nullable|unique:spare_parts',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'unit' => 'nullable|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('spare_parts', 'public');
        }

        SparePart::create([
            'vendor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'brand' => $request->brand,
            'model' => $request->model,
            'part_number' => $request->part_number,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'image' => $image,
            'featured' => $request->has('featured'),
            'status' => $request->status,
            'country_id'    => Auth::user()->country_id
        ]);

        return redirect()->route('vendor.spare-parts.index')
            ->with('success', 'Spare Part Added Successfully.');
    }

    public function editSparePart(SparePart $sparePart)
    {
        if ($sparePart->vendor_id != auth()->id()) {
            abort(403);
        }

        $categories = SparePartCategory::orderBy('name')->get();

        return view('vendor.spare_parts.edit', compact('sparePart', 'categories'));
    }

    public function updateSparePart(Request $request, SparePart $sparePart)
    {
        if ($sparePart->vendor_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:spare_part_categories,id',
            'name' => 'required|max:255',
            'brand' => 'nullable|max:255',
            'model' => 'nullable|max:255',
            'part_number' => 'nullable|unique:spare_parts,part_number,' . $sparePart->id,
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'unit' => 'required|max:100',
            'country' => 'nullable|max:255',
            'status' => 'required|in:Available,Out of Stock,Inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($sparePart->image && Storage::disk('public')->exists($sparePart->image)) {
                Storage::disk('public')->delete($sparePart->image);
            }

            $sparePart->image = $request->file('image')->store('spare_parts', 'public');
        }

        $sparePart->category_id = $request->category_id;
        $sparePart->name = $request->name;
        $sparePart->brand = $request->brand;
        $sparePart->model = $request->model;
        $sparePart->part_number = $request->part_number;
        $sparePart->description = $request->description;
        $sparePart->price = $request->price;
        $sparePart->stock = $request->stock;
        $sparePart->unit = $request->unit;
        $sparePart->country = $request->country;
        $sparePart->status = $request->status;
        $sparePart->featured = $request->has('featured');

        $sparePart->save();

        return redirect()
            ->route('vendor.spare-parts.index')
            ->with('success', 'Spare Part Updated Successfully.');
    }

    public function destroySparePart(SparePart $sparePart)
    {
        if ($sparePart->vendor_id != Auth::id()) {
            abort(403);
        }

        if ($sparePart->image) {
            Storage::disk('public')->delete($sparePart->image);
        }

        $sparePart->delete();

        return back()->with('success', 'Deleted Successfully.');
    }
}

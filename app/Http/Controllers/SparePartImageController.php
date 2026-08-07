<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\SparePartImage;
use Illuminate\Http\Request;

class SparePartImageController extends Controller
{
    public function showSparePartImage()
    {
        $parts = SparePart::with('sparePartImages')
            ->latest()
            ->get();

        return view('vendor.spare_parts.images.show', compact('parts'));
    }

    public function createSparePartImage($id)
    {
        $part = SparePart::with('sparePartImages')->findOrFail($id);

        return view('vendor.spare_parts.images.create', compact('part'));
    }

    public function storeSparePartImage(Request $request, $id)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $part = SparePart::findOrFail($id);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imageName = time() . '_' . uniqid() . '.' . $image->extension();

                $image->move(public_path('uploads/spare_parts'), $imageName);

                SparePartImage::create([
                    'spare_part_id' => $part->id,
                    'image' => $imageName,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    public function destroySparePartImage($id)
    {
        $image = SparePartImage::findOrFail($id);

        $path = public_path('uploads/spare_parts/' . $image->image);

        if (file_exists($path)) {
            unlink($path);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SparePart;
use App\Models\SparePartCategory;
use App\Models\SparePartImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SparePartCategoryController extends Controller
{
    public function showSparePartCategory()
    {
        $categories = SparePartCategory::latest()->paginate(10);

        return view('admin.spare_parts.categories.show', compact('categories'));
    }

    public function storeSparePartCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:spare_part_categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/spare_categories'), $image);
        }

        SparePartCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $image,
        ]);

        return back()->with('success', 'Category added successfully.');
    }

    public function destroySparePartCategory($id)
    {
        $category = SparePartCategory::findOrFail($id);

        if ($category->image && file_exists(public_path('uploads/spare_categories/' . $category->image))) {
            unlink(public_path('uploads/spare_categories/' . $category->image));
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}

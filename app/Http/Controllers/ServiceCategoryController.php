<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function serviceCategoryShow()
    {
        $categories = ServiceCategory::latest()->get();

        return view('admin.service_category.service_category_show', compact('categories'));
    }

    public function serviceCategoryCreate()
    {
        return view('admin.service_category.add_service_category');
    }

    public function serviceCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        ServiceCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.service.category')
            ->with('success', 'Service Category Added Successfully.');
    }

    public function serviceCategoryEdit($id)
    {
        $category = ServiceCategory::findOrFail($id);

        return view('admin.service_category.edit_service_category', compact('category'));
    }

    public function serviceCategoryUpdate(Request $request, $id)
    {
        $category = ServiceCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:service_categories,name,' . $id,
            'icon' => 'nullable|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.service.category')
            ->with('success', 'Category Updated Successfully.');
    }

    public function serviceCategoryDestroy($id)
    {
        $category = ServiceCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.service.category')
            ->with('success', 'Category Deleted Successfully.');
    }
}

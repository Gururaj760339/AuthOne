<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WarrantyPlan;
use Illuminate\Http\Request;

class WarrantyPlanController extends Controller
{
    public function showWarrantyPlans()
    {
        $plans = WarrantyPlan::latest()->get();

        return view('admin.warranty_plan.show', compact('plans'));
    }

    public function createWarrantyPlan()
    {
        return view('admin.warranty_plan.create');
    }

    public function storeWarrantyPlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration_months' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'max_km' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        WarrantyPlan::create([
            'name' => $request->name,
            'duration_months' => $request->duration_months,
            'price' => $request->price,
            'max_km' => $request->max_km,
            'engine_coverage' => $request->has('engine_coverage'),
            'transmission_coverage' => $request->has('transmission_coverage'),
            'electrical_coverage' => $request->has('electrical_coverage'),
            'roadside_assistance' => $request->has('roadside_assistance'),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.warranty.plans.index')
            ->with('success', 'Warranty Plan Added Successfully.');
    }

    public function destroyWarrantyPlan($id)
    {
        $plan = WarrantyPlan::findOrFail($id);

        $plan->delete();

        return redirect()->route('admin.warranty.plans.index')
            ->with('success', 'Warranty Plan Deleted Successfully.');
    }
}

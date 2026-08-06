<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarWarranty;
use App\Models\WarrantyPlan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExtendedWarrantyController extends Controller
{
    public function createExtendWarranty($id)
    {
        $warranty = CarWarranty::findOrFail($id);

        abort_if($warranty->user_id != Auth::id(), 403);

        $plans = WarrantyPlan::where('status', 'Active')->get();

        return view('customer.extend_warranty', compact('warranty', 'plans'));
    }


    public function storeExtendWarranty(Request $request)
    {
        $request->validate([
            'warranty_id' => 'required|exists:car_warranties,id',
            'warranty_plan_id' => 'required|exists:warranty_plans,id',
        ]);

        $warranty = CarWarranty::findOrFail($request->warranty_id);

        abort_if($warranty->user_id != Auth::id(), 403);

        $plan = WarrantyPlan::findOrFail($request->warranty_plan_id);

        //dd($plan->id);

        return redirect()->route('payment.choose.warranty.extended', [
            'warrantyId' => $warranty->id,
            'planId' => $plan->id,
        ]);
    }
}

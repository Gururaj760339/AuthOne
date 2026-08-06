<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AITotalCostCalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'purchase_price' => 'required|numeric|min:1',
            'shipping_cost' => 'required|numeric|min:0',
            'insurance_cost' => 'nullable|numeric|min:0',
            'customs_rate' => 'required|numeric|min:0',
            'vat_rate' => 'required|numeric|min:0',
            'other_fees' => 'nullable|numeric|min:0',
        ]);

        $purchase = $request->purchase_price;
        $shipping = $request->shipping_cost;
        $insurance = $request->insurance_cost ?? 0;
        $customsRate = $request->customs_rate;
        $vatRate = $request->vat_rate;
        $otherFees = $request->other_fees ?? 0;

        // CIF
        $cif = $purchase + $shipping + $insurance;

        // Customs
        $customs = ($cif * $customsRate) / 100;

        // VAT
        $vat = (($cif + $customs) * $vatRate) / 100;

        // Total
        $total = $cif + $customs + $vat + $otherFees;

        // AI Recommendation
        $recommendations = [];

        if ($shipping > 2000) {
            $recommendations[] = "Shipping cost is higher than average.";
        } else {
            $recommendations[] = "Shipping cost looks reasonable.";
        }

        if ($customsRate > 15) {
            $recommendations[] = "High customs duty detected.";
        }

        if ($vatRate > 15) {
            $recommendations[] = "VAT is comparatively high.";
        }

        if ($insurance == 0) {
            $recommendations[] = "Insurance is recommended for imported vehicles.";
        }

        if (empty($recommendations)) {
            $recommendations[] = "Estimated import cost looks good.";
        }

        return response()->json([
            'purchase_price' => round($purchase,2),
            'shipping_cost' => round($shipping,2),
            'insurance_cost' => round($insurance,2),
            'cif' => round($cif,2),
            'customs' => round($customs,2),
            'vat' => round($vat,2),
            'other_fees' => round($otherFees,2),
            'total' => round($total,2),
            'recommendations' => $recommendations,
        ]);
    }
}
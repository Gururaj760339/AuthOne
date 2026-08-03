<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PredictiveMaintenanceController extends Controller
{
    public function predict(Request $request)
    {

        $request->validate([
            'engine_temp' => 'required|numeric',
            'rpm' => 'required|numeric',
            'battery' => 'required|numeric',
            'fuel' => 'required|numeric',
            'oil' => 'required|numeric',
            'mileage' => 'required|numeric',
            'check_engine' => 'required'
        ]);

        $score = 100;

        $problems = [];

        if ($request->engine_temp > 105) {

            $score -= 20;

            $problems[] = "Engine overheating detected.";
        }

        if ($request->rpm > 6000) {

            $score -= 15;

            $problems[] = "High engine RPM.";
        }

        if ($request->battery < 12) {

            $score -= 20;

            $problems[] = "Battery health is poor.";
        }

        if ($request->oil < 20) {

            $score -= 15;

            $problems[] = "Engine oil replacement required.";
        }

        if ($request->fuel < 10) {

            $score -= 5;

            $problems[] = "Fuel level is very low.";
        }

        if ($request->mileage > 100000) {

            $score -= 10;

            $problems[] = "Vehicle has high mileage.";
        }

        if ($request->check_engine == "ON") {

            $score -= 25;

            $problems[] = "Check Engine Light is ON.";
        }

        if ($score >= 90) {

            $status = "Excellent";
        } elseif ($score >= 70) {

            $status = "Good";
        } elseif ($score >= 50) {

            $status = "Warning";
        } else {

            $status = "Critical";
        }

        return response()->json([

            'health_score' => $score,

            'status' => $status,

            'problems' => $problems,

            'recommendation' => $this->recommendation($status)

        ]);
    }

    private function recommendation($status)
    {

        switch ($status) {

            case "Excellent":
                return "Vehicle is healthy.";

            case "Good":
                return "Regular maintenance recommended.";

            case "Warning":
                return "Service your vehicle soon.";

            default:
                return "Immediate inspection required.";
        }
    }
}

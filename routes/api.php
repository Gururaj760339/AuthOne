<?php

use App\Http\Controllers\FinanceRequestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictiveMaintenanceController;
use App\Http\Controllers\AITotalCostCalculatorController;

Route::post('/finance-calculator', [FinanceRequestsController::class, 'financeCalculate'])->name('customer.finance.calculator');
Route::post('/predictive-maintenance', [PredictiveMaintenanceController::class, 'predict']);
Route::post('/ai-total-cost/calculate', [AITotalCostCalculatorController::class, 'calculate'])->name('ai.total.cost.calculate');
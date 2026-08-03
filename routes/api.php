<?php

use App\Http\Controllers\FinanceRequestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictiveMaintenanceController;

Route::post('/finance-calculator', [FinanceRequestsController::class, 'financeCalculate'])->name('customer.finance.calculator');
Route::post('/predictive-maintenance', [PredictiveMaintenanceController::class, 'predict']);

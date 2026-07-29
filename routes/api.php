<?php

use App\Http\Controllers\FinanceRequestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/finance-calculator', [FinanceRequestsController::class, 'financeCalculate'])->name('customer.finance.calculator');


<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
});

Route::get('/workshops-and-maintenance', function () {
    return view('workshops_and_maintenance');
});

Route::get('/car-wash', function () {
    return view('car_wash');
});

Route::get('/buy-finance-cars', function () {
    return view('buy_&_finance_cars');
});

Route::get('/car-rental', function () {
    return view('car_rental');
});

Route::get('/car-imports', function () {
    return view('car_imports');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', function () {
    return view('login');
});
Route::post('/login-user', [UserController::class, 'login'])->name('user.login');
Route::post('/logout-user', [UserController::class, 'logout'])->name('user.logout');



Route::get('/registration', function () {
    return view('registration');
});
Route::post('/registration-user', [UserController::class, 'register'])->name('user.register');


Route::get('/language/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'ar', 'de'])) {
        session(['locale' => $locale]);
    }

    return back();
})->name('language.switch');

Route::get('/booking-form', function () {
    return view('booking.booking_create');
});

Route::get('/finance-apply-form', function () {
    return view('finance.apply_finance');
});

Route::get('/rent-car-booking-form', function () {
    return view('booking.rent_car_booking');
});

Route::get('/import-car-form', function () {
    return view('booking.car_import');
});

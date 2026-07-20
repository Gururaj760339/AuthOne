<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FinanceRequestsController;
use App\Http\Controllers\ImportRequestController;
use App\Http\Controllers\RentalBookingController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimoniasController;
use App\Http\Controllers\UserController;
use App\Models\ImporteRequest;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [UserController::class, 'userPanel'])->name('home'); 

Route::get('/about', function () {
    return view('about');
})->name('customer.about');

Route::get('/faq', function () {
    return view('faq');
})->name('customer.faq');

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

Route::get('/import-car-form', function () {
    return view('booking.car_import');
});

Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])
->name('admin.dashboard')->middleware(['can:isAdmin']);

Route::get('/admin-add-car-brand', function () {
    return view('admin.car_brand.car_brand_add');
})->name('admin.add.car.brand')->middleware(['can:isAdmin']);


Route::post('/admin-car-brand-add', [BrandController::class, 'addCarBrand'])
->name('admin.car.brand.add')->middleware(['can:isAdmin']);

Route::get('/admin-edit-car-brand/{id}', [BrandController::class, 'editCarBrand'])
->name('admin.edit.car.brand')->middleware(['can:isAdmin']);

Route::put('/admin-car-brand-update/{id}', [BrandController::class, 'updateCarBrand'])
->name('admin.car.brand.update')->middleware(['can:isAdmin']);

Route::get('/admin-car-brand', [BrandController::class, 'showCarBrand'])
->name('admin.car.brand.show')->middleware(['can:isAdmin']);

Route::delete('/admin-car-brand-delete/{id}', [BrandController::class, 'deleteCarBrand'])
->name('admin.car.brand.delete')->middleware(['can:isAdmin']);


Route::get('/admin-cars', [CarController::class, 'carShow'])
->name('admin.cars')->middleware(['can:isAdmin']);

Route::get('/admin-car-add-form', [CarController::class, 'carAddForm'])
->name('admin.cars.add.form')->middleware(['can:isAdmin']);

Route::post('/admin-car-add', [CarController::class, 'Carstore'])
->name('admin.cars.add')->middleware(['can:isAdmin']);

Route::get('/admin-car-edit/{id}', [CarController::class, 'carEdit'])
->name('admin.cars.edit')->middleware(['can:isAdmin']);

Route::put('/admin-car-update/{id}', [CarController::class, 'updateCar'])
->name('admin.cars.update')->middleware(['can:isAdmin']);

Route::delete('/admin-car-delete/{id}', [CarController::class, 'deleteCar'])
->name('admin.cars.delete')->middleware(['can:isAdmin']);

Route::get('/buy-finance-cars', [CarController::class, 'carCustomerShow'])->name('customer.cars');
Route::get('/vehicle_details/{slug}', [CarController::class, 'vehicleDetails'])->name('vehicle.details');



Route::get('/admin-car-images', [CarImageController::class, 'showCarImage'])
->name('admin.cars.images')->middleware(['can:isAdmin']);

Route::get('/admin-car-images-add', [CarImageController::class, 'addCarImage'])
->name('admin.cars.image.create')->middleware(['can:isAdmin']);

Route::post('/admin-car-images-store', [CarImageController::class, 'storeCarImage'])
->name('admin.cars.image.store')->middleware(['can:isAdmin']);

Route::delete('/admin-car-images-delete/{id}', [CarImageController::class, 'deleteCarImage']
)->name('admin.cars.image.destroy')->middleware(['can:isAdmin']);



Route::get('/admin-service-categories', [ServiceCategoryController::class, 'serviceCategoryShow'])
->name('admin.service.category')->middleware(['can:isAdmin']);

Route::get('/admin-service-categories-create', [ServiceCategoryController::class, 'serviceCategoryCreate'])
->name('admin.service.category.create')->middleware(['can:isAdmin']);

Route::post('/admin-service-categories-store', [ServiceCategoryController::class, 'serviceCategoryStore'])
->name('admin.service.category.store')->middleware(['can:isAdmin']);

Route::get('/admin-service-categories-edit/{id}', [ServiceCategoryController::class, 'serviceCategoryEdit'])
->name('admin.service.category.edit')->middleware(['can:isAdmin']);

Route::post('/admin-service-categories-update/{id}', [ServiceCategoryController::class, 'serviceCategoryUpdate'])
->name('admin.service.category.update')->middleware(['can:isAdmin']);

Route::delete('/admin-service-categories-destroy/{id}', [ServiceCategoryController::class, 'serviceCategoryDestroy'])
->name('admin.service.category.destroy')->middleware(['can:isAdmin']);



Route::get('/admin-services', [ServiceController::class, 'showService'])
->name('admin.service')->middleware(['can:isAdmin']);

Route::get('/admin-services-create', [ServiceController::class, 'serviceCreate'])
->name('admin.service.create')->middleware(['can:isAdmin']);

Route::post('/admin-services-store', [ServiceController::class, 'serviceStore'])
->name('admin.service.store')->middleware(['can:isAdmin']);

Route::put('/admin-services-update/{id}', [ServiceController::class, 'updateStatus'])
->name('admin.service.update')->middleware(['can:isAdmin']);

Route::delete('/admin-services-delete/{id}', [ServiceController::class, 'deleteCategory'])
->name('admin.service.delete')->middleware(['can:isAdmin']);

Route::get('/workshops-and-maintenance', [ServiceController::class, 'showMaintenanceCustomer'])->name('customer.workshops.maintenance.show');
Route::get('/car-wash', [ServiceController::class, 'showCarWashCustomer'])->name('customer.carwash');

Route::get('/customer-single-car-wash-create/{slug}', [BookingController::class, 'singleServiceCreate'])->name('customer.single.carwash');
Route::get('/customer-maintenance-create', [BookingController::class, 'MaintenanceBookingCreate'])->name('customer.maintenance.booking.create');
Route::get('/customer-car-wash-create', [BookingController::class, 'CarWashBookingCreate'])->name('customer.carwash.booking.create');
Route::post('/customer-booking-store', [BookingController::class, 'BookingStore'])->name('customer.booking.store');

Route::get('/admin-booking', [BookingController::class, 'showBooking'])
->name('admin.booking')->middleware(['can:isAdmin']);

Route::post('/admin-booking-update/{id}', [BookingController::class, 'updateStatus'])
->name('admin.booking.update')->middleware(['can:isAdmin']);

Route::delete('/admin-booking-delete/{id}', [BookingController::class, 'bookingDelete'])
->name('admin.booking.delete')->middleware(['can:isAdmin']);



Route::get('/finance-apply-form', [FinanceRequestsController::class, 'financeRequest'])->name('customer.finance.apply');
Route::post('/finance-request-store', [FinanceRequestsController::class, 'financeStore'])->name('customer.finance.request');
Route::get('/single-finance-request/{slug}', [FinanceRequestsController::class, 'singleFinanceRequest'])->name('customer.single.finance.request');

Route::get('/admin-finance-requests', [FinanceRequestsController::class, 'AdminFinanceRequests'])
->name('admin.finance.request')->middleware(['can:isAdmin']);

Route::put('/admin-finance-requests-update/{id}', [FinanceRequestsController::class, 'financeRequestStatusUpdate'])
->name('admin.finance.request.update')->middleware(['can:isAdmin']);

Route::delete('/admin-finance-requests-delete/{id}', [FinanceRequestsController::class, 'financeRequestDelete'])
->name('admin.finance.request.delete')->middleware(['can:isAdmin']);



Route::get('/admin-rentals', [RentalController::class, 'rentalShow'])
->name('admin.rental')->middleware(['can:isAdmin']);

Route::get('/admin-rentals-create', [RentalController::class, 'retalCreate'])
->name('admin.rental.create')->middleware(['can:isAdmin']);

Route::post('/admin-rentals-store', [RentalController::class, 'rentalStore'])
->name('admin.rental.store')->middleware(['can:isAdmin']);

Route::get('/admin-rentals-edit/{id}', [RentalController::class, 'rentalEdit'])
->name('admin.rental.edit')->middleware(['can:isAdmin']);

Route::put('/admin-rentals-update/{id}', [RentalController::class, 'rentalUpdate'])
->name('admin.rental.update')->middleware(['can:isAdmin']);

Route::delete('/admin-rentals-destroy/{id}', [RentalController::class, 'RentalDestroy'])
->name('admin.rental.destroy')->middleware(['can:isAdmin']);

Route::get('/rentals', [RentalController::class, 'customerRentalShow'])->name('customer.rental');



Route::get('/rentals-booking-create/{id}', [RentalBookingController::class, 'singleRentalBookingCreate'])->name('customer.single.rental.bookin.create');
Route::post('/rentals-booking-store', [RentalBookingController::class, 'customerRentalBookingStore'])->name('customer.rental.booking.store');
Route::get('/rentals-booking-create', [RentalBookingController::class, 'rentalBookingCreate'])->name('customer.rental.booking.create');

Route::get('/admin-rentals-booking', [RentalBookingController::class, 'adminRentalBookingShow'])
->name('admin.rental.booking')->middleware(['can:isAdmin']);

Route::put('/admin-rentals-booking-update/{id}', [RentalBookingController::class, 'adminRentalBookinStatusUpdate'])
->name('admin.rental.booking.update')->middleware(['can:isAdmin']);

Route::delete('/admin-rentals-delete/{id}', [RentalBookingController::class, 'adminRentalBookinDelete'])
->name('admin.rental.booking.delete')->middleware(['can:isAdmin']);


Route::get('/importe-request-create', [ImportRequestController::class, 'customerImporteRequestCreate'])->name('customer.import.request.create');
Route::post('/importe-request-store', [ImportRequestController::class, 'customerImporteRequestStore'])->name('customer.import.request.store');
Route::get('/importe-request', [ImportRequestController::class, 'customerShowImporte'])->name('customer.import.request');

Route::get('/admin-importe-request', [ImportRequestController::class, 'adminImportRequestShow'])
->name('admin.import.request')->middleware(['can:isAdmin']);

Route::put('/admin-importe-update/{id}', [ImportRequestController::class, 'adminImportRequestUpdate'])
->name('admin.import.request.update')->middleware(['can:isAdmin']);

Route::delete('/admin-importe-delete/{id}', [ImportRequestController::class, 'adminImportRequestDestroy'])
->name('admin.import.request.delete')->middleware(['can:isAdmin']);


Route::post('/add-review', [TestimoniasController::class, 'storeReview'])->name('customer.store.review');
Route::get('/admin-reviews', [TestimoniasController::class, 'adminReviewShow'])

->name('admin.review')->middleware(['can:isAdmin']);

Route::delete('/admin-destroy/{id}', [TestimoniasController::class, 'adminReviewDelete'])
->name('admin.destroy')->middleware(['can:isAdmin']);



Route::get('/admin-faq', [FaqController::class, 'showFaq'])
->name('admin.faq')->middleware(['can:isAdmin']);

Route::get('/admin-faq-create', [FaqController::class, 'FaqCreate'])
->name('admin.faq.create')->middleware(['can:isAdmin']);

Route::post('/admin-faq-store', [FaqController::class, 'FaqStore'])
->name('admin.faq.store')->middleware(['can:isAdmin']);

Route::get('/admin-faq-edit/{id}', [FaqController::class, 'FaqEdit'])
->name('admin.faq.edit')->middleware(['can:isAdmin']);

Route::put('/admin-faq-update/{id}', [FaqController::class, 'FaqUpdate'])
->name('admin.faq.update')->middleware(['can:isAdmin']);

Route::delete('/admin-faq-destroy/{id}', [FaqController::class, 'FaqDestroy'])
->name('admin.faq.destroy')->middleware(['can:isAdmin']);



Route::get('/contact', [ContactController::class, 'contractShow'])->name('customer.contact');
Route::get('/contact-faq', [FaqController::class, 'showFaqContactSection'])->name('customer.contact.faq');
Route::post('/contact-store', [ContactController::class, 'contractStore'])->name('customer.contact.store');

Route::get('/admin-contact', [ContactController::class, 'adminContactShow'])
->name('admin.contact')->middleware(['can:isAdmin']);

Route::delete('/admin-contact-destroy/{id}', [ContactController::class, 'contactDestroy'])
->name('admin.contact.destroy')->middleware(['can:isAdmin']);


Route::get('/settings', [SettingController::class, 'showSetting'])
->name('admin.setting')->middleware(['can:isAdmin']);

Route::get('/settings-edit/{id}', [SettingController::class, 'editSetting'])
->name('admin.edit.setting')->middleware(['can:isAdmin']);

Route::put('/settings-update/{id}', [SettingController::class, 'updateSetting'])
->name('admin.update.setting')->middleware(['can:isAdmin']);




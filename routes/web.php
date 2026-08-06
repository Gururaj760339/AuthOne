<?php

use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FinancePartnerController;
use App\Http\Controllers\FinanceRequestsController;
use App\Http\Controllers\ImportRequestController;
use App\Http\Controllers\KycVerificationController;
use App\Http\Controllers\P2PBookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalBookingController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimoniasController;
use App\Http\Controllers\CustomerWarrantyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ExtendedWarrantyController;
use App\Http\Controllers\P2PCarController;
use App\Http\Controllers\PriceEstimationController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Controllers\WarrantyPlanController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportFinanceRequestController;
use App\Services\ShippoService;
use App\Models\ImporteRequest;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\SocialAuthController;
use App\Models\KycVerification;


Route::get('/', [UserController::class, 'userPanel'])->name('home'); 
Route::get('/about', [UserController::class, 'aboutPage'])->name('customer.about'); 
Route::get('/faq', [FaqController::class, 'showCustomerFaq'])->name('customer.faq'); 

Route::get('/login', function () {
    return view('login');
});
Route::post('/login-user', [UserController::class, 'login'])->name('user.login');
Route::post('/logout-user', [UserController::class, 'logout'])->name('user.logout');


Route::get('/registration', function () {
    return view('registration');
});
Route::post('/registration-user', [UserController::class, 'register'])->name('user.register');


Route::get('/auth/google',[SocialAuthController::class,'googleRedirect'])->name('google.login');
Route::get('/auth/google/callback',[SocialAuthController::class,'googleCallback']);
Route::get('/auth/apple',[SocialAuthController::class,'appleRedirect'])->name('apple.login');
Route::get('/auth/apple/callback',[SocialAuthController::class,'appleCallback']);

// Route::get('/language/{locale}', function ($locale) {

//     if (in_array($locale, ['en', 'ar', 'de'])) {
//         session(['locale' => $locale]);
//     }

//     return back();
// })->name('language.switch');

Route::get('/import-car-form', function () {
    return view('booking.car_import');
});

Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])
->name('admin.dashboard')->middleware(['can:isAdmin']);

Route::get('/all-users', [UserController::class, 'showAdminPanelUser'])
->name('admin.users')->middleware(['can:isAdmin']);

Route::get('/create-users-form', [UserController::class, 'addUserForm'])
->name('admin.users.create')->middleware(['can:isAdmin']);

Route::post('/add-users', [UserController::class, 'adminPanelAddUser'])
->name('admin.store.users')->middleware(['can:isAdmin']);

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


Route::get('/cars-filters', [CarController::class, 'customerCarFilter'])->name('cars.filter');

Route::get('/admin-cars', [CarController::class, 'showAdminCar'])
->name('admin.cars')->middleware(['can:isAdmin']);

Route::get('/vendor-cars', [CarController::class, 'showVendorCar'])
->name('vendor.cars')->middleware(['can:isVendor']);

Route::get('/admin-car-add-form', [CarController::class, 'carAddForm'])
->name('vendor.cars.add.form')->middleware(['can:isVendor']);

Route::post('/admin-car-add', [CarController::class, 'Carstore'])
->name('vendor.cars.add')->middleware(['can:isVendor']);

Route::get('/admin-car-edit/{id}', [CarController::class, 'carEdit'])
->name('admin.vendor.cars.edit')->middleware(['can:isAdminOrisVendor']);

Route::put('/admin-car-update/{id}', [CarController::class, 'updateCar'])
->name('admin.vendor.cars.update')->middleware(['can:isAdminOrisVendor']);

Route::put('/admin-car-satus-update/{id}', [CarController::class, 'carUpdateStatus'])
->name('admin.car.status.update')->middleware(['can:isAdmin']);

Route::delete('/admin-car-delete/{id}', [CarController::class, 'deleteCar'])
->name('admin.vendor.cars.delete')->middleware(['can:isAdminOrisVendor']);

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



Route::get('/vendor-services', [ServiceController::class, 'showVendorService'])
->name('vendor.service')->middleware(['can:isVendor']);

Route::get('/admin-services', [ServiceController::class, 'showAdminService'])
->name('admin.service')->middleware(['can:isAdmin']);

Route::get('/admin-services-create', [ServiceController::class, 'serviceCreate'])
->name('vendor.service.create')->middleware(['can:isVendor']);

Route::post('/admin-services-store', [ServiceController::class, 'serviceStore'])
->name('vendor.service.store')->middleware(['can:isVendor']);

Route::put('/admin-services-update/{id}', [ServiceController::class, 'updateStatus'])
->name('admin.vendor.service.update')->middleware(['can:isAdmin']);

Route::delete('/admin-services-delete/{id}', [ServiceController::class, 'deleteCategory'])
->name('admin.vendor.service.delete')->middleware(['can:isAdminOrisVendor']);


Route::get('/workshops-and-maintenance', [ServiceController::class, 'showMaintenanceCustomer'])->name('customer.workshops.maintenance.show');
Route::get('/car-wash', [ServiceController::class, 'showCarWashCustomer'])->name('customer.carwash');

Route::get('/customer-single-car-wash-create/{slug}', [BookingController::class, 'singleServiceCreate'])->name('customer.single.carwash');
Route::get('/customer-maintenance-create', [BookingController::class, 'MaintenanceBookingCreate'])->name('customer.maintenance.booking.create');
Route::get('/customer-car-wash-create', [BookingController::class, 'CarWashBookingCreate'])->name('customer.carwash.booking.create');
Route::post('/customer-booking-store', [BookingController::class, 'BookingStore'])->name('customer.booking.store');
Route::get('/booking/more-services', [BookingController::class, 'moreServices'])->name('booking.more.services');
Route::post('/booking/finish', [BookingController::class, 'finishBooking'])->name('booking.finish');


Route::get('/admin-booking', [BookingController::class, 'showBooking'])->name('admin.booking')->middleware(['can:isAdmin']);

Route::post('/admin-booking-update/{id}', [BookingController::class, 'updateStatus'])
->name('admin.booking.update')->middleware(['can:isAdmin']);

Route::delete('/admin-booking-delete/{id}', [BookingController::class, 'bookingDelete'])
->name('admin.booking.delete')->middleware(['can:isAdmin']);



Route::get('/finance-apply-form', [FinanceRequestsController::class, 'financeRequest'])->name('customer.finance.apply');
Route::post('/finance-request-store', [FinanceRequestsController::class, 'financeStore'])->name('customer.finance.request');
Route::get('/single-finance-request/{slug}', [FinanceRequestsController::class, 'singleFinanceRequest'])->name('customer.single.finance.request');

Route::get('/admin-finance-requests', [FinanceRequestsController::class, 'AdminFinanceRequests'])
->name('admin.finance.request')->middleware(['can:isAdmin']);

Route::get('/vendor-finance-requests', [FinanceRequestsController::class, 'vendorFinanceRequests'])
->name('vendor.finance.request')->middleware(['can:isVendor']);

Route::put('/admin-finance-requests-update/{id}', [FinanceRequestsController::class, 'financeRequestStatusUpdate'])
->name('admin.finance.request.update')->middleware(['can:isAdminOrisVendor']);

Route::delete('/admin-finance-requests-delete/{id}', [FinanceRequestsController::class, 'financeRequestDelete'])
->name('admin.finance.request.delete')->middleware(['can:isAdmin']);


Route::get('/admin-finance-partners', [FinancePartnerController::class, 'showFinancePartner'])
->name('admin.finance.partner')->middleware(['can:isAdmin']);

Route::get('/admin-finance-partner-create', [FinancePartnerController::class, 'addFinancePartnerFrom'])
->name('admin.finance.partner.create')->middleware(['can:isAdmin']);

Route::post('/admin-finance-partner-store', [FinancePartnerController::class, 'financePartnerStore'])
->name('admin.finance.partner.store')->middleware(['can:isAdmin']);

Route::delete('/admin-finance-partner-destroy/{id}', [FinancePartnerController::class, 'financePartnerDestroy'])
->name('admin.finance.partner.destroy')->middleware(['can:isAdmin']);




Route::get('/admin-rentals', [RentalController::class, 'showAdminRental'])
->name('admin.rental')->middleware(['can:isAdmin']);

Route::get('/vendor-rentals', [RentalController::class, 'showVendorRental'])
->name('vendor.rental')->middleware(['can:isVendor']);

Route::get('/admin-rentals-create', [RentalController::class, 'retalCreate'])
->name('vendor.rental.create')->middleware(['can:isVendor']);

Route::post('/admin-rentals-store', [RentalController::class, 'rentalStore'])
->name('vendor.rental.store')->middleware(['can:isVendor']);

Route::get('/admin-rentals-edit/{id}', [RentalController::class, 'rentalEdit'])
->name('admin.vendor.rental.edit')->middleware(['can:isAdminOrisVendor']);

Route::put('/admin-rentals-update/{id}', [RentalController::class, 'rentalUpdate'])
->name('admin.vendor.rental.update')->middleware(['can:isAdminOrisVendor']);

Route::delete('/admin-rentals-destroy/{id}', [RentalController::class, 'RentalDestroy'])
->name('admin.vendor.rental.destroy')->middleware(['can:isAdminOrisVendor']);

Route::get('/rentals', [RentalController::class, 'customerRentalShow'])->name('customer.rental');
Route::get('/rental/car/search/', [RentalController::class, 'carSearch'])->name('customer.rentals.car.search');



Route::get('/rentals-booking-create/{id}', [RentalBookingController::class, 'singleRentalBookingCreate'])->name('customer.single.rental.bookin.create');
Route::post('/rentals-booking-store', [RentalBookingController::class, 'customerRentalBookingStore'])->name('customer.rental.booking.store');
Route::get('/rentals-booking-create', [RentalBookingController::class, 'rentalBookingCreate'])->name('customer.rental.booking.create');
Route::get('/p2p-booking/create/{id}', [P2PBookingController::class, 'createBooking'])->name('p2p.booking.create');
Route::post('/p2p-booking/store/{id}', [P2PBookingController::class, 'storeBooking'])->name('p2p.booking.store');

Route::get('/admin-rentals-booking', [RentalBookingController::class, 'adminRentalBookingShow'])
->name('admin.rental.booking')->middleware(['can:isAdmin']);

Route::put('/admin-rentals-booking-update/{id}', [RentalBookingController::class, 'adminRentalBookinStatusUpdate'])
->name('admin.rental.booking.update')->middleware(['can:isAdmin']);

Route::delete('/admin-rentals-delete/{id}', [RentalBookingController::class, 'adminRentalBookinDelete'])
->name('admin.rental.booking.delete')->middleware(['can:isAdmin']);


Route::get('/importe-request-create', [ImportRequestController::class, 'customerImporteRequestCreate'])->name('customer.import.request.create');
Route::post('/importe-request-store', [ImportRequestController::class, 'customerImporteRequestStore'])->name('customer.import.request.store');
Route::get('/importe-request', [ImportRequestController::class, 'customerShowImporte'])->name('customer.import.request');
Route::get('/customer/import-finance/{importRequest}', [ImportFinanceRequestController::class, 'CustomerImportFinanceCreate'])->name('customer.import.finance.create');
Route::post('/customer/import-finance/store', [ImportFinanceRequestController::class, 'customerImportFinanceStore'])->name('customer.import.finance.store');

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

Route::get('/vendor-dashboard', [VendorController::class, 'vendorDashboard'])
->name('vendor.dashboard')->middleware(['can:isVendor']);



Route::get('/payment/finance/{id}', [PaymentController::class, 'choosePaymentFinance'])->name('payment.choose.finance');
Route::get('/payment/service', [PaymentController::class, 'choosePaymentService'])->name('payment.choose.service');
Route::get('/payment/car-import/{id}', [PaymentController::class, 'choosePaymentCarImport'])->name('payment.choose.car.import');
Route::get('/payment/rental/{rentalId}/booking/{rentalBookingId}',[PaymentController::class, 'choosePaymentCarRental'])->name('payment.choose.car.rental');
Route::get('/payment/warranty/{warrantyId}/extended/{planId}', [PaymentController::class, 'choosePaymentWarrantyExtended'])->name('payment.choose.warranty.extended');

Route::get('/payment/{type}/stripe/{id}', [PaymentController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('/payment/stripe', [PaymentController::class, 'stripeCheckoutService'])->name('stripe.checkout.services');
Route::get('/payment/{type}/stripe/{rentalId}/{rentalBookingId}', [PaymentController::class, 'stripeRentalCheckout'])->name('stripe.checkout.rental');
Route::get('/payment/warranty/{warrantyId}/stripe/{planId}/checkout',[PaymentController::class, 'stripeCheckoutWarrantyExtended'])->name('stripe.checkout.warranty.extended');
Route::get('/stripe/success/{id}', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/payment/{paymentId}/warranty/{warrantyId}/plan/{planId}/success',[PaymentController::class, 'warrantyStripeSuccess'])->name('warranty.stripe.success');Route::get('/stripe/cancel/{id}', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
 
Route::post('/chatbot', [ChatbotController::class, 'chat']);


Route::get('/finance-partner/dashboard', [FinancePartnerController::class, 'financePartnerdashboard'])->name('finance.partner.dashboard');
Route::get('/finance-partner/requests', [FinancePartnerController::class, 'financeRequests'])->name('finance.partner.requests');
Route::post('/finance-partner/requests/approve/{id}', [FinancePartnerController::class, 'approveFinanceRequest'])->name('finance.partner.approve');
Route::post('/finance-partner/requests/reject/{id}', [FinancePartnerController::class, 'rejectFinanceRequest'])->name('finance.partner.reject');
Route::get('/import-finance-partner/requests', [FinancePartnerController::class, 'ImportFinanceRequests'])->name('import.finance.partner.requests');
Route::post('/import-finance-partner/requests/approve/{id}', [FinancePartnerController::class, 'approveImportFinanceRequest'])->name('import.finance.partner.approve');
Route::post('/import-finance-partner/requests/reject/{id}', [FinancePartnerController::class, 'rejectImportFinanceRequest'])->name('import.finance.partner.reject');

Route::get('/my-profile', [UserController::class, 'myProfile'])->name('customer.profile');
Route::get('/create-kyc', [KycVerificationController::class, 'createKyc'])->name('customer.create.kyc');
Route::post('/store-kyc', [KycVerificationController::class, 'storeKyc'])->name('customer.store.kyc');
Route::get('/show-kyc', [KycVerificationController::class, 'showKyc'])->name('customer.show.kyc');
Route::delete('/customer/kyc/delete', [KycVerificationController::class, 'destroyKyc'])->name('customer.kyc.destroy');
Route::get('/customer/import-requests', [ImportRequestController::class, 'customerProfileImportRequests'])->name('customer.import.requests');

Route::get('/admin-kycs', [AdminKycController::class, 'showKycs'])->name('admin.kycs.show');
Route::get('/admin-kyc/{id}', [AdminKycController::class, 'showKyc'])->name('admin.kyc.show');
Route::post('/admin-approve/{id}', [AdminKycController::class, 'approveKyc'])->name('admin.kyc.approve');
Route::post('/admin-reject/{id}', [AdminKycController::class, 'rejectKyc'])->name('admin.kyc.reject');

Route::get('/contract/{booking}/preview', [ContactsController::class, 'rentalContractPreview'])->name('rental.contract.preview');
Route::get('/contract/{booking}/download', [ContactsController::class, 'rentalContractDownload'])->name('rental.contract.download');
Route::get('/contract/{booking}', [ContactsController::class, 'showContact'])->name('rental.contract.show');

Route::get('/p2p/cars', [P2PCarController::class, 'showCars'])->name('p2p.cars.show');
Route::get('/p2p/cars/create', [P2PCarController::class, 'carCreate'])->name('p2p.cars.create');
Route::post('/p2p/cars', [P2PCarController::class, 'storeCar'])->name('p2p.cars.store');
Route::delete('/p2p/cars/destroy/{id}', [P2PCarController::class, 'carDestroy'])->name('p2p.cars.destroy');
Route::get('/p2p/cars/rental-requests', [P2PBookingController::class, 'rentalRequests'])->name('p2p.cars.rental.requests');
Route::put('/p2p/cars/rental-request/{id}', [P2PBookingController::class, 'updateRentalStatus'])->name('p2p.cars.rental.status.update');


Route::get('/p2p/verifications/create', [UserVerificationController::class, 'createVerification'])->name('p2p.verifications.create');
Route::post('/p2p/verifications', [UserVerificationController::class, 'storeVerification'])->name('p2p.verifications.store');


Route::get('/admin/all-users-verification', [UserVerificationController::class, 'UserVerificationList'])->name('admin.all.users.verification')->middleware(['can:isAdmin']);
Route::get('/admin/user-verification/{id}', [UserVerificationController::class, 'singleUserVerificationList'])->name('admin.single.user.verification')->middleware(['can:isAdmin']);
Route::post('/admin/user-verification/approve/{id}', [UserVerificationController::class, 'approveUser'])->name('admin.user.verification.approve')->middleware(['can:isAdmin']);
Route::post('/admin/user-verification/reject/{id}', [UserVerificationController::class, 'rejectUser'])->name('admin.user.verification.reject')->middleware(['can:isAdmin']);

Route::get('/admin/users-cars', [P2PCarController::class, 'showAdminAllCars'])->name('admin.p2p.cars.show')->middleware(['can:isAdmin']);
Route::get('/admin/users-car/{id}', [P2PCarController::class, 'showAdminSingleCar'])->name('admin.p2p.car.show')->middleware(['can:isAdmin']);
Route::post('/admin/users-cars/approve/{id}', [P2PCarController::class, 'approveAdminCar'])->name('admin.p2p.car.approve')->middleware(['can:isAdmin']);
Route::post('/admin/users-cars/reject/{id}', [P2PCarController::class, 'rejectAdminCar'])->name('admin.p2p.car.reject')->middleware(['can:isAdmin']);

Route::post('/repair-estimation', [PriceEstimationController::class, 'repair'])->name('repair.estimation');
Route::post('/rental-estimation', [PriceEstimationController::class, 'rental'])->name('rental.estimation');
Route::post('/import-estimation', [PriceEstimationController::class, 'import'])->name('import.estimation');

Route::get('/language/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar', 'de'])) {
        abort(404);
    }
    Session::put('language', $lang);
    return redirect()->back();
})->name('language.switch');

Route::post('/imports/{id}/shipment', [ImportController::class, 'createShipment'])->name('import.shipment.create');
Route::post('/import-request/{id}/shipment', [ImportRequestController::class, 'shipment'])->name('import.shipment');
Route::get('/import-request/{id}/tracking', [ImportRequestController::class, 'tracking'])->name('import.tracking');

Route::get('/customer/warranties', [CustomerWarrantyController::class, 'customerWarranties'])->name('customer.warranties');
Route::get('/customer/warranty/{id}/extend', [ExtendedWarrantyController::class, 'createExtendWarranty'])->name('customer.extended.warranty.create');
Route::post('/customer/warranty/extend', [ExtendedWarrantyController::class, 'storeExtendWarranty'])->name('customer.extended.warranty.store');

Route::get('/warranty-plans', [WarrantyPlanController::class, 'showWarrantyPlans'])->name('admin.warranty.plans.index')->middleware(['can:isAdmin']);
Route::get('/warranty-plans/create', [WarrantyPlanController::class, 'createWarrantyPlan'])->name('admin.warranty.plans.create')->middleware(['can:isAdmin']);
Route::post('/warranty-plans', [WarrantyPlanController::class, 'storeWarrantyPlan'])->name('admin.warranty.plans.store')->middleware(['can:isAdmin']);
Route::delete('/warranty-plans/{id}', [WarrantyPlanController::class, 'destroyWarrantyPlan'])->name('admin.warranty.plans.destroy');
<?php

use App\Http\Controllers\LoyaltyRewardController;
use App\Http\Controllers\SparePartCategoryController;
use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CountryController;
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
use App\Http\Controllers\FuelDeliveryController;
use App\Http\Controllers\FuelDriverDashboardController;
use App\Http\Controllers\FuelPartnerController;
use App\Http\Controllers\FuelPartnerDashboardController;
use App\Http\Controllers\FuelPartnerDriverController;
use App\Http\Controllers\P2PCarController;
use App\Http\Controllers\PriceEstimationController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Controllers\WarrantyPlanController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportFinanceRequestController;
use App\Http\Controllers\LoyaltyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoadsidePartnerController;
use App\Http\Controllers\RoadsideAssistanceController;
use App\Http\Controllers\RoadsideRequestController;
use App\Services\ShippoService;
use App\Models\ImporteRequest;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\SparePartImageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VendorOrderController;
use App\Models\KycVerification;


Route::get('/', [UserController::class, 'userPanel'])->name('home');
Route::get('/about', [UserController::class, 'aboutPage'])->name('customer.about');
Route::get('/faq', [FaqController::class, 'showCustomerFaq'])->name('customer.faq');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-user', [UserController::class, 'login'])->name('user.login');
Route::post('/logout-user', [UserController::class, 'logout'])->name('user.logout');


Route::get('/registration', function () {
    return view('registration');
});
Route::post('/registration-user', [UserController::class, 'register'])->name('user.register');


Route::get('/auth/google', [SocialAuthController::class, 'googleRedirect'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'googleCallback']);
Route::get('/auth/apple', [SocialAuthController::class, 'appleRedirect'])->name('apple.login');
Route::get('/auth/apple/callback', [SocialAuthController::class, 'appleCallback']);

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

Route::delete(
    '/admin-car-images-delete/{id}',
    [CarImageController::class, 'deleteCarImage']
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
Route::get('/payment/rental/{rentalId}/booking/{rentalBookingId}', [PaymentController::class, 'choosePaymentCarRental'])->name('payment.choose.car.rental');
Route::get('/payment/warranty/{warrantyId}/extended/{planId}', [PaymentController::class, 'choosePaymentWarrantyExtended'])->name('payment.choose.warranty.extended');
Route::get('/payment/subscription/{id}', [PaymentController::class, 'choosePaymentSubscription'])->name('payment.choose.subscription');

Route::get('/payment/{type}/stripe/{id}', [PaymentController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('/payment/stripe', [PaymentController::class, 'stripeCheckoutService'])->name('stripe.checkout.services');
Route::get('/payment/stripe/order/{orderId}', [PaymentController::class, 'stripeCheckoutSparePart'])->name('stripe.checkout.spare_parts');
Route::get('/payment/{type}/stripe/{rentalId}/{rentalBookingId}', [PaymentController::class, 'stripeRentalCheckout'])->name('stripe.checkout.rental');
Route::get('/payment/warranty/{warrantyId}/stripe/{planId}/checkout', [PaymentController::class, 'stripeCheckoutWarrantyExtended'])->name('stripe.checkout.warranty.extended');
Route::get('/payment/checkout/subscription/{id}', [PaymentController::class, 'stripeCheckoutSubscription'])->name('stripe.checkout.subscription');

Route::get('/stripe/{paymentId}/success/{amount}', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/payment/{paymentId}/warranty/{warrantyId}/plan/{planId}/success', [PaymentController::class, 'warrantyStripeSuccess'])->name('warranty.stripe.success');
Route::get('/payment/{paymentId}/order/{orderId}/success', [PaymentController::class, 'StripeSuccessSparePart'])->name('spare_parts.stripe.success');
Route::get('/stripe/cancel/{id}', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
Route::get('/stripe/{paymentId}/success/subscription/{subscriptionId}', [PaymentController::class, 'subscriptionStripeSuccess'])->name('stripe.success.subscription');


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


Route::get('/spare-part-categories', [SparePartCategoryController::class, 'showSparePartCategory'])->name('admin.spare.categories')->middleware(['can:isAdmin']);
Route::post('/add-spare-part-categories', [SparePartCategoryController::class, 'storeSparePartCategory'])->name('admin.spare.categories.store')->middleware(['can:isAdmin']);
Route::delete('/spare-part-categories/{id}', [SparePartCategoryController::class, 'destroySparePartCategory'])->name('admin.spare.categories.destroy')->middleware(['can:isAdmin']);

Route::get('/admin/spare-parts/images', [SparePartImageController::class, 'showSparePartImage'])->name('vendor.spare.images')->middleware(['can:isVendor']);
Route::get('/spare-images/{id}', [SparePartImageController::class, 'createSparePartImage'])->name('vendor.spare.images.create')->middleware(['can:isVendor']);
Route::post('/admin/spare-parts/{id}/images', [SparePartImageController::class, 'storeSparePartImage'])->name('vendor.spare.images.store')->middleware(['can:isVendor']);
Route::delete('/admin/spare-images/{id}', [SparePartImageController::class, 'destroySparePartImage'])->name('vendor.spare.images.destroy')->middleware(['can:isVendor']);

Route::get('vendor/spare-parts/show', [SparePartController::class, 'showSparePart'])->name('vendor.spare-parts.index')->middleware(['can:isVendor']);
Route::get('vendor/spare-parts/create', [SparePartController::class, 'createSparePart'])->name('vendor.spare-parts.create')->middleware(['can:isVendor']);
Route::post('vendor/spare-parts/store', [SparePartController::class, 'storeSparePart'])->name('vendor.spare-parts.store')->middleware(['can:isVendor']);
Route::get('vendor/spare-parts/{sparePart}/edit', [SparePartController::class, 'editSparePart'])->name('vendor.spare-parts.edit')->middleware(['can:isVendor']);
Route::put('vendor/spare-parts/{sparePart}/update', [SparePartController::class, 'updateSparePart'])->name('vendor.spare-parts.update')->middleware(['can:isVendor']);
Route::delete('vendor/spare-parts/{sparePart}/destroy', [SparePartController::class, 'destroySparePart'])->name('vendor.spare-parts.destroy')->middleware(['can:isVendor']);
Route::get('/spare-parts', [SparePartController::class, 'showCustomerSparePart'])->name('customer.spare.parts');
Route::get('/spare-part/{id}', [SparePartController::class, 'showCustomerSparePartDetails'])->name('customer.spare.parts.show');


Route::get('carts', [CartController::class, 'showCart'])->name('customer.cart');
Route::post('cart/add/{id}', [CartController::class, 'addCart'])->name('customer.cart.add');
Route::put('cart/update/{id}', [CartController::class, 'updateCart'])->name('customer.cart.update');
Route::delete('cart/remove/{id}', [CartController::class, 'removeCart'])->name('customer.cart.remove');
Route::delete('cart/clear', [CartController::class, 'clearCart'])->name('customer.cart.clear');

Route::get('/checkout', [CheckoutController::class, 'checkoutPage'])->name('customer.checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('customer.checkout.place');

Route::get('/order/success/{id}', [CheckoutController::class, 'orderSuccess'])->name('customer.order.success');
Route::get('/orders', [CheckoutController::class, 'orderHistory'])->name('customer.orders.history');
Route::get('/orders/{id}', [CheckoutController::class, 'showOrder'])->name('customer.order.details');

Route::get('vendor/spare-parts/orders', [VendorOrderController::class, 'showVendorOrder'])->name('vendor.spare-parts.orders')->middleware(['can:isVendor']);
Route::get('vendor/spare-parts/orders/{id}', [VendorOrderController::class, 'showVendorOrderDetails'])->name('vendor.spare-parts.orders.show')->middleware(['can:isVendor']);
Route::put('vendor/spare-parts/orders/{id}/status', [VendorOrderController::class, 'updateVendorOrderStatus'])->name('vendor.spare-parts.orders.status')->middleware(['can:isVendor']);

Route::get('admin/spare-parts/orders', [AdminOrderController::class, 'adminShowOrder'])->name('admin.spare-parts.orders');
Route::get('admin/spare-parts/order/{id}', [AdminOrderController::class, 'adminShowOrderDetails'])->name('admin.spare-parts.orders.show');
Route::put('admin/spare-parts/orders/{id}/status', [AdminOrderController::class, 'adminUpdateOrderStatus'])->name('admin.spare-parts.orders.status');
Route::put('admin/spare-parts/orders/{id}/payment-status', [AdminOrderController::class, 'adminUpdatePaymentStatus'])->name('admin.spare-parts.orders.payment-status');
Route::delete('admin/spare-parts/orders/destroy/{id}', [AdminOrderController::class, 'destroyOrder'])->name('admin.spare-parts.orders.destroy');

Route::get('/loyalty', [LoyaltyController::class, 'customerLoyaltyDashboard'])->name('customer.loyalty');
Route::post('/loyalty/redeem/{id}', [LoyaltyController::class, 'redeemReward'])->name('customer.loyalty.redeem');

Route::get('admin/loyalty/rewards', [LoyaltyRewardController::class, 'showReward'])->name('admin.loyalty.rewards.index');
Route::get('admin/loyalty/rewards/create', [LoyaltyRewardController::class, 'createLoyaltyReward'])->name('admin.loyalty.rewards.create');
Route::post('admin/loyalty/rewards', [LoyaltyRewardController::class, 'storeLoyaltyReward'])->name('admin.loyalty.rewards.store');
Route::get('admin/loyalty/rewards/{id}/edit', [LoyaltyRewardController::class, 'editLoyaltyReward'])->name('admin.loyalty.rewards.edit');
Route::put('admin/loyalty/rewards/{id}', [LoyaltyRewardController::class, 'updateLoyaltyReward'])->name('admin.loyalty.rewards.update');
Route::delete('admin/loyalty/rewards/{id}', [LoyaltyRewardController::class, 'destroyLoyaltyReward'])->name('admin.loyalty.rewards.destroy');


Route::prefix('partner/roadside')
    ->name('partner.roadside.')
    ->middleware('auth')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            RoadsidePartnerController::class,
            'dashboard'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Availability
        |--------------------------------------------------------------------------
        */

        Route::post('/availability', [
            RoadsidePartnerController::class,
            'toggleAvailability'
        ])->name('availability');


        /*
        |--------------------------------------------------------------------------
        | Assistance Requests
        |--------------------------------------------------------------------------
        */

        Route::get('/requests', [
            RoadsidePartnerController::class,
            'requests'
        ])->name('requests');


        Route::get('/requests/{id}', [
            RoadsidePartnerController::class,
            'showRequest'
        ])->name('request.show');


        Route::post('/requests/{id}/accept', [
            RoadsidePartnerController::class,
            'accept'
        ])->name('accept');


        /*
        |--------------------------------------------------------------------------
        | Active Services
        |--------------------------------------------------------------------------
        */

        Route::get('/active-services', [
            RoadsidePartnerController::class,
            'activeServices'
        ])->name('active');


        Route::post('/requests/{id}/status', [
            RoadsidePartnerController::class,
            'updateStatus'
        ])->name('status');


        /*
        |--------------------------------------------------------------------------
        | Completed Services
        |--------------------------------------------------------------------------
        */

        Route::get('/completed-services', [
            RoadsidePartnerController::class,
            'completedServices'
        ])->name('completed');


        /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

        Route::get('/earnings', [
            RoadsidePartnerController::class,
            'earnings'
        ])->name('earnings');
    });

Route::get('rodeside-services', [RoadsideRequestController::class, 'showProvider'])->name('customer.roadside.providers');
Route::get('rodeside-services/location', [RoadsideRequestController::class, 'location'])->name('customer.roadside.location');
Route::get('rodeside-services/request/create/{id}', [RoadsideRequestController::class, 'createRequest'])->name('customer.roadside.request.create');
Route::post('rodeside-services/request/store', [RoadsideRequestController::class, 'roadsideRequestStore'])->name('customer.roadside.request.store');


Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Roadside Requests
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/roadside/requests',
        [RoadsideRequestController::class, 'index']
    )->name('roadside.requests.index');


    Route::get(
        '/roadside/requests/{id}',
        [RoadsideRequestController::class, 'show']
    )->name('roadside.requests.show');


    Route::post(
        '/roadside/requests/{id}/cancel',
        [RoadsideRequestController::class, 'cancel']
    )->name('roadside.requests.cancel');


    Route::delete(
        '/roadside/requests/{id}',
        [RoadsideRequestController::class, 'destroy']
    )->name('roadside.requests.destroy');
});



Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Roadside Partners
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/roadside/partners',
            [RoadsidePartnerController::class, 'index']
        )->name('roadside.partners.index');


        Route::get(
            '/roadside/partners/{id}',
            [RoadsidePartnerController::class, 'show']
        )->name('roadside.partners.show');


        Route::post(
            '/roadside/partners/{id}/approve',
            [RoadsidePartnerController::class, 'approve']
        )->name('roadside.partners.approve');


        Route::post(
            '/roadside/partners/{id}/reject',
            [RoadsidePartnerController::class, 'reject']
        )->name('roadside.partners.reject');


        Route::post(
            '/roadside/partners/{id}/activate',
            [RoadsidePartnerController::class, 'activate']
        )->name('roadside.partners.activate');


        Route::post(
            '/roadside/partners/{id}/deactivate',
            [RoadsidePartnerController::class, 'deactivate']
        )->name('roadside.partners.deactivate');


        Route::delete(
            '/roadside/partners/{id}',
            [RoadsidePartnerController::class, 'destroy']
        )->name('roadside.partners.destroy');
    });


Route::middleware('auth')->group(function () {

    Route::get(
        '/fuel-delivery',
        [FuelDeliveryController::class, 'create']
    )->name('fuel.delivery.create');

    Route::post(
        '/fuel-delivery',
        [FuelDeliveryController::class, 'store']
    )->name('fuel.delivery.store');

    Route::get(
        '/fuel-delivery/{id}',
        [FuelDeliveryController::class, 'show']
    )->name('fuel.delivery.show');

    Route::get(
        '/my-fuel-requests',
        [FuelDeliveryController::class, 'myRequests']
    )->name('fuel.delivery.my');
});


Route::middleware('auth')->prefix('fuel-partner')->name('fuel.partner.')->group(function () {

    Route::get(
        '/dashboard',
        [FuelPartnerDashboardController::class, 'dashboard']
    )->name('dashboard');

    Route::get(
        '/requests',
        [FuelPartnerDashboardController::class, 'requests']
    )->name('requests');

    Route::post(
        '/requests/{id}/accept',
        [FuelPartnerDashboardController::class, 'accept']
    )->name('requests.accept');

    Route::post(
        '/requests/{id}/reject',
        [FuelPartnerDashboardController::class, 'reject']
    )->name('requests.reject');

    Route::post(
        '/requests/{id}/assign-driver',
        [FuelPartnerDashboardController::class, 'assignDriver']
    )->name('requests.assign-driver');

    Route::post(
        '/requests/{id}/complete',
        [FuelPartnerDashboardController::class, 'complete']
    )->name('requests.complete');

    Route::get(
        '/drivers',
        [FuelPartnerDriverController::class, 'index']
    )->name('drivers.index');


    Route::get(
        '/drivers/create',
        [FuelPartnerDriverController::class, 'create']
    )->name('drivers.create');


    Route::post(
        '/drivers',
        [FuelPartnerDriverController::class, 'store']
    )->name('drivers.store');


    Route::put(
        '/drivers/{id}/status',
        [FuelPartnerDriverController::class, 'updateStatus']
    )->name('drivers.status');


    Route::delete(
        '/drivers/{id}',
        [FuelPartnerDriverController::class, 'destroy']
    )->name('drivers.destroy');
});


Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/fuel-partners',
            [FuelPartnerController::class, 'index']
        )->name('fuel-partners.index');

        Route::get(
            '/fuel-partners/{id}',
            [FuelPartnerController::class, 'show']
        )->name('fuel-partners.show');

        Route::post(
            '/fuel-partners/{id}/approve',
            [FuelPartnerController::class, 'approve']
        )->name('fuel-partners.approve');

        Route::post(
            '/fuel-partners/{id}/reject',
            [FuelPartnerController::class, 'reject']
        )->name('fuel-partners.reject');

        Route::post(
            '/fuel-partners/{id}/suspend',
            [FuelPartnerController::class, 'suspend']
        )->name('fuel-partners.suspend');
    });

Route::middleware(['auth'])->prefix('fuel-driver')->name('fuel.driver.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [FuelDriverDashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | All Deliveries
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/deliveries',
        [FuelDriverDashboardController::class, 'deliveries']
    )->name('deliveries.index');


    /*
    |--------------------------------------------------------------------------
    | Delivery Details
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/deliveries/{id}',
        [FuelDriverDashboardController::class, 'showDelivery']
    )->name('deliveries.show');


    /*
    |--------------------------------------------------------------------------
    | Update Delivery Status
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/deliveries/{id}/status',
        [FuelDriverDashboardController::class, 'updateDeliveryStatus']
    )->name('deliveries.status');
});


Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | VIP Membership
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/vip-membership',
        [SubscriptionController::class, 'index']
    )->name('subscriptions.index');


    Route::get(
        '/vip-membership/{id}',
        [SubscriptionController::class, 'show']
    )->name('subscriptions.show');


    Route::post(
        '/vip-membership/{id}/subscribe',
        [SubscriptionController::class, 'subscribe']
    )->name('subscriptions.subscribe');


    Route::post(
        '/vip-membership/{id}/cancel',
        [SubscriptionController::class, 'cancel']
    )->name('subscriptions.cancel');


    Route::get(
        '/my-subscriptions',
        [SubscriptionController::class, 'mySubscriptions']
    )->name('subscriptions.my');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('countries', CountryController::class);
});

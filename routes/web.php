<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SubscriptionPurchaseController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Admin login routes (no middleware)
Route::get('admin/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Redirect /admin to /admin/login if not authenticated
Route::get('admin', function() {
    return redirect()->route('admin.login');
});

// Admin protected routes
Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminPagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/buyer', [AdminPagesController::class, 'buyer'])->name('buyer');
    Route::get('/buyer/{id}', [AdminPagesController::class, 'buyerDetails'])->name('buyer.show');
    Route::get('/seller', [AdminPagesController::class, 'seller'])->name('seller');
    Route::get('/seller/{id}', [AdminPagesController::class, 'supplierDetails'])->name('seller.show');
    Route::get('/manufacturer', [AdminPagesController::class, 'manufacturer'])->name('manufacturer');
    Route::get('/manufacturer/{id}', [AdminPagesController::class, 'manufacturerDetails'])->name('manufacturer.show');
    Route::get('/service', [AdminPagesController::class, 'service'])->name('service');
    Route::get('/orders', [AdminPagesController::class, 'orders'])->name('orders');
    Route::get('/tracking', [AdminPagesController::class, 'tracking'])->name('tracking');
    Route::get('/plan', [AdminPagesController::class, 'plan'])->name('plan');
    Route::get('/enquiry', [AdminPagesController::class, 'enquiry'])->name('enquiry');
    Route::get('/payment', [AdminPagesController::class, 'payment'])->name('payment');
    Route::get('/profile', [AdminPagesController::class, 'profile'])->name('profile');
    Route::get('/newsletter', [AdminPagesController::class, 'newsletterList'])->name('newsletter.list');
    Route::get('/contact-us', [AdminPagesController::class, 'contactList'])->name('contact.list');
    
    Route::get('/material', [AdminMaterialController::class, 'index'])->name('material');
    Route::get('/material/create', [AdminMaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [AdminMaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}/edit', [AdminMaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{id}', [AdminMaterialController::class, 'update'])->name('material.update');
    Route::get('/material/{id}', [AdminMaterialController::class, 'show'])->name('material.show');
    Route::delete('/material/{id}', [AdminMaterialController::class, 'destroy'])->name('material.destroy');
    Route::post('/material/{id}/toggle', [AdminMaterialController::class, 'toggleStatus'])->name('material.toggle');
    Route::post('/material/{id}/certification', [AdminMaterialController::class, 'toggleCertification'])->name('material.certification');


    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::post('buyer/status/{id}', [\App\Http\Controllers\Admin\AdminPagesController::class, 'toggleBuyerStatus'])->name('buyer.status');
    Route::post('seller/status/{id}', [\App\Http\Controllers\Admin\AdminPagesController::class, 'toggleSellerStatus'])->name('seller.toggle');
    Route::post('manufacturer/status/{id}', [\App\Http\Controllers\Admin\AdminPagesController::class, 'toggleManufacturerStatus'])->name('manufacturer.toggle');
    Route::resource('subscription', \App\Http\Controllers\Admin\SubscriptionPlanController::class);
});


Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('about.us');
Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-condition', [PagesController::class, 'termsCondition'])->name('terms.condition');
Route::get('/category', [PagesController::class, 'category'])->name('category');
Route::get('/contact-us', [PagesController::class, 'contactUs'])->name('contact.us');
Route::get('/listing', [PagesController::class, 'listing'])->name('listing');
Route::get('/listing-details/{id}', [PagesController::class, 'listingDetails'])->name('listing.details');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/wishlist', [\App\Http\Controllers\UserMaterialCollectionController::class, 'wishlist'])->name('wishlist');
    Route::post('/collections/{collection}/{material}', [\App\Http\Controllers\UserMaterialCollectionController::class, 'toggle'])->name('collection.toggle');
});

Route::get('/compare', [\App\Http\Controllers\UserMaterialCollectionController::class, 'compare'])
    ->middleware('auth')->name('user.compare');

Route::get('/compare/add/{material}', [\App\Http\Controllers\UserMaterialCollectionController::class, 'addToCompare'])
    ->middleware('auth')->name('compare.add');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.forgot.send');
Route::get('/forgot-password/otp', [ForgotPasswordController::class, 'otpForm'])->name('password.otp.form');
Route::post('/forgot-password/otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.otp.verify');
Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'resetForm'])->name('password.reset.form');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'reset'])->name('password.reset.submit');
Route::get('/sign-up', [RegisterController::class, 'showRegistrationForm'])->name('sign.up');
Route::post('/sign-up', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/otp', [LoginController::class, 'otpForm'])->name('otp.form');
Route::post('/otp-verify', [LoginController::class, 'otpVerify'])->middleware('throttle:6,1')->name('otp.verify');
Route::get('/single-blog', [PagesController::class, 'singleBlog'])->name('single.blog');
Route::get('/subscription', [PagesController::class, 'subscription'])->name('subscription');
Route::get('/subscription-plan', [PagesController::class, 'subscriptionPlan'])->name('subscription.plan');
Route::get('/raw-material-supplier', [PagesController::class, 'rawMaterialSupplier'])->name('raw.material.supplier');
Route::get('/reducing-textiles', [PagesController::class, 'reducingTextiles'])->name('reducing.textiles');
Route::get('/ai-driven-suggestion', [PagesController::class, 'aiDrivenSuggestion'])->name('ai.driven.suggestion');
Route::get('/manufacturers', [PagesController::class, 'manufacturer'])->name('manufacturer');
Route::get('/post-production-services', [PagesController::class, 'postProductionServices'])->name('post.production.services');
Route::post('/newsletter', [PagesController::class, 'newsletter'])->name('newsletter.store');
Route::post('/contact-us', [PagesController::class, 'contactUsStore'])->name('contact-us.store');


// Route::prefix('seller')->name('seller.')->middleware(['auth:supplier'])->group(function () {


// Route::prefix('seller')->name('seller.')->group(function () {
Route::prefix('seller')->name('seller.')->middleware(['auth:supplier'])->group(function () {
    Route::get('/production', [\App\Http\Controllers\ProductionController::class, 'index'])->name('production.index');
    Route::post('/production', [\App\Http\Controllers\ProductionController::class, 'create'])->name('production.create');
    Route::get('/production/{project}', [\App\Http\Controllers\ProductionController::class, 'show'])->name('production.show');
    Route::post('/production/{project}/milestones/{milestone?}', [\App\Http\Controllers\ProductionController::class, 'milestone'])->name('production.milestone');
    Route::post('/production/{project}/samples', [\App\Http\Controllers\ProductionController::class, 'submitSample'])->name('production.samples.submit');
    Route::post('/production/{project}/comments', [\App\Http\Controllers\ProductionController::class, 'comment'])->name('production.comments');
    Route::post('/production/{project}/files', [\App\Http\Controllers\ProductionController::class, 'file'])->name('production.files');
    Route::post('/production/{project}/deliveries/{delivery?}', [\App\Http\Controllers\ProductionController::class, 'delivery'])->name('production.delivery');
    Route::post('/production/{project}/meetings', [\App\Http\Controllers\ProductionController::class, 'meeting'])->name('production.meetings');
    Route::get('/samples', [\App\Http\Controllers\SampleSystemController::class, 'manage'])->name('samples.index');
    Route::get('/orders/{order}/sharing', [\App\Http\Controllers\SampleSystemController::class, 'buyerOrder'])->name('orders.sharing');
    Route::post('/samples', [\App\Http\Controllers\SampleSystemController::class, 'storeSample'])->name('samples.store');
    Route::post('/samples/{sample}/documents', [\App\Http\Controllers\SampleSystemController::class, 'storeSampleDocument'])->name('samples.documents.store');
    Route::put('/samples/{sample}', [\App\Http\Controllers\SampleSystemController::class, 'updateSample'])->name('samples.update');
    Route::delete('/samples/{sample}', [\App\Http\Controllers\SampleSystemController::class, 'destroySample'])->name('samples.destroy');
    Route::post('/sample-purchases/{purchase}/decision', [\App\Http\Controllers\SampleSystemController::class, 'sellerDecision'])->name('samples.decision');
    Route::get('/sample-purchases/{purchase}', [\App\Http\Controllers\SampleSystemController::class, 'purchaseShow'])->name('samples.purchase.show');
    Route::post('/orders/{order}/files', [\App\Http\Controllers\SampleSystemController::class, 'addOrderFile'])->name('orders.files.store');
    Route::post('/orders/{order}/messages', [\App\Http\Controllers\SampleSystemController::class, 'orderMessage'])->name('orders.messages.store');
    Route::post('/sample-purchases/{purchase}/status', [\App\Http\Controllers\SampleSystemController::class, 'status'])->name('samples.status');
    Route::post('/sample-purchases/{purchase}/messages', [\App\Http\Controllers\SampleSystemController::class, 'message'])->name('samples.messages');
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::get('/enquiry', [SellerController::class, 'enquiry'])->name('enquiry');
    Route::get('/material', [MaterialController::class, 'index'])->name('material');
    Route::get('/material/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{id}', [MaterialController::class, 'update'])->name('material.update');
    Route::get('/material/{id}', [MaterialController::class, 'show'])->name('material.show');
    Route::delete('/material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');
    Route::post('/material/{id}/toggle', [MaterialController::class, 'toggleStatus'])->name('material.toggle');
    Route::get('/orders', [SellerController::class, 'orders'])->name('orders');
    Route::get('/plans', [SellerController::class, 'plans'])->name('plans');
    Route::get('/payment', [SellerController::class, 'payment'])->name('payment');
    Route::get('/profile', [SellerController::class, 'profile'])->name('profile');
    Route::post('/profile', [SellerController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/business', [SellerController::class, 'updateBusiness'])->name('profile.business');
    Route::get('/logout', [SellerController::class, 'logout'])->name('logout');
    // Approve enquiry (and create order)
    Route::post('/enquiry/{id}/approve', [EnquiryController::class, 'approveBySupplier'])->name('enquiry.approve');
});

// Route::get('/payment/success-proxy', function (Request $request) {
//     $sessionId = $request->query('session_id');

//     // If no session ID, redirect safely to homepage
//     if (!$sessionId) {
//         return Redirect::to('/');
//     }

//     // Encode session ID safely for URL
//     $encoded = urlencode($sessionId);

//     // Redirect internally using a clean URL (this avoids ModSecurity triggers)
//     return Redirect::to("/payment/success?session_id={$encoded}");
// });

Route::post('/subscription/purchase', [SubscriptionPurchaseController::class, 'purchase'])->name('subscription.purchase');
Route::get('/payment/success', [SubscriptionPurchaseController::class, 'success'])->name('payment.success');



Route::post('/subscription/free', [SubscriptionPurchaseController::class, 'free'])->name('subscription.free');
Route::post('/stripe/charge', [SubscriptionPurchaseController::class, 'charge'])->name('stripe.charge');
// Enquiry create (user must be logged in)
Route::post('/enquiry', [EnquiryController::class, 'store'])->middleware('auth')->name('enquiry.store');

Route::get('/chat/unread', [\App\Http\Controllers\ChatController::class, 'unread'])->name('chat.unread');
Route::get('/chat/{enquiry}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
Route::get('/chat/{enquiry}/messages', [\App\Http\Controllers\ChatController::class, 'messages'])->name('chat.messages');
Route::post('/chat/{enquiry}/messages', [\App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');

// User dashboard routes
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/production', [\App\Http\Controllers\ProductionController::class, 'index'])->name('production.index');
    Route::get('/production/{project}', [\App\Http\Controllers\ProductionController::class, 'show'])->name('production.show');
    Route::post('/production/{project}/samples/{submission}/review', [\App\Http\Controllers\ProductionController::class, 'reviewSample'])->name('production.samples.review');
    Route::post('/production/{project}/comments', [\App\Http\Controllers\ProductionController::class, 'comment'])->name('production.comments');
    Route::post('/production/{project}/files', [\App\Http\Controllers\ProductionController::class, 'file'])->name('production.files');
    Route::post('/production/{project}/meetings', [\App\Http\Controllers\ProductionController::class, 'meeting'])->name('production.meetings');
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/subscriptions', [UserDashboardController::class, 'subscriptions'])->name('subscriptions');
    Route::get('/enquiries', [UserDashboardController::class, 'enquiries'])->name('enquiries');
    Route::get('/orders', [UserDashboardController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}/sharing', [\App\Http\Controllers\SampleSystemController::class, 'buyerOrder'])->name('orders.sharing');
    Route::get('/samples', [\App\Http\Controllers\SampleSystemController::class, 'myPurchases'])->name('samples.orders');
    Route::get('/materials/{material}/samples', [\App\Http\Controllers\SampleSystemController::class, 'materialSamples'])->name('materials.samples');
    Route::post('/orders/{order}/files', [\App\Http\Controllers\SampleSystemController::class, 'uploadFile'])->name('orders.files.store');
    Route::post('/orders/{order}/messages', [\App\Http\Controllers\SampleSystemController::class, 'orderMessage'])->name('orders.messages.store');
    Route::delete('/sharing/files/{file}', [\App\Http\Controllers\SampleSystemController::class, 'deleteFile'])->name('sharing.files.destroy');
    Route::post('/samples/purchase', [\App\Http\Controllers\SampleSystemController::class, 'purchase'])->name('samples.purchase');
    Route::get('/samples/purchases/{purchase}', [\App\Http\Controllers\SampleSystemController::class, 'purchaseShow'])->name('samples.purchase.show');
    Route::post('/samples/purchases/{purchase}/checkout', [\App\Http\Controllers\SampleSystemController::class, 'checkout'])->name('samples.checkout');
    Route::get('/samples/purchases/{purchase}/success', [\App\Http\Controllers\SampleSystemController::class, 'checkoutSuccess'])->name('samples.checkout.success');
    Route::post('/samples/purchases/{purchase}/status', [\App\Http\Controllers\SampleSystemController::class, 'status'])->name('samples.status');
    Route::post('/samples/purchases/{purchase}/messages', [\App\Http\Controllers\SampleSystemController::class, 'message'])->name('samples.messages');
    Route::get('/report', [UserDashboardController::class, 'report'])->name('report');
    Route::get('/tracking', [UserDashboardController::class, 'tracking'])->name('tracking');
    Route::get('/payments', [UserDashboardController::class, 'payments'])->name('payments');
    Route::get('/orders/export', [UserDashboardController::class, 'export'])->name('orders.export');
    Route::post('/orders/{id}/pay', [\App\Http\Controllers\OrderPaymentController::class, 'checkout'])->name('orders.pay');
    Route::get('/orders/success', [\App\Http\Controllers\OrderPaymentController::class, 'success'])->name('orders.success');
    Route::get('/logout', [UserDashboardController::class, 'logout'])->name('logout');
});

// Manufacturer dashboard routes (similar to seller)
Route::prefix('manufacturer')->name('manufacturer.')->middleware(['auth:manufacturer'])->group(function () {
    Route::get('/production', [\App\Http\Controllers\ProductionController::class, 'index'])->name('production.index');
    Route::post('/production', [\App\Http\Controllers\ProductionController::class, 'create'])->name('production.create');
    Route::get('/production/{project}', [\App\Http\Controllers\ProductionController::class, 'show'])->name('production.show');
    Route::post('/production/{project}/progress', [\App\Http\Controllers\ProductionController::class, 'progress'])->name('production.progress');
    Route::post('/production/{project}/milestones/{milestone?}', [\App\Http\Controllers\ProductionController::class, 'milestone'])->name('production.milestone');
    Route::post('/production/{project}/samples', [\App\Http\Controllers\ProductionController::class, 'submitSample'])->name('production.samples.submit');
    Route::post('/production/{project}/comments', [\App\Http\Controllers\ProductionController::class, 'comment'])->name('production.comments');
    Route::post('/production/{project}/files', [\App\Http\Controllers\ProductionController::class, 'file'])->name('production.files');
    Route::post('/production/{project}/deliveries/{delivery?}', [\App\Http\Controllers\ProductionController::class, 'delivery'])->name('production.delivery');
    Route::post('/production/{project}/shipments/{shipment?}', [\App\Http\Controllers\ProductionController::class, 'shipment'])->name('production.shipment');
    Route::post('/production/{project}/meetings', [\App\Http\Controllers\ProductionController::class, 'meeting'])->name('production.meetings');
    Route::get('/samples', [\App\Http\Controllers\SampleSystemController::class, 'manage'])->name('samples.index');
    Route::get('/orders/{order}/sharing', [\App\Http\Controllers\SampleSystemController::class, 'buyerOrder'])->name('orders.sharing');
    Route::post('/samples', [\App\Http\Controllers\SampleSystemController::class, 'storeSample'])->name('samples.store');
    Route::post('/samples/{sample}/documents', [\App\Http\Controllers\SampleSystemController::class, 'storeSampleDocument'])->name('samples.documents.store');
    Route::put('/samples/{sample}', [\App\Http\Controllers\SampleSystemController::class, 'updateSample'])->name('samples.update');
    Route::delete('/samples/{sample}', [\App\Http\Controllers\SampleSystemController::class, 'destroySample'])->name('samples.destroy');
    Route::post('/sample-purchases/{purchase}/decision', [\App\Http\Controllers\SampleSystemController::class, 'sellerDecision'])->name('samples.decision');
    Route::get('/sample-purchases/{purchase}', [\App\Http\Controllers\SampleSystemController::class, 'purchaseShow'])->name('samples.purchase.show');
    Route::post('/orders/{order}/files', [\App\Http\Controllers\SampleSystemController::class, 'addOrderFile'])->name('orders.files.store');
    Route::post('/orders/{order}/messages', [\App\Http\Controllers\SampleSystemController::class, 'orderMessage'])->name('orders.messages.store');
    Route::post('/sample-purchases/{purchase}/status', [\App\Http\Controllers\SampleSystemController::class, 'status'])->name('samples.status');
    Route::post('/sample-purchases/{purchase}/messages', [\App\Http\Controllers\SampleSystemController::class, 'message'])->name('samples.messages');
    Route::get('/dashboard', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'dashboard'])->name('dashboard');
    Route::get('/enquiry', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'enquiry'])->name('enquiry');
    Route::get('/orders', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'orders'])->name('orders');
    Route::get('/plans', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'plans'])->name('plans');
    Route::get('/payment', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'payment'])->name('payment');
    Route::get('/profile', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'profile'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/business', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'updateBusiness'])->name('profile.business');
    Route::get('/logout', [\App\Http\Controllers\Manufacturer\ManufacturerController::class, 'logout'])->name('logout');
    // Approve enquiry (and create order)
    Route::post('/enquiry/{id}/approve', [EnquiryController::class, 'approveByManufacturer'])->name('enquiry.approve');

    // Materials CRUD
    Route::get('/material', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'index'])->name('material');
    Route::get('/material/create', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}/edit', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{id}', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'update'])->name('material.update');
    Route::get('/material/{id}', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'show'])->name('material.show');
    Route::delete('/material/{id}', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'destroy'])->name('material.destroy');
    Route::post('/material/{id}/toggle', [\App\Http\Controllers\Manufacturer\MaterialController::class, 'toggleStatus'])->name('material.toggle');
});

Route::middleware(['auth:supplier,manufacturer,web'])->get('/sharing/files/{file}', [\App\Http\Controllers\SampleSystemController::class, 'downloadFile'])->name('sharing.files.download');
Route::middleware(['admin.auth'])->post('/admin/sample-purchases/{purchase}/confirm-payment', [\App\Http\Controllers\SampleSystemController::class, 'manualPaymentConfirmed'])->name('admin.samples.payment.confirm');
Route::middleware(['admin.auth'])->get('/admin/production', [\App\Http\Controllers\ProductionController::class, 'admin'])->name('admin.production.index');
Route::middleware(['admin.auth'])->get('/admin/production/export', [\App\Http\Controllers\ProductionController::class, 'adminExport'])->name('admin.production.export');
Route::middleware(['auth:supplier,manufacturer,web'])->get('/production/files/{file}', [\App\Http\Controllers\ProductionController::class, 'download'])->name('production.files.download');
Route::middleware(['admin.auth'])->get('/admin/sample-purchases', [\App\Http\Controllers\SampleSystemController::class, 'adminPurchases'])->name('admin.samples.index');

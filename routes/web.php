<?php

use App\Http\Controllers\Api\CaptchaController as ApiCaptchaController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\CaptchaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmailVerifyController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PdfController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SellController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Frontend\OtpController;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mews\Captcha\Facades\Captcha;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//!<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< BACKEND ROUTES >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

Auth::routes(['register' => false]);

// Email Verification Routes
Route::middleware('auth')->prefix('email')->group(function () {
    Route::get('/verify', [EmailVerifyController::class, 'notice'])->name('verification.notice');
    Route::post('/verification-notification', [EmailVerifyController::class, 'verificationSend'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
});

// Localization Route
Route::get('lang/change', [LangController::class, 'lang_change'])->name('lang.change');

//Captcha Route
Route::get('reload-captcha', [CaptchaController::class, 'reloadCaptcha']);

// AUTH group route for users, categories, subcategories and products
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'dashboard']);

    // users CRUD routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('role:Super Admin');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('role:Super Admin');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:Super Admin');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update')->middleware('role:Super Admin');
    Route::get('/users/{id}/delete', [UserController::class, 'delete'])->name('users.delete')->middleware('role:Super Admin');

    // change password routes
    Route::get('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');

    // Categories routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'createCat'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');


    // SUB Categories routes
    Route::get('/Subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/subCategory/create', [SubCategoryController::class, 'createSubCat'])->name('subcategory.create');
    Route::get('/subCategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::get('/subCategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
    Route::post('subCategory/store', [SubCategoryController::class, 'storeSubCat'])->name('subcategory.store');
    Route::put('/subCategory/update', [SubCategoryController::class, 'update'])->name('subcategory.update');

    // Products routes
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

    // Dependant dropdown menu while product
    Route::post('/getSubCategory', [SubCategoryController::class, 'getSubCategory'])->name('product.getSubcategory');

    // Customer crud routes in admin panel
    Route::resource('customers', CustomerController::class);

    //Supplier crud routes
    Route::resource('suppliers', SupplierController::class);

    //Purchase crud routes
    Route::resource('purchases', PurchaseController::class);
    // Route::post('/purchases/submit-form', [PurchaseController::class, 'formSubmit'])->name('purchase.cart');
    Route::post('/purchases/store-data', [PurchaseController::class, 'storeData'])->name('purchases.store');
    Route::post('/purchases/autocomplete/products', [PurchaseController::class, 'autoCompleteProducts'])->name('autoComplete.product');


    //Branch crud routes
    Route::resource('branches', BranchController::class);

    // Stock 
    Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');

    //POS
    Route::get('/pos/create', [PosController::class, 'index'])->name('pos.index');
    Route::post('/purchases/autocomplete/customer', [PosController::class, 'autoCompleteCustomer'])->name('autoComplete.customer');
    Route::post('/pos/autocomplete/products', [PosController::class, 'autoCompletePosProducts'])->name('autoComplete.pos.product');
    Route::get('/pos/product/filter', [PosController::class, 'productFilter'])->name('pos.product.filter');
    Route::get('/pos/products', [PosController::class, 'productFetch'])->name('pos.products');
    Route::post('/pos/store-data', [PosController::class, 'storeData'])->name('pos.store');

    // Sell
    Route::resource('sells', SellController::class);

    // PDF
    Route::post('/pdf/download', [PdfController::class, 'downloadInvoice'])->name('pdf.download');

    // Roles routes with role of Super Admin only
    Route::group(['middleware' => 'role:Super Admin'], function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
        Route::post('/roles/permission/store', [RoleController::class, 'permissionStore'])->name('permission.store');
        Route::post('/roles/permissions/store', [RoleController::class, 'rolePermissionStore'])->name('roles.permission.store');
    });

    // Dependant Role-Permission Checkbox AJAX call route
    Route::post('/getRole', [RoleController::class, 'getRole']);
});



Route::get('send/mail', function () {
    $userMail = 'iqbal@gmail.com';

    // dispatch(new SendEmailJob($userMail));
    SendEmailJob::dispatch($userMail);

    dd('Send mail successfully');
});

//Captcha APIs
Route::get('api/captcha', [ApiCaptchaController::class, 'view']);


// Route::get('/otp', function () {
//     return view('frontend.otp');
// });

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    abort(403, 'Unauthorized');
})->name('login');

Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('login', [VendorAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [VendorAuthController::class, 'login'])->name('login.submit');
    Route::get('register', [VendorAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [VendorAuthController::class, 'register']);

    Route::middleware('auth:vendor')->group(function () {
        Route::get('dashboard', function () {
            return view('vendor.dashboard');
        })->name('dashboard');

        Route::post('logout', [VendorAuthController::class, 'logout'])->name('logout');
    });
});





Route::prefix('admin')->name('admin.')->group(function () {

    // Login routes
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Routes protected by admin authentication
    Route::middleware('auth:admin')->group(function () {

        Route::resource('categories', CategoryController::class);
        Route::any('update-category', [CategoryController::class, 'updateCategory'])->name('update-category');
        
        Route::resource('subcategories', SubCategoryController::class);
        Route::any('update-subcategory', [SubCategoryController::class, 'updateSubCategory'])->name('update-subcategory');
        Route::get('/get-subcategories/{category_id}', [ServiceController::class, 'getSubcategories'])->name('get.subcategories');

        Route::resource('service-types', ServiceTypeController::class);
        Route::any('update-service-types', [ServiceTypeController::class, 'updateServiceType'])->name('update-service-types');
        
        Route::resource('services', ServiceController::class);
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

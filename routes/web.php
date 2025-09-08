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

Route::prefix('vendor')->group(function () {

    // Registration Routes
    Route::get('register', [VendorAuthController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('register', [VendorAuthController::class, 'register']);

    // Login Routes
    Route::get('login', [VendorAuthController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('login', [VendorAuthController::class, 'login']);

    // Routes protected by vendor authentication
    Route::middleware('auth:vendor')->group(function () {
        // Vendor Dashboard
        Route::get('dashboard', function () {
            return view('vendor.dashboard'); // create this Blade file
        })->name('vendor.dashboard');

        // Logout
        Route::post('logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
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
        
        Route::resource('service-types', ServiceTypeController::class);
        Route::any('update-service-types', [ServiceTypeController::class, 'updateServiceType'])->name('update-service-types');
        
        Route::resource('services', ServiceController::class);
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

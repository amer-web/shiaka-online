<?php

use App\Http\Controllers\Admin\CustomerAddressController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\ProductCouponController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\ShippingCompanyController;
=======
use App\Http\Controllers\Auth\LoginController;
>>>>>>> 4cc0fdf4963698c3b557caa4c42c821eda32f0d2
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin.')->prefix('admin')->group(function () {
<<<<<<< HEAD
    Route::get('/', [IndexController::class, 'index'])->name('index');
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login', 'Auth\LoginController@login')->name('login');
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');
    Route::resource('languages', LanguagesController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::resource('product_coupons', ProductCouponController::class);
    Route::resource('product_reviews', ProductReviewController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('shipping_companies',ShippingCompanyController::class);
    Route::post('customer_addresses/get_states',[CustomerAddressController::class,'get_states'])->name('customer_addresses.get_states');
    Route::post('customer_addresses/get_cities',[CustomerAddressController::class,'get_cities'])->name('customer_addresses.get_cities');
    Route::resource('customer_addresses',CustomerAddressController::class);
    Route::get('customer_addresses/create/{id}',[CustomerAddressController::class,'create'])->name('customer_addresses.create');

=======
    Route::get('login', [LoginController::class, 'showLoginFormAdmin'])->name('login');
    // Route::post('login', 'Auth\LoginController@login')->name('login');
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

    Route::middleware(['auth','role:admin'])->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::resource('languages', LanguagesController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        // Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    });
>>>>>>> 4cc0fdf4963698c3b557caa4c42c821eda32f0d2
});

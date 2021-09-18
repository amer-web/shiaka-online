<?php

use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
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
});

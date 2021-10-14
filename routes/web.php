<?php

use App\Http\Controllers\Frontend\CustomerOrderController;
use App\Http\Controllers\Frontend\CustomersDashboardController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Livewire\Frontend\CartPage;
use App\Http\Livewire\Frontend\Checkout;
use App\Http\Livewire\Frontend\ProductDetails;
use App\Http\Livewire\Frontend\ShopProduct;
use App\Http\Livewire\Frontend\WishListPage;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('alpine', 'alpine');
Route::prefix(LaravelLocalization::setLocale())->middleware([ 'localizationRedirect', 'localeSessionRedirect','localize','currency'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get(LaravelLocalization::transRoute('admin.product'), ProductDetails::class)->name('product.details');
    Route::get('shop/{slug?}', ShopProduct::class)->name('frontend.shop');
    Route::get('cart', CartPage::class)->name('frontend.cart');
    Route::get('wishlist', WishListPage::class)->name('frontend.wishlist');
    Route::middleware('auth')->group(function () {
        Route::get('checkout', Checkout::class)->name('frontend.checkout');
        Route::post('checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
        Route::get('checkout/{id}/completed', [PaymentController::class, 'completed'])->name('frontend.checkout.complete');
        Route::get('checkout/{id}/cancelled', [PaymentController::class, 'cancel'])->name('frontend.checkout.cancel');
        Route::get('dashboard',[CustomersDashboardController::class,'index'])->name('customer.dashboard');
        Route::resource('orders',CustomerOrderController::class);
        Route::get('addresses',[CustomersDashboardController::class,'address'])->name('customer.address');
        Route::get('profile',[CustomersDashboardController::class,'profile'])->name('customer.profile');
    });
});
Auth::routes();
Route::get('/test', function () {
    return 'test';
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

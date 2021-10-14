<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Services\OmniPayService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class IndexController extends Controller
{
    public function index()
    {

        return view('frontend.index');
    }
//    public function productDetails(Product $slug)
//    {
//        $product = $slug;
//        $productsRelated = $this->product->where('category_id', $product->category_id)->where('id', '<>', $product->id)->whereStatus(1)->inRandomOrder()->with('media','translations')->take(6)->get();
//        return view('frontend.product-details', compact('product', 'productsRelated'));
//    }
}

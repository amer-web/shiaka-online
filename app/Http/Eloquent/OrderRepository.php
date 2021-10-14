<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCoupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface
{
    public function create($data)
    {

        $rating_default_currency = currency(getNumbers()->get('total'),null,null,false) / (currency(getNumbers()->get('total'),null,config('currency.default'),false));
        $order = Order::create([
            'ref_id' => 'Order-' . Str::random(10),
            'user_id' => auth()->user()->id,
            'shipping_company_id' => $data['shipping_company_id'],
            'user_address_id' => $data['user_address_id'],
            'payment_method' => $data['payment-method'],
            'subtotal' => getNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount' => getNumbers()->get('discount'),
            'tax' => getNumbers()->get('tax'),
            'shipping' => getNumbers()->get('shipping'),
            'total' => getNumbers()->get('total'),
            'currency' => config('currency.default'),
            'total_paid' => currency(getNumbers()->get('total'),null,'USD',false),
            'payment_currency' => currency()->getUserCurrency(),
            'rating_default_currency' => $rating_default_currency,
        ]);
        foreach (cartItems() as $item) {
            $order->products()->attach(
                $item->model->id,
                ['qty' => $item->qty,
                ]);
        }
        return $order;

    }
}

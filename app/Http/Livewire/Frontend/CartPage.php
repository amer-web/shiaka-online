<?php

namespace App\Http\Livewire\Frontend;

use App\Models\ProductCoupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPage extends Component
{
    public $quantity;
    public $coupon_code;
    public $discount;
    public $subtotal;
    public $countCart;
    public $tax;
    public $total;

    public function render()
    {
        (session()->has('currency') ? currency()->setUserCurrency(session()->get('currency')) : null);
        $items = cartItems();
        $this->countCart = Cart::instance('default')->content()->count();
        $this->discount = getNumbers()->get('discount') ;
        $this->tax = currency(getNumbers()->get('tax')) ;
        $this->total = currency(getNumbers()->get('total'));
        $this->subtotal =  currency(getNumbers()->get('subtotal'));
        return view('livewire.frontend.cart-page', ['items' => $items])->extends('layouts.frontend.app');
    }

    public function inCreaseQuantityProduct($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($item->rowId, $item->qty + 1);
        $this->emit('refreshMiniCart');
        if (session()->has('coupon')) {
            session()->remove('coupon');
            $this->coupon_code = '';
        }
        $this->alert('success', 'تم تحديث عربة التسوق بنجاح');
    }

    public function deCreaseQuantityProduct($rowId)
    {
        $item = Cart::get($rowId);
        if ($item->qty > 1) {
            Cart::update($item->rowId, $item->qty - 1);
            $this->alert('success', 'تم تحديث عربة التسوق بنجاح');
            $this->emit('refreshMiniCart');
            if (session()->has('coupon')) {
                session()->remove('coupon');
                $this->coupon_code = '';
            }
        } else {

        }
    }

    public function itemRemove($rowId)
    {
        Cart::instance('default')->remove($rowId);
        if (session()->has('coupon')) {
            session()->remove('coupon');
            $this->coupon_code = '';
        }
        $this->emit('refreshMiniCart');
        $this->alert('success', 'تم تحديث عربة التسوق بنجاح');
    }

    public function applyDiscount()
    {
        if ($this->coupon_code != '') {
            $coupon = ProductCoupon::where('code', $this->coupon_code)->whereStatus(1)->first();
            if ($coupon) {
                $discount = $coupon->discount($this->subtotal);
                if ($discount > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'discount' => $discount
                    ]);
                    $this->emit('refreshMiniCart');
                } else {
                    $this->alert('warning', 'هذا الكود ليس عليه تخفيض');
                }
            } else {
                $this->alert('error', 'هذا الكود غير صالح');
            }
        } else {
            $this->alert('error', 'ادخل كود الخصم');
        }
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->coupon_code = '';
        $this->emit('refreshMiniCart');
        $this->alert('success', 'تم حذف الكوبون بنجاح');
    }
}

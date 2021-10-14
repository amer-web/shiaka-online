<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishListPage extends Component
{
    public function render()
    {
        $items = Cart::instance('wishlist')->content();
        return view('livewire.frontend.wish-list-page', ['items' => $items])->extends('layouts.frontend.app');
    }

    public function itemRemove($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('refreshMiniCart');
        $this->alert('success', 'تم تحديث تحديث قائمة الأمنيات بنجاح');
    }
    public function removeAndMoveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        Cart::instance('default')->add($item,$item->qty);
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('refreshMiniCart');
        $this->alert('success', 'تم تحديث عربة التسوق بنجاح');
    }
}

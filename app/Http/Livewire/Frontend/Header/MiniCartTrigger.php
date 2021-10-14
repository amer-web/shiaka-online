<?php

namespace App\Http\Livewire\Frontend\Header;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class MiniCartTrigger extends Component
{
    public $countWishlist;
    public $countCart;
    public $totalCart;
    public $l;

    protected function getListeners()
    {
        return ['refreshMiniCart' => '$refresh'];
    }

    function render()
    {
        $this->refresh();
        return view('livewire.frontend.header.mini-cart-trigger');
    }

    public function refresh()
    {

        (session()->has('currency') ? currency()->setUserCurrency(session()->get('currency')) : null);
        $this->countWishlist = Cart::instance('wishlist')->content()->count();
        $this->countCart = cartItems()->count();
        $this->totalCart = currency(getNumbers()->get('total'));
    }


}

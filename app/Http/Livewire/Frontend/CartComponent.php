<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{

    protected function getListeners()
    {
        return ['addToCartComponent' => 'addToCart','addToWishlistComponent' => 'addToWishlist'];
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->price)->associate(Product::class);
        $this->alert('success', 'تم اضافة المنتج فى عربة التسوق');
        $this->emit('refreshMiniCart');
    }

    public function addToWishlist($id)
    {
        $product = Product::find($id);;
        $checkProduct = Cart::instance('wishlist')->content()->search(function ($cartItem, $id) use ($product) {
            return $cartItem->id == $product->id;
        });
        if ($checkProduct) {
            $this->emit('close');
            $this->alert('warning', 'تم اضافة المنتج من قبل');
        } else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)->associate(Product::class);
            $this->emit('close');
            $this->alert('success', 'تم اضافة المنتج فى قائمة الأمنيات');
            $this->emit('refreshMiniCart');
        }
    }



    public function render()
    {
        return view('livewire.frontend.cart-component');
    }
}

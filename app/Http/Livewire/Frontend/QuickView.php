<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class QuickView extends Component
{
    public $viewModal = false;
    public $product = [];
    public $quantity = 1;

    protected function getListeners()
    {
        return ['viewProduct' => 'viewProductQuick'];
    }

    public function render()
    {
        return view('livewire.frontend.quick-view');
    }

    public function deCreaseQuantity()
    {
        $this->quantity++;
    }

    public function inCreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        } else {
            $this->quantity = 1;
        }
    }

    public function addToCart()
    {
        Cart::add($this->product->id, $this->product->name, $this->quantity, $this->product->price)->associate(Product::class);
        $this->emit('close');
        $this->alert('success', 'تم اضافة المنتج فى عربة التسوق');
        $this->emit('refreshMiniCart');
    }

    public function addToWishlist()
    {
        $productId = $this->product->id;
        $checkProduct = Cart::instance('wishlist')->content()->search(function ($cartItem, $id) use ($productId) {
            return $cartItem->id == $productId;
        });
        if ($checkProduct) {
            $this->emit('close');
            $this->alert('warning', 'تم اضافة المنتج من قبل');
        } else {
            Cart::instance('wishlist')->add($this->product->id, $this->product->name, 1, $this->product->price)->associate(Product::class);
            $this->emit('close');
            $this->alert('success', 'تم اضافة المنتج فى قائمة الأمنيات');
            $this->emit('refreshMiniCart');
        }
    }

    public function viewProductQuick($id)
    {
        $this->viewModal = true;
        $this->product = Product::find($id);
        $product = $this->product;
        $this->emit('amer', $product);

    }
//    public function openModal()
//    {
//        $this->emit('show');
//    }

}

<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $quantity = 1;

    public function mount(Product $slug)
    {
        $this->product = Product::where('id', $slug->id)->withAVG('reviews','rating')->withCount('reviews')->with('category', 'translations')->first();
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
        $this->alert('success', 'تم اضافة المنتج فى عربة التسوق');
        $this->emit('refreshMiniCart');
    }

    public function render()
    {
        $productsRelated = Product::where('category_id', $this->product->category_id)->where('id', '<>', $this->product->id)->whereStatus(1)->inRandomOrder()->with('media', 'translations', 'category')->withAVG('reviews','rating')->withCount('reviews')->take(6)->get();
        return view('livewire.frontend.product-details', ['productsRelated' => $productsRelated])->extends('layouts.frontend.app');
    }


}

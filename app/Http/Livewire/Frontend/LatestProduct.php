<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;

class LatestProduct extends Component
{

    public function render()
    {
        $products = $this->getLatestProduct();
        return view('livewire.frontend.latest-product',['products' => $products]);
    }
    public function getLatestProduct()
    {
        return $products = Product::whereStatus(1)->with('translation','media')->withCount('reviews')->withAvg('reviews','rating')->orderBy('created_at','desc')->where('quantity' ,'>' ,0)->take('8')->get();
    }

}

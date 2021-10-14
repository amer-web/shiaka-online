<?php

namespace App\Http\Livewire\Frontend\Header;

use Livewire\Component;

class MiniCartWrapper extends Component
{
    protected function getListeners()
    {
        return ['refreshMiniCart' => '$refresh'];
    }
    public function render()
    {
        (session()->has('currency') ? currency()->setUserCurrency(session()->get('currency')) : null);
        return view('livewire.frontend.header.mini-cart-wrapper');
    }
}

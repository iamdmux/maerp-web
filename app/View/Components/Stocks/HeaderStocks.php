<?php

namespace App\View\Components\Stocks;

use Illuminate\View\Component;

class HeaderStocks extends Component
{
    public $cartItems = 0;

    public function __construct()
    {
        
        if(auth()->check()){
            $this->cartItems = auth()->user()->cart->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stocks.header-stocks', [
            'cartItems' => $this->cartItems
        ]);
    }
}

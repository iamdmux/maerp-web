<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = auth()->user()->orders;
        $orders->load('items');

        return view('stocks.orders.index', [
            'orders' => $orders
        ]);
    }


    public function store(Request $request){
        $request->validate([

        ]);

        if(auth()->check()){

            $user = auth()->user();
            $cart = $user->cart;

            if(!$cart->count()){
                return back()->withErrors(['error' => ['Il tuo carrello è vuoto']]);    
            }

            if($order = $user->orders()->create([
                'user_id' => $user->id,
                'subtotal' => 999
            ])){
                foreach ($cart as $item) {
                    $order->items()->attach( $order->id, [
                        'lotto_id' => $item->pivot->lotto_id,
                        'quantita' => $item->pivot->quantita,
                    ]);
                }
                $user->cart()->detach();
                return back()->with('success', "L'ordine è stato creato");
            }

            return back()->withErrors(['error' => ['Qualcosa è andato storto']]);   
        }
    }
}

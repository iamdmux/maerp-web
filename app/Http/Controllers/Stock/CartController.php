<?php

namespace App\Http\Controllers\Stock;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Models\Stock\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(){

        $cart = auth()->user()->cart;
        return view('stocks.cart.index', [
            'cart' => $cart
        ]);
    }

   public function store(request $request){
    $request->validate([
        "quantita" => "required|numeric",
        "lotto_id" => "required"
    ]);

    $lotto = Lotto::findOrFail($request->lotto_id);
    $user = auth()->user();

    if($exists = $user->cart->where('pivot.lotto_id', $lotto->id)->first()){
        $exists->pivot->quantita = ($exists->pivot->quantita+$request->quantita);
        $exists->pivot->update();
    } else {
        $user->cart()->attach($lotto, ['quantita' => $request->quantita]);
    }

    return back()->with('success', 'Il lotto è stato aggiunto nel carrello');
   }

   public function update(Request $request, $pivotCartId){

    $cartItem = Cart::findOrFail($pivotCartId);
    $cartItem->delete();
    return back()->with('success', 'Il carrello è stato modificato correttamente');
   }
}

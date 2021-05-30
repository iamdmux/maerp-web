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
        "lotto_id" => "required",
    ]);

    $lotto = Lotto::findOrFail($request->lotto_id);
    $user = auth()->user();

    // se c'è già nel carrello
    $exists = $user->cart->where('pivot.lotto_id', $lotto->id)->first();
    // e se il lotto non ha cambiato il prezzo, intanto
    $prezzoUguale = false;
    if($exists){
        $prezzoUguale = ($lotto->shop_prezzo == $exists->pivot->prezzo);
    }

    if($exists && $prezzoUguale){
        $exists->pivot->quantita = ($exists->pivot->quantita+$request->quantita);
        
        if( ((int)$exists->pivot->quantita-(int)$lotto->quantita) < 0 ){
            return back()->withErrors(['error' => ['Questa quantità non è disponibile']]);     
        }

        // update lotto quantità
        Lotto::cambiaQuantita($lotto, $request->quantita, 'remove');

        $exists->pivot->update();

    } else {

        if((int)$request->quantita > (int)$lotto->quantita){
            return back()->withErrors(['error' => ['Questa quantità non è disponibile']]);     
        }

        // update lotto quantità
        Lotto::cambiaQuantita($lotto, $request->quantita, 'remove');

        $user->cart()->attach($lotto, ['quantita' => $request->quantita, 'prezzo' => $lotto->shop_prezzo]);
    }

    return back()->with('success', 'Il lotto è stato aggiunto nel carrello');
   }

   public function update(Request $request, $pivotCartId){

    $cartItem = Cart::findOrFail($pivotCartId);

    // update lotto quantità
    $lotto = Lotto::findOrFail($cartItem->lotto_id);
    Lotto::cambiaQuantita($lotto, $cartItem->quantita, 'add');

    $cartItem->delete();
    return back()->with('success', 'Il carrello è stato modificato correttamente');
   }

}

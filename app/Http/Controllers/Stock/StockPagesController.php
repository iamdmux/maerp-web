<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class StockPagesController extends Controller
{
    public function homepage(){
        return view('stocks.homepage');
    }

    public function index(){

        $lotti = Lotto::where('in_shop', true)->paginate(25);

        // $userlocale = request()->getLocale();

        $position = Location::get();
        if(isset($position->countryCode)){
            $userlocale = $position->countryCode;
        } else {
            abort(405);
        }
        

        $filteredByCountry = $lotti->filter(function ($value, $key) use ($userlocale) {
            $nazArray = json_decode($value->nazioni_tranne);
            
            if(in_array($userlocale, $nazArray)){
                // tutti tranne (scarto quello nell'array)
                if($value->visibilita == 'tutti'){
                    return;
                }
                // tutti tranne (scarto quello nell'array)
                if($value->visibilita == 'nessuno'){
                    return $value;
                }
            }

            // i lotti non nell'array
            if($value->visibilita == 'tutti'){
                return $value;
            }
            if($value->visibilita == 'nessuno'){
                return;
            }
        });
        

        return view('stocks.index', [
            'lotti' => $filteredByCountry,
        ]);
    }

    public function show($id){
        $lotto = Lotto::with('marca')->findOrFail($id);
        return view('stocks.show', [
            'lotto' => $lotto
        ]);
    }
}

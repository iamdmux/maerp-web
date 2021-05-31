<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;
use Torann\GeoIP\Facades\GeoIP;
// use Stevebauman\Location\Facades\Location;

class StockPagesController extends Controller
{
    public function homepage(){
        return view('stocks.homepage');
    }

    public function index(){
        
        $lotti = Lotto::where('in_shop', true)->paginate(25);

        $geo = geoip()->getLocation();
        $countryCode = $geo->iso_code;
        

        $filteredByCountry = $lotti->filter(function ($value, $key) use ($countryCode) {
            $nazArray = json_decode($value->nazioni_tranne);
            
            if(in_array($countryCode, $nazArray)){
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
            'countryCode' => $countryCode
        ]);
    }

    public function show($id){
        $lotto = Lotto::with('marca')->findOrFail($id);
        return view('stocks.show', [
            'lotto' => $lotto
        ]);
    }
}

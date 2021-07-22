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
        
        $lotti = Lotto::where('in_shop', true)->paginate(10);

        $geo = geoip()->getLocation();
        $countryCode = $geo->iso_code;
        
        // placeholder per il form
        $userEmail = '';
        if(auth()->check()){
            $user = auth()->user();
            $userEmail = $user->email;
        }

        $lotti->filter(function ($value, $key) use ($lotti, $countryCode) {
            $nazArray = json_decode($value->nazioni_tranne);
            
            if(in_array($countryCode, $nazArray)){
                // tutti tranne (scarto quello nell'array)
                if($value->visibilita == 'tutti'){
                    $lotti->forget($key);
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
                $lotti->forget($key);
                return;
            }
        });
        

        return view('stocks.index', [
            'lotti' => $lotti,
            'countryCode' => $countryCode,
            'userEmail' => $userEmail
        ]);
    }

    public function show($lang, $id){
        $lotto = Lotto::with('marca')->findOrFail($id);

        $geo = geoip()->getLocation();
        $countryCode = $geo->iso_code;


        $nazArray = json_decode($lotto->nazioni_tranne);

        
        if($lotto->visibilita == 'tutti'){
            // tutti tranne (scarto quello nell'array)
            if(in_array($countryCode, $nazArray)){
                abort(401);
            }
        }

        if($lotto->visibilita == 'nessuno'){
            // nessumo ma includi ..
            if(!in_array($countryCode, $nazArray)){
                abort(401);
            }
        }

        return view('stocks.show', [
            'lotto' => $lotto
        ]);
    }

    public function contacts(){
        return view('stocks.contacts', [
            'uffVendite' => help_contacts_text_uff_vendite(),
            'uffAcquisti' => help_contacts_text_uff_acquisti(),
            'uffContabile' => help_contacts_text_contabile(),
            'uffManagement' => help_contacts_text_management(),
        ]);
    }

    public function contactSendEmail(Request $request){
        $request->validate([
            'nome' => ('required|max:255'),
            'email' => ('required|email'),
            'oggetto' => ('required||max:255'),
            'messaggio' => ('required||max:10000'),
        ]);
    }


    public function company(){
        return view('stocks.company');
    }

   
}

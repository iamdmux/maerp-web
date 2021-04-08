<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Imports\ClientiImport;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function view(){
        $numeroUtenti = User::get()->count();
        $numeroClienti = Cliente::with('user')->get()->count();
        $numeroLotti = Lotto::get()->count();
        $agenti = User::with('clienti')->get();

        return view('dashboard', [
            'numeroUtenti' => $numeroUtenti,
            'numeroClienti' => $numeroClienti,
            'numeroLotti' => $numeroLotti,
            'agenti' => $agenti
        ]);
    }

    public function import(){
        if(auth()->id() == 1){
            Excel::import(new ClientiImport, storage_path('app/import/lista_clienti.xlsx'));
            return redirect('/')->with('success', 'All good!');
        } else {
            return 'Hello.';
        }
    }
}

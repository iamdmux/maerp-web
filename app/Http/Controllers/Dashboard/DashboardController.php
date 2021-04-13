<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\ClientiImport;
use App\Models\Magazzino\Lotto;
use App\Models\Vendite\Cliente;
use App\Imports\FornitoriImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function view(){
        $numeroUtenti = User::get()->count();
        $numeroClienti = Cliente::with('user')->get()->count();
        $numeroLotti = Lotto::get()->count();
        $users = User::with('clienti')->get();
        $responsabileMagazzino = User::find(User::RESPONSABILE_MAGAZZINO_ID);

        return view('dashboard', [
            'numeroUtenti' => $numeroUtenti,
            'numeroClienti' => $numeroClienti,
            'numeroLotti' => $numeroLotti,
            'users' => $users,
            'responsabileMagazzino' => $responsabileMagazzino
        ]);
    }

    /* 
        /importclienti
        /importfornitori
    */ 
    public function importClienti(){
        if(auth()->id() == 1){
            Excel::import(new ClientiImport, storage_path('app/import/lista_clienti.xlsx'));
            return redirect('/')->with('success', 'All good!');
        } else {
            return 'Hello.';
        }
    }

    public function importFornitori(){
        if(auth()->id() == 1){
            Excel::import(new FornitoriImport, storage_path('app/import/lista_fornitori.xls'));
            return redirect('/')->with('success', 'All good!');
        } else {
            return 'Hello.';
        }
    }
}

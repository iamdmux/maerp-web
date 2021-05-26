<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\ClientiImport;
use App\Models\Magazzino\Lotto;
use App\Models\Vendite\Cliente;
use App\Imports\FornitoriImport;
use App\Models\Acquisti\Fornitore;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Vendite\Fattura;

class DashboardController extends Controller
{
    public function view(){
        $role = auth()->user()->getRoleNames()[0];

        if($role == 'agente'){
            $numeroClienti = $clienti = auth()->user()->clienti()->count();
        } else {
            $numeroClienti = Cliente::with('user')->get()->count();
        }
        
        $numeroUtenti = (User::get()->count()-2);
        
        $numeroLotti = Lotto::get()->count();

        $users = User::with('clienti')->get();
        
        // TEMP
        $isclienti = Cliente::get()->count();
        $isfornitori = Fornitore::get()->count();

        return view('dashboard', [
            'numeroUtenti' => $numeroUtenti,
            'numeroClienti' => $numeroClienti,
            'numeroLotti' => $numeroLotti,
            'users' => $users,
            'role' => $role,

            'isclienti' => $isclienti,
            'isfornitori' => $isfornitori
        ]);
    }

    public function ruolo(Request $request){
        $data = $request->validate([
            'ruolo' => ''
        ]);

        auth()->user()->syncRoles([$data['ruolo']]);
        return redirect('/')->with('success', 'Ruolo cambiato');
    }

    /* 
        /importclienti
        /importfornitori
    */ 
    public function importClienti(){
        if(auth()->id() == 1 || auth()->id() == 2){
            Excel::import(new ClientiImport, storage_path('app/import/lista_clienti.xlsx'));
            return redirect('/erp')->with('success', 'All good!');
        } else {
            return 'Hello.';
        }
    }

    public function importFornitori(){
        if(auth()->id() == 1){
            Excel::import(new FornitoriImport, storage_path('app/import/lista_fornitori.xls'));
            return redirect('/erp')->with('success', 'All good!');
        } else {
            return 'Hello.';
        }
    }
}


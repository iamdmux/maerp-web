<?php

namespace App\Http\Controllers\Vendite;

use App\Models\Vendite\Cliente;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;

class FatturaAPI extends Controller
{
    public function getClienti(Request $request){
        $data = $request->validate([
            'query_cliente' => ''
        ]);

        if (auth()->user()->getRoleNames()[0] == 'agente'){
            return auth()->user()->clienti()->where('denominazione', 'like', '%' . $data['query_cliente'] . '%')
            ->orWhere('partita_iva', 'like', '%' . $data['query_cliente'] . '%')
            ->limit(10)
            ->get();
        } else {
            return Cliente::where('denominazione', 'like', '%' . $data['query_cliente'] . '%')
            ->orWhere('partita_iva', 'like', '%' . $data['query_cliente'] . '%')
            ->limit(10)
            ->get();
        }
    }

    public function getArticoli(Request $request){
        $data = $request->validate([
            'query_articolo' => ''
        ]);

       return Lotto::where('codice_articolo', 'like', '%' . $data['query_articolo'] . '%')
       ->limit(10)
       ->get();
    }
}

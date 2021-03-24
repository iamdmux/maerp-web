<?php

namespace App\Http\Controllers\Vendite;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;

class FatturaJsonResponse extends Controller
{
    public function getClienti(){
        return auth()->user()->clienti;
    }

    public function getArticoli(){
       return Lotto::get();
    }
}

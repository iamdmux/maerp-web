<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function view(){
        $numeroUtenti = User::get()->count();
        $numeroClienti = Cliente::get()->count();
        $numeroLotti = Lotto::get()->count();
        return view('dashboard', [
            'numeroUtenti' => $numeroUtenti,
            'numeroClienti' => $numeroClienti,
            'numeroLotti' => $numeroLotti
        ]);
    }
}

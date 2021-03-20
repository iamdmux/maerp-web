<?php

namespace App\Http\Controllers\Vendite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FatturaController extends Controller
{
    public function index(){
        return view('fatture.index');
    }

    public function create(){
        return view('fatture.create');
    }
}

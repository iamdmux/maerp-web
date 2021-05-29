<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;

class StockPagesController extends Controller
{
    public function homepage(){
        return view('stocks.homepage');
    }

    public function index(){
        $lotti = Lotto::where('in_shop', true)->paginate(25);
        return view('stocks.index', [
            'lotti' => $lotti
        ]);
    }

    public function show($id){
        $lotto = Lotto::with('marca')->findOrFail($id);
        return view('stocks.show', [
            'lotto' => $lotto
        ]);
    }
}

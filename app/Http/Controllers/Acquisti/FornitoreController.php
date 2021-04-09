<?php

namespace App\Http\Controllers\Acquisti;

use Illuminate\Http\Request;
use App\Models\Acquisti\Fornitore;
use App\Http\Controllers\Controller;

class FornitoreController extends Controller
{
    public function index(){
        $fornitori = Fornitore::paginate(100);
        return view('acquisti.fornitori.index', [
            'fornitori' => $fornitori
        ]);
    }
}

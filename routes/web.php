<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () { return view('homepage'); })->name('home.page');

    // Clienti
    Route::resource('/clienti', ClienteController::class);

    // MAGAZZINO
    // Lotti
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]);

    // Marche
    Route::resource('/magazzino/marche', MarcaController::class, ['except' => ['show']]);
});

require __DIR__.'/auth.php';

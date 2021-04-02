<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Models\Blackbox\BlackboxJsonResponse;
use App\Http\Controllers\Blackbox\CapoController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;
use App\Http\Controllers\Vendite\FatturaController;
use App\Http\Controllers\Vendite\FatturaJsonResponse;
use App\Http\Controllers\Blackbox\OperatoreController;
use App\Http\Controllers\Vendite\FatturaPdfController;
use App\Http\Controllers\Blackbox\LavorazioneController;



Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () { return view('homepage'); })->name('home.page');


// VENDITE
    // Clienti
    Route::resource('/vendite/clienti', ClienteController::class);

    // Fatture
    Route::get('/vendite/fatture/pdf', [FatturaPdfController::class, 'get']); // forbidden
    Route::post('/vendite/fatture/pdf', [FatturaPdfController::class, 'post'])->name('fatturapdf.postView');
    Route::resource('/vendite/fatture', FatturaController::class);
    
    //Fattura Json Response
    Route::get('/api/fattura/clienti', [FatturaJsonResponse::class, 'getClienti']);
    Route::get('/api/fattura/articoli', [FatturaJsonResponse::class, 'getArticoli']);
   

// MAGAZZINO
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]);
    Route::resource('/magazzino/marche', MarcaController::class, ['except' => ['show']]);

// BLACKBOX
    Route::resource('/blackbox/lavorazioni', LavorazioneController::class);
    Route::resource('/blackbox/operatori', OperatoreController::class, ['except' => ['show']]);
    Route::resource('/blackbox/capi', CapoController::class, ['except' => ['show']]);

    //Blackbox Json Response
    // Route::get('/api/blackbox/capi', [BlackboxJsonResponse::class, 'getCapi']);
});

require __DIR__.'/auth.php';

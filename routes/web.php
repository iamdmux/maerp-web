<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Vendite\FatturaAPI;
use App\Models\Blackbox\BlackboxJsonResponse;
use App\Http\Controllers\Blackbox\BlackboxAPI;
use App\Http\Controllers\Blackbox\CapoController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;
use App\Http\Controllers\Vendite\FatturaController;
use App\Http\Controllers\Blackbox\OperatoreController;
use App\Http\Controllers\Vendite\FatturaPdfController;
use App\Http\Controllers\Blackbox\LavorazioneController;
use App\Http\Controllers\Blackbox\LavorazioneDelGiornoController;



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
    Route::get('/api/fattura/clienti', [FatturaAPI::class, 'getClienti']);
    Route::get('/api/fattura/articoli', [FatturaAPI::class, 'getArticoli']);
   

// MAGAZZINO
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]);
    Route::resource('/magazzino/marche', MarcaController::class, ['except' => ['show']]);

// BLACKBOX
    Route::resource('/blackbox/lavorazioni', LavorazioneController::class);
    Route::resource('/blackbox/operatori', OperatoreController::class, ['except' => ['show']]);
    Route::resource('/blackbox/capi', CapoController::class, ['except' => ['show']]);

    // lavorazione attiva
    Route::get('/blackbox/lavorazione/{lavorazione_id}', [LavorazioneDelGiornoController::class, 'show'] )->name('lavorazione.giorno');
    Route::post('/api/blackbox/lavorazione/{id}', [BlackboxAPI::class, 'action']);
    //Blackbox Json Response
    // Route::get('/api/blackbox/capi', [BlackboxJsonResponse::class, 'getCapi']);
});

require __DIR__.'/auth.php';

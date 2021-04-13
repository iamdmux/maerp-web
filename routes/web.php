<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendite\FatturaAPI;
use App\Models\Blackbox\BlackboxJsonResponse;
use App\Http\Controllers\Blackbox\BlackboxAPI;
use App\Http\Controllers\Blackbox\CapoController;
use App\Http\Controllers\Blackbox\FerieController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;
use App\Http\Controllers\Vendite\ClienteController;
use App\Http\Controllers\Vendite\FatturaController;
use App\Http\Controllers\Acquisti\FornitoreController;
use App\Http\Controllers\Blackbox\OperatoreController;
use App\Http\Controllers\Vendite\FatturaPdfController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Blackbox\LavorazioneController;
use App\Http\Controllers\Blackbox\PauseTotaliController;
use App\Http\Controllers\Blackbox\LavorazioneDelGiornoController;



Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [DashboardController::class, 'view'])->name('home.page');

    //import
    Route::get('/importclienti', [DashboardController::class, 'importClienti']);
    Route::get('/importfornitori', [DashboardController::class, 'importFornitori']);
    
// VENDITE
    // Clienti
    Route::resource('/vendite/clienti', ClienteController::class);

    // Fatture
    Route::get('/vendite/fatture/pdf', [FatturaPdfController::class, 'get']); // forbidden
    Route::post('/vendite/fatture/pdf', [FatturaPdfController::class, 'post'])->name('fatturapdf.postView');
    Route::resource('/vendite/fatture', FatturaController::class);
    
    //Fattura Json Response
    Route::post('/api/fattura/clienti', [FatturaAPI::class, 'getClienti']);
    Route::post('/api/fattura/articoli', [FatturaAPI::class, 'getArticoli']);

// ACQUISTI
    //fornitori
    Route::resource('/acquisti/fornitori', FornitoreController::class);

// AGENTI
    // Route::resource('/agenti', AgenteController::class); ??

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

    // visualizza pause
    Route::get('/blackbox/pausetotali', [PauseTotaliController::class, 'index'])->name('pause.totali.index');
    Route::get('/blackbox/lavorazione/{lavorazione_id}/pause', [LavorazioneDelGiornoController::class, 'indexPause'])->name('pauselavorazione.giorno.index');

    // ferie
    Route::resource('/blackbox/ferie', FerieController::class);

    // pause
    Route::post('/api/blackbox/lavorazione/{id}/pausa', [BlackboxAPI::class, 'pausa']);
    Route::get('/api/blackbox/lavorazione/{id}/pause', [BlackboxAPI::class, 'getAllPause']);



});

require __DIR__.'/auth.php';

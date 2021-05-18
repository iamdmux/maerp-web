<?php

use App\Mail\InvioClientePdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendite\FatturaAPI;
use App\Http\Controllers\Shop\ShopController;
use App\Models\Blackbox\BlackboxJsonResponse;
use App\Http\Controllers\Blackbox\BlackboxAPI;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Blackbox\CapoController;
use App\Http\Controllers\Import\ImportController;
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
use App\Http\Controllers\Magazzino\LottoStatusController;
use App\Http\Controllers\Impostazioni\ImpostazioneController;
use App\Http\Controllers\Blackbox\LavorazioneDelGiornoController;

// TEST EMAIL
// Route::get('/mailable', function () {
//     return new App\Mail\InvioClientePdf();
// });

Route::get('/shop', [ShopController::class, 'index'])->name('home.shop');

Route::group(['middleware' => ['auth']], function(){ //['prefix' => 'admin', 

    Route::group(['middleware' => ['can:dashboard']], function () {
        
        Route::get('/', [DashboardController::class, 'view'])->name('admin.home.page');
        Route::post('/ruolo', [DashboardController::class, 'ruolo']);
        
        //import
        Route::get('/importclienti', [DashboardController::class, 'importClienti']);
        Route::get('/importfornitori', [DashboardController::class, 'importFornitori']);

        // Route::get('/import-doc-ddt', [ImportController::class, 'importDdt']); non più utilizzato
        // Route::get('/import-doc-fatture', [ImportController::class, 'importFatture']); non più utilizzato

    });

    // impostazioni
Route::group(['middleware' => ['can:impostazioni']], function () {
    Route::get('/impostazioni', [ImpostazioneController::class, 'edit'])->name('impostazioni.edit');
    Route::patch('/impostazioni', [ImpostazioneController::class, 'update'])->name('impostazioni.update');
});

// VENDITE
    Route::group(['middleware' => ['can:vendite']], function () {
        // Clienti
        Route::resource('/vendite/clienti', ClienteController::class);                                              // --> filtra clienti by agente

        // Fatture
        Route::get('/fatture/pdf', [FatturaPdfController::class, 'get']); // get forbidden
        Route::post('/fatture/pdf', [FatturaPdfController::class, 'post'])->name('fatturapdf.postView');
        Route::get('/vendite/fatture/{fatturaId}/pdf', [FatturaPdfController::class, 'show'])->name('fatturapdf.show');

        Route::resource('/vendite/fatture', FatturaController::class);                                              // --> agente: solo preventivi e ordini

        // Conversione
        Route::post('/vendite/fatture/converti', [FatturaController::class, 'convertiFattura']);
        // Invia pdf per email
        Route::post('/vendite/fatture/invia-pdf', [FatturaPdfController::class, 'inviaPdfFattura'])->name('inviaPdf.email');

        //Fattura Json Response
        Route::post('/api/fattura/clienti', [FatturaAPI::class, 'getClienti']);
        Route::post('/api/fattura/articoli', [FatturaAPI::class, 'getArticoli']);
    });


// ACQUISTI
    Route::group(['middleware' => ['can:acquisti']], function () {
        //fornitori
        Route::resource('/acquisti/fornitori', FornitoreController::class);
    });
    

// AGENTI
    // Route::resource('/agenti', AgenteController::class); ??

    
    // MAGAZZINO
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]); // middleware in construct

    // Status prenotazioni e vendite quantità
    Route::post('/api/magazzino/lotto/{id}', [LottoStatusController::class, 'cambiaStatusLotto'])->name('add.status.lotto');
    Route::delete('/api/magazzino/lotto/{id}', [LottoStatusController::class, 'destroyStatusLotto'])->name('delete.status.lotto');

    Route::group(['middleware' => ['can:magazzino-blackbox']], function () {
        Route::resource('/magazzino/marche', MarcaController::class, ['except' => ['show']]);
    });

    // BLACKBOX
    Route::group(['middleware' => ['can:magazzino-blackbox']], function () {
        Route::resource('/blackbox/lavorazioni', LavorazioneController::class);
        Route::resource('/blackbox/operatori', OperatoreController::class, ['except' => ['show']]);
        Route::resource('/blackbox/capi', CapoController::class, ['except' => ['show']]);

        // lavorazione attiva
        Route::get('/blackbox/lavorazione/{lavorazione_id}', [LavorazioneDelGiornoController::class, 'show'] )->name('lavorazione.giorno');
        Route::post('/api/blackbox/lavorazione/{id}', [BlackboxAPI::class, 'lavorazioneCapi']);

        // visualizza pause
        Route::get('/blackbox/pausetotali', [PauseTotaliController::class, 'index'])->name('pause.totali.index');
        Route::get('/blackbox/lavorazione/{lavorazione_id}/pause', [LavorazioneDelGiornoController::class, 'indexPause'])->name('pauselavorazione.giorno.index');

        // ferie
        Route::resource('/blackbox/ferie', FerieController::class);

        // pause
        Route::post('/api/blackbox/lavorazione/{id}/pausa', [BlackboxAPI::class, 'creaPausa']);
        Route::get('/api/blackbox/lavorazione/{id}/pause', [BlackboxAPI::class, 'getAllPause']);
        // modifica pause
        Route::post('/api/blackbox/lavorazione/{id}/modifica-pausa', [BlackboxAPI::class, 'modificaPause']);

    });
});

require __DIR__.'/auth.php';

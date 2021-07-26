<?php

use App\Mail\InvioClientePdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dev\DevController;
use App\Http\Controllers\Vendite\FatturaAPI;
use App\Models\Blackbox\BlackboxJsonResponse;
use App\Http\Controllers\Blackbox\BlackboxAPI;
use App\Http\Controllers\Stock\CartController;
use App\Http\Controllers\Stock\FormController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Stock\OrderController;
use App\Http\Controllers\Blackbox\CapoController;
use App\Http\Controllers\Import\ImportController;
use App\Http\Controllers\Stock\AccountController;
use App\Http\Controllers\Blackbox\FerieController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;
use App\Http\Controllers\Vendite\ClienteController;
use App\Http\Controllers\Vendite\FatturaController;
use App\Http\Controllers\Stock\StockPagesController;
use App\Http\Controllers\Acquisti\FornitoreController;
use App\Http\Controllers\Blackbox\OperatoreController;
use App\Http\Controllers\Vendite\FatturaPdfController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Blackbox\LavorazioneController;
use App\Http\Controllers\Blackbox\PauseTotaliController;
use App\Http\Controllers\Stock\StockFormEmailController;
use App\Http\Controllers\Magazzino\LottoStatusController;
use App\Http\Controllers\Impostazioni\ImpostazioneController;
use App\Http\Controllers\Blackbox\LavorazioneDelGiornoController;


/* INFO
 #DEV: SET NULL -- controllo per la relazione nella constrain del db ON DELETE set  null
                 
                - magazzino_lotti ok    ($lotto->marca->nome)
                - clienti ok            ($cliente->user)
                        // in cliente destroy non è possibile cancellare il cliente se è associato la fattura
                - fatture ok            ($fattura->cliente) 
                - articoli              - sembra ok
                - stocks_orders         - sembra ok
*/


// Route::get('/mailable', function () {
//     $formtext = App\Models\Stock\StocksForm::find(1);
//     return new App\Mail\Stocks\StocksFormInformations($formtext);
// })->middleware(['auth', 'isDeveloper']);



// LOGS
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'isDeveloper']);

// redirect if ERP on NOT
Route::get('/', function(){
    $user =  auth()->user();
    if($user){
        if($user->hasAnyRole(['admin', 'agente', 'resp. magazzino'])){
            return redirect()->to('/erp');
        } else {
            return redirect()->to( app()->getLocale() . '/stocks');
        }
    }
    return redirect()->to( app()->getLocale() . '/stocks');
});

// STOCK
Route::group(['prefix' => '{language}'], function(){
    Route::get('stocks', [StockPagesController::class, 'homepage'])->name('stocks.home');

    Route::resource('stocks/account', AccountController::class, ['except' => ['index', 'show', 'destroy']])->middleware('auth');

    Route::get('stocks/lotti', [StockPagesController::class, 'index'])->name('stocks.index');
    Route::get('stocks/lotti/{id}', [StockPagesController::class, 'show'])->name('stocks.show');

    Route::resource('stocks/cart', CartController::class)->middleware('auth');
    Route::resource('stocks/orders', OrderController::class)->middleware('auth');

    Route::get('contacts', [StockPagesController::class, 'contacts'])->name('stocks.contacts');
    Route::get('company', [StockPagesController::class, 'company'])->name('stocks.company');

    Route::post('/form', [ FormController::class, 'store'])->name('formEmail.store');
});




// ERP

//axios.defaults.baseURL = '/erp/'; -> in app.js
Route::group(['prefix' => 'erp', 'middleware' => ['auth', 'can:erp user']], function(){

    Route::group(['middleware' => ['can:dashboard']], function () {
        
        Route::get('/', [DashboardController::class, 'view'])->name('admin.home.page');
        Route::post('ruolo', [DashboardController::class, 'ruolo']);
        

        Route::post('ruolo', [DashboardController::class, 'changeUserPassword'])->name('bacheca.cambia.userpassword');

        //import
        Route::get('importclienti', [DashboardController::class, 'importClienti'])->middleware(['isDeveloper']);
        Route::get('importfornitori', [DashboardController::class, 'importFornitori'])->middleware(['isDeveloper']);
        
        // TEMP
        // Route::get('devs/creamagazzinoaccount', [DevController::class, 'magazzino'])->middleware(['isDeveloper']); // TIENE USER FREE FINO A 25

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
        Route::resource('/vendite/fatture', FatturaController::class);                                              // --> agente: solo preventivi e ordini
        
        Route::get('/vendite/fatture/{fatturaId}/pdf', [FatturaPdfController::class, 'show'])->name('fatturapdf.show');

        

        // Conversione
        Route::post('/vendite/fatture/converti', [FatturaController::class, 'convertiFattura'])->name('fattura.converti');
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
    
   
    // MAGAZZINO
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]); // middleware in construct
    Route::delete('/magazzino/bulk/lotti', [LottoController::class, 'bulkDelete'])->name('lotti.bulkDelete');

    // upload media
    Route::post('/magazzino/lotti/media', [LottoController::class, 'fileUpload'])->name('lotto.store.media');

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

    // erp - Stocks
    Route::get('/stocks/forms', [FormController::class, 'index'])->name('erp.stocksforms.index');
    Route::get('/stocks/forms/{id}', [FormController::class, 'show'])->name('erp.stocksforms.show');
    Route::delete('/stocks/forms/{id}', [FormController::class, 'delete'])->name('erp.stocksforms.delete');

});

require __DIR__.'/auth.php';

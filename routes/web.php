<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Magazzino\LottoController;
use App\Http\Controllers\Magazzino\MarcaController;
use App\Http\Controllers\Vendite\FatturaController;
use App\Http\Controllers\Vendite\FatturaJsonResponse;
use App\Http\Controllers\Vendite\FatturaPdfController;



Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () { return view('homepage'); })->name('home.page');


// VENDITE
    // Clienti
    Route::resource('/vendite/clienti', ClienteController::class);

    // Fatture
    Route::get('/vendite/fatture/pdf', [FatturaPdfController::class, 'get']); // forbidden
    Route::post('/vendite/fatture/pdf', [FatturaPdfController::class, 'post'])->name('fatturapdf.postView');
    Route::resource('/vendite/fatture', FatturaController::class);

    Route::get('/api/clienti', [FatturaJsonResponse::class, 'getClienti']);
    Route::get('/api/articoli', [FatturaJsonResponse::class, 'getArticoli']);
   

// MAGAZZINO
    // Lotti
    Route::resource('/magazzino/lotti', LottoController::class, ['except' => ['show']]);

    // Marche
    Route::resource('/magazzino/marche', MarcaController::class, ['except' => ['show']]);
});

require __DIR__.'/auth.php';

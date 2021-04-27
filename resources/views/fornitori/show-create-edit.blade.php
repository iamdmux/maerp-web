@extends('layouts.app')

@section('content')

@php
    $create = $create ?? false;
    $edit = $edit ?? false;
    $show = $show ?? false;

    $disable = $show ? 'disabled' : '';

    $formAction = '';
    if($create){
        $formAction = route('fornitori.store');
    } elseif($edit){
        $formAction = route('fornitori.update', $fornitore->id);
    }

@endphp


<x-back-to-page-button route="{{route('fornitori.index')}}" />

@php
    $title = '';
    $buttonText = '';
    if($create){
        $title = 'Aggiungi nuovo fornitore';
        $buttonText = 'Salva nuovo fornitore';
    } elseif($edit){
        $title = 'Modifica fornitore';
        $buttonText = 'Modifica fornitore';
    } elseif($show){
        $title = 'fornitore: ' . $fornitore->denominazione;
    }
@endphp


<x-page-title text="{{$title}}" />

@if($edit)
    <p>Stai modificando {{$fornitore->denominazione}}</p>
@endif

<x-errors-component />

<form action="{{$formAction}}" method="POST">

    @csrf
    @if($edit)
        @method('PATCH')
    @endif

    <h1 class="mt-6 font-semibol text-gray-500 uppercase">Anagrafica</h1>

    <div class="flex flex-wrap">
        <div class="mr-8">
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    denominazione
                </p>
                <input class="placeholder-red-300" {{$disable}} required autocomplete="off" type="text" name="denominazione" placeholder="ragione sociale"
                value="{{old('denominazione') ? old('denominazione') : (($edit || $show) ? $fornitore->denominazione : '')}}">
            </div>
            

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    referente
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="referente" placeholder="referente"
                value="{{old('referente') ? old('referente') : (($edit || $show) ? $fornitore->referente : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    partita_iva
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="partita_iva" placeholder="partita_iva"
                value="{{old('partita_iva') ? old('partita_iva') : (($edit || $show) ? $fornitore->partita_iva : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_fiscale
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="codice_fiscale" placeholder="codice_fiscale"
                value="{{old('codice_fiscale') ? old('codice_fiscale') : (($edit || $show) ? $fornitore->codice_fiscale : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    paese
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="paese" placeholder="paese"
                value="{{old('paese') ? old('paese') : (($edit || $show) ? $fornitore->paese : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    indirizzo
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="indirizzo" placeholder="indirizzo"
                value="{{old('indirizzo') ? old('indirizzo') : (($edit || $show) ? $fornitore->indirizzo : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    citta
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="citta" placeholder="citta"
                value="{{old('citta') ? old('citta') : (($edit || $show) ? $fornitore->citta : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    cap
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="cap" placeholder="cap"
                value="{{old('cap') ? old('cap') : (($edit || $show) ? $fornitore->cap : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    provincia
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="provincia" placeholder="provincia"
                value="{{old('provincia') ? old('provincia') : (($edit || $show) ? $fornitore->provincia : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note indirizzo
                </p>
                <textarea {{$disable}} class="rounded-md border-gray-200" name="note_indirizzo" placeholder="note indirizzo">{{old('note_indirizzo') ? old('note_indirizzo') : (($edit || $show) ? $fornitore->note_indirizzo : '')}}</textarea>
            </div>
        </div>
        <div class="mr-8">
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    email
                </p>
                <input {{$disable}} autocomplete="off" type="email" name="email" placeholder="email"
                value="{{old('email') ? old('email') : (($edit || $show) ? $fornitore->email : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    pec
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="pec" placeholder="pec"
                value="{{old('pec') ? old('pec') : (($edit || $show) ? $fornitore->pec : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    telefono
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="telefono" placeholder="telefono"
                value="{{old('telefono') ? old('telefono') : (($edit || $show) ? $fornitore->telefono : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note extra
                </p>
                <textarea {{$disable}} class="rounded-md border-gray-200" type="text" name="note_extra" placeholder="note extra">{{old('note_extra') ? old('note_extra') : (($edit || $show) ? $fornitore->note_extra : '')}}</textarea>
            </div>
        </div>
    </div>

    @if(!$show)
    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
       {{$buttonText}}
    </button>
    @endif

</form>


@if($edit)
<form action="{{route('fornitori.destroy', [$fornitore->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo fornitore?')" class="mt-12 text-gray-500 hover:text-red-500">
        elimina fornitore
    </button>
</form>
@endif

@endsection
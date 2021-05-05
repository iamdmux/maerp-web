@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lotti.index')}}" />

<x-page-title text="Crea nuovo lotto" />

<form action="{{route('lotti.store')}}" method="POST">

    @csrf

    <div class="mt-8">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Marca
        </p>
        
        <select name="marca_id">
            <option disabled {{old('marca_id') ? '' : 'selected'}} value> -- seleziona -- </option>
            @foreach ($marche as $marca)
            <option {{old('marca_id') == $marca->id ? 'selected' : ''}} value="{{$marca->id}}">{{$marca->nome}}</option>
            @endforeach
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Stagione
        </p>
        <select name="stagione">
            <option {{old('stagione') ? '' : 'selected'}} value> -- seleziona -- </option>
            <option {{old('stagione') == 'primavera' ? 'selected' : ''}} value="primavera">Primavera</option>
            <option {{old('stagione') == 'estate' ? 'selected' : ''}} value="estate">Estate</option>
            <option {{old('stagione') == 'autunno' ? 'selected' : ''}} value="autunno">Autunno</option>
            <option {{old('stagione') == 'inverno' ? 'selected' : ''}} value="inverno">Inverno</option>
            <option {{old('stagione') == 'nessuna' ? 'selected' : ''}} value="nessuna">Nessuna</option>
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Tipologia
        </p>
        <select name="tipologia">
            <option disabled {{old('tipologia') ? '' : 'selected'}} value> -- seleziona -- </option>
            @foreach ($tipoogia as $tipo)
            <option {{old('tipologia') == $tipo['val'] ? 'selected' : ''}} value="{{$tipo['val']}}"> {{$tipo['show']}} </option>
            @endforeach
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Kg Lotto
        </p>
        <input type="number" name="kg" step="0.5" min="0" placeholder="Kg Lotto" value="{{old('kg') ? old('kg') : '1'}}">
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Quantità
        </p>
        <input type="number" name="quantita" min="0" placeholder="Quantità di Pezzi" value="{{old('quantita') ? old('quantita') : '1'}}">
    </div>

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Codice Articolo
        </p>
        <input autocomplete='off' type="text" name="codice_articolo" placeholder="Codice Articolo" value="{{old('codice_articolo') ? old('codice_articolo') : ''}}">
    </div>

    <button class="mt-8 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva nuovo lotto
    </button>

    <x-errors-component />

</form>

@endsection
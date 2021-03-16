@extends('layouts.app')

@section('content')

<div class="mb-4">
    <a href="{{route('lotti.index')}}"
        class="px-2 py-1 bg-gray-600 rounded-md text-white font-bold hover:bg-gray-500"
    >
        &larr;
    </a>
</div>

<h3 class="text-gray-700 text-3xl font-bold">Crea nuovo lotto</h3>

<form action="{{route('lotti.store')}}" method="POST">

    @csrf

    <div class="mt-8">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Marca
        </p>
        
        <select class="rounded-md border-gray-300" name="marca_id">
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
        <select class="rounded-md border-gray-300" name="stagione">
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
        <select class="rounded-md border-gray-300" name="tipologia">
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
        <input class="rounded-md border-gray-300" type="number" name="kg" step="0.5" min="0" placeholder="Kg Lotto" value="{{old('kg') ? old('kg') : ''}}">
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Quantità
        </p>
        <input class="rounded-md border-gray-300" type="number" name="quantita" min="0" placeholder="Quantità di Pezzi" value="{{old('quantita') ? old('quantita') : ''}}">
    </div>

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Venditore
        </p>
        <input class="rounded-md border-gray-300" type="text" name="venditore" placeholder="Venditore" value="{{old('venditore') ? old('venditore') : ''}}">
    </div>

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Codice Articolo
        </p>
        <input class="rounded-md border-gray-300" type="text" name="codice_articolo" placeholder="Codice Articolo" value="{{old('codice_articolo') ? old('codice_articolo') : ''}}">
    </div>

    <button class="mt-8 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
        Salva nuovo lotto
    </button>

    <div class="mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

</form>

@endsection
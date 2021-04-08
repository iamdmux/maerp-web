@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lotti.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Modifica lotto</h3>
<p>Stai modificando il lotto {{$lotto->id}}</p>

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


<form action="{{route('lotti.update', $lotto->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mt-8">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Marca
        </p>
        
        <select name="marca_id">
            <option disabled> -- seleziona -- </option>
            @foreach ($marche as $marca)
            <option
                {{ $lotto->marca_id == $marca->id ? 'selected' : 
                  (old('marca_id') == $marca->id ? 'selected' : '' ) }}
                value="{{$marca->id}}"
            >
                {{$marca->nome}}
            </option>
            
            @endforeach
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Stagione
        </p>
        @php
         $stagioni = [
            'primavera',
            'estate',
            'autunno',
            'inverno',
            'nessuna'
         ]   
        @endphp
        <select name="stagione">
            <option disabled > -- seleziona -- </option>

            @foreach ($stagioni as $stagione)
                <option
                    {{ old('stagione') == $stagione ? 'selected' : ($lotto->stagione == $stagione ? 'selected' : '') }}
                    value="{{$stagione}}"
                >
                    {{$stagione}}
                </option>
            @endforeach
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Tipologia
        </p>
        <select name="tipologia">
            <option disabled value> -- seleziona -- </option>
            @foreach ($tipoogia as $tipo)
                <option {{ old('tipologia') == $tipo['val'] ? 'selected' : ($lotto->tipologia == $tipo['val'] ? 'selected' : '')}}
                value="{{$tipo['val']}}"
                > {{$tipo['show']}}
                </option>
            @endforeach
          </select>
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Kg Lotto
        </p>
        <input type="number" name="kg" step="0.5" min="0" placeholder="Kg Lotto" value="{{old('kg') ? old('kg') : $lotto->kg}}">
    </div>
    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Quantità
        </p>
        <input type="number" name="quantita" min="0" placeholder="Quantità di Pezzi" value="{{old('quantita') ? old('quantita') : $lotto->quantita}}">
    </div>

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Venditore
        </p>
        <input type="text" name="venditore" placeholder="Venditore"
        value="{{old('venditore') ? old('venditore') : $lotto->venditore}}"
        >
    </div>

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Codice Articolo
        </p>
        <input type="text" name="codice_articolo" placeholder="Codice Articolo"
            value="{{old('codice_articolo') ? old('codice_articolo') : $lotto->codice_articolo}}">
    </div>

    <button class="mt-8 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva nuovo lotto
    </button>
</form>

<form action="{{route('lotti.destroy', [$lotto->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo lotto?')" class="mt-12 text-gray-500 hover:text-red-500">
        cancella lotto
    </button>
</form>





@endsection
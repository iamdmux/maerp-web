@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lotti.index')}}" />

<x-page-title text="Modifica lotto" />

<p>Stai modificando il lotto {{$lotto->id}}</p>

<x-errors-component />

@can('modificare-lotti')
<form action="{{route('lotti.update', $lotto->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Codice Articolo
        </p>
        <input type="text" name="codice_articolo" placeholder="Codice Articolo"
            value="{{old('codice_articolo') ? old('codice_articolo') : $lotto->codice_articolo}}">
    </div>

    <div class="mt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
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
    <div class="pt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
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
    <div class="mt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
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
    <div class="mt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Kg Lotto
        </p>
        <input type="number" name="kg" step="0.5" min="0" placeholder="Kg Lotto" value="{{old('kg') ? old('kg') : $lotto->kg}}">
    </div>
    <div class="mt-5">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Quantità
        </p>
        <input type="number" name="quantita" min="0" placeholder="Quantità di Pezzi" value="{{old('quantita') ? old('quantita') : $lotto->quantita}}">
    </div>

    <button class="mt-8 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Modifica lotto
    </button>
</form>
@endcan

<div class="mt-16">
    <div class="my-3">
        <p class="font-semibold mb-3">Quantità prenotate</p>
        @forelse($prenotatoList as $status)
        <form class="flex my-1" action="{{route('delete.status.lotto', $status->pivot->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <p>{{$loop->iteration}} - {{$status->name}}</p> 
            @if(auth()->id() == $status->id || auth()->user()->hasRole('admin'))
            <button onclick="return confirm('Sei sicuro di cancellare questa quantità prenotata?')" class="text-xs px-1 ml-2 bg-gray-300 rounded">cancella</button>
            @endif
        </form>
        @empty
        <p>Nessuna quantità prenotata</p>
        @endforelse
    </div>
    <div class="my-3">
        <p class="font-semibold mb-3">Quantità vendute</p>
        @forelse($vendutoList as $status)
        <form class="flex my-1" action="{{route('delete.status.lotto', $status->pivot->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <p>{{$loop->iteration}} - {{$status->name}}</p> 
            @if(auth()->id() == $status->id || auth()->user()->hasRole('admin'))
            <button onclick="return confirm('Sei sicuro di cancellare questa quantità venduta?')" class="text-xs px-1 ml-2 bg-gray-300 rounded">cancella</button>
            @endif
        </form>
        @empty
        <p>Nessuna quantità venduta</p>
        @endforelse
    </div>
</div>

<form action="{{route('lotti.destroy', [$lotto->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo lotto?')" class="mt-12 text-gray-500 hover:text-red-500">
        cancella lotto
    </button>
</form>

@endsection
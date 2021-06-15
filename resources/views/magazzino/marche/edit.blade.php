@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('marche.index')}}" />

<x-page-title text="Modifica nome marca" />

<p>Stai modificando la marca <span class="font-bold">'{{$marca->nome}}'</span></p>
<form action="{{route('marche.update', $marca->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mt-8">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Nome
        </p>
        <input autocomplete="off" type="text" name="nome" value="{{old('marca') ? old('marca') : $marca->nome}}">
    </div>

    <div class="mt-3">
        <marca-nazioni-select
        :nazioni-array="{{json_encode($nazioniArray)}}"
        oldnazione="{{old('nazioni_selez') ? old('nazioni_selez') : $marca->nazioni_selez}}">
        </marca-nazioni-select>
    </div>
    <div class="flex mt-24">
        <button class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
            Modifica nuova marca
        </button>
    </div>
</form>

<form action="{{route('marche.destroy', [$marca->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa marca?')" class="mt-12 text-gray-500 hover:text-red-500">
     cancella marca
    </button>
</form>

<x-errors-component />



@endsection
@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('marche.index')}}" />


<x-page-title text="Crea nuova marca" />

<form action="{{route('marche.store')}}" method="POST">

    @csrf

    <div class="mt-8">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Nome
        </p>
        <input autocomplete="off" type="text" name="nome" placeholder="nome marca" value="{{old('nome') ? old('nome') : ''}}">
    </div>

    <div class="mt-3">
        <marca-nazioni-select
        :nazioni-array="{{json_encode($nazioniArray)}}"
        oldnazione="{{old('nazioni_selez') ? old('nazioni_selez') : ''}}">
        </marca-nazioni-select>
    </div>

    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva nuova marca
    </button>

    <x-errors-component />

</form>

@endsection
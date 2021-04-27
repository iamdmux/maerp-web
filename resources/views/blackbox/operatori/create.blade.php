@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('marche.index')}}" />

<x-page-title text="Aggiungi nuovo operatore" />

<form action="{{route('operatori.store')}}" method="POST">

    @csrf

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Nome
        </p>
        <input autocomplete="off" type="text" name="nome" class="mt-8" placeholder="nome operatore">
    </div>

    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva nuovo operatore
    </button>

    <x-errors-component />

</form>

@endsection
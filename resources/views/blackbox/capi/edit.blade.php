@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('capi.index')}}" />

<h3 class="text-gray-700 text-3xl font-bold">Modifica capo</h3>
<p>Stai modificando il capo: <span class="font-bold">'{{$capo->nome}}'</span></p>
<form action="{{route('capi.update', $capo->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div>
        <input autocomplete="off" type="text" name="nome" class="mt-8" value="{{old('nome') ? old('nome') : $capo->nome}}">
    </div>
    <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
        tipo
    </p>
    <select name="tipo">
        <option value="bambino">bambino</option>
        <option value="adulto">adulto</option>
    </select>
    <div class="flex">
        <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
            Modifica capo
        </button>
    </div>
</form>

<form class="mt-4" action="{{route('capi.destroy', [$capo->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo capo?')">
     elimina
    </button>
</form>

<x-errors-component />



@endsection
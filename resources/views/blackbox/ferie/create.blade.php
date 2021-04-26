@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('ferie.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Crea ferie</h3>

<form action="{{route('ferie.store')}}" method="POST">

    @csrf

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Operatore
        </p>
        <select name="operatore_id">
            @foreach ($operatori  as $operatore)
            <option value="{{$operatore->id}}">{{$operatore->nome}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-wrap">
        <div class="mr-2">
            <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Dal giorno:
            </p>
            <input type="date" name="dal">
        </div>
        <div>
            <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                al giorno:
            </p>
            <input type="date" name="al">
        </div>
    </div>
    <div class="mt-3">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Note
        </p>
        <textarea name="note" cols="32" rows="5" placeholder="note"></textarea>
    </div>
    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva ferie
    </button>

    <x-errors-component />

</form>

@endsection
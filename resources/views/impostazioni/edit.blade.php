@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('admin.home.page')}}" />

<x-page-title text="Impostazioni" />

<form action="{{route('impostazioni.update')}}" method="POST">

    @csrf
    @method('PATCH')

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            numerazione fattura
        </p>
        {{-- <p class="text-xs">La numerazione verrà presa in considerazione se non ci dovessero esserci fatture presenti o se questa numerazione è di numero più altro dell'ultima</p> --}}
        <input autocomplete="off" type="text" name="numerazione_fattura" class="mt-1" value="{{old('numerazione_fattura') ? old('numerazione_fattura') : $impostazioni->numerazione_fattura}}">
    </div>

    <div class="flex">
        <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
            Modifica impostazioni
        </button>
    </div>
</form>

<x-errors-component />



@endsection
@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Modifica lavorazione</h3>

<x-errors-component />

@method('update')
<create-lavorazione method="edit" data="{{$lavorazione->data}}" form-url="{{route('lavorazioni.update', $lavorazione->id )}}" :operatori="{{$operatori->toJson()}}" :lavorazione="{{$lavorazione->toJson()}}" :capi-bambino="{{json_encode($capiBambino)}}" :capi-adulto="{{$capiAdulto->toJson()}}"></create-lavorazione>

<form class="mt-12" action="{{route('lavorazioni.destroy', [$lavorazione->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa lavorazione?')">
        elimina
    </button>
</form>

@endsection
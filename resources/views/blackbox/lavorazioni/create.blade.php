@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Aggiungi nuova lavorazione</h3>

<x-errors-component />
<create-lavorazione method="create" form-url="{{route('lavorazioni.store')}}" :operatori="{{$operatori->toJson()}}" :capi-bambino="{{$capiBambino->toJson()}}" :capi-adulto="{{$capiAdulto->toJson()}}" />

@endsection
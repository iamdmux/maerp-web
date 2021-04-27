@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />

<x-page-title text="Aggiungi nuova lavorazione" />

<x-errors-component />
<create-edit-lavorazione method="create" form-url="{{route('lavorazioni.store')}}" :operatori="{{$operatori->toJson()}}" :capi-bambino="{{$capiBambino->toJson()}}" :capi-adulto="{{$capiAdulto->toJson()}}" />

@endsection
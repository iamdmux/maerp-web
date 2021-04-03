@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Aggiungi nuova lavorazione</h3>

<div class="mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<create-lavorazione method="create" form-url="{{route('lavorazioni.store')}}" :capi-bambino="{{json_encode($capiBambino)}}" :capi-adulto="{{json_encode($capiAdulto)}}" />

@endsection
@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('marche.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Modifica lavorazione</h3>

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
@method('update')
<create-lavorazione method="edit" form-url="{{route('lavorazioni.update', $lavorazione->id )}}" :lavorazione="{{json_encode($lavorazione)}}" :capi-bambino="{{json_encode($capiBambino)}}" :capi-adulto="{{json_encode($capiAdulto)}}" />

@endsection
@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<h3 class="text-gray-700 text-2xl font-semibold mb-6">Fattura / doc numero {{$fattura->numero}}</h3>

<create-fattura method="show" pdf-url="{{route('fatturapdf.view')}}" form-url="" :old="{{ json_encode($fattura) }}">
</create-fattura>


@endsection

{{-- @php
    $cliente_id = old('cliente_id') ? old('cliente_id') : '';
    $denominazione = old('denominazione') ? old('denominazione') : '';
    $old = compact($cliente_id, $denominazione);
@endphp --}}
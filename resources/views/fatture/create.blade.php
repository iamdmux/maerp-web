@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

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

<h3 class="text-gray-700 text-2xl font-semibold mb-6">Crea nuova fattura / doc</h3>


<create-fattura method="create" pdf-url="{{route('fatturapdf.postView')}}" form-url="{{route('fatture.store')}}" :old="{{ json_encode(session()->getOldInput()) }}">
</create-fattura>


@endsection

{{-- @php
    $cliente_id = old('cliente_id') ? old('cliente_id') : '';
    $denominazione = old('denominazione') ? old('denominazione') : '';
    $old = compact($cliente_id, $denominazione);
@endphp --}}
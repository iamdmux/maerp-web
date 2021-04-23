@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<h3 class="text-gray-700 text-2xl font-semibold mb-6">Visualizzazione di: {{$fattura->tipo_documento}} numero {{$fattura->numero}} del {{$fattura->data->format('d-m-Y')}}</h3>

<create-fattura method="show"
:can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}"
pdf-show="{{route('fatturapdf.show', $fattura->id)}}"
pdf-url="{{route('fatturapdf.postView')}}"
:old="{{ json_encode($fattura) }}">
</create-fattura>


@endsection
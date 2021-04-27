@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<x-page-title text="Visualizzazione di: {{$fattura->tipo_documento}} numero {{$fattura->numero}} del {{$fattura->data->format('d-m-Y')}}" />

<x-errors-component />

<create-edit-fattura method="show"
:can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}"
pdf-show="{{route('fatturapdf.show', $fattura->id)}}"
pdf-url="{{route('fatturapdf.postView')}}"
invio-pdf-url="{{route('inviaPdf.email')}}"
:old="{{ json_encode($fattura) }}">
</create-edit-fattura>



@endsection
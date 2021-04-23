@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<h3 class="text-gray-700 text-2xl font-semibold mb-6">Modifica {{$fattura->tipo_documento}} numero {{$fattura->numero}} del {{$fattura->data->format('d-m-Y')}}</h3>

<create-fattura method="edit" :can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}" form-url="{{route('fatture.update', $fattura->id )}}" pdf-url="{{route('fatturapdf.postView')}}" :old="{{ json_encode($fattura) }}">
</create-fattura>

<form class="mt-4" action="{{route('fatture.destroy', [$fattura->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa fattura?')">
     elimina
    </button>
</form>

@endsection
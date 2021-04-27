@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<x-page-title text="Modifica {{$fattura->tipo_documento}} numero {{$fattura->numero}} del {{$fattura->data->format('d-m-Y')}}" />

<x-errors-component />

<create-edit-fattura method="edit"
fattura-nextcounter="{{$fatturaNextCounter}}"
:can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}"
form-url="{{route('fatture.update', $fattura->id )}}"
pdf-url="{{route('fatturapdf.postView')}}"
:old="{{ json_encode($fattura) }}">
</create-edit-fattura>

<form class="mt-4" action="{{route('fatture.destroy', [$fattura->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa fattura?')">
     elimina
    </button>
</form>

@endsection
@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<x-page-title text="Visualizzazione di: {{$fattura->tipo_documento}} numero {{$fattura->numero}} del {{$fattura->data->format('d-m-Y')}}" />

<x-errors-component />


<create-edit-fattura m-view="show"
{{-- fattura-nextcounter="{{$fatturaNextCounter}}" --}}
pdf-show="{{route('fatturapdf.show', $fattura->id)}}"
:can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}"
form-url="{{route('fatture.update', $fattura->id )}}"
pdf-url="{{route('fatturapdf.postView')}}"
:load-data="{{ json_encode($fattura) }}"
:articoli-conv="{{ json_encode($articoliConv) }}"
:old = {{ json_encode(session()->getOldInput()) }}
{{-- json mi cambia la data --}}
data-fattura="{{$fattura->data}}"

fattura-converti-url="{{route('fattura.converti')}}"
>


</create-edit-fattura>



@endsection
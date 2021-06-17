@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('fatture.index')}}" />

<x-errors-component />

<x-page-title text="Crea nuova fattura / doc" />

<create-edit-fattura m-view="create"
fattura-nextcounter="{{$fatturaNextCounter}}"
:can-creare-fatture="{{$canCreareFatture ? 'true' : 'false'}}"
pdf-url="{{route('fatturapdf.postView')}}"
form-url="{{route('fatture.store')}}"
:old="{{ json_encode(session()->getOldInput()) }}">
</create-edit-fattura>


@endsection
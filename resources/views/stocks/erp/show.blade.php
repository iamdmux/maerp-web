@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('erp.stocksforms.index')}}" />

<x-page-title text="Visualizza messaggio" />


    <div class="mt-12 bg-gray-100 border border-gray-300 p-8 rounded">

        @php
            $div = "mb-2";
        @endphp

    <div class="{{$div}}">
        <p>pagina del form:</p>
        <p><b>{{$form->tipo_form}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>nome:</p>
        <p><b>{{$form->nome}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>cognome</p>
        <p><b>{{$form->cognome}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>email:</p>
        <p><b>{{$form->email}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>azienda:</p>
        <p><b>{{$form->azienda}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>oggetto:</p>
        <p><b>{{$form->oggetto}}</b></p>
    </div>
    <div class="{{$div}}">
        <p>messaggio:</p>
        <p><b>{{$form->messaggio}}</b></p>
    </div>

</div>

<form action="{{route('erp.stocksforms.delete', [$form->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo messaggio?')" class="mt-12 text-gray-500 hover:text-red-500">
     cancella messaggio
    </button>
</form>
@endsection
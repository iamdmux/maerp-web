@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('erp.stocksforms.index')}}" />

<x-page-title text="Visualizza messaggio" />


    <div class="mt-12 bg-gray-100 border border-gray-300 p-8 rounded">

        @php
            $div = "mb-2";
        @endphp

    <div class="{{$div}}">
        <p><b>pagina del form:</b></p>
        <p>{{$form->tipo_form}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>nome:</b></p>
        <p>{{$form->nome}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>cognome</b></p>
        <p>{{$form->cognome}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>email:</b></p>
        <p>{{$form->email}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>azienda:</b></p>
        <p>{{$form->azienda}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>oggetto:</b></p>
        <p>{{$form->oggetto}}</p>
    </div>
    <div class="{{$div}}">
        <p><b>messaggio:</b></p>
        <p>{{$form->messaggio}}</p>
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
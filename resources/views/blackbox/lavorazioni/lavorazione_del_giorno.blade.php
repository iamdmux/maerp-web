@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />

<div class="my-4">
    <p class="font-semibold">Lavorazione del giorno:</p>
    <div class="mt-2 inline-block px-6 py-4 bg-gray-50 border border-yellow-400 rounded-lg">
        <p class=" leading-5 text-gray-800">{{$lavorazione->dataStrings}}</p>
    </div>
</div>

<div class="text-right mr-3">
    <a target="_blank" title="visualizza tutte le pause" href="{{ route('pauselavorazione.giorno.index', $lavorazione->id) }}" class="ml-3 text-xs mb-2 py-1 px-2 {{help_svg_link()}}">visualizza pause</a>
</div>
<Lavorazione-giornaliera method="create" :tipi-pausa="{{json_encode($tipiPausa)}}" :lavorazione="{{json_encode($lavorazione)}}" />


@endsection
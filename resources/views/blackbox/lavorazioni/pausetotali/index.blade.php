@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />


<div>
    <form action="{{route('pause.totali.index')}}" method="GET">
    <p class="text-xs leading-4 font-medium text-gray-500 ">Visualizza per mese e anno</p>
    <select name="month">
        @foreach ($mesiArray as $num => $text)
            <option {{request()->get('month') == $num ? 'selected' : ''}} value="{{$num}}">{{$text}}</option>
        @endforeach
    </select>

    <select class="ml-3" name="year">
        @foreach ($yearsArray as $y)
            <option {{request()->get('year') == $y ? 'selected' : ''}} value="{{$y}}">{{$y}}</option>
        @endforeach
    </select>
    <button class="ml-3">Ricarica</button>
    </form>
</div>

<div class="mt-4 inline-block px-6 py-4 bg-gray-50 border border-yellow-400 rounded-lg">
    <p class=" leading-5 text-gray-800">pause di {{$mesiArray[$month] ?? $month}} {{$year}}</p>
</div>

<div class="mt-6">
    @foreach ($operatoriNomeIds as $operatore)
    @foreach($pause as $key => $pausa)
    @if($key == $operatore->id)
    <div class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{$operatore->nome}}</p>
        <div class="bg-white">
            <div class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {{$pausa->toTimeString()}}
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
    

    
</div>
{{-- <h3 class="text-gray-700 text-2xl font-bold">Pause lavorazione</h3>



<div class="mt-6">
@forelse ($operatoriPause as $operatore => $pause)    
<div class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
    <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{$operatore}}</p>
    <div class="bg-white">
        <div class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            @foreach($pause as $pausa)
                @php
                    $dalle = date("H:i", strtotime($pausa->pivot->dalle));
                    $alle = date("H:i", strtotime($pausa->pivot->alle));
                @endphp

                <p class="text-sm leading-5 text-gray-500">{{$dalle}} - {{$alle}} <span class="font-semibold text-xs">#{{$pausa->pivot->tipo}}</span></p>
            @endforeach

            @if($operatoriTotalePause[$operatore])
                <p class="font-semibold text-gray-500 border-t mt-4">{{  date("H:i", strtotime($operatoriTotalePause[$operatore]['totPausa'])) }}</p>
            @endif
        </div>
    </div>
</div>
@empty
<p>nessuna pausa fatta</p>
@endforelse --}}

</div>
@endsection

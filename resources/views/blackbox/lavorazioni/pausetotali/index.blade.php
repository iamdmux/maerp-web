@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('lavorazioni.index')}}" />


<div>
    <h3 class="text-gray-700 text-3xl font-bold">Pause mensili di {{$mesiArray[$month] ?? $month}} {{$year}}</h3>

    <form action="{{route('pause.totali.index')}}" method="GET">
    <p class="text-xs leading-4 font-medium text-gray-500 pb-1 pt-3">Visualizza per mese e anno</p>
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

{{-- <div class="mt-4 inline-block px-6 py-4 bg-gray-50 border border-yellow-400 rounded-lg">
    <p class=" leading-5 text-gray-800">pause di {{$mesiArray[$month] ?? $month}} {{$year}}</p>
</div> --}}

<div class="mt-6">
    @foreach ($operatoriNomeIds as $operatore)
    @foreach($pause as $key => $pausa)
    @if($key == $operatore->id)
    <div class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{$operatore->nome}}</p>
        <div class="bg-white">
            <div class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            {{-- @foreach ($pausa as $key => $p)
                @if($key !== 'totale')
                    <p>{{$p->toTimeString()}} <span>#{{$key}}</span></p>
                @endif
            @endforeach --}}
                <div style="min-height:50px;">
                    @isset($pausa['bagno'])
                    <div class="flex items-baseline">
                        <p class="text-gray-700 font-sm font-semibold " style="min-width: 155px;">
                            {{$pausa['bagno']->diffInDays($zeroTime) ? $pausa['bagno']->diffInDays($zeroTime) . ' giorni,' : ''}} 
                            {{$pausa['bagno']->hour ? $pausa['bagno']->hour . ' ore,' : ''}} {{$pausa['bagno']->minute}} minuti
                        </p>
                        <p class="ml-4 text-sm font-semibold text-gray-500 " style="min-width: 85px;"><i>bagno</i></p>
                    </div>
                    @endisset
                    @isset($pausa['pausafunzionale'])
                    <div class="flex items-baseline">
                        <p class="text-gray-700 font-sm font-semibold " style="min-width: 155px;">
                            {{$pausa['pausafunzionale']->diffInDays($zeroTime) ? $pausa['pausafunzionale']->diffInDays($zeroTime). ' giorni,' : ''}} 
                            {{$pausa['pausafunzionale']->hour ? $pausa['pausafunzionale']->hour . ' ore,' : ''}}  {{$pausa['pausafunzionale']->minute}} minuti
                            
                        </p>
                        <p class="ml-4 text-sm font-semibold text-gray-500 " style="min-width: 85px;"><i>pausa funz.</i></p>
                    </div>
                    @endisset
                </div>
                <hr class="mt-3 mb-2">
                <p class="font-bold ">
                    {{$pausa['totale']->diffInDays($zeroTime) ? $pausa['totale']->diffInDays($zeroTime) . ' giorni, ' : ''}}
                    {{$pausa['totale']->hour ? $pausa['totale']->hour .' ore, ' : ''}}{{$pausa['totale']->minute}} minuti
                </p>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
    

    
</div>

@endsection

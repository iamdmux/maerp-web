@extends('layouts.app')

@section('content')

@php
    $checked = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
@endphp

<x-page-title text="Fatture" />

<x-errors-component />

<div class="mt-10">
    <a href="{{route('fatture.create')}}" class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">Crea nuova fattura</a>
</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Data e numero</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">F. elettronica</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">N° articoli / Qt</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">importo</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @php
                        $fromStocks = '<span class="bg-yellow-200 px-1 text-xs font-bold rounded">stocks</span>';
                    @endphp
                    @forelse ($fatture as $fattura)

                    @php
                    $quantita = 0;
                    foreach ($fattura->articoli as $articolo) {
                        $quantita = ($quantita+$articolo->quantita);
                    }
                    @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$fattura->tipo_documento}}</td>

                            {{-- #DEV: SET NULL --}}
                            @if(isset($fattura->cliente))
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$fattura->cliente->denominazione}} {!! $fattura->is_from_stocks ?  $fromStocks : '' !!}</td>
                            @else
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">-- {!! $fattura->is_from_stocks ?  $fromStocks : '' !!}</td>    
                            @endif
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$fattura->data_ita}} / {{$fattura->numero}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{!!$fattura->fattura_elettronica ? $checked : '' !!}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$fattura->articoli->count()}} / {{$quantita}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$fattura->importo_totale}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('fatture.show', $fattura->id)}}" title="visualizza" class="{{help_svg_link()}}">{!!help_svg_icon_show()!!}</a>
                                @if(!$fattura->uuid)
                                <a href="{{ route('fatture.edit', $fattura->id)}}" title="modifica" class="{{help_svg_link()}}">{!! help_svg_icon_edit() !!}</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-8">
    {{ $fatture->links() }}
</div>
@endsection
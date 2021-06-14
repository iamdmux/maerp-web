@extends('layouts.app')

@section('content')

@php
    $checked = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
@endphp

<x-page-title text="Lotti" />

<x-errors-component />

@can('modificare-lotti')
<div class="mt-10">
    <a href="{{route('lotti.create')}}" class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">Crea nuovo lotto</a>
</div>
@endcan

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">N. Lotto</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Codice Articolo</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">In Shop</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Stagione</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tipologia</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Quantità</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Kg</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Prenotato</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Venduto</th>
                        {{-- <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Venditore</th> --}}
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($lotti as $lotto)
                        @php
                            $prenotatoList = $lotto->status->filter(function ($item) {
                                return $item->pivot->tipo == 'prenotato';
                            });

                            $vendutoList = $lotto->status->filter(function ($item) {
                                return $item->pivot->tipo == 'venduto';
                            });
                        @endphp     
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->id}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->codice_articolo}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{!!$lotto->in_shop ? $checked : '' !!}</td>
                            @if(isset($lotto->marca->nome))
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->marca->nome}}</td>
                            @else
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">-</td>
                            @endif
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->stagione}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->tipologia}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->quantita}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lotto->kg}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                @foreach ($prenotatoList as $status)
                                    <p>
                                        {{$loop->iteration}} - {{$status->name}}
                                    </p>
                                @endforeach

                                @if($lotto->quantita > 0)
                                <div>
                                    <form action="{{route('add.status.lotto', $lotto->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tipo" value="prenotato">
                                    <button class="text-xs bg-gray-300 hover:bg-gray-400 rounded px-1">prenota</button>
                                    </form>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                @foreach ($vendutoList as $status)
                                    <p>
                                        {{$loop->iteration}} - {{$status->name}}
                                    </p>
                                @endforeach

                                @if($prenotatoList->count() && ($vendutoList->count() < $prenotatoList->count()) )
                                <div>
                                    <form action="{{route('add.status.lotto', $lotto->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tipo" value="venduto">
                                    <button class="text-xs bg-gray-300 hover:bg-gray-400 rounded px-1">vendi</button>
                                    </form>
                                </div>
                                @endif
                            </td>
                            

                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                {{-- @can('modificare-lotti') --}}
                                <a href="{{route('lotti.edit', $lotto->id)}}" class="{{help_svg_link()}}">{!!help_svg_icon_edit()!!}</a>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @empty
                        {{-- <p>Nessun lotto trovato</p> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
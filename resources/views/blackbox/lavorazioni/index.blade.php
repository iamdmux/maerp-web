@extends('layouts.app')

@section('content')

<h3 class="text-gray-700 text-3xl font-bold">Lavorazioni</h3>

<div class="mt-10 mb-4">
    <a href="{{route('lavorazioni.create')}}" class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">Aggiungi nuova lavorazione</a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Numero capi</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($lavorazioni as $lavorazione)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lavorazione->data}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$lavorazione->capiScelti->count()}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('lavorazione.giorno', $lavorazione->id) }}" class="{{col_a_link()}}">apri lavorazione</a>
                                <a class="ml-3" href="{{ route('lavorazioni.edit', $lavorazione->id) }}" class="{{col_a_link()}}">Modif.</a>
                                <div class="relative" x-data="{ open: false }">
                                <a x-on:click="open = true" class="ml-3">vedi pause</a>
                                <form class="" style="display: none" x-show="open" x-on:click.away="open = false"action="{{route('pauselavorazione.index', $lavorazione->id)}}" method="GET">
                                    @csrf
                                    <input class="w-24" name="pass" type="password" placeholder="password"> <button>vai</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


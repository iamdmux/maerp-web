@extends('layouts.app')

@section('content')

<h3 class="text-gray-700 text-3xl font-bold">ferie</h3>

<div class="mt-10">
    <a href="{{route('ferie.create')}}" class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">Crea nuove ferie</a>
</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Operatore</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Da</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">a</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">note</th>


                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($ferieAnno as $ferie)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"><b>{{$ferie->operatore->nome}}</b></td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$ferie->dalStrings}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{$ferie->alStrings}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{strlen($ferie->note) > 120 ? substr_replace($ferie->note, "...", 120) : $ferie->note}}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('ferie.edit', [$ferie->id])}}" title="modifica" class="{{help_svg_link()}}">{!!help_svg_icon_edit()!!}</a>
                            </td>
                        </tr>
                    @empty
                        {{-- <p>Nessuna ferie trovata</p> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@extends('stocks.layout.app-stock')

@section('content')
<div class="p-4">
    <h1 class="mt-12 mb-6 font-semibold text-3xl">Contatti</h1>
    <p>Il nostro team multilingue è a disposizione di clienti, fornitori e partner.</p>
    
    @php
        $cssUfficioTitle = "my-6 font-semibold text-xl uppercase";
    @endphp

    <div class="mt-10">
        <h2 class="{{$cssUfficioTitle}}">Ufficio Vendite</h2> 
        <section class="flex flex-wrap">
            @foreach ($uffVendite as $uff)
                <div class="flex flex-col justify-between pr-12 pl-6 my-8 mr-4 border-l-4 border-gray-200" style="width:22rem;">
                    {{-- <p class="font-xs">regione</p> --}}
                    <div class="mb-3">
                        <h3 class="font-semibold uppercase text-xl">{{$uff['regione']}}</h3>
                    </div>

                    <div>
                        <p><b>{{$uff['ruolo']}}</b></p>
                        <p class="text-sm">({{$uff['lang']}})</p>

                        <div class="my-3">
                            <p class="text-2xl">
                                {{$uff['man']}}
                            </p>
                        </div>
                        <div>
                            <a href="tel:{{$uff['tel']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="ml-6">{{$uff['tel']}}</span>
                            </a>
                        </div>
                        <div class="mt-1">
                            <a href="mailto:{{$uff['email']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="ml-6">{{$uff['email']}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <div class="mt-10">
        <h2 class="{{$cssUfficioTitle}}">Ufficio Acquisti</h2>
        <section class="flex flex-wrap">
            @foreach ($uffAcquisti as $uff)
                <div class="flex flex-col justify-between pr-12 pl-6 my-8 mr-4 border-l-4 border-gray-200" style="width:22rem;">
                    <div>
                        <p><b>{{$uff['ruolo']}}</b></p>
                        <p class="text-sm">({{$uff['lang']}})</p>

                        <div class="my-3">
                            <p class="text-2xl">
                                {{$uff['man']}}
                            </p>
                        </div>
                        <div>
                            <a href="tel:{{$uff['tel']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="ml-6">{{$uff['tel']}}</span>
                            </a>
                        </div>
                        <div class="mt-1">
                            <a href="mailto:{{$uff['email']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="ml-6">{{$uff['email']}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <div class="mt-10">
        <h2 class="{{$cssUfficioTitle}}">Amministrazione contabile</h2>
        <section class="flex flex-wrap">
            @foreach ($uffContabile as $uff)
                <div class="flex flex-col justify-between pr-12 pl-6 my-8 mr-4 border-l-4 border-gray-200" style="width:22rem;">
                    <div>
                        <p><b>{{$uff['ruolo']}}</b></p>
                        <p class="text-sm">({{$uff['lang']}})</p>
                        <div class="my-3">
                            <p class="text-2xl">
                                {{$uff['man']}}
                            </p>
                        </div>
                        <div>
                            <a href="tel:{{$uff['tel']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="ml-6">{{$uff['tel']}}</span>
                            </a>
                        </div>
                        <div class="mt-1">
                            <a href="mailto:{{$uff['email']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="ml-6">{{$uff['email']}}</span>
                            </a>
                        </div>
                        <div class="mt-1">
                            <a href="mailto:{{$uff['email']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="ml-6">{{$uff['email2']}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <div class="mt-10">
        <h2 class="{{$cssUfficioTitle}}">Management</h2>
        <section class="flex flex-wrap">
            @foreach ($uffManagement as $uff)
                <div class="flex flex-col justify-between pr-12 pl-6 my-8 mr-4 border-l-4 border-gray-200" style="width:22rem;">
                    <div>
                        <p><b>{{$uff['ruolo']}}</b></p>
                        <p class="text-sm">({{$uff['lang']}})</p>
                        <div class="my-3">
                            <p class="text-2xl">
                                {{$uff['man']}}
                            </p>
                        </div>
                        @isset( $uff['area'] )
                            <p class="my-2">area: {{$uff['area']}}</p>
                        @endisset
                    </div>
                    <div>
                        <div>
                            <a href="tel:{{$uff['tel']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="ml-6">{{$uff['tel']}}</span>
                            </a>
                        </div>
                        <div class="mt-1">
                            <a href="mailto:{{$uff['email']}}" class="relative inline-block hover:bg-gray-300 rounded px-1">
                                <svg class="absolute w-4 h-4 mt-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="ml-6">{{$uff['email']}}</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </section>
    </div>

</div>


@endsection
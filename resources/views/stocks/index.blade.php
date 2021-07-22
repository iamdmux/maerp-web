@extends('stocks.layout.app-stock')

@section('content')

<div class="px-4">
@if(auth()->id() == 1)
<p>countryCode: {{$countryCode}}</p>
@endif

        <div class="flex flex-wrap my-10">

                @forelse ($lotti as $lotto)

                <div class="w-full lg:w-1/2">
                    <div class="mr-6 mb-6 border border-grey-dark group shadow-none hover:shadow-lg rounded-lg transition-shadow">
                    <a href="{{route('stocks.show', app()->getLocale(), $lotto->id)}}">
                        <div class="flex flex-col md:flex-row">
                            <div class="relative">
                                <div class="relative">
                                    <div class="w-full md:w-64">
                                        <img class="w-full lg:h-56 object-cover" src="{{ asset('storage/' . $lotto->shop_image) }}">
                                    </div>
                                    <span
                                        class="absolute top-0 right-0 bg-white px-5 py-1 mt-4 mr-6 rounded-full  font-bold  text-v-green text-sm uppercase tracking-wide">
                                        New
                                    </span>
                                </div>
                            </div>
                            <div class="p-3">
                                <h3 class="text-xl">lotto {{$lotto->codice_articolo}}</h3>
                                <p class="font-bold  text-xl block pt-1">{{$lotto->shop_prezzo}} €</p>

                                <p class="pt-4 font-bold text-base block">In Stock</p>
                                <p class="pt-2 text-sm xl:text-base">
                                    {{ substr_replace($lotto->shop_descrizione, "...", 150) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            @empty
            <div class="my-16">
                <p>Nessun prodotto trovato</p>
            </div>
            @endforelse

      </div>

      <div class="mt-8">
        {{ $lotti->links() }}
      </div>


      <form action="{{route('formEmail.store', app()->getLocale())}}" method="POST">
        @csrf
      <div x-data="{ open: {{$errors->any() ? 'true' : 'false'}} }"  class="lg:ml-auto my-16 py-8 px-4 lg:px-16 bg-gray-200 rounded" style="max-width: 450px;">
        <div x-on:click.prevent="open = !open" class="pb-6">
            <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <button x-bind:class="{'bg-gray-500' : open}" class="mt-2 font-semibold bg-gray-800 hover:bg-gray-600 text-white rounded px-4 py-1">
                Non trovi quello che stai cercando?
            </button>
            @php
                $inp = "h-8 w-full";
            @endphp
            <p class="pt-2">Richiedi informazioni per una fornitura speciale!</p>

            @if ($errors->any())
                <div class="mt-4 font-semibold text-yellow-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div
            x-show="open"
            class="flex flex-col"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform opacity-0"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="transform opacity-100"
            x-transition:leave-end="transform opacity-0"
            >
            <div class="flex flex-wrap">
                <div class="w-full flex flex-col">
                    <span>nome *</span>
                    <input type="text" name="name" class="{{$inp}}" value="{{old('name') ? old('name') : ''}}">
                </div>
                <div class="w-full flex flex-col mt-2">
                    <span>cognome *</span>
                    <input type="text" name="surname" class="{{$inp}}" value="{{old('surname') ? old('surname') : ''}}">
                </div>

                <div class="w-full flex flex-col mt-2">
                    <span>email *</span>
                    <input type="text" name="email" class="{{$inp}}" value="{{old('email') ? old('email') : ($userEmail ? $userEmail : '')}}">
                </div>
                <div class="w-full flex flex-col mt-2">
                    <span>azienda</span>
                    <input type="text" name="company" class="{{$inp}}" value="{{old('company') ? old('company') : ''}}">
                </div>
                <div class="w-full flex flex-col mt-2">
                    <span>oggetto *</span>
                    <input type="text" name="object" class="{{$inp}}" value="{{old('object') ? old('object') : ''}}">
                </div>
            </div>
            <div class="flex flex-col mt-2">
                <span>Messaggio *</span>
                <textarea name="textbody" cols="10" rows="3">{{old('textbody') ? old('textbody') : ''}}</textarea>
            </div>
            <div class="w-full mt-6 text-right mr-3">
                <button onclick="return confirm('Vuoi inviare il messaggio?')" class="bg-gray-800 hover:bg-gray-900 text-white rounded px-2">Invia il messaggio</button>
            </div>
        </div>
        </form>
        
      </div>
</div>
@endsection
{{-- 
@if($lotto->shop_image)
<img src="{{ asset($lotto->shop_image) }}" class="object-cover">
@else
<div class="h-full flex-1 bg-gray-300">Lotto
@endif
<div class="self-end opacity-0 group-hover:opacity-100 transition duration-300">
<p class="p-2 text-sm">
    {{$lotto->shop_descrizione}}
</p>
</div>
@if(!$lotto->shop_image)
</div>
@endif --}}
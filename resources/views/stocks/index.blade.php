@extends('stocks.layout.app-stock')

@section('content')

@if(auth()->id() == 1)
<p>countryCode: {{$countryCode}}</p>
@endif

        <div class="flex flex-wrap mt-10 mb-40">

            
                @forelse ($lotti as $lotto)
                <div class="mr-6 mb-6 w-full lg:w-2/5 border border-grey-dark group shadow-none hover:shadow-lg rounded-lg transition-shadow">
                <a href="{{route('stocks.show', $lotto->id)}}">
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
                {{-- <a href="{{route('stocks.show', $lotto->id)}}">
                    <div style="max-width: 740px;" class="flex flex-col w-full md:flex-row items-center border border-grey-dark group shadow-none hover:shadow-lg rounded transition-shadow">
                        <div class="relative">
                            <div class="relative rounded-l">
                                <div class="">
                                    <img src="{{ asset('storage/' . $lotto->shop_image) }}" style="min-width: 260px;" class="h-56 object-cover">
                                </div>
                                <span
                                    class="absolute top-0 right-0 bg-white px-5 py-1 mt-4 mr-4 rounded-full  font-bold  text-v-green text-sm uppercase tracking-wide">New</span>
                            </div>
                        </div>
                        <div class="h-full p-5" style="width: 380px;">
                            <h3 class=" text-xl xl:text-2xl">lotto {{$lotto->codice_articolo}}</h3>
                            <span class=" font-bold  text-xl block pt-1">{{$lotto->shop_prezzo}} €</span>

                            <span class="pt-4  font-bold text-base block">In Stock</span>
                            <p class="pt-2 text-sm xl:text-sm">
                                {{ substr_replace($lotto->shop_descrizione, "...", 180) }}
                            </p>
                        </div>
                    </div>
                </a> --}}
                {{-- <a href="{{route('stocks.show', $lotto->id)}}">
                    <div class="flex flex-col sm:flex-row items-center border border-grey-dark group shadow-none hover:shadow-lg rounded transition-shadow w-1/2">
                        <div class="w-full sm:w-2/5 lg:w-5/11 relative">
                            <div class="relative rounded-l">
                                <div class="w-full h-56 bg-center bg-no-repeat bg-cover" style="max-width: 400px; background-image:url({{ asset('storage/' . $lotto->shop_image) }})">
                                    <img src="{{ asset('storage/' . $lotto->shop_image) }}" class="w-full object-cover"> 
                                </div>
                                <span
                                    class="absolute top-0 right-0 bg-white px-5 py-1 mt-4 mr-4 rounded-full  font-bold  text-v-green text-sm uppercase tracking-wide">New</span>
                            </div>
                        </div>
                        <div class="w-full h-full sm:w-3/5 lg:w-6/11 px-6 py-6">
                            <h3 class=" text-xl xl:text-2xl ">lotto {{$lotto->codice_articolo}}</h3>
                            <span class=" font-bold  text-xl block pt-1">{{$lotto->shop_prezzo}} €</span>

                            <span class="pt-4  font-bold text-v-green text-base block">In Stock</span>
                            <p class="  pt-2 text-sm xl:text-base">
                                {{$lotto->shop_descrizione}}
                            </p>
                        </div>
                    </div>
                </a> --}}
            
            @empty
            <div class="my-16">
                <p>Nessun prodotto trovato</p>
            </div>
            @endforelse

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
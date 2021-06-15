@extends('stocks.layout.app-stock')

@section('content')

@if(auth()->id() == 1)
<p>countryCode: {{$countryCode}}</p>
@endif

        <div class="flex flex-wrap my-10">

                @forelse ($lotti as $lotto)

                <div class="w-full lg:w-1/2">
                    <div class="mr-6 mb-6 border border-grey-dark group shadow-none hover:shadow-lg rounded-lg transition-shadow">
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


      {{-- <div class="mt-16 p-2 bg-gray-200 rounded">
          <p>non trovi quello che cerchi?</p>
      </div> --}}

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
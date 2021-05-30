@extends('stocks.layout.app-stock')

@section('content')

        <div>
            <div class="flex flex-wrap mt-10">
                @forelse ($lotti as $lotto)
                {{-- <a href="{{route('stock.show', $lotto->id)}}">
                    <div class="p-4 mr-8 mb-8">
                        <div>
                            <div class="relative group flex w-full h-auto md:w-80 md:h-60 rounded">
                                @if($lotto->shop_image)
                                <img src="{{ asset('storage/' . $lotto->shop_image) }}" class="w-full object-cover">
                                @else
                                <div class="h-full flex-1 bg-gray-300 items-center justify-center">Lotto</div>
                                @endif
                                <div class="absolute bottom-0 self-end opacity-0 group-hover:opacity-100 transition duration-300 bg-white bg-opacity-50">
                                    <p class="p-2 text-sm font-semibold">
                                        {{$lotto->shop_descrizione}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-80">
                            {{-- <p class="text-xs font-medium uppercase tracking-wider">lotto</p> 
                            <h3 class="font-semibold"> {{$lotto->codice_articolo}}</h3>
                            <p class="uppercase tracking-wider">{{$lotto->shop_prezzo}} €</p>
                        </div>
                    </div>
                </a> --}}
                <a href="{{route('stocks.show', $lotto->id)}}">
                    <div class="flex flex-col sm:flex-row items-center border border-grey-dark group shadow-none hover:shadow-lg rounde transition-shadow w-1/2">
                        <div class="w-full sm:w-2/5 lg:w-5/11 relative">
                            <div class="relative rounded-l">
                                <div class="w-full h-56 bg-center bg-no-repeat bg-cover" style="max-width: 400px; background-image:url({{ asset('storage/' . $lotto->shop_image) }})">
                                    {{-- <img src="{{ asset('storage/' . $lotto->shop_image) }}" class="w-full object-cover"> --}}
                                </div>
                                <span
                                    class="absolute top-0 right-0 bg-white px-5 py-1 mt-4 mr-4 rounded-full font-hk font-bold  text-v-green text-sm uppercase tracking-wide">New</span>
                                {{-- <div
                                    class="absolute opacity-0 group-hover:opacity-100 flex justify-center items-center py-28 inset-0 group hover:shadow-lg transition-all bg-secondary bg-opacity-85">
                                    <a href="/cart"
                                    class="bg-white hover:bg-primary-light rounded-full px-3 py-3 flex items-center transition-all mr-3">
                                        <img src="https://d33wubrfki0l68.cloudfront.net/16f4de05841e1eea2fbe536d4053b73f0ad85baf/77013/assets/img/icons/icon-cart.svg "
                                            class="h-6 w-6"
                                            alt="icon cart"/>
                                    </a>
                                    <a href="/product"
                                    class="bg-white hover:bg-primary-light rounded-full px-3 py-3 flex items-center transition-all mr-3">
                                        <img src="https://d33wubrfki0l68.cloudfront.net/56f050a65973a419ab0f192614c9a3c7232604d1/4b447/assets/img/icons/icon-search.svg"
                                            class="h-6 w-6"
                                            alt="icon search"/>
                                    </a>
                                    <a href="/account/wishlist/"
                                    class="bg-white hover:bg-primary-light  rounded-full px-3 py-3 flex items-center transition-all">
                                        <img src="https://d33wubrfki0l68.cloudfront.net/f7c995473e0c29c1578cd00a2b7baa1562456ad9/b584a/assets/img/icons/icon-heart.svg"
                                            class="h-6 w-6"
                                            alt="icon heart"/>
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="w-full h-full sm:w-3/5 lg:w-6/11 px-6 py-6">
                            <h3 class="font-hk text-xl xl:text-2xl text-grey-darkest">lotto {{$lotto->codice_articolo}}</h3>
                            <span class="font-hk font-bold  text-xl block pt-1">{{$lotto->shop_prezzo}} €</span>

                            <span class="pt-4 font-hk font-bold text-v-green text-base block">In Stock</span>
                            <p class="font-hk text-grey-darkest pt-2 text-sm xl:text-base">
                                {{$lotto->shop_descrizione}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="my-16">
                <p>Nessun prodotto trovato</p>
            </div>
            @endforelse
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
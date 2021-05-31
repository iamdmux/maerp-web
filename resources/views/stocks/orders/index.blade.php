@extends('stocks.layout.app-stock')

@section('content')

<div class="flex px-4 flex-col-reverse lg:flex-row justify-between pb-16 sm:pb-20 lg:pb-24">
    <div class="lg:w-3/5">
        <div class="pt-10">   
            <h1 class="font-semibold  text-2xl pb-3 text-center sm:text-left">I miei ordini</h1>
            <div class="pt-8">
                @forelse ($orders as $order)
                    
                        <div class="flex justify-between mb-8 bg-black text-white py-2 px-4 font-semibold text-lg rounded">
                            <p>
                                ordine del {{$order->created_at->format('d-m-Y')}}
                            </p>
                            <p>
                                status: {{$order->status}}
                            </p>
                        </div>
                        <div class="block px-4">
                            <div class="flex text-xs text-center py-3 md:text-sm justify-between border-b border-grey-darker">
                                <div class="w-1/4">
                                    <span class="font-semibold uppercase">Prodotto</span>
                                </div>
                                <div class="w-1/4">
                                    <span class="font-semibold uppercase">Quantità</span>
                                </div>
                                <div class="w-1/4">
                                    <span class="font-semibold uppercase">Prezzo</span>
                                </div>
                                <div class="w-1/4">
                                    <span class="font-semibold uppercase">Totale Articolo</span>
                                </div>
                            </div>
                        </div>
                        @foreach ($order->items as $lotto)
                            <div class="flex flex-row items-center py-3 border-b border-grey-dark justify-between mb-0 md:flex">
                            <div class="w-1/4 relative">
                                <div class="w-1/4 text-left">
                                    <div class="w-20 mx-0 relative pr-0 hidden md:block">
                                        <div class="h-20 rounded flex items-center justify-center">
                                            <div class="aspect-w-1 aspect-h-1 w-full">
                                                <img src="{{ asset('storage/' . $lotto->shop_image) }}"
                                                    alt="product image"
                                                    class="object-cover"/>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-base mt-2 ml-4">{{$lotto->codice_articolo}}</span>
                                </div>
                            </div>
                            <div class="w-1/4 text-center border-b-0 border-grey-dark pb-0">
                                <div class="mx-auto mr-8 xl:mr-4">
                                    <div class="flex justify-center">
                                        {{$lotto->pivot->quantita}}
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/4 text-center">
                                <span>{{$lotto->shop_prezzo}}</span>
                            </div>
                            <div class="w-1/4 text-center">
                                <span>{{$lotto->shop_prezzo*$lotto->pivot->quantita}}</span>
                            </div>
                        </div>
                        @endforeach
                        {{-- totale --}}
                        <div class="mb-16 text-right">
                            <div class="px-8 border-b border-grey-darker">
                                <p class="font-semibold my-3 uppercase">Totale</p>
                                <p class="font-semibold my-3 uppercase">{{$order->subtotal}} €</p>
                            </div>
                        </div>
                        @empty
                            <p>Non c'è nessun ordine</p>

                @endforelse
            </div>
        </div>

        <div class="flex flex-wrap justify-between mt-16">
            <a href="{{route('stocks.index')}}"
               class="mb-4 px-6 py-2 font-semibold rounded-xl border border-black hover:bg-gray-200">torna su stocks
            </a>
            <a href="{{route('orders.index')}}"
                class="mb-4 px-6 py-2 font-semibold rounded-xl bg-black text-white hover:bg-gray-800">Aggiorna pagina ordine
            </a>
        </div>
    </div>
</div>

@endsection
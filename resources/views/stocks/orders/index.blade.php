@extends('stocks.layout.app-stock')

@section('content')

<div class="flex flex-col-reverse lg:flex-row justify-between pb-16 sm:pb-20 lg:pb-24">
    <div class="lg:w-3/5">
        <div class="pt-10">
            
            <h1 class="font-hkbold text-secondary text-2xl pb-3 text-center sm:text-left">I miei ordini</h1>
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
                    @foreach ($order->items as $lotto)
                    <div class="hidden sm:block">
                        <div class="flex justify-between border-b border-grey-darker">
                            <div class="w-1/2 lg:w-3/5 xl:w-1/2 pl-8 sm:pl-12 pb-2">
                                <span class="font-hkbold text-secondary text-sm uppercase">Prodotto</span>
                            </div>
                            <div class="w-1/4 sm:w-1/6 lg:w-1/5 xl:w-1/4 pb-2 text-center sm:mr-2 md:mr-18 lg:mr-12 xl:mr-18">
                                <span class="font-hkbold text-secondary text-sm uppercase">Quantità</span>
                            </div>
                            <div class="w-1/4 lg:w-1/5 xl:w-1/4 pb-2 text-right md:pr-10">
                                <span class="font-hkbold text-secondary text-sm uppercase">Prezzo</span>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 border-b border-grey-dark flex-row justify-between items-center mb-0 hidden md:flex">
                        <div class="w-1/2 lg:w-3/5 xl:w-1/2 flex flex-row items-center border-b-0 border-grey-dark pt-0 pb-0 text-left">
                            <div class="w-20 mx-0 relative pr-0">
                                <div class="h-20 rounded flex items-center justify-center">
                                    <div class="aspect-w-1 aspect-h-1 w-full">
                                        <img src="{{ asset('storage/' . $lotto->shop_image) }}"
                                            alt="product image"
                                            class="object-cover"/>
                                    </div>
                                </div>
                            </div>
                            <span class="font-hk text-secondary text-base mt-2 ml-4">{{$lotto->codice_articolo}}</span>
                        </div>

                        <div class="w-full sm:w-1/5 xl:w-1/4 text-center border-b-0 border-grey-dark pb-0">
                            <div class="mx-auto mr-8 xl:mr-4">
                                <div class="flex justify-center">
                                    {{$lotto->pivot->quantita}}
                                </div>

                            </div>
                        </div>
                        <div class="w-1/4 lg:w-1/5 xl:w-1/4 text-right pr-10 xl:pr-10 pb-4">
                            <span class="font-hk text-secondary">$1045</span>
                        </div>
                    </div>
                    @endforeach
                    {{-- totale --}}
                    <div class="hidden sm:block">
                        <div class="flex justify-end border-b border-grey-darker">
                            <div class="w-1/4 lg:w-1/5 xl:w-1/4 pb-2 text-right md:pr-10">
                                <p class="font-hkbold text-secondary text-sm uppercase font-bold">Totale</p>
                                <p class="font-hkbold text-secondary text-sm uppercase font-bold">{{$order->subtotal}}</p>
                            </div>
                        </div>
                    </div>

                    @empty
                        <p>Non c'è nessun ordine</p>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-8 sm:pt-12">
            <a href="{{route('stocks.index')}}"
               class="px-6 py-2 font-semibold rounded-xl border border-black hover:bg-gray-200">torna su stocks</a>
            <a href="{{route('orders.index')}}"
                class="px-6 py-2 font-semibold rounded-xl bg-black text-white hover:bg-gray-800">Aggiorna pagina ordine
            </a>
        </div>
    </div>
</div>

@endsection
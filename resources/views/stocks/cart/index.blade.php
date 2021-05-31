@extends('stocks.layout.app-stock')

@section('content')

<div class="flex flex-col-reverse lg:flex-row justify-between pb-16 sm:pb-20 lg:pb-24">
    <div class="lg:w-3/5 px-4">
        <div class="pt-10">
            
            <h1 class="font-semibold  text-2xl pb-3 text-center sm:text-left">Carrello</h1>
            <div class="pt-8">
                @if($cart->count())
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
                @endif
                @php
                    $costoTotale = 0;
                @endphp
                
                @forelse ($cart as $item)
                @php
                    $costoTotale = ($costoTotale+($item->shop_prezzo*$item->pivot->quantita));
                @endphp
                <div class="flex flex-row items-center py-3 border-b border-grey-dark justify-between mb-0 md:flex">
                    <div class="w-1/4 relative">
                        <form class="absolute left-0 top-0 md:mt-5 -ml-2 md:-ml-7" action="{{route('cart.update', $item->pivot->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button onclick="return confirm('Vuoi togliere questo prodotto dal carrello?')">
                                <svg class="w-6 h-6 text-grey-800 mr-2 md:mr-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </form>
                        <div class="w-1/4 text-left">
                            <div class="w-20 mx-0 relative pr-0 hidden md:block">
                                <div class="h-20 rounded flex items-center justify-center">
                                    <div class="aspect-w-1 aspect-h-1 w-full">
                                        <img src="{{ asset('storage/' . $item->shop_image) }}"
                                            alt="product image"
                                            class="object-cover"/>
                                    </div>
                                </div>
                            </div>
                            <span class="  text-base mt-2 ml-4">{{$item->codice_articolo}}</span>
                        </div>
                    </div>
                    <div class="w-1/4 text-center border-b-0 border-grey-dark pb-0">
                        <div class="mx-auto mr-8 xl:mr-4">
                            {{-- <div class="flex justify-center"
                                 x-data="{ productQuantity: @php echo $item->pivot->quantita @endphp }">
                                <input type="number"
                                       id="quantity-form-desktop"
                                       class="form-input form-quantity rounded-r-none w-16 py-0 px-2 text-center"
                                       x-model="productQuantity"
                                       min="1"
                                       max="{{$item->quantita}}" />
                                <div class="flex flex-col">
                                    <span class="px-1 bg-white border border-l-0 border-grey-darker flex-1 rounded-tr cursor-pointer"
                                          @click="productQuantity < {{$item->quantita}} ? productQuantity++ : productQuanity={{$item->quantita}}"><i class="bx bxs-up-arrow text-xs text-primary pointer-events-none"></i></span>
                                    <span class="px-1 bg-white flex-1 border border-t-0 border-l-0 rounded-br border-grey-darker cursor-pointer"
                                          @click="productQuantity > 1 ? productQuantity-- : productQuanity=1"><i
                                           class="bx bxs-down-arrow text-xs text-primary pointer-events-none"></i></span>
                                </div>
                            </div> --}}
                            
                            <div class="flex justify-center">
                                {{$item->pivot->quantita}}
                            </div>

                        </div>
                    </div>
                    <div class="w-1/4 text-center">
                        <span class=" ">{{$item->shop_prezzo}}</span>
                    </div>
                    <div class="w-1/4 text-center">
                        <span class=" ">{{$item->shop_prezzo*$item->pivot->quantita}}</span>
                    </div>
                </div>
                @empty
                    <p>Il carrello è vuoto</p>
                @endforelse
            </div>
        </div>

        <div class="flex flex-wrap justify-between mt-16">
            <a href="{{route('stocks.index')}}"
               class="mb-4 px-6 py-2 font-semibold rounded-xl border border-black hover:bg-gray-200">torna su stocks
            </a>
            <a href="{{route('cart.index')}}"
                class="mb-4 px-6 py-2 font-semibold rounded-xl bg-black text-white hover:bg-gray-800">Aggiorna Carrello
            </a>
        </div>
    </div>

    @if($cart->count())
    <div class="w-full lg:w-1/3 mx-auto lg:mx-0 mt-16 lg:mt-0">
        <form action="{{route('orders.store')}}" method="POST">
            @csrf
            <div class="bg-gray-200 py-8 px-8 rounded">
                <h4 class="font-semibold  text-2xl pb-3 text-center sm:text-left">Cart Totals</h4>
                <div>
                    <p class="font-semibold  pt-1 pb-2">Cart Note</p>
                    <p class="  text-sm pb-4">Special instructions for us</p>
                    <label for="cart_note"
                        class="block relative h-0 w-0 overflow-hidden">Cart Note</label>
                    <textarea rows="5"
                            placeholder="Enter your text"
                            class="form-textarea w-full"
                            name="annotazioni"
                            id="cart_note"></textarea>
                </div>
                <div class="pt-4">
                    {{-- <p class="font-semibold  pt-1 pb-4">Add Coupon</p> --}}
                    {{-- <div class="flex justify-between">
                        <label for="discount_code"
                            class="block relative h-0 w-0 overflow-hidden">Discount Code</label>
                        <input type="text"
                            placeholder="Discount code"
                            class="w-3/5 xl:w-2/3 form-input"
                            id="discount_code"/>
                        <button class="w-2/5 xl:w-1/3 ml-4 lg:ml-2 xl:ml-4 btn btn-outline btn-sm"
                                aria-label="Apply button">Apply</button>
                    </div> --}}
                </div>
                
                <div class="mb-12 pt-4">
                    <p class="font-semibold  pt-1 pb-2">Cart Total</p>
                    {{-- <div class="border-b border-grey-darker pb-1 flex justify-between">
                        <span class=" ">Subtotal</span>
                        <span class=" ">$236</span>
                    </div> --}}
                    {{-- <div class="border-b border-grey-darker pt-2 pb-1 flex justify-between">
                        <span class=" ">Coupon applied</span>
                        <span class=" ">-$36</span>
                    </div> --}}
                    
                    <div class="pt-3 flex justify-between">
                        <span class="font-semibold ">Total</span>
                        <span class="font-semibold ">{{$costoTotale}} €</span>
                    </div>
                </div>

                <button class="px-6 py-2 font-semibold rounded-xl bg-black text-white hover:bg-gray-800">order now</button>
                @endif
            </div>
        </form>
    </div>
</div>
</div>
@endsection
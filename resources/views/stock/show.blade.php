@extends('stock.layout.app-stock')

@section('content')
  
    <div class="px-4 md:px-0 py-6">
      <div class="mx-auto mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:flex-1 px-4">
            <div x-data="{ image: 1 }" class="flex flex-col md:flex-row" x-cloak>

              @if($lotto->shop_image || $lotto->shop_video)
              <div class="flex md:flex-col order-last md:order-first -mx-2 mb-4">
                @if($lotto->shop_image)
                  <div class="px-2">
                    <button x-on:click="image = 1" :class="{ 'ring-2 ring-yellow-300 ring-inset': image === 1 }"
                    class="focus:outline-none mb-3 mr-3 w-full rounded-lg h-24 md:h-20 md:w-36 bg-gray-100 flex items-center justify-center"
                    style="padding: 2px;">
                      <img src="{{ asset('storage/'.$lotto->shop_image) }}" class="h-full object-cover">
                    </button>
                  </div>
                  @endif
                  @if($lotto->shop_video)
                  <div class="px-2">
                    <button x-on:click="image = 2" :class="{ 'ring-2 ring-yellow-300 ring-inset': image === 2 }"
                    class="focus:outline-none mb-3 mr-3 w-full rounded-lg h-24 md:h-20 md:w-36 bg-gray-100 flex items-center justify-center"
                    style="padding: 2px;">
                      <p>video</p>
                    </button>
                  </div>
                  @endif
              </div>
              @endif

              <div class="h-64 flex-1 md:h-80 rounded-lg bg-gray-100 mb-4">
                @if($lotto->shop_image)
                <div x-show="image === 1" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <img src="{{ asset('storage/'.$lotto->shop_image) }}" class="h-full object-cover">
                </div>
                @endif

                @if($lotto->shop_video)
                <div x-show="image === 2" style="display:none" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <video class="w-full h-auto" controls>
                    <source src="{{asset('storage/'.$lotto->shop_video)}}" type="video/mp4">
                    <source src="{{asset('storage/'.$lotto->shop_video)}}" type="video/ogg">
                    Your browser does not support the video tag.
                  </video>
                </div>
                @endif
              </div>
            </div>
          </div>

          <div class="md:flex-1 px-4">
            <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
              {{$lotto->codice_articolo}}
            </h2>
          
            <div>
              <span class="font-bold text-gray-500 text-xl">
                {{$lotto->kg}} 
              </span>
              Kg 
            </div>

            <p class="text-gray-500 text-sm">{{$lotto->marca->nome}}</p>

            <div class="flex items-center space-x-4 my-4">
              <div>
                <div class="rounded-lg flex py-2">
                  <span class="text-gray-400 mr-1 mt-1">€</span>
                  <span class="font-bold text-gray-700 text-2xl">
                    {{$lotto->shop_prezzo}}
                  </span>
                </div>
              </div>
              <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
            </div>
    
            <p class="text-gray-800">
              {{$lotto->shop_descrizione}}
            </p>
    
            <div class="flex mt-6 py-4 space-x-4">
              <div class="relative">
                <div class="text-center left-0 -mt-6 pt-1 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>

                <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 px-8 h-14">
                  @for ($i = 1; $i <= $lotto->quantita; $i++)
                  <option>{{$i}}</option>
                  @endfor
                </select>
    
                {{-- <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg> --}}
              </div>
    
              <button type="button" class="h-14 px-6 py-2 font-semibold rounded-xl bg-black hover:bg-gray-800 text-yellow-300 hover:text-yellow-200">
                Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
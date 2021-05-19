@extends('shop.layout.app')

@section('content')
  
    <div class="py-6">
      <div class="mx-auto mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:flex-1 px-4">
            <div x-data="{ image: 1 }" x-cloak>
              <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
                <div x-show="image === 1" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <span class="text-5xl">1</span>
                </div>
    
                <div x-show="image === 2" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <span class="text-5xl">2</span>
                </div>
    
                <div x-show="image === 3" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <span class="text-5xl">3</span>
                </div>
    
                <div x-show="image === 4" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                  <span class="text-5xl">4</span>
                </div>
              </div>
    
              <div class="flex -mx-2 mb-4">
                <template x-for="i in 4">
                  <div class="flex-1 px-2">
                    <button x-on:click="image = i" :class="{ 'ring-2 ring-yellow-300 ring-inset': image === i }" class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                      <span x-text="i" class="text-2xl"></span>
                    </button>
                  </div>
                </template>
              </div>
            </div>
          </div>
          <div class="md:flex-1 px-4">
            <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">Lorem ipsum dolor</h2>
            <p class="text-gray-500 text-sm">By ABC Company</p>
    
            <div class="flex items-center space-x-4 my-4">
              <div>
                <div class="rounded-lg flex py-2">
                  <span class="text-gray-400 mr-1 mt-1">€</span>
                  <span class="font-bold text-gray-700 text-2xl">25</span>
                </div>
              </div>
              <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
            </div>
    
            <p class="text-gray-800">Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Vitae exercitationem porro saepe ea harum corrupti vero id laudantium enim, libero blanditiis expedita cupiditate a est.</p>
    
            <div class="flex mt-6 py-4 space-x-4">
              <div class="relative">
                <div class="text-center left-0 -mt-6 pt-1 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>
                <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 px-4 h-14">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
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
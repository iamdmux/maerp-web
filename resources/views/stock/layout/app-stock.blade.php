<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body>
    @if(!help_is_production())
    <div class="absolute bg-red-700 p-1 rounded-bl text-xs text-white right-0">
        <p class="block md:hidden">sm</p>
        <p class="hidden md:block lg:hidden">md</p>
        <p class="hidden lg:block xl:hidden">lg</p>
        <p class="hidden xl:block 2xl:hidden">xl</p>
        <p class="hidden 2xl:block">2xl</p>
    </div>
    @endif

    <div class="w-full text-gray-700 bg-black">
        <div class="container mx-auto">
            <div x-data="{ open: false }" class="flex flex-col mx-auto md:items-center md:justify-between md:flex-row">
            <div class="py-1 flex flex-row items-center justify-between">
                <a href="/stocks" class="text-lg font-semibold text-white">
                    <img src="{{asset('img/logo-m&a.jpeg ')}}" class="w-24 h-24" alt="logo">
                </a>
                <button class="pr-4 md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6 text-white">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" style="display:none" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                </button>
            </div>
            <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow px-2 md:px-0 pb-4 md:pb-0 text-white hidden md:flex md:justify-end md:flex-row">
                @php
                    $menu_a_class = "w-full md:w-auto text-center md:text-left self-start px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg  hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                @endphp

                @can('utilizzare erp')
                <a class="{{$menu_a_class}}" href="/erp">Torna su Erp</a>
                @endcan

                <a class="{{$menu_a_class}}" href="#">Home</a>
                <a class="{{$menu_a_class}}"" href="#">Shop</a>
                <a class="{{$menu_a_class}}"" href="#">About</a>
                <a class="{{$menu_a_class}}"" href="#">Contact</a>
                <a class="{{$menu_a_class}}"" href="#">
                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </a>
                {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="self-start flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <p>Dropdown</p>
                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button> --}}

                    {{-- dropdown list--}}
                    {{-- <div x-show="open" 
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">

                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
                        </div>
                    </div> 
                </div>    --}}
            </nav>
            </div>
        </div>
      </div>
      
    <div class="container mx-auto">
        @yield('content')
    </div>

      <footer class="bg-black pt-10 sm:mt-10">
        <div class="container flex flex-wrap m-auto text-gray-800  justify-left">
            
            <!-- Col-1 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">
                <!-- Col Title -->
                <div class="text-md uppercase text-gray-400 font-bold mb-6">
                    M&A Export s.r.l.
                </div>
    
                <!-- Links leading-loose  -->
                <p class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    Sede legale:<br>
                    Via Italia 21 - 10035 Mazze (Torino) - Italia<br>
                    IBAN: IT 90 Q 03268 30210 0529 2716 8480<br>
                    tel: 0039/3336321195<br>
                    P.IVA: IT11320520015<br>
                    Email: info@maerp.app
                </p>
            </div>
    
            <!-- Col-2 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-64" style="min-width: 250px">
                <!-- Col Title -->
                <div class="text-md uppercase text-gray-400 font-bold mb-6">
                    Pagine
                </div>
    
                <!-- Links -->
                <a href="#" class="my-2 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    Home
                </a>
                <a href="#" class="my-2 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    Shop
                </a>
                <a href="#" class="my-2 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    Chi siamo
                </a>
                <a href="#" class="my-2 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                    Contatti
                </a>
            </div>
    
            <!-- Col-3 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">
                <!-- Col Title -->
                <div class="text-md uppercase text-gray-400 font-bold mb-6">
                    Contattaci
                </div>
    

               <div class="my-3 block  text-gray-300 hover:text-gray-100 text-sm  duration-700">
                   @php 
                    $title = "text-gray-500 font-semibold mt-2";
                    $tex = "";
                   @endphp

                <p class="font-semibold mt-2 uppercase">Sede di Torino (Caluso)</p>
                <p class="{{$title}}">Ufficio Vendite</p>

                    <p class="{{$tex}} mt-1">Sara (English, Deutsch): +393203635839</p>
                    <p class="{{$tex}}">Elena (Român, English) +393203635834</p>
                    <p class="{{$tex}}">Bassem +393203635836 (العربية - français)</p>
                    <p class="{{$tex}}">Davide (Italiano) +393297883215</p>

                    <p class="{{$title}}">Ufficio Acquisti</p>
                        <p class="{{$tex}} mt-1">Oleg (русский, English, Italiano) +393463281421</p>
               </div>
            </div>

            <!-- Col-4 -->
            <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">

               <div class="my-3 lg:pt-8 block  text-gray-300 hover:text-gray-100 text-sm  duration-700">
                    <p class="font-semibold mt-2 uppercase">Sede di Verona (Colognola ai Colli)</p>
                    <p class="{{$title}}">Ufficio Vendite</p>
                        <p class="{{$tex}} mt-1">Roberto (Italiano) +393337100290</p>
                        <p class="{{$tex}}">Isolda (русский, Italiano) +393473181020</p>
                    <p class="{{$title}} mt-10">Sede Amministrativa</p>
                        <p class="{{$tex}} mt-1">Alex (Italiano, Epol) +393336321195</p>
                        <p class="{{$tex}}">Andrei (русский, Italiano) +393897622477</p>
               </div>
            </div>
        </div>
    
        <!-- Copyright Bar -->
        <div class="pt-2">
            <div class="flex pb-5 px-3 m-auto pt-5 
                border-t border-gray-500 text-gray-400 text-sm 
                flex-col md:flex-row">
                <div class="flex mx-auto container">
                    <div>
                        Copyright © 2015 M&A Export. All Rights Reserved.
                    </div>
        
                    <!-- Required Unicons (if you want) -->
                    <div class="md:flex-auto md:flex-row-reverse flex-row flex">
                        <a href="#" class="w-6 mx-1">
                            <i class="uil uil-facebook-f">xx</i>
                        </a>
                        <a href="#" class="w-6 mx-1">
                            <i class="uil uil-twitter-alt">xx</i>
                        </a>
                        <a href="#" class="w-6 mx-1">
                            <i class="uil uil-youtube">xx</i>
                        </a>
                        <a href="#" class="w-6 mx-1">
                            <i class="uil uil-linkedin">xx</i>
                        </a>
                        <a href="#" class="w-6 mx-1">
                            <i class="uil uil-instagram">xx</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>



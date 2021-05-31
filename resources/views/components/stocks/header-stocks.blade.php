<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stocks</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}"  type='image/x-icon'>
    
    {{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"> --}}
    <!-- toast -->
    <link rel="stylesheet" href="{{ asset('css/toast-with-cheese.css')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    @if(!help_is_production())
    <div class="absolute bg-red-700 p-1 rounded-bl text-xs right-0">
        <p class="block md:hidden">sm</p>
        <p class="hidden md:block lg:hidden">md</p>
        <p class="hidden lg:block xl:hidden">lg</p>
        <p class="hidden xl:block 2xl:hidden">xl</p>
        <p class="hidden 2xl:block">2xl</p>
    </div>
    @endif

    
    <div class="w-full">
        <div class="container mx-auto">
            <div x-data="{ open: false }" class="flex flex-col mx-auto px-2 md:items-center md:justify-between md:flex-row">
            <div class="py-1 flex flex-row items-center justify-between">
                <a href="/stocks" class="text-lg font-semibold ">
                    <img src="{{asset('img/logo-mea.png')}}" class="w-24 h-24 my-3" alt="logo">
                </a>
                <button class="pr-4 md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6 ">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" style="display:none" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                </button>
            </div>
            <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow px-2 md:px-0 pb-4 md:pb-0  hidden md:flex md:justify-end md:flex-row">
                @php
                    $menu_a_class = "w-full md:w-auto text-center md:text-left self-start px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg  hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                @endphp

                <a class="{{$menu_a_class}}" href="/stocks">Home</a>
                <a class="{{$menu_a_class}}" href="{{route('stocks.index')}}">Stocks</a>
                <a class="{{$menu_a_class}}" href="#">About</a>
                <a class="{{$menu_a_class}}" href="#">Contact</a>
                
                {{-- cart --}}
                @auth
                <a class="{{$menu_a_class}}" href="{{route('cart.index')}}">
                    <div class="relative mx-auto w-8">
                    @if($cartItems)
                        <div class="flex items-center justify-center absolute left-0 top-0 -ml-2 -mt-3 w-5 h-4 rounded-full bg-yellow-300">{{$cartItems}}</div>
                    @endif
                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </a>
                @endauth

                @guest
                <a class="{{$menu_a_class}} text-gray-500" href="/register">Registrati</a>
                <a class="{{$menu_a_class}} text-gray-500" href="/login">Login</a>
                @endguest

                @auth
                    @php
                        $dropDownClass = "block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    @endphp
                    <div @click.away="open = false" class="relative z-50" x-data="{ open: false }">
                        <button @click="open = !open" class="{{$menu_a_class}}">
                            <span>
                                <a>{{auth()->user()->name}}</a>
                            </span>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button> 

                            {{-- dropdown list--}}
                            <div x-show="open"  style="display:none"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">

                                <div class="px-2 py-2 text-center bg-white rounded-md shadow">
                                    @if(auth()->user()->account()->exists())
                                    <a class="{{$dropDownClass}}" href="{{route('account.edit', auth()->user()->slug)}}">Il mio account</a>
                                    @else
                                    <a class="{{$dropDownClass}}" href="{{route('account.create')}}">Il mio account</a>
                                    @endif
                                    
                                    <a class="{{$dropDownClass}}" href="{{route('orders.index')}}">I miei ordini</a>
                                    @can('erp user')
                                    <a class="{{$dropDownClass}}" href="/erp">Torna su Erp</a>
                                    @endcan
                                    {{-- -- logout -- --}}
                                    <a class="relative {{$dropDownClass}}" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        logout
                                        <svg class="w-4 h-4 absolute right-0 top-0 mt-3 mr-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>

                                </div>
                            </div> 
                    </div> 
                @endauth
            </nav>
            </div>
        </div>
    </div>
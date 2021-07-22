@extends('stocks.layout.app-stock')

@section('content')
<div class="p-4 w-full xl:w-3/4">
    
    <h1 class="my-6 font-semibold text-3xl">{{__('pages.About Us')}}</h1>
    <img src="{{asset('img/chisiamo-magazzino.jpg')}}" alt="magaazzino" class="w-full rounded">
    <p class="mt-10">
        {{ __('pages.us_intro_1')}}
    </p>
    @php
    $w = 'w-6 h-6';
    @endphp


    <section class="flex flex-wrap justify-around my-24 text-center uppercase tracking-wider">
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            <p class="mt-3"><span class="text-2xl font-semibold">{{ __('pages.us_numerlist_1_num')}}</span> {{ __('pages.us_numerlist_1_um')}}</p>
            <p>{{ __('pages.us_numerlist_1_desc')}}</p>
        </div>
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            <p class="mt-3"><span class="text-2xl font-semibold">{{ __('pages.us_numerlist_2_num')}}</span> {{ __('pages.us_numerlist_2_um')}}</p>
            <p>{{ __('pages.us_numerlist_2_desc')}}</p>
        </div>
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            <p class="mt-3"><span class="text-2xl font-semibold">{{ __('pages.us_numerlist_3_num')}}</span> {{ __('pages.us_numerlist_3_um')}}</p>
            <p>{{ __('pages.us_numerlist_3_desc')}}</p>
        </div>
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            <p class="mt-3"><span class="text-2xl font-semibold">{{ __('pages.us_numerlist_4_num')}}</span> {{ __('pages.us_numerlist_4_um')}}</p>
            <p>{{ __('pages.us_numerlist_4_desc')}}</p>
        </div>
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            <p class="mt-3"><span class="text-2xl font-semibold">{{ __('pages.us_numerlist_5_num')}}</span> {{ __('pages.us_numerlist_5_um')}}</p>
            <p>{{ __('pages.us_numerlist_5_desc')}}</p>
        </div>
    </section>

    <div class="flex flex-wrap">
        <div class="flex flex-col justify-center w-full lg:w-1/2 lg:pr-6">
            <div>
                <h3 class="text-2xl font-semibold">{{ __('pages.Where_we_buy_title') }}</h3>
                <p class="mb-8">{{ __('pages.Where_we_buy_desc') }}</p>
            </div>
            <div>
                <h3 class="text-2xl font-semibold">{{ __('pages.Where_to_sell_title') }}</h3>
                <p class="mb-8">{{ __('pages.Where_to_sell_desc') }}</p>
            </div>
            <div class="mb-6">
                <h3 class="text-2xl font-semibold">{{ __('pages.our_mission_title') }}</h3>
                <p>{{ __('pages.our_mission_desc') }}</p>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <img src="{{asset('img/chisiamo-export.jpg')}}" alt="magaazzino" class="w-full rounded">
        </div>
    </div>

    <div class="my-24 p-8 bg-gray-100 border border-black rounded">
        <h3 class="text-2xl font-semibold mb-1">{{ __('pages.benefit_title')}}</h3>
        <p>{{ __('pages.benefit_desc')}}</p>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 lg:pr-6">
            <h4 class="font-semibold text-lg">{{ __('pages.benefit_offer')}}</h4>
            <div class="pl-6 mt-16 mb-6">
                <ul>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list1') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list2') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list3') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list4') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list5') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list6') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list7') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list8') }}</li>
                    <li style="list-style-type: disc;" class="mb-1">{{ __('pages.list9') }}</li>
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <img src="{{asset('img/chisiamo-vetrina.jpg')}}" alt="magaazzino" class="w-full rounded">
        </div>
    </div>
@endsection
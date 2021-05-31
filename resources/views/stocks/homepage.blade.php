@extends('stocks.layout.app-stock')

@section('content')

<div x-data>
    <div class="hero-slider relative"
         x-data
         x-init="new Glide('.hero-slider', { autoplay: 3000, type: 'carousel' }).mount()">
        <div class="glide__track"
             data-glide-el="track">
            <div class="glide__slides">
                <div class="glide__slide">
                    <div class="bg-left sm:bg-center bg-no-repeat bg-gray-300 bg-cover rounded"
                    style="background-image:url(/stocks-media/home/hero-slide-01.jpg)">
                        <div class="py-48 px-5 sm:px-10 md:px-12 xl:px-24 text-center sm:text-left sm:w-5/6 lg:w-3/4 xl:w-2/3" style="height: 528px;">
                            <h3 class="font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl">New Men’s <br/> Outdoor Collection</h3>
                            <a href="#" class="absolute mt-8 py-3 px-6 bg-black text-white rounded">Know more</a>
                        </div>
                    </div>
                </div>
                
                <div class="glide__slide">
                    <div class="bg-left sm:bg-center bg-no-repeat bg-gray-300 bg-cover rounded"
                    style="background-image:url(/stocks-media/home/hero-slide-02.jpg)">
                        <div class="py-48 px-5 sm:px-10 md:px-12 xl:px-24 text-center sm:text-left sm:w-5/6 lg:w-3/4 xl:w-2/3" style="height: 528px;">
                            <h3 class="font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl">Blake by <br/> 30% off</h3>
                            <a href="#" class="absolute mt-8 py-3 px-6 bg-black text-white rounded">Know more</a>
                        </div>
                    </div>
                </div>
                
                <div class="glide__slide">
                    <div class="bg-left sm:bg-center bg-no-repeat bg-gray-300 bg-cover rounded"
                    style="background-image:url(/stocks-media/home/hero-slide-03.jpg)">
                        <div class="py-48 px-5 sm:px-10 md:px-12 xl:px-24 text-center sm:text-left sm:w-5/6 lg:w-3/4 xl:w-2/3" style="height: 528px;">
                            <h3 class="font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl">Hoodie your way! <br/> For Men</h3>
                            <a href="#" class="absolute mt-8 py-3 px-6 bg-black text-white rounded">Know more</a>
                        </div>
                    </div>
                </div>
                
                <div class="glide__slide">
                    <div class="bg-left sm:bg-center bg-no-repeat bg-gray-300 bg-cover rounded" 
                    style="background-image:url(/stocks-media/home/hero-slide-04.jpg)">
                        <div class="py-48 px-5 sm:px-10 md:px-12 xl:px-24 text-center sm:text-left sm:w-5/6 lg:w-3/4 xl:w-2/3" style="height: 528px;">
                            <h3 class="font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl">Match and play Women’s Dresses</h3>
                            <a href="#" class="absolute mt-8 py-3 px-6 bg-black text-white rounded">Know more</a>
                        </div>
                    </div>
                </div>
                
                <div class="glide__slide">
                    <div class="bg-left sm:bg-center bg-no-repeat bg-gray-300 bg-cover rounded"
                    style="background-image:url(/stocks-media/home/hero-slide-05.jpg)">
                        <div class="py-48 px-5 sm:px-10 md:px-12 xl:px-24 text-center sm:text-left sm:w-5/6 lg:w-3/4 xl:w-2/3" style="height: 528px;">
                            <h3 class="font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl">Back to school, <br/> the stylish way</h3>
                            <a href="#" class="absolute mt-8 py-3 px-6 bg-black text-white rounded">Know more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 inset-x-0 mb-6 z-30 text-center"
             data-glide-el="controls[nav]">
            
            <span class="inline-block border border-primary transition-colors hover:bg-secondary p-1 rounded-full mr-1 focus:outline-none cursor-pointer"
                  data-glide-dir="=0"></span>
            
            <span class="inline-block border border-primary transition-colors hover:bg-secondary p-1 rounded-full mr-1 focus:outline-none cursor-pointer"
                  data-glide-dir="=1"></span>
            
            <span class="inline-block border border-primary transition-colors hover:bg-secondary p-1 rounded-full mr-1 focus:outline-none cursor-pointer"
                  data-glide-dir="=2"></span>
            
            <span class="inline-block border border-primary transition-colors hover:bg-secondary p-1 rounded-full mr-1 focus:outline-none cursor-pointer"
                  data-glide-dir="=3"></span>
            
            <span class="inline-block border border-primary transition-colors hover:bg-secondary p-1 rounded-full mr-1 focus:outline-none cursor-pointer"
                  data-glide-dir="=4"></span>
            
        </div>
    </div>

    <div class="flex flex-wrap flex-col lg:flex-row justify-between my-16 lg:my-32 lg:px-12 xl:px-40">

        <div class="my-10 lg:my-0 flex flex-col lg:flex-row">
            <div class="mx-auto my-3 px-6">
                <img src="{{asset('stocks-media/home/icon-shipping.svg')}}"
                    class="w-12 h-12 object-contain object-center"
                    alt="icon"/>
            </div>
            <div class="text-center lg:text-left">
                <h3 class="font-semibold text-xl tracking-wide">
                    Free shipping</h3>
                <p class="text-base tracking-wide">
                    On all orders over $30</p>
            </div>
        </div>

        <div class="my-10 lg:my-0 flex flex-col lg:flex-row">
            <div class="mx-auto my-3 px-6">
                <img src="{{asset('stocks-media/home/icon-support.svg')}}"
                    class="w-12 h-12 object-contain object-center"
                    alt="icon"/>
            </div>
            <div class="text-center lg:text-left">
                <h3 class="font-semibold text-xl tracking-wide">
                    Always available</h3>
                <p class="text-base tracking-wide">
                    24/7 call center available</p>
            </div>
        </div>

        <div class="my-10 lg:my-0 flex flex-col lg:flex-row">
            <div class="mx-auto my-3 px-6">
                <img src="{{asset('stocks-media/home/icon-return.svg')}}"
                    class="w-12 h-12 object-contain object-center"
                    alt="icon"/>
            </div>
            <div class="text-center lg:text-left">
                <h3 class="font-semibold text-xl tracking-wide">
                    Free returns</h3>
                <p class="text-base tracking-wide">
                    30 days free return policy</p>
            </div>
        </div>
    </div>


    <div class="pb-20 md:pb-24 lg:pb-32 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div class="px-10 mx-auto lg:mx-0 text-center lg:text-left">
            <div class="lg:w-3/4 xl:w-2/3 lg:pt-10 pb-4 md:pb-10">
                <h1 class="font-semibold text-3xl md:text-4xl lg:text-4.5xl">Trending Collections</h1>
                <p class="text-lg pt-4">Checkout our newest trends this coming season</p>
            </div>
        </div>
        <div class="mt-6 sm:mt-10 lg:mt-0">
            <div class="px-10 h-56 sm:h-80 bg-left sm:bg-center bg-no-repeat bg-cover rounded relative"
                 style="background-image:url(/stocks-media/home/collection-01.jpg)">
                <div class="w-2/3 absolute inset-0 px-6 md:px-10 py-14 ">
                    <h3 class=" font-semibold  text-xl sm:text-2xl md:text-3xl">Passion Pearl <br/> Collection</h3>
                    <a href="#"
                       class="flex items-center pt-5 group">
                        <div class="bg-white rounded-full h-8 w-8 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                        <span class=" font-semibold transition-colors  group-hover:text-v-red sm:text-lg pl-3 sm:pl-5 leading-none -mt-1">
                            Get it now</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-left sm:bg-center bg-no-repeat bg-cover rounded relative h-56 sm:h-80 lg:h-68"
             style="background-image:url(/stocks-media/home/collection-02.jpg)">
            <div class="md:w-2/3 absolute inset-0 px-6 md:px-10 py-14">
                <h3 class=" font-semibold  text-xl sm:text-2xl md:text-3xl">Hoodie your way! For Men</h3>
                <a href="#"
                   class="flex items-center pt-5 group">
                    <div class="bg-white rounded-full p-2 h-8 w-8 flex items-center justify-center hover:ml-4 transition duration-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <p class=" font-semibold  transition-colors group-hover:text-v-red sm:text-lg pl-3 sm:pl-5 leading-none -mt-1">
                        Get it now</p>
                </a>
            </div>
        </div>
        <div class="px-10 lg:row-span-2 bg-left sm:bg-center bg-no-repeat bg-cover rounded relative h-56 sm:h-80 lg:h-auto"
             style="background-image:url(/stocks-media/home/collection-shoes.jpg)">
            <div class="w-2/3 absolute inset-0 px-6 md:px-10 py-14 sm:py-16">
                <h3 class=" font-semibold  text-xl sm:text-2xl md:text-3xl">
                    W.W. Shoes <br/> by Zara
                </h3>
                <a href="#"
                   class="flex items-center pt-5 group">
                    <div class="bg-white rounded-full p-2 h-8 w-8 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <p class=" font-semibold  transition-colors group-hover:text-v-red sm:text-lg pl-3 sm:pl-5 leading-none -mt-1">
                        Get it now</p>
                </a>
            </div>
        </div>
        <div class="bg-left sm:bg-center bg-no-repeat bg-cover rounded relative h-56 sm:h-80 lg:h-68"
             style="background-image:url(/stocks-media/home/collection-03.jpg)">
            <div class="w-2/3 absolute inset-0 px-6 md:px-10 py-14">
                <h3 class=" font-semibold  text-xl sm:text-2xl md:text-3xl">Anabelle Purses</h3>
                <a href="#"
                   class="flex items-center pt-5 group">
                    <div class="bg-white rounded-full p-2 h-8 w-8 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <p class=" font-semibold  transition-colors group-hover:text-v-red sm:text-lg pl-3 sm:pl-5 leading-none -mt-1">
                        Get it now</p>
                </a>
            </div>
        </div>
    </div>

    <div class="px-8">
        <h4 class=" text-xl  uppercase text-center">Alcuni dei nostri marchi</h4>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 pt-8 gap-5">
            
            <img src="{{asset('stocks-media/home/logo-Benetton.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
            
            <img src="{{asset('stocks-media/home/logo-Bershka.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
            
            <img src="{{asset('stocks-media/home/logo-desigual.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
            
            <img src="{{asset('stocks-media/home/logo-Diesel.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
            
            <img src="{{asset('stocks-media/home/logo-guess.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
            
            <img src="{{asset('stocks-media/home/logo-hem.png')}}"
                alt="brand logo"
                class="h-24 w-auto mb-6 sm:mb-10 lg:mb-0"/>
        </div>
    </div>



</div>


@endsection
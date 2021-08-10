<footer class="bg-black pt-10 sm:mt-24">
    <div class="container flex flex-wrap m-auto text-gray-800  justify-left">
        
        <!-- Col-1 -->
        <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">
            <!-- Col Title -->
            <div class="text-md uppercase text-gray-400 font-bold mb-6">
                M&A Export s.r.l.
            </div>

            <!-- Links leading-loose  -->
            <p class="my-3 leading-loose block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                Sede legale:<br>
                Via Italia 21 - 10035 Mazze (Torino) - Italia<br>
                IBAN: IT 90 Q 03268 30210 0529 2716 8480<br>
                tel: 0039/3336321195<br>
                P.IVA: IT11320520015<br>
                Email: info@maerp.app
            </p>
        </div>

        <!-- Col-2 -->
        <div class="p-5 leading-loose w-1/2 sm:w-4/12 md:w-64" style="min-width: 250px">
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
        <div class="p-5  w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">
            <!-- Col Title -->
            <div class="text-md uppercase text-gray-400 font-bold mb-6">
                Contattaci
            </div>


           <div class="my-3 block  text-gray-300 hover:text-gray-100 text-sm  duration-700">
               @php 
                $title = "text-gray-500 font-semibold mt-2";
                $tex = "normal-case";
               @endphp

                <p><a class="leading-loose font-semibold mt-2 uppercase" href="{{route('stocks.contacts', app()->getLocale())}}">Sede di Torino (Caluso)</a></p>
                <p><a class="leading-loose font-semibold mt-2 uppercase" href="{{route('stocks.contacts', app()->getLocale())}}">Sede di Verona (Colognola ai Colli)</a></p>
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
                    Copyright © {{date('Y')}} M&A Export. All Rights Reserved.
                </div>
    
                <!-- Required Unicons (if you want) -->
                <div class="md:flex-auto md:flex-row-reverse flex-row flex">
                    <a href="#" class="w-6 mx-1">
                        <i class="uil uil-facebook-f"></i>
                    </a>
                    <a href="#" class="w-6 mx-1">
                        <i class="uil uil-twitter-alt"></i>
                    </a>
                    <a href="#" class="w-6 mx-1">
                        <i class="uil uil-youtube"></i>
                    </a>
                    <a href="#" class="w-6 mx-1">
                        <i class="uil uil-linkedin"></i>
                    </a>
                    <a href="#" class="w-6 mx-1">
                        <i class="uil uil-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
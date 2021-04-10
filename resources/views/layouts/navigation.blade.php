<div x-data="navigation()" @sidebar-open="sidebarOpen = !sidebarOpen" class="flex h-screen bg-gray-200 font-roboto">
    
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-52 transition duration-300 transform bg-black overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="mt-8 pl-4">
        <img src="{{asset('img/logo-m&a.webp')}}" class="w-24 h-24" alt="logo">
    </div>

        <nav class="mt-10">
            <a class="flex items-center mt-2 py-1 px-6 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('home.page') ? 'bg-gray-700 text-blue-400' : ''}}" href="/">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>

                <span class="mx-3">Dashboard</span>
            </a>

            <hr class="mt-2" style="background-color: #242424; height: 1px; border: 0;">

            {{-- VENDITE --}}
            <div @click="open('vendite')" class="cursor-pointer flex items-center mt-2 py-1 px-6 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>

                <span class="mx-3">Vendite</span>
            </div>

                <a x-show="isOpenVendite()" class="flex items-center mt-2 py-1 pl-8 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('clienti.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{route('clienti.index')}}">
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>

                    <span class="mx-3">Clienti</span>
                </a>

                <a x-show="isOpenVendite()" class="flex items-center mt-2 py-1 pl-8 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('fatture.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{route('fatture.index')}}">
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>

                    <span class="mx-3">Fatture / doc</span>
                </a>

            <hr class="mt-2" style="background-color: #242424; height: 1px; border: 0;">

            {{-- ACQUISTI --}}
            <div @click="open('acquisti')" class="cursor-pointer flex items-center mt-2 py-1 px-6 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>

                <span class="mx-3">Acquisti</span>
            </div>

            <a x-show="isOpenAcquisti()" class="flex items-center mt-2 py-1 pl-8 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('fornitori.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{route('fornitori.index')}}">
                <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>

                <span class="mx-3">Fornitori</span>
            </a>

            <hr class="mt-2" style="background-color: #242424; height: 1px; border: 0;">

            {{-- MAGAZZINO --}}
            <div @click="open('magazzino')" class="cursor-pointer flex items-center mt-2 py-1 px-6 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>

                <span class="mx-3">Magazzino</span>
            </div>

                <a x-show="isOpenMagazzino()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('lotti.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('lotti.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>

                    <span class="mx-3">Lotti</span>
                </a>

                <a x-show="isOpenMagazzino()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('marche.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('marche.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>

                    <span class="mx-3">Marche</span>
                </a>

                <hr class="mt-2" style="background-color: #242424; height: 1px; border: 0;">

                {{-- Blackbox --}}
                <div @click="open('blackbox')" class="cursor-pointer flex items-center mt-2 py-1 px-6 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                    </svg>

                    <span class="mx-3">Blackbox</span>
                </div>

                <a x-show="isOpenBlackbox()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('lavorazioni.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('lavorazioni.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="mx-3">Lavorazioni</span>
                </a>

                <a x-show="isOpenBlackbox()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('operatori.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('operatori.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="mx-3">Operatori</span>
                </a>

                <a x-show="isOpenBlackbox()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('capi.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('capi.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="mx-3">Capi</span>
                </a>

                <a x-show="isOpenBlackbox()" style="display:none" class="flex items-center mt-2 py-1 pl-8 text-gray-100 hover:bg-gray-700 bg-opacity-25 hover:text-gray-100 {{url()->current() == route('pause.totali.index') }} ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('pause.totali.index') }}">
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <span class="mx-3">Pause</span>
                </a>

            @push('scripts')
            <script> 
                let isMagazzino = window.location.pathname.split('/')[1] == 'magazzino' ? true : false;
                let isVendite = window.location.pathname.split('/')[1] == 'vendite' ? true : false;
                let isBlackbox = window.location.pathname.split('/')[1] == 'blackbox' ? true : false;
                let isAcquisti = window.location.pathname.split('/')[1] == 'acquisti' ? true : false;
                function navigation() {
                    return {
                        sidebarOpen: false,
                        showMagazzino: isMagazzino,
                        showVendite: isVendite,
                        showBlackbox: isBlackbox,
                        showAcquisti: isAcquisti,
                        open(menu) {
                            if(menu == 'magazzino'){
                                this.showMagazzino = !this.showMagazzino
                            } else if(menu == 'vendite'){
                                this.showVendite = !this.showVendite
                            } else if(menu == 'blackbox'){
                                this.showBlackbox = !this.showBlackbox
                            } else if(menu == 'acquisti'){
                                this.showAcquisti = !this.showAcquisti
                            }
                            
                            },
                        isOpenMagazzino() { return this.showMagazzino === true },
                        isOpenVendite() { return this.showVendite === true },
                        isOpenBlackbox() { return this.showBlackbox === true },
                        isOpenAcquisti() { return this.showAcquisti === true },
                    }
                }
            </script>
            @endpush
        </nav>
</div> 
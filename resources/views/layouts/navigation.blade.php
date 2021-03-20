<div x-data="navigation()" class="flex h-screen bg-gray-200 font-roboto">
    
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <svg class="h-12 w-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"/>
            </svg>

            <span class="text-white text-2xl mx-2 font-semibold">Dashboard</span>
        </div>
    </div>

        <nav class="mt-10">
            <a class="flex items-center mt-4 py-2 px-6 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('home.page') ? 'bg-gray-700 text-blue-400' : ''}}" href="/">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>

                <span class="mx-3">Dashboard</span>
            </a>

            {{-- VENDITE --}}
            <div @click="open('vendite')" class="cursor-pointer flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>

                <span class="mx-3">Vendite</span>
            </div>

                <a x-show="isOpenVendite()" class="flex items-center mt-4 py-2 pl-8 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('clienti.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{route('clienti.index')}}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>

                    <span class="mx-3">Clienti</span>
                </a>

                <a x-show="isOpenVendite()" class="flex items-center mt-4 py-2 pl-8 bg-opacity-25 hover:bg-gray-700 text-gray-100 {{url()->current() == route('fatture.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{route('fatture.index')}}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>

                    <span class="mx-3">Fatture</span>
                </a>

            {{-- MAGAZZINO --}}
            <div @click="open('magazzino')" class="cursor-pointer flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>

                <span class="mx-3">Magazzino</span>
            </div>

                <a x-show="isOpenMagazzino()" style="display:none" class="flex items-center mt-4 py-2 pl-8 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{url()->current() == route('lotti.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('lotti.index') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>

                    <span class="mx-3">Lotti</span>
                </a>

                <a x-show="isOpenMagazzino()" style="display:none" class="flex items-center mt-4 py-2 pl-8 text-gray-100 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{url()->current() == route('marche.index') ? 'bg-gray-700 text-blue-400' : ''}}" href="{{ route('marche.index') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>

                    <span class="mx-3">Marche</span>
                </a>


            @push('scripts')
            <script> 
                let isMagazzino = window.location.pathname.split('/')[1] == 'magazzino' ? true : false;
                let isVendite = window.location.pathname.split('/')[1] == 'vendite' ? true : false;
                function navigation() {
                    return {
                        sidebarOpen: false,
                        showMagazzino: isMagazzino,
                        showVendite: isVendite,
                        open(menu) {
                            if(menu == 'magazzino'){
                                this.showMagazzino = !this.showMagazzino
                            } else if(menu == 'vendite'){
                                this.showVendite = !this.showVendite
                            }
                            
                            },
                        isOpenMagazzino() { return this.showMagazzino === true },
                        isOpenVendite() { return this.showVendite === true },
                    }
                }
            </script>
            @endpush
        </nav>
</div> 
<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Maerp') }}</title>
        
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}"  type='image/x-icon'>
        <!-- Filepond stylesheet -->
        {{-- <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css"> --}}
        <!-- toast -->
        <link rel="stylesheet" href="{{ asset('css/toast-with-cheese.css')}}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <main>
                @include('layouts.toast-with-cheese')

                    {{-- nav wrapper --}}
                <div x-data="navigation()" @sidebar-open="sidebarOpen = !sidebarOpen" class="flex h-screen bg-gray-200 font-roboto">
                    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>  
                    @include('layouts.navigation')
                    {{-- end nav wrapper --}}

                        <div id="app" class="flex-1 flex flex-col overflow-hidden">
                            @include('layouts.top-header')
                            <main class="relative flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                                <div class="container mx-auto px-6 py-8">
                                    @yield('content')
                                </div>
                            </main>
                        </div>
                    </div>
            </main>

        </div>
        @stack('scripts')
    </body>
</html>

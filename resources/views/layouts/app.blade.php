<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- toast -->
        <link rel="stylesheet" href="{{ asset('css/toast-with-cheese.css')}}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <main>
                @include('layouts.toast-with-cheese')
                @include('layouts.navigation')
                <div id="app" class="flex-1 flex flex-col overflow-hidden"> {{-- div wrapper--}}
                    @include('layouts.top-header') {{-- div navigation --}}
                    <main class="relative flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        <div class="container mx-auto px-6 py-8">
                            @yield('content')
                        </div>
                    </main>
                </div> {{-- end div wrapper--}}
                </div> {{-- end div navigation --}}
            </main>

        </div>
        @stack('scripts')
    </body>
</html>

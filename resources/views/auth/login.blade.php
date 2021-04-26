{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        {{-- <link rel="canonical" href="{{ $page->getUrl() }}"> --}}

        <meta name="description" content="descrizione">

        <title>login</title>
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
               
        <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
            <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
                <div class="flex justify-center items-center">
                    <img src="{{asset('img/logo-m&a.webp')}}" class="w-24 h-24" alt="logo">
                </div>

                <form class="mt-4" method="POST" action="{{ route('login') }}">

                    @csrf

                    <label class="block">
                        <span class="text-gray-700 text-sm">Email</span>
                        <input type="email" name="email" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                    </label>

                    <label class="block mt-3">
                        <span class="text-gray-700 text-sm">Password</span>
                        <input type="password" name="password" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                    </label>

                    <div class="flex justify-between items-center mt-4">
                        {{-- <div>
                            <label class="inline-flex items-center">
                                <input name="remember" type="hidden" checked name="" class="form-checkbox text-indigo-600">
                                <span class="mx-2 text-gray-600 text-sm">Remember me</span>
                            </label>
                        </div> --}}
                        
                        <div>
                            <a class="block text-sm fontme text-indigo-700 hover:underline" href="#">Hai dimenticato la password?</a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button class="py-2 px-4 text-center bg-gray-800 rounded-md w-full text-white text-sm hover:bg-gray-700">
                            Entra
                        </button>
                    </div>
                    
                    <x-errors-component />
                   
                </form>
            </div>
        </div>
    </body>
</html>
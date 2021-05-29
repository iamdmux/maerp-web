@extends('stocks.layout.app-stock')
@section('content')

        <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
            <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
                <div class="flex justify-center items-center">
                    <img src="{{asset('img/logo-m&a.webp')}}" class="w-24 h-24" alt="logo">
                </div>

                <form class="mt-4" method="POST" action="{{ route('register') }}">

                    @csrf

                    <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
                    
                    <x-errors-component />
                   
                </form>
            </div>
        </div>
@endsection
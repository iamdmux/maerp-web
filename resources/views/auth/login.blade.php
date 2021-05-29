@extends('stocks.layout.app-stock')

@section('content')
               
        <div class="flex justify-center items-center h-screen px-6">
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
    @endsection
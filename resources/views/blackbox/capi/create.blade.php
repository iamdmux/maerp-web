@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('marche.index')}}" />


<h3 class="text-gray-700 text-3xl font-bold">Aggiungi nuovo capo</h3>

<form action="{{route('capi.store')}}" method="POST">

    @csrf

    <div>
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Nome
        </p>
        <input autocomplete="off" type="text" name="nome" class="mt-8" placeholder="nome capo">
        <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            tipo
        </p>
       <select name="tipo">
           <option value="bambino">bambino</option>
           <option value="adulto">adulto</option>
       </select>
    </div>

    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        Salva nuovo capo
    </button>

    <div class="mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

</form>

@endsection
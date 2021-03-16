@extends('layouts.app')

@section('content')

<div class="mb-4">
    <a href="{{route('marche.index')}}"
        class="px-2 py-1 bg-gray-600 rounded-md text-white font-bold hover:bg-gray-500"
    >
        &larr;
    </a>
</div>

<h3 class="text-gray-700 text-3xl font-bold">Crea nuova marca</h3>

<form action="{{route('marche.store')}}" method="POST">

    @csrf

    <div>
        <input autocomplete="off" type="text" name="nome" class="mt-8 rounded-md" placeholder="nome marca">
    </div>

    <button class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
        Salva nuova marca
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
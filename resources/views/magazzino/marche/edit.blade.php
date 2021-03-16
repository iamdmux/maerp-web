@extends('layouts.app')

@section('content')

<div class="mb-4">
    <a href="{{route('marche.index')}}"
        class="px-2 py-1 bg-gray-600 rounded-md text-white font-bold hover:bg-gray-500"
    >
        &larr;
    </a>
</div>

<h3 class="text-gray-700 text-3xl font-bold">Modifica nome marca</h3>
<p>Stai modificando la marca <span class="font-bold">'{{$marca->nome}}'</span></p>
<form action="{{route('marche.update', $marca->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div>
        <input autocomplete="off" type="text" name="nome" class="mt-8 rounded-md" value="{{old('marca') ? old('marca') : $marca->nome}}">
    </div>

    <div class="flex">
        <button class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
            Modifica nuova marca
        </button>
    </div>
</form>

<form action="{{route('marche.destroy', [$marca->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa marca?')" class="mt-12 text-gray-500 hover:text-red-500">
     cancella marca
    </button>
</form>

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



@endsection
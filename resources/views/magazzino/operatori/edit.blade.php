@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('operatori.index')}}" />

<h3 class="text-gray-700 text-3xl font-bold">Modifica nome marca</h3>
<p>Stai modificando l'operatore <span class="font-bold">'{{$operatore->nome}}'</span></p>
<form action="{{route('operatori.update', $operatore->id)}}" method="POST">

    @csrf
    @method('PATCH')

    <div>
        <input autocomplete="off" type="text" name="nome" class="mt-8" value="{{old('marca') ? old('marca') : $operatore->nome}}">
    </div>

    <div class="flex">
        <button class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
            Modifica operatore
        </button>
    </div>
</form>

<form class="mt-4" action="{{route('operatori.destroy', [$operatore->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo operatore?')">
     elimina
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
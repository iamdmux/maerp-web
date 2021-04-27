@extends('layouts.app')

@section('content')

<x-back-to-page-button route="{{route('ferie.index')}}" />

<x-page-title text="Modifica ferie" />

<p>Stai modificando le ferie di <span class="font-bold">'{{$ferie->operatore->nome}}'</span></p>
<p class="text-sm">dal: {{$ferie->dalStrings}}</p>
<p class="text-sm">al: {{$ferie->alStrings}}</p>
<form action="{{route('ferie.update', $ferie->id)}}" method="POST">
    @csrf
    @method('PATCH')

        <div>
            <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Operatore
            </p>

            <select name="operatore_id">
                @foreach ($operatori  as $operatore)
                <option value="{{$operatore->id}}" {{$ferie->operatore_id == $operatore->id ? 'selected' : ''}}>{{$operatore->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-wrap">
            <div class="mr-2">
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Dal giorno:
                </p>
                <input type="date" name="dal" value="{{$ferie->dal->format('Y-m-d')}}">
            </div>
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    al giorno:
                </p>
                <input type="date" name="al" value="{{$ferie->al->format('Y-m-d')}}">
            </div>
        </div>
        <div class="mt-3">
            <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Note
            </p>
            <textarea name="note" cols="32" rows="5" placeholder="note">{{$ferie->note}}</textarea>
        </div>
        <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
            Aggiorna ferie
        </button>
    </form>

<form action="{{route('ferie.destroy', [$ferie->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questa ferie?')" class="mt-12 text-gray-500 hover:text-red-500">
     cancella ferie
    </button>
</form>

<x-errors-component />



@endsection
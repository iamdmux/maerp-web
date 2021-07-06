@extends('layouts.app')

@section('content')

@php
    $action = $method == 'create' ? route('lotti.store') : route('lotti.update', $lotto->id);
    $text1 = $method == 'create' ? 'Crea nuovo lotto' : 'Modifica lotto';
@endphp

<x-back-to-page-button route="{{route('lotti.index')}}" />

<x-page-title text="{{$text1}}" />

@if($method == 'edit')
<p>Stai modificando il lotto {{$lotto->id}} - '{{$lotto->codice_articolo}}' </p>
@endif

<x-errors-component />


@can('modificare-lotti')
<form action="{{$action}}" method="POST" enctype='multipart/form-data'>
    @csrf
    @if($method == 'edit')
        @method('PATCH')
    @endif
    <div class="flex flex-wrap mt-10">
        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Codice Articolo
            </p>
            <input autocomplete="off" type="text" name="codice_articolo" placeholder="Codice Articolo"
            @php
                if($method == 'create'){
                    $val1 = old('codice_articolo') ? old('codice_articolo') : '';
                } else {
                    $val1 = old('codice_articolo') ? old('codice_articolo') : $lotto->codice_articolo;
                }
            @endphp
                value="{{$val1}}">
        </div>

        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Marca
            </p>
            @if($method == 'create')
            <select name="marca_id">
                <option disabled {{old('marca_id') ? '' : 'selected'}} value> -- seleziona -- </option>
                @foreach ($marche as $marca)
                <option {{old('marca_id') == $marca->id ? 'selected' : ''}} value="{{$marca->id}}">{{$marca->nome}}</option>
                @endforeach
            </select>
            @elseif($method == 'edit')
            <select name="marca_id">
                <option disabled> -- seleziona -- </option>
                @foreach ($marche as $marca)
                <option
                    {{ $lotto->marca_id == $marca->id ? 'selected' : 
                    (old('marca_id') == $marca->id ? 'selected' : '' ) }}
                    value="{{$marca->id}}"
                >
                    {{$marca->nome}}
                </option>
                
                @endforeach
            </select>
            @endif
        </div>
        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Stagione
            </p>
            @php
            $stagioni = [
                'estate',
                'inverno',
                'mix'
            ]   
            @endphp
            
            @if($method == 'create')
            <select name="stagione">
                <option {{old('stagione') ? '' : 'selected'}} value> -- seleziona -- </option>
                <option {{old('stagione') == 'primavera' ? 'selected' : ''}} value="primavera">Primavera</option>
                <option {{old('stagione') == 'estate' ? 'selected' : ''}} value="estate">Estate</option>
                <option {{old('stagione') == 'autunno' ? 'selected' : ''}} value="autunno">Autunno</option>
                <option {{old('stagione') == 'inverno' ? 'selected' : ''}} value="inverno">Inverno</option>
                <option {{old('stagione') == 'nessuna' ? 'selected' : ''}} value="nessuna">Nessuna</option>
            </select>
            @elseif($method == 'edit')
            <select name="stagione">
                <option {{old('stagione') ? '' : 'selected'}} value> -- seleziona -- </option>
                <option {{old('stagione') == 'primavera' ? 'selected' : ($lotto->stagione == 'primavera' ? 'selected' : '')}} value="primavera">Primavera</option>
                <option {{old('stagione') == 'estate' ? 'selected' : ($lotto->stagione == 'estate' ? 'selected' : '')}} value="estate">Estate</option>
                <option {{old('stagione') == 'autunno' ? 'selected' : ($lotto->stagione == 'autunno' ? 'selected' : '')}} value="autunno">Autunno</option>
                <option {{old('stagione') == 'inverno' ? 'selected' : ($lotto->stagione == 'inverno' ? 'selected' : '')}} value="inverno">Inverno</option>
                <option {{old('stagione') == 'nessuna' ? 'selected' : ($lotto->stagione == 'nessuna' ? 'selected' : '')}} value="nessuna">Nessuna</option>
            </select>
            @endif
        </div>
        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Tipologia
            </p>
            @if($method == 'create')
            <select name="tipologia">
                <option disabled {{old('tipologia') ? '' : 'selected'}} value> -- seleziona -- </option>
                @foreach ($tipoogia as $tipo)
                <option {{old('tipologia') == $tipo['val'] ? 'selected' : ''}} value="{{$tipo['val']}}"> {{$tipo['show']}} </option>
                @endforeach
            </select>
            @elseif($method == 'edit')
            <select name="tipologia">
                <option disabled value> -- seleziona -- </option>
                @foreach ($tipoogia as $tipo)
                    <option {{ old('tipologia') == $tipo['val'] ? 'selected' : ($lotto->tipologia == $tipo['val'] ? 'selected' : '')}}
                    value="{{$tipo['val']}}"
                    > {{$tipo['show']}}
                    </option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Kg Lotto
            </p>
            @php
                if($method == 'create'){
                    $val2 = old('kg') ? old('kg') : '';
                } else {
                    $val2 = old('kg') ? old('kg') : $lotto->kg;
                }
            @endphp
            <input type="number" name="kg" step="0.5" min="0" placeholder="Kg Lotto" value="{{$val2}}">
        </div>
        <div class="mr-8">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Quantità
            </p>
            @php
                if($method == 'create'){
                    $val3 = old('quantita') ? old('quantita') : '';
                } else {
                    $val3 = old('quantita') ? old('quantita') : $lotto->quantita;
                }
            @endphp
            <input type="number" name="quantita" min="0" placeholder="Quantità di Pezzi" value="{{$val3}}">
        </div>

        <div class="mt-12 bg-gray-100 border border-gray-300 p-8 rounded">
            <p class="pb-1 text-left text-xs leading-4 font-bold text-black uppercase tracking-wider">
                Shop
            </p>
            <div class="mt-4 flex">
                <label class="pb-1 text-left text-xs leading-4 font-semibold text-gray-800 uppercase tracking-wider">
                    @php
                        if($method == 'create'){
                            $checked1 = old('in_shop') ? 'checked' : '';
                        } else {
                            $checked1 = $lotto->in_shop ? 'checked' : '';
                        }
                    @endphp
                    <input type="hidden" name="in_shop" value="0">
                    <input type="checkbox" value="1" name="in_shop" {{$checked1}}>
                    Mostra in e-shop
                </label>
            </div>
            <div class="mt-8">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Prezzo (in euro)
                </p>
                @php
                    if($method == 'create'){
                        $val4 = old('shop_prezzo') ? old('shop_prezzo') : '';
                    } else {
                        $val4 = old('shop_prezzo') ? old('shop_prezzo') : $lotto->shop_prezzo;
                    }
                @endphp
                <input type="number" name="shop_prezzo" value="{{$val4}}">
            </div>
            <div class="flex flex-wrap mt-4">
                <div x-data="{ disable: false }" class="mr-4">
                    <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Immagine
                    </p>
                    @if($method == 'edit')
                        @if($lotto->shop_image)
                        <div class="h-56">
                            <img src="{{asset('storage/' . $lotto->shop_image)}}" alt="" class="w-48 object-cover" style="max-height: 220px;">
                        </div>
                        <div class="mb-6">
                            <label>
                                <input x-on:change="disable = !disable" type="checkbox" value="1" name="delete_image">
                                elimina immagine
                            </label>
                        </div>
                        @endif
                    @endif
                    
                    <input type="file" name="shopimage" x-bind:class="{ 'invisible': disable}">
                    {{-- <div class="my-1" x-data x-init="FilePond.create($refs.input1);" style="width: 340px;"> 
                        <input type="file" name="shop_image" x-ref="input1">
                    </div> --}}
                    @error('shop_image') <p>{{$message}}</p> @endError
                </div>
                <div x-data="{ disable: false }" class="mr-4">
                    <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Video
                    </p>

                    @if($method == 'edit')
                        @if($lotto->shop_video)
                        <div class="h-56">
                        <video class="w-48 object-cover" style="max-height: 220px;" controls>
                            <source src="{{asset('storage/' . $lotto->shop_video)}}" type="video/mp4">
                            <source src="{{asset('storage/' . $lotto->shop_video)}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                        </div>
                        <div class="mb-6">
                            <label>
                                <input x-on:change="disable = !disable" type="checkbox" value="1" name="delete_video">
                                elimina video
                            </label>
                        </div>
                        @endif
                    @endif

                    <input type="file" name="shopvideo" x-bind:class="{ 'invisible': disable}">
                    {{-- <div class="my-1" x-data x-init="FilePond.create($refs.input2);" style="width: 340px;"> 
                        <input type="file" name="shop_video" x-ref="input2">
                    </div> --}}
                    @error('shop_video') <p>{{$message}}</p> @endError
                </div>
            </div>

            <div class="mt-4">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Descrizione lotto
                </p>
                @php
                    if($method == 'create'){
                        $val5 = old('shop_descrizione') ? old('shop_descrizione') : '';
                    } else {
                        $val5 = old('shop_descrizione') ? old('shop_descrizione') : $lotto->shop_descrizione;
                    }
                @endphp
                <textarea cols="86" rows="5" name="shop_descrizione">{{$val5}}</textarea>
            </div>
            <div class="mt-8">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Visibilità nazioni
                </p>


                <lotto-nazioni-select 
                :nazioni-array="{{json_encode($nazioniArray)}}"
                @if($method == 'edit')
                    old-visibilita="{{old('visibilita') ? old('visibilita') : $lotto->visibilita}}"
                    :old-nazioni-tranne="{{old('nazioni_tranne') ? json_encode(old('nazioni_tranne')) : json_encode($lotto->nazioni_tranne)}}"
                @else
                    :old-visibilita="{{old('visibilita') ? old('visibilita') : '{}'}}"
                    :old-nazioni-tranne="{{old('nazioni_tranne') ? json_encode(old('nazioni_tranne')) : '{}'}}"
                @endif
                >
                </lotto-nazioni-select>
            </div>
        </div>
    </div>
    <button class="mt-8 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
        @if($method == 'create')
            Salva nuovo lotto
        @else
            Modifica lotto
        @endif
    </button>
</form>
@endcan

@if($method == 'edit')
    <div class="mt-16">
        <div class="my-3">
            <p class="font-semibold mb-3">Quantità prenotate</p>
            @forelse($prenotatoList as $status)
            <form class="flex my-1" action="{{route('delete.status.lotto', $status->pivot->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <p>{{$loop->iteration}} - {{$status->name}}</p> 
                @if(auth()->id() == $status->id || auth()->user()->hasRole('admin'))
                <button onclick="return confirm('Sei sicuro di cancellare questa quantità prenotata?')" class="text-xs px-1 ml-2 bg-gray-300 rounded">cancella</button>
                @endif
            </form>
            @empty
            <p>Nessuna quantità prenotata</p>
            @endforelse
        </div>
        <div class="my-3">
            <p class="font-semibold mb-3">Quantità vendute</p>
            @forelse($vendutoList as $status)
            <form class="flex my-1" action="{{route('delete.status.lotto', $status->pivot->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <p>{{$loop->iteration}} - {{$status->name}}</p> 
                @if(auth()->id() == $status->id || auth()->user()->hasRole('admin'))
                <button onclick="return confirm('Sei sicuro di cancellare questa quantità venduta?')" class="text-xs px-1 ml-2 bg-gray-300 rounded">cancella</button>
                @endif
            </form>
            @empty
            <p>Nessuna quantità venduta</p>
            @endforelse
        </div>
    </div>

@can('modificare-lotti')
<form action="{{route('lotti.destroy', [$lotto->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo lotto?')" class="mt-12 text-gray-500 hover:text-red-500">
        cancella lotto
    </button>
</form>
@endcan

@endif


@endsection
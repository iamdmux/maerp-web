@extends('stocks.layout.app-stock')

@section('content')

@php
    $create = $create ?? false;
    $edit = $edit ?? false;
    $show = $show ?? false;

    $disable = $show ? 'disabled' : '';

    $formAction = '';
    if($create){
        $formAction = route('account.store', app()->getLocale());
    } elseif($edit){
        $formAction = route('account.update', app()->getLocale() , auth()->user()->slug);
    }
@endphp


@php
    $title = '';
    $buttonText = '';
    if($create){
        $title = 'Profilo utente';
        $buttonText = 'Salva profilo';
    } elseif($edit){
        $title = 'Modifica profilo';
        $buttonText = 'Modifica profilo';
    }
@endphp

<x-page-title text="{{$title}}" />


<x-errors-component />

<form action="{{$formAction}}" method="POST">

    @csrf
    @if($edit)
        @method('PATCH')
    @endif

    @php
        $labelClass = "font-semibold text-sm uppercase";
        $inputSpace = "mr-6";
        $rowMargin = "py-6";
    @endphp
    {{-- <h1 class="mt-6 font-semibol text-gray-500 uppercase">Anagrafica</h1> --}}

    <div class="mt-8 flex flex-wrap {{$rowMargin}} border-t">
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                denominazione *
            </p>
            <input class="placeholder-red-300" {{$disable}} required autocomplete="off" type="text" name="denominazione" placeholder="ragione sociale"
            value="{{old('denominazione') ? old('denominazione') : (($edit || $show) ? $userAccount->denominazione : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                codice_sdi
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="codice_sdi" placeholder="codice sdi"
            value="{{old('codice_sdi') ? old('codice_sdi') : (($edit || $show) ? $userAccount->codice_sdi : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                tipologia
            </p>

            <select {{$disable}} name="tipologia" class="w-44">
                @foreach ($tipologia as $tipo)
                    @php
                        $val_tipologia_select = '';
                        if($create){
                            $val_tipologia_select = old('tipologia') == $tipo['val'] ? 'selected' : '';
                        } elseif($edit){
                            $val_tipologia_select = old('tipologia') == $tipo['val'] ? 'selected' : ($userAccount->tipologia == $tipo['val'] ? 'selected' : '');
                        } elseif($show){
                            $val_tipologia_select = $userAccount->tipologia == $tipo['val'] ? 'selected' : '';
                        }
                    @endphp
                
                    <option {{$disable}} value="{{$tipo['val']}}" {{$val_tipologia_select}}>
                        {{$tipo['show']}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                referente
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="referente" placeholder="referente"
            value="{{old('referente') ? old('referente') : (($edit || $show) ? $userAccount->referente : '')}}">
        </div>
    </div>

    <div class="flex flex-wrap {{$rowMargin}} border-t">
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                email *
            </p>
            <input {{$disable}} autocomplete="off" type="email" name="email" placeholder="email"
            value="{{old('email') ? old('email') : (($edit || $show) ? $userAccount->email : '')}}">
        </div>
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                pec
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="pec" placeholder="pec"
            value="{{old('pec') ? old('pec') : (($edit || $show) ? $userAccount->pec : '')}}">
        </div>
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                telefono
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="telefono" placeholder="telefono"
            value="{{old('telefono') ? old('telefono') : (($edit || $show) ? $userAccount->telefono : '')}}">
        </div>
    </div>

    <div class="flex flex-wrap {{$rowMargin}} border-t">
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                partita iva *
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="partita_iva" placeholder="partita_iva"
            value="{{old('partita_iva') ? old('partita_iva') : (($edit || $show) ? $userAccount->partita_iva : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                codice fiscale
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="codice_fiscale" placeholder="codice_fiscale"
            value="{{old('codice_fiscale') ? old('codice_fiscale') : (($edit || $show) ? $userAccount->codice_fiscale : '')}}">
        </div>
    </div>

    <div class="flex flex-wrap {{$rowMargin}} border-t">

        <div class="{{$inputSpace}}">
            <nazioni-select enabledisable="{{$disable}}"
            class-label="flex {{$labelClass}}"
            :nazioni-array="{{json_encode($nazioniArray)}}"
            oldnazione="{{old('nazione') ? old('nazione') : (($edit || $show) ? $userAccount->nazione : '')}}"
            oldnazionesigla="{{old('nazione_sigla') ? old('nazione_sigla') : (($edit || $show) ? $userAccount->nazione_sigla : '')}}">
            </nazioni-select>
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                indirizzo *
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="indirizzo" placeholder="indirizzo"
            value="{{old('indirizzo') ? old('indirizzo') : (($edit || $show) ? $userAccount->indirizzo : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                citta *
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="citta" placeholder="citta"
            value="{{old('citta') ? old('citta') : (($edit || $show) ? $userAccount->citta : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                cap *
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="cap" placeholder="cap"
            value="{{old('cap') ? old('cap') : (($edit || $show) ? $userAccount->cap : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                provincia
            </p>
            <input {{$disable}} autocomplete="off" type="text" name="provincia" placeholder="provincia"
            value="{{old('provincia') ? old('provincia') : (($edit || $show) ? $userAccount->provincia : '')}}">
        </div>

        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                note indirizzo
            </p>
            <textarea {{$disable}} class="rounded-md border-gray-200" name="note_indirizzo" placeholder="note indirizzo">{{old('note_indirizzo') ? old('note_indirizzo') : (($edit || $show) ? $userAccount->note_indirizzo : '')}}</textarea>
        </div>

    </div>

    <div class="flex flex-wrap {{$rowMargin}} border-t">
        <div class="{{$inputSpace}}">
            <p class="{{$labelClass}}">
                note extra
            </p>
            <textarea {{$disable}} class="rounded-md border-gray-200" type="text" name="note_extra" placeholder="note extra">{{old('note_extra') ? old('note_extra') : (($edit || $show) ? $userAccount->note_extra : '')}}</textarea>
        </div>
    </div>

    <div>
        @if(!$show)
            <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
            {{$buttonText}}
            </button>
        @endif
    </div>
</form>


{{-- @if($edit)
<form action="{{route('clienti.destroy', [$userAccount->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo cliente?')" class="mt-12 text-gray-500 hover:text-red-500">
        elimina cliente
    </button>
</form>
@endif --}}

@endsection
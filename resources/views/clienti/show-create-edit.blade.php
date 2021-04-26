@extends('layouts.app')

@section('content')

@php
    $create = $create ?? false;
    $edit = $edit ?? false;
    $show = $show ?? false;

    $disable = $show ? 'disabled' : '';

    $formAction = '';
    if($create){
        $formAction = route('clienti.store');
    } elseif($edit){
        $formAction = route('clienti.update', $cliente->id);
    }

@endphp


<x-back-to-page-button route="{{route('clienti.index')}}" />

@php
    $title = '';
    $buttonText = '';
    if($create){
        $title = 'Aggiungi nuovo cliente';
        $buttonText = 'Salva nuovo cliente';
    } elseif($edit){
        $title = 'Modifica cliente';
        $buttonText = 'Modifica cliente';
    } elseif($show){
        $title = 'cliente: ' . $cliente->denominazione;
    }
@endphp


<h3 class="text-gray-700 text-3xl font-bold">{{$title}}</h3>
@if($edit)
    <p>Stai modificando {{$cliente->denominazione}}</p>
@endif

<x-errors-component />

<form action="{{$formAction}}" method="POST">

    @csrf
    @if($edit)
        @method('PATCH')
    @endif

    <h1 class="mt-6 font-semibol text-gray-500 uppercase">Anagrafica</h1>

    <div class="flex flex-wrap">
        <div class="mr-8">
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    denominazione
                </p>
                <input class="placeholder-red-300" {{$disable}} required autocomplete="off" type="text" name="denominazione" placeholder="ragione sociale"
                value="{{old('denominazione') ? old('denominazione') : (($edit || $show) ? $cliente->denominazione : '')}}">
            </div>
            
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_sdi
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="codice_sdi" placeholder="codice sdi"
                value="{{old('codice_sdi') ? old('codice_sdi') : (($edit || $show) ? $cliente->codice_sdi : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    tipologia
                </p>

                <select {{$disable}} name="tipologia" class="w-44">
                    @foreach ($tipologia as $tipo)
                        @php
                            $val_tipologia_select = '';
                            if($create){
                                $val_tipologia_select = old('tipologia') == $tipo['val'] ? 'selected' : '';
                            } elseif($edit){
                                $val_tipologia_select = old('tipologia') == $tipo['val'] ? 'selected' : ($cliente->tipologia == $tipo['val'] ? 'selected' : '');
                            } elseif($show){
                                $val_tipologia_select = $cliente->tipologia == $tipo['val'] ? 'selected' : '';
                            }
                        @endphp
                    
                        <option {{$disable}} value="{{$tipo['val']}}" {{$val_tipologia_select}}>
                            {{$tipo['show']}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    referente
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="referente" placeholder="referente"
                value="{{old('referente') ? old('referente') : (($edit || $show) ? $cliente->referente : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    partita_iva
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="partita_iva" placeholder="partita_iva"
                value="{{old('partita_iva') ? old('partita_iva') : (($edit || $show) ? $cliente->partita_iva : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_fiscale
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="codice_fiscale" placeholder="codice_fiscale"
                value="{{old('codice_fiscale') ? old('codice_fiscale') : (($edit || $show) ? $cliente->codice_fiscale : '')}}">
            </div>

            <nazioni-select enabledisable="{{$disable}}"
            :nazioni-array="{{json_encode($nazioniArray)}}"
            oldnazione="{{old('nazione') ? old('nazione') : (($edit || $show) ? $cliente->nazione : '')}}"
            oldnazionesigla="{{old('nazione_sigla') ? old('nazione_sigla') : (($edit || $show) ? $cliente->nazione_sigla : '')}}">
            </nazioni-select>

            {{-- <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    nazione
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="nazione" placeholder="nazione"
                value="{{old('nazione') ? old('nazione') : (($edit || $show) ? $cliente->nazione : '')}}">
            </div> --}}

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    indirizzo
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="indirizzo" placeholder="indirizzo"
                value="{{old('indirizzo') ? old('indirizzo') : (($edit || $show) ? $cliente->indirizzo : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    citta
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="citta" placeholder="citta"
                value="{{old('citta') ? old('citta') : (($edit || $show) ? $cliente->citta : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    cap
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="cap" placeholder="cap"
                value="{{old('cap') ? old('cap') : (($edit || $show) ? $cliente->cap : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    provincia
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="provincia" placeholder="provincia"
                value="{{old('provincia') ? old('provincia') : (($edit || $show) ? $cliente->provincia : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note indirizzo
                </p>
                <textarea {{$disable}} class="rounded-md border-gray-200" name="note_indirizzo" placeholder="note indirizzo">{{old('note_indirizzo') ? old('note_indirizzo') : (($edit || $show) ? $cliente->note_indirizzo : '')}}</textarea>
            </div>
        </div>
        <div class="mr-8">
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    email
                </p>
                <input {{$disable}} autocomplete="off" type="email" name="email" placeholder="email"
                value="{{old('email') ? old('email') : (($edit || $show) ? $cliente->email : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    pec
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="pec" placeholder="pec"
                value="{{old('pec') ? old('pec') : (($edit || $show) ? $cliente->pec : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    telefono
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="telefono" placeholder="telefono"
                value="{{old('telefono') ? old('telefono') : (($edit || $show) ? $cliente->telefono : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note extra
                </p>
                <textarea {{$disable}} class="rounded-md border-gray-200" type="text" name="note_extra" placeholder="note extra">{{old('note_extra') ? old('note_extra') : (($edit || $show) ? $cliente->note_extra : '')}}</textarea>
            </div>
        </div>
        <div>
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    aliquota iva
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="aliquota_iva" placeholder="aliquota iva"
                value="{{old('aliquota_iva') ? old('aliquota_iva') : (($edit || $show) ? $cliente->aliquota_iva : '')}}">
            </div>

            <div class="flex items-end">
                <div>
                    <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        termini pagamento
                    </p>
  
                    <input {{$disable}} autocomplete="off" type="text" name="termini_pagamento" placeholder="termini pagamento"
                    value="{{old('termini_pagamento') ? old('termini_pagamento') : (($edit || $show) ? $cliente->termini_pagamento : '')}}">
                </div>

                <div>
                    @php
                        $giorni = [
                            ['val' => 'giorni', 'show'=> 'giorni'],
                            ['val' => 'ggfinemese', 'show'=> 'gg. fine mese'],
                        ];
                    @endphp
                    <select {{$disable}} class="ml-2" name="termini_tipo">
                        @foreach ($giorni as $giorno)
                            @php
                                $val_termini_tipo_select = '';
                                if($create){
                                    $val_termini_tipo_select = old('termini_tipo') == $giorno['val'] ? 'selected' : '';
                                } elseif($edit){
                                    $val_termini_tipo_select = old('termini_tipo') == $giorno['val'] ? 'selected' : ($cliente->termini_tipo == $giorno['val'] ? 'selected' : '');
                                } elseif($show){
                                    $val_termini_tipo_select = $cliente->termini_tipo == $giorno['val'] ? 'selected' : '';
                                }
                            @endphp
                            <option {{$disable}} value="{{$giorno['val']}}" {{$val_termini_tipo_select}}>
                                {{$giorno['show']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    metodo pagamento pred.
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="metodo_pagamento_predef" placeholder="metodo pagamento pred."
                value="{{old('metodo_pagamento_predef') ? old('metodo_pagamento_predef') : (($edit || $show) ? $cliente->metodo_pagamento_predef : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    iban
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="iban" placeholder="iban"
                value="{{old('iban') ? old('iban') : (($edit || $show) ? $cliente->iban : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    fax
                </p>
                <input {{$disable}} autocomplete="off" type="text" name="fax" placeholder="fax"
                value="{{old('fax') ? old('fax') : (($edit || $show) ? $cliente->fax : '')}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    indirizzo spedizione
                </p>
                <textarea {{$disable}} class="rounded-md border-gray-200" type="text" name="indirizzo_spedizione" placeholder="indirizzo spedizione">{{old('indirizzo_spedizione') ? old('indirizzo_spedizione') : (($edit || $show) ? $cliente->indirizzo_spedizione : '')}}</textarea>
            </div>

            @can('assegnare-clienti')
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Agente assegnato:
                </p>
                <select {{$disable}} name="user_id">
                    {{-- {{old('agente_id') == $agente->id ? 'selected' : ($cliente->user_id == $agente->id ? 'selected' : '')}}  --}}
                    @foreach ($listaAgenti as $agente)
                        @php
                        $val_agente_select = '';
                        if($create){
                            $val_agente_select = old('user_id') == $agente->id ? 'selected' : '';
                        } elseif($edit){
                            $val_agente_select = old('user_id') == $agente->id ? 'selected' : ($cliente->user_id == $agente->id ? 'selected' : '');
                        } elseif($show){
                            $val_agente_select = $cliente->user_id == $agente->id ? 'selected' : '';
                        }
                    @endphp

                    <option value="{{$agente->id}}" {{$val_agente_select}}>
                        {{$agente->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            @endcan

        </div>
    </div>

    @if(!$show)
    <button class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
       {{$buttonText}}
    </button>
    @endif

</form>


@if($edit)
<form action="{{route('clienti.destroy', [$cliente->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Sei sicuro di cancellare questo cliente?')" class="mt-12 text-gray-500 hover:text-red-500">
        elimina cliente
    </button>
</form>
@endif

@endsection
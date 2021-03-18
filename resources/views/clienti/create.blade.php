@extends('layouts.app')

@section('content')

{{-- <div class="mb-4">
    <a href="{{route('clienti.index')}}"
        class="px-2 py-1 bg-gray-600 rounded-md text-white font-bold hover:bg-gray-500"
    >
        &larr;
    </a>
</div> --}}

<x-back-to-page-button route="{{route('clienti.index')}}" />

<h3 class="text-gray-700 text-3xl font-bold">Aggiungi nuovo cliente</h3>

<form action="{{route('clienti.store')}}" method="POST">

    @csrf

    <div class="flex flex-wrap">
        <div>
            <h1 class="mt-6 font-semibol text-gray-500 uppercase">Anagrafica</h1>
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    denominazione
                </p>
                <input required autocomplete="off" type="text" name="denominazione" placeholder="ragione sociale"
                value="{{old('denominazione') ? old('denominazione') : ''}}">
            </div>
            
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_sdi
                </p>
                <input autocomplete="off" type="text" name="codice_sdi" placeholder="codice sdi"
                value="{{old('codice_sdi') ? old('codice_sdi') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    tipologia
                </p>
                <select name="tipologia">
                    <option value="azienda" {{old('tipologia') == 'azienda' ? 'selected' : ''}}">Azienda</option>
                    <option value="persona_fisica" {{old('tipologia') == 'persona_fisica' ? 'selected' : ''}}>Persona fisica</option>
                    <option value="pubblica_amministrazione" {{old('tipologia') == 'pubblica_amministrazione' ? 'selected' : ''}}>Pubblica amministrazione</option>
                    <option value="condominio" {{old('tipologia') == 'condominio' ? 'selected' : ''}}>Condominio</option>
                </select>
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    referente
                </p>
                <input autocomplete="off" type="text" name="referente" placeholder="referente"
                value="{{old('referente') ? old('referente') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    partita_iva
                </p>
                <input autocomplete="off" type="text" name="partita_iva" placeholder="partita_iva"
                value="{{old('partita_iva') ? old('partita_iva') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_fiscale
                </p>
                <input autocomplete="off" type="text" name="codice_fiscale" placeholder="codice_fiscale"
                value="{{old('codice_fiscale') ? old('codice_fiscale') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    paese
                </p>
                <input autocomplete="off" type="text" name="paese" placeholder="paese"
                value="{{old('paese') ? old('paese') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    indirizzo
                </p>
                <input autocomplete="off" type="text" name="indirizzo" placeholder="indirizzo"
                value="{{old('indirizzo') ? old('indirizzo') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    citta
                </p>
                <input autocomplete="off" type="text" name="citta" placeholder="citta"
                value="{{old('citta') ? old('citta') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    cap
                </p>
                <input autocomplete="off" type="text" name="cap" placeholder="cap"
                value="{{old('cap') ? old('cap') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    provincia
                </p>
                <input autocomplete="off" type="text" name="provincia" placeholder="provincia"
                value="{{old('provincia') ? old('provincia') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note indirizzo
                </p>
                <textarea class="rounded-md border-gray-200" name="note_indirizzo" placeholder="note indirizzo">{{old('note_indirizzo') ? old('note_indirizzo') : ''}}</textarea>
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    codice_interno
                </p>
                <input autocomplete="off" type="text" name="codice_interno" placeholder="codice interno"
                value="{{old('codice_interno') ? old('codice_interno') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    email
                </p>
                <input autocomplete="off" type="email" name="email" placeholder="email"
                value="{{old('email') ? old('email') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    pec
                </p>
                <input autocomplete="off" type="text" name="pec" placeholder="pec"
                value="{{old('pec') ? old('pec') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    telefono
                </p>
                <input autocomplete="off" type="text" name="telefono" placeholder="telefono"
                value="{{old('telefono') ? old('telefono') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    note extra
                </p>
                <textarea class="rounded-md border-gray-200" type="text" name="note_extra" placeholder="note extra">{{old('note_extra') ? old('note_extra') : ''}}</textarea>
            </div>
        </div>
        <div class="ml-24">
            <h1 class="mt-6 font-semibol text-gray-500 uppercase">Rapporti commerciali</h1>
            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    aliquota iva
                </p>
                <input autocomplete="off" type="text" name="aliquota_iva" placeholder="aliquota iva"
                value="{{old('aliquota_iva') ? old('aliquota_iva') : ''}}">
            </div>

            <div class="flex items-end">
                <div>
                    <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        termini pagamento
                    </p>
                    <input autocomplete="off" type="text" name="termini_pagamento" placeholder="termini pagamento"
                    value="{{old('termini_pagamento') ? old('termini_pagamento') : ''}}">
                </div>

                <div>
                    <select name="termini_tipo">
                        <option value="giorni" {{old('termini_tipo') ==  'giorni' ? 'selected' : ''}}>giorni</option>
                        <option value="ggfinemese" {{old('termini_tipo') ==  'ggfinemese' ? 'selected' : ''}}>gg. fine mese</option>
                    </select>
                </div>
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    metodo pagamento predefinito
                </p>
                <input autocomplete="off" type="text" name="metodo_pagamento_predef" placeholder="metodo pagamento predefinito"
                value="{{old('metodo_pagamento_predef') ? old('metodo_pagamento_predef') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    iban
                </p>
                <input autocomplete="off" type="text" name="iban" placeholder="iban"
                value="{{old('iban') ? old('iban') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    fax
                </p>
                <input autocomplete="off" type="text" name="fax" placeholder="fax"
                value="{{old('fax') ? old('fax') : ''}}">
            </div>

            <div>
                <p class="pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    indirizzo spedizione
                </p>
                <textarea class="rounded-md border-gray-200" type="text" name="indirizzo_spedizione" placeholder="indirizzo spedizione">{{old('indirizzo_spedizione') ? old('indirizzo_spedizione') : ''}}</textarea>
            </div>

        </div>
    </div>
    <button class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
        Salva nuovo cliente
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
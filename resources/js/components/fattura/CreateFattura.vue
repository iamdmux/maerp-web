<template>
<form ref="form" method="POST">
<input type="hidden" name="_token" :value="csrf">

<div class="flex flex-wrap mb-2">
  <label class="p-3 mr-2 bg-gray-100 rounded">preventivo
    <input :disabled="method == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="preventivo" checked>
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">ordine
    <input :disabled="method == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="ordine">
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">proforma
    <input :disabled="method == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="proforma">
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">fattura
    <input :disabled="method == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="fattura">
  </label>
</div>

<div class="my-5">
  <label class="p-3 bg-gray-100 rounded">fattura elettronica
    <input :disabled="method == 'show'" v-model="fattura_elettronica" type="checkbox" value="true" name="fattura_elettronica">
  </label>
</div>

<input type="hidden" v-model="tab_show_cliente" name="tab_show_cliente">
<input type="hidden" v-model="tab_show_dati_documento" name="tab_show_dati_documento">
<input type="hidden" v-model="tab_show_contributi_ritenute" name="tab_show_contributi_ritenute">
<input type="hidden" v-model="tab_show_opzioni_avanzate" name="tab_show_opzioni_avanzate">
<input type="hidden" v-model="tab_show_personalizzazione" name="tab_show_personalizzazione">
<input type="hidden" v-model="tab_show_note_doc" name="tab_show_note_doc">
<input type="hidden" v-model="quantiArticoli" name="quantiArticoli">

<!-- wrapper 1 -->
<div class="flex flex-wrap">
  <!-- CLIENTE -->
  <div class="relative bg-gray-100 rounded p-4 mb-4 mr-4">
    <div class="flex justify-between mx-6">
      <h1><b>CLIENTE</b></h1>
      <button @click.prevent="tab_show_cliente = !tab_show_cliente" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>
     
    <div v-show="tab_show_cliente">
      <div class="m-6"> 
        <div class="relative mb-2">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              ragione sociale / nome
          </p>
          <input :disabled="method == 'show'" required v-model="denominazione" @input="searchCliente" class=" w-36" autocomplete="off" type="text" name="denominazione">
          <div v-if="filterCliente.length" class="z-10 text-sm p-4 bg-white rounded border border-gray-400">
            <div v-for="cliente in filterCliente" :key="cliente.id">
              <p @click="confermaCliente(cliente.id)" class="hover:bg-blue-400 cursor-pointer">{{cliente.denominazione}}</p> 
            </div>
          </div>
          <input type="hidden" name="cliente_id" :value="clienteId">
        </div>
        <div class="flex flex-wrap">
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo
            </p>
            <input disabled v-model="indirizzo" class=" w-36" autocomplete="off" type="text" name="indirizzo">
            <input :value="indirizzo" class=" w-36" autocomplete="off" type="hidden" name="indirizzo">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                città
            </p>
            <input disabled v-model="citta" class=" w-36" autocomplete="off" type="text" name="citta">
            <input :value="citta" class=" w-36" autocomplete="off" type="hidden" name="citta">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                cap
            </p>
            <input disabled v-model="cap" class=" w-36" autocomplete="off" type="text" name="cap">
            <input :value="cap" class=" w-36" autocomplete="off" type="hidden" name="cap">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                provincia
            </p>
            <input disabled v-model="provincia" class=" w-36" autocomplete="off" type="text" name="provincia">
            <input :value="provincia" class=" w-36" autocomplete="off" type="hidden" name="provincia">
          </div>
        </div>
        <div class="flex flex-wrap mt-2">
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                paese
            </p>
            <input disabled v-model="paese" class=" w-36" autocomplete="off" type="text" name="paese">
            <input :value="paese" class=" w-36" autocomplete="off" type="hidden" name="paese">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                partita iva
            </p>
            <input disabled v-model="partita_iva" class=" w-36" autocomplete="off" type="text" name="partita_iva">
            <input :value="partita_iva" class=" w-36" autocomplete="off" type="hidden" name="partita_iva">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice fiscale
            </p>
            <input disabled v-model="codice_fiscale" class=" w-36" autocomplete="off" type="text" name="codice_fiscale">
            <input :value="codice_fiscale" class=" w-36" autocomplete="off" type="hidden" name="codice_fiscale">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                note indirizzo
            </p>
            <textarea disabled v-model="note_indirizzo" rows="2" cols="15" class="text-sm" name="note_indirizzo"></textarea>
            <input :value="note_indirizzo" class=" w-36" autocomplete="off" type="hidden" name="note_indirizzo">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- DATI DOCUMENTO -->
  <div class="relative bg-gray-100 rounded p-4 mb-4 mr-4">
    <div class="flex justify-between mx-6">
      <h1><b>DATI DOCUMENTO</b></h1>
      <button @click.prevent="tab_show_dati_documento = !tab_show_dati_documento" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>

    <div v-show="tab_show_dati_documento">
      <div class="flex flex-wrap">

        <div class="m-6">
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  numero
              </p>
              <input required :disabled="method == 'show'" v-model="numero" class=" w-24" autocomplete="off" type="text" name="numero">
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  data
              </p>
              <input :disabled="method == 'show'" v-model="data" class="" type="date" name="data">
          </div>
        </div>

        <div class="m-6">
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  lingua
              </p>
              <select :disabled="method == 'show'" v-model="lingua" class=" rounded-md border-gray-200" name="lingua">
                <option class="px-3" value="ita">italiano</option>
              </select>
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  valuta
              </p>
              <select :disabled="method == 'show'" v-model="valuta" class=" rounded-md border-gray-200" name="valuta">
                <option class="px-3" value="euro">euro</option>
              </select>
          </div>
        </div>
      </div>
      <div class="m-6">
        <div>
          <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              note documento
          </p>
          <textarea :disabled="method == 'show'" v-model="note_documento" rows="3" cols="35" class="text-sm" name="note_documento"></textarea>
        </div>
      </div>
    </div>
  </div>

    <!-- FATTURA ELETTRONICA -->
  <div v-show="fattura_elettronica" class="relative w-full bg-gray-100 rounded p-4 mb-4" style="max-width: 1113px;">
    <div class="flex justify-between mx-6">
      <h1><b>FATTURA ELETTRONICA</b></h1>
      <button @click.prevent="tab_show_fattura_elettronica = !tab_show_fattura_elettronica" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>
    
    <div class="m-6" v-show="tab_show_fattura_elettronica">
      <div class="flex">
        <div class="mr-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice destinatario
            </p>
            <input v-model="el_codice_destinatario" class=" w-36" autocomplete="off" type="text" name="el_codice_destinatario">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo PEC
            </p>
            <input v-model="el_indirizzo_pec" class=" w-36" autocomplete="off" type="email" name="el_indirizzo_pec">
          </div>
        </div>

        <div class="mr-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                esigibilità iva
            </p>
            <select v-model="el_esigibilita_iva" class=" rounded-md border-gray-200" name="el_esigibilita_iva">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                emesso in seguito a
            </p>
            <select v-model="el_emesso_in_seguito_a" class=" rounded-md border-gray-200" name="el_emesso_in_seguito_a">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
        </div>

        <div class="mr-6">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              metodo di pagamento
          </p>
          <select v-model="el_metodo_pagamento" class=" rounded-md border-gray-200" name="el_metodo_pagamento">
            <option class="px-3" value="contanti">contanti</option>
          </select>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome istituto di credito
            </p>
            <input v-model="el_nome_istituto_di_credito" class=" w-36" autocomplete="off" type="text"  name="el_nome_istituto_di_credito">
          </div>
        </div>

        <div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IBAN
            </p>
            <input v-model="el_iban" class=" w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_iban">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome beneficiario
            </p>
            <input v-model="el_nome_beneficiario" class=" w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_nome_beneficiario">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


  <!-- OPZIONI AVANZATE -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4" style="max-width: 1113px;">
    <div class="flex justify-between mx-6">
      <h1><b>OPZIONI AVANZATE</b></h1>
      <button @click.prevent="tab_show_opzioni_avanzate = !tab_show_opzioni_avanzate" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>

    <div v-show="tab_show_opzioni_avanzate">
      <div class="flex flex-wrap">
        <div class="m-6">
          <div class="mb-2"> 
            <div class="flex mb-2">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input :disabled="method == 'show'" v-model="documento_di_trasporto" type="checkbox" value="true" name="documento_di_trasporto">
                  documento di trasporto
              </label>
            </div>
            <div class="flex mb-1">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input :disabled="method == 'show'" v-model="includi_marca_da_bollo" type="checkbox" value="true" name="includi_marca_da_bollo">
                  includi marca da_bollo
              </label>
            </div>
          </div>
          <div>
            <div v-show="includi_marca_da_bollo" class="mx-4 mb-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  costo bollo
              </p>
              <input :disabled="method == 'show'" v-model="costo_bollo" autocomplete="off" class="" type="text" name="costo_bollo">
            </div>
          </div>
            <div class="flex mb-1">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input :disabled="method == 'show'" v-model="includi_metodo_pagamento" type="checkbox" value="true" name="includi_metodo_pagamento">
                  includi metodo di pagamento
              </label>
            </div>
            <div v-show="includi_metodo_pagamento" class="mx-4 mb-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  metodo di pagamento
              </p>
              <select :disabled="method == 'show'" v-model="metodo_pagamento" class=" rounded-md border-gray-200" name="metodo_pagamento">
                <option class="px-3" value="non_specificato">non specificato</option>
                <option class="px-3" value="contanti">contanti</option>
              </select>
            </div>
            <!-- <div class="flex">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input type="checkbox" name="applica_sconto_o_maggiorazione_sul_tot">
                  applica sconto o maggiorazione sul totale da pagare
              </label>
            </div> -->
        </div>
        <div v-show="documento_di_trasporto" class="m-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              DDT /fattura accompagnatoria
            </p>
            <div class="flex flex-wrap">
              <div>
                <div class="my-3">
                  <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                      numero ddt
                  </p>
                  <input :disabled="method == 'show'" v-model="numero_ddt" autocomplete="off" class="" type="text" name="numero_ddt">
                </div>
              </div>
              <div>
                <div class="my-3">
                  <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                      data ddt
                  </p>
                  <input :disabled="method == 'show'" v-model="data_ddt" autocomplete="off" class="" type="date" name="data_ddt">
                </div>
              </div>
            </div>
            <div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    numero di colli
                </p>
                <input :disabled="method == 'show'" v-model="numero_colli_ddt" autocomplete="off" class="" type="text" name="numero_colli_ddt" placeholder="es. 3 BANCALI">
              </div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    peso
                </p>
                <input :disabled="method == 'show'" v-model="peso_ddt" autocomplete="off" class="" type="text" name="peso_ddt">
              </div>
            </div>

          </div>
        </div>
        <div v-show="documento_di_trasporto" class="m-6">
          <div class="flex flex-wrap">
            <div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    casuale trasporto
                </p>
                <textarea :disabled="method == 'show'" v-model="casuale_trasporto" rows="4" cols="15" autocomplete="off" class="text-sm" name="casuale_trasporto"></textarea>
              </div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    trasporto a cura di
                </p>
                <textarea :disabled="method == 'show'" v-model="trasporto_a_cura_di" rows="4" cols="15" autocomplete="off" class="text-sm" name="trasporto_a_cura_di"></textarea>
              </div>
            </div>
            <div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    luogo di destinazione
                </p>
                <textarea :disabled="method == 'show'" v-model="luogo_destinazione" rows="4" cols="15" autocomplete="off" class="text-sm" name="luogo_destinazione"></textarea>
              </div>
              <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    annotazioni
                </p>
                <textarea :disabled="method == 'show'" v-model="annotazioni" rows="4" cols="15" autocomplete="off" class="text-sm" name="annotazioni"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<h1 class="mt-12 mb-6"><b>LISTA ARTICOLI</b></h1>

  <div style="max-width: 1113px;">
    <aggiungi-articolo v-for="numero in quantiArticoli"
    :numero-articolo="quantiArticoli"
    :method="method"
    :lotto_id="lotto_id_arr[numero-1]"
    :codice="codice_arr[numero-1]"
    :quantita="quantita_arr[numero-1]"
    :unita_di_misura="unita_di_misura_arr[numero-1]"
    :prezzo_netto="prezzo_netto_arr[numero-1]"
    :descrizione="descrizione_arr[numero-1]"
    :iva="iva_arr[numero-1]"
    :key="numero" />
  </div>

  <div v-if="method != 'show'" class="my-8 flex">
    <button @click.prevent="quantiArticoli++" class="px-3 py-2 bg-green-500 rounded-md text-white font-medium hover:bg-blue-400">
      aggiungi articolo
    </button>

    <button v-if="quantiArticoli > 1" @click.prevent="quantiArticoli--" class="ml-3 px-3 py-2 bg-blue-800 rounded-md text-white font-medium hover:bg-blue-400">
      rimuovi articolo
    </button>
  </div>


<div v-if="method != 'show'" class="flex justify-between">
  <button @click="submitForm('action')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      salva fattura
  </button>
    <button @click="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      vedi fattura pdf
  </button>
</div>
<!-- <div v-else> la action non funziona bene
    <button @click.prevent="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      vedi fattura pdf
    </button>
</div> -->



</form>
</template>

<script>
import { ref } from '@vue/reactivity'
// import { computed } from '@vue/runtime-core'
import AggiungiArticolo from './AggiungiArticolo.vue'
import { onMounted } from '@vue/runtime-core'
// import storeArticoli from '../../composable/storeArticoli'

export default {
  props: {
    method:{
      type: String,
      required: true
    },
    pdfUrl: {
      type: String,
      required: true
    },
    formUrl: {
      type: String,
      required: false
    },
    old:{
      type: Object,
      required: false
    }
  },
  components: {
    AggiungiArticolo
  },
  setup(props){

    // props
    const method = ref(props.method)
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const route = ref(props.route)
    const old = ref((props.old))

    const tipo_documento = ref(old.value.tab_show_cliente ? old.value.tab_show_cliente : 'preventivo')

    const tab_show_cliente =              ref(old.value.tab_show_cliente ? old.value.tab_show_cliente : true)
    const tab_show_dati_documento =       ref(old.value.tab_show_dati_documento ? old.value.tab_show_dati_documento : true)
    const tab_show_contributi_ritenute =  ref(old.value.tab_show_contributi_ritenute ? old.value.tab_show_contributi_ritenute : false)
    const tab_show_opzioni_avanzate =     ref(old.value.tab_show_opzioni_avanzate ? old.value.tab_show_opzioni_avanzate : false)
    const tab_show_personalizzazione =    ref(old.value.tab_show_personalizzazione ? old.value.tab_show_personalizzazione : false)
    const tab_show_note_doc =             ref(old.value.tab_show_note_doc ? old.value.tab_show_note_doc : false)
    const fattura_elettronica =           ref(old.value.fattura_elettronica ? old.value.fattura_elettronica : false)
    const tab_show_fattura_elettronica =  ref(old.value.tab_show_fattura_elettronica ? old.value.tab_show_fattura_elettronica : true)

    const listaClienti = ref({})
    const quantiArticoli = ref(old.value.quantiArticoli ? old.value.quantiArticoli : 1)
    const dateToday =       new Date().toISOString().split("T")[0]

    // GET OLD OR SHOW
    const get_clienteId =       method.value == 'show' ? old.value.cliente.cliente_id : old.value.cliente_id
    const get_denominazione =   method.value == 'show' ? old.value.cliente.denominazione : old.value.denominazione
    const get_indirizzo =       method.value == 'show' ? old.value.cliente.indirizzo : old.value.indirizzo
    const get_citta =           method.value == 'show' ? old.value.cliente.citta : old.value.citta
    const get_cap =             method.value == 'show' ? old.value.cliente.cap : old.value.cap
    const get_provincia =       method.value == 'show' ? old.value.cliente.provincia : old.value.provincia
    const get_note_indirizzo =  method.value == 'show' ? old.value.cliente.note_indirizzo : old.value.note_indirizzo
    const get_paese =           method.value == 'show' ? old.value.cliente.paese : old.value.paese
    const get_partita_iva =     method.value == 'show' ? old.value.cliente.partita_iva : old.value.partita_iva
    const get_codice_fiscale =  method.value == 'show' ? old.value.cliente.codice_fiscale : old.value.codice_fiscale

    
    const clienteId =       ref(get_clienteId ? get_clienteId : '')
    const denominazione =   ref(get_denominazione ? get_denominazione : '')
    const indirizzo =       ref(get_indirizzo ? get_indirizzo : '')
    const citta =           ref(get_citta ? get_citta : '')
    const cap =             ref(get_cap ? get_cap : '')
    const provincia =       ref(get_provincia ? get_provincia : '')
    const note_indirizzo =  ref(get_note_indirizzo ? get_note_indirizzo : '')
    const paese =           ref(get_paese ? get_paese : '')
    const partita_iva =     ref(get_partita_iva ? get_partita_iva : '')
    const codice_fiscale =  ref(get_codice_fiscale ? get_codice_fiscale : '')
    
    const numero =          ref(old.value.numero ? old.value.numero : '')
    const data =            ref(old.value.data ? old.value.data : dateToday)
    const data_ddt =        ref(old.value.data_ddt ? old.value.data_ddt : dateToday)
    const numero_ddt =      ref(old.value.numero_ddt ? old.value.numero_ddt : '')
    const includi_marca_da_bollo = ref(old.value.includi_marca_da_bollo ? old.value.includi_marca_da_bollo : false)
    const costo_bollo =     ref(old.value.costo_bollo ? old.value.costo_bollo : '2.00')
    const includi_metodo_pagamento = ref(old.value.includi_metodo_pagamento ? old.value.includi_metodo_pagamento : false)
    const metodo_pagamento = ref(old.value.metodo_pagamento ? old.value.metodo_pagamento : 'non_specificato')
    const lingua =          ref(old.value.lingua ? old.value.lingua : 'ita')
    const valuta =          ref(old.value.valuta ? old.value.valuta : 'euro')

    // ddt
    const documento_di_trasporto = ref(old.value.documento_di_trasporto ? old.value.documento_di_trasporto : false)
    const numero_colli_ddt =       ref(old.value.numero_colli_ddt ? old.value.numero_colli_ddt : '')
    const peso_ddt =               ref(old.value.peso_ddt ? old.value.peso_ddt : '')
    const casuale_trasporto =      ref(old.value.casuale_trasporto ? old.value.casuale_trasporto : '')
    const trasporto_a_cura_di =    ref(old.value.trasporto_a_cura_di ? old.value.trasporto_a_cura_di : '')
    const luogo_destinazione =     ref(old.value.luogo_destinazione ? old.value.luogo_destinazione : '')
    const annotazioni =            ref(old.value.annotazioni ? old.value.annotazioni : '')

    // elettr
    const el_codice_destinatario =      ref(old.value.el_codice_destinatario ? old.value.el_codice_destinatario : '')
    const el_indirizzo_pec =            ref(old.value.el_indirizzo_pec ? old.value.el_indirizzo_pec : '')
    const el_esigibilita_iva =          ref(old.value.el_esigibilita_iva ? old.value.el_esigibilita_iva : '')
    const el_emesso_in_seguito_a =      ref(old.value.el_emesso_in_seguito_a ? old.value.el_emesso_in_seguito_a : '')
    const el_metodo_pagamento =         ref(old.value.el_metodo_pagamento ? old.value.el_metodo_pagamento : '')
    const el_nome_istituto_di_credito = ref(old.value.el_nome_istituto_di_credito ? old.value.el_nome_istituto_di_credito : '')
    const el_iban =                     ref(old.value.el_iban ? old.value.el_iban : '')
    const el_nome_beneficiario =        ref(old.value.el_nome_beneficiario ? old.value.el_nome_beneficiario : '')

    const note_documento = ref(old.value.note_documento ? old.value.note_documento : '')
    

    // Articoli da show - 
    let lotto_id_show = []
    let codice_show = []
    let quantita_show = []
    let unita_di_misura_show = []
    let prezzo_netto_show = []
    let importo_netto_show = []
    let descrizione_show = []
    let iva_show = []

    if(method.value == 'show'){
      old.value.articoli.forEach((el, i) => {
        
        if(el.codice)         {codice_show.push(el.codice)}
        if(el.lotto_id)       {lotto_id_show.push(el.lotto_id)}
        if(el.quantita)       {quantita_show.push(el.quantita)}
        if(el.unita_di_misura){unita_di_misura_show.push(el.unita_di_misura)}
        if(el.prezzo_netto)   {prezzo_netto_show.push(el.prezzo_netto)}
        if(el.importo_netto)  {importo_netto_show.push(el.importo_netto)}
        if(el.descrizione)    {descrizione_show.push(el.descrizione)}
        if(el.iva)            {iva_show.push(el.iva)}
        // costo_iva costo_iva importo_totale
      });
      quantiArticoli.value = (codice_show.length)
    }

    const lotto_id_arr  =       method.value == 'show' ? ref(lotto_id_show) : (ref(old.value.lotto_id ? old.value.lotto_id : ['']))
    const codice_arr =          method.value == 'show' ? ref(codice_show) : (ref(old.value.codice ? old.value.codice : ['']))
    const quantita_arr =        method.value == 'show' ? ref(quantita_show) : (ref(old.value.quantita ? old.value.quantita : [1]))
    const unita_di_misura_arr = method.value == 'show' ? ref(unita_di_misura_show) : (ref(old.value.unita_di_misura ? old.value.unita_di_misura : ['']))
    const prezzo_netto_arr =    method.value == 'show' ? ref(prezzo_netto_show) : (ref(old.value.prezzo_netto ? old.value.prezzo_netto : [0.00]))
    const descrizione_arr =     method.value == 'show' ? ref(descrizione_show) : (ref(old.value.descrizione ? old.value.descrizione : ['']))
    const iva_arr =             method.value == 'show' ? ref(iva_show) : (ref(old.value.iva ? old.value.iva : [22]))


    //
    // mounted
     const settingOnmounting = async () => {
       if(method.value == 'show'){
          form.value.action = props.pdfUrl
          form.value.target = "viewpdf"
       }
      }
    onMounted(settingOnmounting)



    // form
    const form = ref(null)
    const formAction = ref('')
    const submitForm = (type) => {

      if(type == 'pdf'){
        form.value.action = props.pdfUrl
        form.value.target = "viewpdf"
        form.value.method = "POST"
        console.log(form.value.action, form.value.target)
        if(method.value == 'show'){
          form.value.submit()
        }
        // 
      }
      else if(type == 'action'){
        form.value.action = props.formUrl
        form.value.target = "_self"
        // form.value.submit()
      }
    }

    // cerca cliente
    const filterCliente = ref('')
    const searchCliente = () => {
      if(denominazione.value){
        axios.get('/api/fattura/clienti').then(res => {
          listaClienti.value = res.data
        })
        .then( ()=>{
          filterCliente.value = listaClienti.value.filter(cliente => cliente.denominazione.toLowerCase().indexOf(denominazione.value.toLowerCase()) > -1)
        })
      }
    }

    const confermaCliente = (id) =>{
      let cliente = listaClienti.value.find( c => c.id == id)

      if(cliente){
        denominazione.value = cliente.denominazione
        indirizzo.value = cliente.indirizzo
        citta.value = cliente.citta
        cap.value = cliente.cap
        provincia.value = cliente.provincia
        note_indirizzo.value = cliente.note_indirizzo
        paese.value = cliente.paese
        partita_iva.value = cliente.partita_iva
        codice_fiscale.value = cliente.codice_fiscale
        clienteId.value = cliente.id

        filterCliente.value = ''
        }
    }
    axios.defaults.withCredentials = true;
    



    return {
      // old_articoli
      lotto_id_arr, codice_arr, quantita_arr, unita_di_misura_arr, prezzo_netto_arr, descrizione_arr, iva_arr,
      //form
      form, submitForm, formAction, tipo_documento,
      // basics_and_switch
      method, route, csrf, tab_show_cliente, tab_show_fattura_elettronica, tab_show_dati_documento, tab_show_contributi_ritenute, tab_show_opzioni_avanzate, tab_show_personalizzazione, tab_show_note_doc,
      // methods/computed
      searchCliente, confermaCliente,
      // otherObjects
      listaClienti, filterCliente, quantiArticoli,
      // vmodels
      clienteId, fattura_elettronica, denominazione, indirizzo, citta, data, numero, data_ddt, numero_ddt, cap, provincia, note_indirizzo, paese, partita_iva,
      codice_fiscale, includi_marca_da_bollo, documento_di_trasporto, includi_metodo_pagamento, el_indirizzo_pec, lingua, note_documento, valuta,
      el_emesso_in_seguito_a, el_esigibilita_iva, el_metodo_pagamento, el_nome_istituto_di_credito,el_iban,el_nome_beneficiario,
      metodo_pagamento, costo_bollo, numero_colli_ddt, peso_ddt, casuale_trasporto,trasporto_a_cura_di,luogo_destinazione,annotazioni,

      // elettronica v-model
      el_codice_destinatario, el_indirizzo_pec, el_esigibilita_iva, el_emesso_in_seguito_a, el_metodo_pagamento, el_nome_istituto_di_credito, el_iban, el_nome_beneficiario,
      //articoli
      // storeArticoli
    }
  }
}
</script>
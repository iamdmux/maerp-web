<template>
<form ref="form" method="POST">
    <input type="hidden" name="_token" :value="csrf">

<div class="flex flex-wrap mb-2">
  <label class="p-3 mr-2 bg-gray-100 rounded">preventivo
    <input type="radio" name="tipo_documento" value="preventivo" checked>
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">ordine
    <input type="radio" name="tipo_documento" value="ordine">
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">proforma
    <input type="radio" name="tipo_documento" value="proforma">
  </label>
  <label class="p-3 mr-2 bg-gray-100 rounded">fattura
    <input type="radio" name="tipo_documento" value="fattura">
  </label>
</div>

<div class="my-5">
  <label class="p-3 bg-gray-100 rounded">fattura elettronica
    <input v-model="fattura_elettronica" type="checkbox" name="fattura_elettronica">
  </label>
</div>

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
          <input required v-model="denominazione" @input="searchCliente" class="input-small w-36" autocomplete="off" type="text" name="denominazione">
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
            <input :disabled="method == 'create'" v-model="indirizzo" class="input-small w-36" autocomplete="off" type="text" name="indirizzo">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                città
            </p>
            <input :disabled="method == 'create'" v-model="citta" class="input-small w-36" autocomplete="off" type="text" name="citta">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                cap
            </p>
            <input :disabled="method == 'create'" v-model="cap" class="input-small w-36" autocomplete="off" type="text" name="cap">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                provincia
            </p>
            <input :disabled="method == 'create'" v-model="provincia" class="input-small w-36" autocomplete="off" type="text" name="provincia">
          </div>
        </div>
        <div class="flex flex-wrap mt-2">
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                paese
            </p>
            <input :disabled="method == 'create'" v-model="paese" class="input-small w-36" autocomplete="off" type="text" name="provincia">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                partita iva
            </p>
            <input :disabled="method == 'create'" v-model="partita_iva" class="input-small w-36" autocomplete="off" type="text" name="partita_iva">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice fiscale
            </p>
            <input :disabled="method == 'create'" v-model="codice_fiscale" class="input-small w-36" autocomplete="off" type="text" name="codice_fiscale">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                note indirizzo
            </p>
            <textarea :disabled="method == 'create'" v-model="note_indirizzo" rows="2" cols="15" class="text-sm" name="note_indirizzo"></textarea>
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
              <input class="input-small w-24" autocomplete="off" type="text" name="numero">
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  data
              </p>
              <input v-model="data" class="input-small" type="date" name="data">
          </div>
        </div>

        <div class="m-6">
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  lingua
              </p>
              <select class="input-small rounded-md border-gray-200" name="lingua">
                <option class="px-3" value="ita">italiano</option>
              </select>
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  valuta
              </p>
              <select class="input-small rounded-md border-gray-200" name="valuta">
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
          <textarea rows="3" cols="35" class="text-sm" name="note_documento"></textarea>
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
            <input v-model="el_codice_destinatario" class="input-small w-36" autocomplete="off" type="text" name="el_codice_destinatario">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo PEC
            </p>
            <input class="input-small w-36" autocomplete="off" type="email" name="el_indirizzo_pec">
          </div>
        </div>

        <div class="mr-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                esigibilità iva
            </p>
            <select class="input-small rounded-md border-gray-200" name="el_esigibilita_iva">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                emesso in seguito a
            </p>
            <select class="input-small rounded-md border-gray-200" name="el_emesso_in_seguito_a">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
        </div>

        <div class="mr-6">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              metodo di pagamento
          </p>
          <select class="input-small rounded-md border-gray-200" name="el_metodo_pagamento">
            <option class="px-3" value="contanti">contanti</option>
          </select>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome istituto di credito
            </p>
            <input class="input-small w-36" autocomplete="off" type="text"  name="el_nome_istituto_di_credito">
          </div>
        </div>

        <div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IBAN
            </p>
            <input class="input-small w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_iban">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome beneficiario
            </p>
            <input class="input-small w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_nome_beneficiario">
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
                  <input v-model="documento_di_trasporto" type="checkbox" name="documento_di_trasporto">
                  documento di trasporto
              </label>
            </div>
            <div class="flex mb-1">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input v-model="includi_marca_da_bollo" type="checkbox" name="includi_marca_da_bollo">
                  includi marca da_bollo
              </label>
            </div>
          </div>
          <div>
            <div v-show="includi_marca_da_bollo" class="mx-4 mb-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  costo bollo
              </p>
              <input autocomplete="off" class="input-small" type="text" name="costo_bollo" value="2,00">
            </div>
          </div>
            <div class="flex mb-1">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input v-model="includi_metodo_pagamento" type="checkbox" name="includi_metodo_pagamento">
                  includi metodo di pagamento
              </label>
            </div>
            <div v-show="includi_metodo_pagamento" class="mx-4 mb-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  metodo di pagamento
              </p>
              <select class="input-small rounded-md border-gray-200" name="metodo_pagamento">
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
                  <input v-model="numero_ddt" autocomplete="off" class="input-small" type="text" name="numero_ddt">
                </div>
              </div>
              <div>
                <div class="my-3">
                  <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                      data ddt
                  </p>
                  <input v-model="data_ddt" autocomplete="off" class="input-small" type="date" name="data_ddt">
                </div>
              </div>
            </div>
            <div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    numero di colli
                </p>
                <input autocomplete="off" class="input-small" type="text" name="numero_colli_ddt" placeholder="es. 3 BANCALI">
              </div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    peso
                </p>
                <input autocomplete="off" class="input-small" type="text" name="peso_ddt">
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
                <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="casuale_trasporto"></textarea>
              </div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    trasporto a cura di
                </p>
                <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="trasporto_a_cura_di"></textarea>
              </div>
            </div>
            <div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    luogo di destinazione
                </p>
                <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="luogo_destinazione"></textarea>
              </div>
              <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    annotazioni
                </p>
                <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="annotazioni"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<h1 class="mt-12 mb-6"><b>LISTA ARTICOLI</b></h1>

  <div style="max-width: 1113px;">
    <aggiungi-articolo v-for="articolo in quantiArticoli" :numero-articolo="quantiArticoli" :key="articolo" />
  </div>

  <div class="my-8 flex">
    <button @click.prevent="quantiArticoli++" class="px-3 py-2 bg-green-500 rounded-md text-white font-medium hover:bg-blue-300">
      aggiungi articolo
    </button>

    <button v-if="quantiArticoli > 1" @click.prevent="quantiArticoli--" class="ml-3 px-3 py-2 bg-blue-800 rounded-md text-white font-medium hover:bg-blue-300">
      rimuovi articolo
    </button>
  </div>


<div class="flex justify-between">
  <button @click="submitForm('action')" class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
      salva fattura
  </button>
    <button @click="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
      vedi fattura pdf
  </button>
</div>

</form>
</template>

<script>
import { ref } from '@vue/reactivity'
// import { computed } from '@vue/runtime-core'
import AggiungiArticolo from './AggiungiArticolo.vue'
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
      required: true
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


    const tab_show_cliente = ref(true)
    const tab_show_dati_documento = ref(true)
    const tab_show_contributi_ritenute = ref(false)
    const tab_show_opzioni_avanzate = ref(false)
    const tab_show_personalizzazione = ref(false)
    const tab_show_note_doc = ref(false)
    const fattura_elettronica = ref(false)
    const tab_show_fattura_elettronica = ref(true)

    const listaClienti = ref({})
    const quantiArticoli = ref(1)

    // v-model input
    const clienteId = ref('')
    const denominazione = ref('')
    const indirizzo = ref('')
    const citta = ref('')
    const cap = ref('')
    const provincia = ref('')
    const note_indirizzo = ref('')
    const paese = ref('')
    const partita_iva = ref('')
    const codice_fiscale = ref('')
    const data = ref(new Date().toISOString().split("T")[0])
    const data_ddt = ref(new Date().toISOString().split("T")[0])
    const numero_ddt = ref('')
    const includi_marca_da_bollo = ref(false)
    const includi_metodo_pagamento = ref(false)
    const documento_di_trasporto = ref(false)

    // elettr
    const el_codice_destinatario = ref('')
    const el_indirizzo_pec = ref('')
    const el_esigibilita_iva = ref('')
    const el_emesso_in_seguito_a = ref('')
    const el_metodo_pagamento = ref('')
    const el_nome_istituto_di_credito = ref('')
    const el_iban = ref('')
    const el_nome_beneficiario = ref('')

    // form
    const form = ref(null)
    const formAction = ref('')
    const submitForm = (type) => {

      if(type == 'pdf'){
        form.value.action = props.pdfUrl
        form.value.target = "viewpdf" 
        // form.value.submit()
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
        axios.get('/api/clienti').then(res => {
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
      //form
      form, submitForm, formAction,
      // basics_and_switch
      method, route, csrf, tab_show_cliente, tab_show_fattura_elettronica, tab_show_dati_documento, tab_show_contributi_ritenute, tab_show_opzioni_avanzate, tab_show_personalizzazione, tab_show_note_doc,
      // methods/computed
      searchCliente, confermaCliente,
      // otherObjects
      listaClienti, filterCliente, quantiArticoli,
      // vmodels
      clienteId, fattura_elettronica, denominazione, indirizzo, citta, data, data_ddt, numero_ddt, cap, provincia, note_indirizzo, paese, partita_iva,
      codice_fiscale, includi_marca_da_bollo, documento_di_trasporto, includi_metodo_pagamento,

      // elettronica v-model
      el_codice_destinatario, el_indirizzo_pec, el_esigibilita_iva, el_emesso_in_seguito_a, el_metodo_pagamento, el_nome_istituto_di_credito, el_iban, el_nome_beneficiario,
      //articoli
      // storeArticoli
    }
  }
}
</script>
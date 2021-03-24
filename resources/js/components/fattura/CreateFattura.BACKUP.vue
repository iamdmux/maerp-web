<template>
<form target="viewpdf" :action="route" method="POST">
    <input type="hidden" name="_token" :value="csrf">

  <!-- CLIENTE -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
     <h1>CLIENTE</h1>
     <button @click.prevent="tab_show_cliente = !tab_show_cliente" class="absolute top-0 right-0 p-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    <div v-if="tab_show_cliente">
      <div class="m-6"> 
        <div class="relative">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              ragione sociale / nome
          </p>
          <input required v-model="denominazione" @input="searchCliente" class="input-small w-36" autocomplete="off" type="text" name="denominazione">
          <div v-if="filterCliente.length" class="z-10 p-4 bg-white">
            <div v-for="cliente in filterCliente" :key="cliente.id">
              <p @click="confermaCliente(cliente.id)" class="hover:bg-blue-400 cursor-pointer">{{cliente.denominazione}}</p> 
            </div>
          </div>
        </div>
        <div class="flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo
            </p>
            <input v-model="indirizzo" class="input-small w-36" autocomplete="off" type="text" name="indirizzo">
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                città
            </p>
            <input v-model="citta" class="input-small w-36" autocomplete="off" type="text" name="citta">
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                cap
            </p>
            <input v-model="cap" class="input-small w-36" autocomplete="off" type="text" name="cap">
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                provincia
            </p>
            <input v-model="provincia" class="input-small w-36" autocomplete="off" type="text" name="provincia">
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                note indirizzo
            </p>
            <textarea v-model="note_indirizzo" rows="4" cols="15" class="text-sm" name="note_indirizzo"></textarea>
          </div>
        </div>
        <div class="flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                paese
            </p>
            <select v-model="paese" class="input-small rounded-md border-gray-200" name="paese">
              <option class="px-3" value="ita">Italia</option>
            </select>
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                partita iva
            </p>
            <input v-model="partita_iva" class="input-small w-36" autocomplete="off" type="text" name="partita_iva">
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice fiscale
            </p>
            <input v-model="codice_fiscale" class="input-small w-36" autocomplete="off" type="text" name="codice_fiscale">
          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- DATI DOCUMENTO -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
    <h1>DATI DOCUMENTO</h1>
      <button @click.prevent="tab_show_dati_documento = !tab_show_dati_documento" class="absolute top-0 right-0 p-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    <div v-if="tab_show_dati_documento">
      <div class="flex flex-wrap">

        <div class="m-6">
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  numero
              </p>
              <input class="input-small w-36" autocomplete="off" type="text" name="numero">
          </div>
          <div class="mt-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  data
              </p>
              <input class="input-small" type="date" name="data">
          </div>
        </div>

        <div class="m-6">
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  lingua
              </p>
              <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="lingua">
                <option class="px-3" value="ita">italiano</option>
              </select>
          </div>
          <div class="mt-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  valuta
              </p>
              <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="lingua">
                <option class="px-3" value="euro">euro</option>
              </select>
          </div>
        </div>

        <!-- <div class="m-6">
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  oggetto (visibile)
              </p>
              <input autocomplete="off" class="input-small" type="text" name="oggetto_visibile" placeholder="Oggetto che apparirà nel documento">
          </div>
          <div class="mt-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  oggetto interno (non visibile)
              </p>
              <input autocomplete="off" class="input-small" type="text" name="oggetto_interno" placeholder="Opzionale, per identificazione interna">
          </div>
        </div> -->
        <!-- <div class="m-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                centro di ricavo
            </p>
            <input autocomplete="off" class="input-small" type="text" name="centro_di_ricavo" placeholder="Opzionale">
          </div>
        </div> -->
      </div>
    </div>
  </div>


  <!-- Contributi e Ritenute -->
  <!-- <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
   <h1>CONTRIBUTI E RITENUTE</h1>
     <button @click.prevent="tab_show_contributi_ritenute = !tab_show_contributi_ritenute" class="absolute top-0 right-0 p-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    <div v-if="tab_show_contributi_ritenute">
      <div class="m-6">
        <div>
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="applica_rivalsa">
                applica cassa/rivalsa
            </label>
          </div>
          <div class="flex flex-wrap mx-6 my-3">
            <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    rivalsa inps
                </p>
                <div class="relative" >
                <input class="input-small w-16" type="text" name="rivalsa_inps" placeholder="0">
                </div>
            </div>
            <div class="ml-8">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    cassa prof.
                </p>
                <div class="relative" >
                <input class="input-small w-16" type="text" name="cassa_prof" placeholder="0">
                </div>
            </div>
          </div>
        </div>
        
        <div>
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="applica_ritenuta">
              applica ritenuta
            </label>
          </div>
          <div class="flex flex-wrap mx-6 my-3">
            <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    ritenuta dacconto
                </p>
                <div class="relative" >
                <input class="input-small w-16" type="text" name="rit_dacconto" placeholder="0">
                </div>
            </div>
            <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    imponibile ritenuta
                </p>
                <div class="relative" >
                <input class="input-small w-16" type="text" name="imponibile_ritenuta" placeholder="0">
                </div>
            </div>
          </div>
        </div>

        <div>
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="applica_altra_ritenuta">
              applica altra ritenuta
            </label>
          </div>
          <div class="mx-6 my-3">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  altra ritenuta
              </p>
              <div class="relative" >
              <input class="input-small w-16" type="text" name="altra_ritenuta" placeholder="0">
              </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- OPZIONI AVANZATE -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
     <h1>OPZIONI AVANZATE</h1>
      <button @click.prevent="tab_show_opzioni_avanzate = !tab_show_opzioni_avanzate" class="absolute top-0 right-0 p-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
      </button>
      <div v-if="tab_show_opzioni_avanzate">
        <div class="m-6">
        <!-- <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                metodo di pagamento
            </p>
            <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="metodo_pagamento">
              <option class="px-3" value="non_specificato">non specificato</option>
            </select>
        </div> -->

        <div class="mt-8"> 
          <!-- <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="mostra_dettagli_pagamento">
                mostra dettagli pagamento
            </label>
          </div> -->
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="documento_di_trasporto">
                documento di trasporto
            </label>
          </div>
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="fatt_accompagnatoria">
                fattura accompagnatoria
            </label>
          </div>
          <div class="flex">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input type="checkbox" name="includi_marca_da_bollo">
                includi marca da_bollo
            </label>
          </div>
        </div>

        <div>
          <div class="mx-6 my-3">
            <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                costo bollo
            </p>
            <input autocomplete="off" class="input-small" type="text" name="costo_bollo" value="2,00">
          </div>
        </div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="applica_sconto_o_maggiorazione_sul_tot">
              applica sconto o maggiorazione sul totale da pagare
          </label>
        </div>
        <!-- <div class="flex mx-6 my-3">
          <label class="inline-flex items-center">
            <input type="radio" class="form-radio" name="tipo_sconto_o_maggiorazione_sul_tot" value="maggiorazione">
            <span class="ml-2">maggiorazione</span>
          </label>
          <label class="inline-flex items-center ml-6">
            <input type="radio" class="form-radio" name="tipo_sconto_o_maggiorazione_sul_tot" value="sconto">
            <span class="ml-2">sconto</span>
          </label>
          <div class="mx-6">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                maggiorazione
            </p>
            <input autocomplete="off" class="input-small w-16" type="text" name="val_sconto_o_maggiorazione_sul_tot" placeholder="0">
          </div>
        </div> -->
        <!-- <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="applica_split_payment">
              applica split payment
          </label>
        </div> -->
      </div>
      <div class="m-6">
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
          DDT /fattura accompagnatoria
        </p>
        <!-- <div class="flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                modello grafico DDT
            </p>
            <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="modello_grafico_ddt">
              <option class="px-3" value="ddt_1">DDT 1</option>
            </select>
          </div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                modello grafico fattura accompagnatoria
            </p>
            <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="modello_grafico_fatt_accomp">
              <option class="px-3" value="fatt_acc_1">FT accompagnatoria 1</option>
            </select>
          </div>
        </div> -->

        <div class="flex flex-wrap">
          <div>
            <div class="my-3">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  numero ddt
              </p>
              <input autocomplete="off" class="input-small" type="text" name="numero_ddt">
            </div>
          </div>
          <div>
            <div class="my-3">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  data ddt
              </p>
              <input autocomplete="off" class="input-small" type="date" name="data_ddt">
            </div>
          </div>
        </div>

        <div class="flex flex-wrap">
          <div>
            <div class="my-3 mr-2">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  casuale trasporto
              </p>
              <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="casuale_trasporto"></textarea>
            </div>
            <div class="my-3">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  trasporto a cura di
              </p>
              <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="trasporto_a_cura_di"></textarea>
            </div>
          </div>
          <div>
            <div class="my-3 mr-2">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  luogo di destinazione
              </p>
              <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="luogo_destinazione"></textarea>
            </div>
            <div class="my-3">
              <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  annotazioni
              </p>
              <textarea rows="4" cols="15" autocomplete="off" class="text-sm" name="annotazioni"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PERSONALIZZAZIONE -->
  <!-- <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
    <h1>PERSONALIZZAZIONE</h1>
      <button @click.prevent="tab_show_personalizzazione = !tab_show_personalizzazione" class="absolute top-0 right-0 p-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
      </button>
    <div v-if="tab_show_personalizzazione">
      <div class="m-6">
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="mostra_scadenze">
              mostra scadenze
          </label>
        </div>
      </div>
    </div>
  </div> -->

  <!-- NOTE DOCUMENTO -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4">
    <h1>NOTE DOCUMENTO</h1>
      <button @click.prevent="tab_show_note_doc = !tab_show_note_doc" class="absolute top-0 right-0 p-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
      </button>
    <div v-if="tab_show_note_doc">
      <div class="m-6">
        <div class="my-3">
          <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              note documento
          </p>
          <textarea rows="4" cols="100" autocomplete="off" class="text-sm" name="note_documento"></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-wrap justify-between">
    <h1>LISTA ARTICOLI</h1>
        <!-- <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="usa_prezzi_lordi">
              utilizza prezzi lordi
          </label>
        </div> -->
  </div>
 <div class="mt-4 relative w-full bg-gray-100 rounded p-4 mb-4">
   <div class="flex flex-wrap">
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            codice articolo
        </p>
        <input class="input-small w-36" autocomplete="off" type="text" name="articolo_id">
      </div>
      <!-- <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            nome prodotto
        </p>
        <input class="input-small w-36" autocomplete="off" type="text" name="nome_prodotto">
      </div> -->
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            quantita
        </p>
        <input class="input-small w-36" autocomplete="off" type="text" name="quantita">
      </div>
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            unita di misura
        </p>
        <input class="input-small w-36" autocomplete="off" type="text" name="unita_di_misura">
      </div>
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            prezzo_netto
        </p>
        <input class="input-small w-36" autocomplete="off" type="text" name="prezzo_netto">
      </div>
    </div>
    <div class="mt-4 flex flex-wrap">
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            descrizione
        </p>
        <textarea rows="4" cols="50" autocomplete="off" class="text-sm" name="descrizione"></textarea>
      </div>
        <!-- <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              sconto
          </p>
          <input class="input-small w-36" autocomplete="off" type="text" name="sconto">
        </div> -->
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              iva
          </p>
          <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="iva">
            <option class="px-3" value="22">22%</option>
          </select>
        </div>
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              importo totale
          </p>
          <input class="input-small w-36" autocomplete="off" type="text" name="importo_totale">
        </div>
        <div class="flex mt-6">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="non_imponibile">
              articolo non_imponibile
          </label>
        </div>
    </div>
 </div>

    <button class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
        vedi fattura pdf
    </button>
</form>
</template>

<script>
import { ref } from '@vue/reactivity'
import { computed } from '@vue/runtime-core'
export default {
  props: {
    route: {
      type: String,
      required: true
    },
      clienti:{
        type: Object,
        required: true
      }
  },
  setup(props){
    const tab_show_cliente = ref(true)
    const tab_show_dati_documento = ref(false)
    const tab_show_contributi_ritenute = ref(false)
    const tab_show_opzioni_avanzate = ref(false)
    const tab_show_personalizzazione = ref(false)
    const tab_show_note_doc = ref(false)

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const route = ref(props.route)
    const listaClienti = ref(props.clienti)

    // v-model input
      const denominazione = ref('')
      const indirizzo = ref('')
      const citta = ref('')
      const cap = ref('')
      const provincia = ref('')
      const note_indirizzo = ref('')
      const paese = ref('')
      const partita_iva = ref('')
      const codice_fiscale = ref('')

    // cerca cliente
    const filterCliente = ref('')
    const searchCliente = computed(() => {
      if(denominazione.value){
        filterCliente.value = (listaClienti.value.filter(cliente => cliente.denominazione.toLowerCase().startsWith(denominazione.value.toLowerCase())))
      }
    })
    const confermaCliente = (clienteId) =>{

      let cliente = listaClienti.value.find( c => c.id == clienteId)
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

        filterCliente.value = ''
        }
      }
    

    return {
      // basics_and_switch
      route, csrf, tab_show_cliente, tab_show_dati_documento, tab_show_contributi_ritenute, tab_show_opzioni_avanzate, tab_show_personalizzazione, tab_show_note_doc,
      // methods/computed
      searchCliente, confermaCliente,
      // otherObjects
      listaClienti, filterCliente,
      // vmodels
      denominazione, indirizzo, citta, cap, provincia, note_indirizzo, paese, partita_iva, codice_fiscale
    }
  }
}
</script>
<template>
   <div class="mb-4 relative w-full bg-gray-100 rounded">
     <div class="flex flex-wrap">
      <div>
        <div class="m-6 flex flex-wrap">
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  codice articolo
              </p>
              <input :disabled="method == 'show'" required v-model="codice" @input="searchArticolo" class="input-small w-36" autocomplete="off" type="text" name="codice[]">
                <div v-if="filterArticolo.length" class="z-10 text-sm p-4 bg-white rounded border border-gray-400">
                  <div v-for="articolo in filterArticolo" :key="articolo.id">
                    <p @click="confermaArticolo(articolo.id)" class="hover:bg-blue-400 cursor-pointer">{{articolo.codice_articolo}}</p> 
                  </div>
                </div>
                <input type="hidden" name="lotto_id[]" :value="articoloId">
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  quantita
              </p>
              <input :disabled="method == 'show'" v-model="quantita" class="input-small w-24" min="0" name="quantita[]" autocomplete="off" type="number"><!--  min="0" :max="quantitaMax" -->
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  unita di misura
              </p>
              <input :disabled="method == 'show'" v-model="unita_di_misura" class="input-small w-28" name="unita_di_misura[]" autocomplete="off" type="text">
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  prezzo_netto
              </p>
              <input :disabled="method == 'show'" v-model="prezzo_netto" name="prezzo_netto[]" class="input-small w-24" autocomplete="off" type="text">
            </div>
        </div>
        <div class="m-6 flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                descrizione
            </p>
            <textarea :disabled="method == 'show'" v-model="descrizione" rows="4" cols="50" name="descrizione[]" class="text-sm"></textarea>
          </div>

              <!-- <div class="flex mt-6">
                <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    <input type="checkbox" name="non_imponibile">
                    articolo non_imponibile
                </label>
              </div> -->
        </div>
      </div>
      <div class="my-6">
        <div class="flex flex-col">
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                iva
            </p>
            <select :disabled="method == 'show'" v-model="iva" name="iva[]" autocomplete="off" class="input-small rounded-md border-gray-200">
              <option :selected="iva == 22" value="22">22</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo netto
            </p>
            <input disabled v-model="importo_netto" name="importo_netto[]" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" name="importo_netto[]" :value="importo_netto">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IVA
            </p>
            <input disabled v-model="costo_iva" name="costo_iva[]" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" name="costo_iva[]" :value="costo_iva">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo totale
            </p>
            <input disabled v-model="importo_totale" name="importo_totale[]" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" name="importo_totale[]" :value="importo_totale">
          </div>
        </div>
      </div>
    </div>
 </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { computed, onMounted, watch, watchEffect } from '@vue/runtime-core'
// import storeArticoli from '../../composable/storeArticoli'

export default {
  props:{
    numeroArticolo:{
      type: Number,
      required: true
    },
    method:{
      required: true
    },
    lotto_id:{
      required: false
    },
    codice:{
      required: false
    },
    quantita:{
      required: false
    },
    unita_di_misura:{
      required: false
    },
    prezzo_netto:{
      required: false
    },
    descrizione:{
      required: false
    },
    iva:{
      required: false
    }
  },
  setup(props){

    // props
    const numeroArticolo = ref(props.numeroArticolo)

    const lotto_id      = ref(props.lotto_id ? props.lotto_id : '')
    const codice        = ref(props.codice ? props.codice : '')
    const quantita      = ref(props.quantita ? props.quantita : 1)
    const unita_di_misura = ref(props.unita_di_misura ? props.unita_di_misura: '')
    const prezzo_netto  = ref(props.prezzo_netto ? props.prezzo_netto : 0.00)
    const descrizione   = ref(props.descrizione ? props.descrizione : '')
    const iva           = ref(props.iva ? props.iva : 22)

    
    const articoloId = ref('') // se è i lotto dal db
    const listaArticoli = ref({})
    const filterArticolo = ref('')
  
    const quantitaMax = ref(0)
    const importo_netto =ref(0)
    const costo_iva = ref(0)

    // onmounted
    // const log = async () => {
    //     console.log(numeroArticolo.value, lotto_id.value, codice.value, quantita.value, unita_di_misura.value, prezzo_netto.value, descrizione.value, iva.value)
    //   }
    // onMounted(log)

    const searchArticolo = () => {
      if(codice){
        axios.get('/api/articoli').then(res => {
          listaArticoli.value = res.data
        }).then( ()=>{
          filterArticolo.value = listaArticoli.value.filter(articolo => articolo.codice_articolo.toLowerCase().indexOf(codice.value.toLowerCase()) > -1)
        })
      }
    }
    
    const confermaArticolo = (id) =>{
      let articolo = listaArticoli.value.find( a => a.id == id)
      if(articolo){
        codice.value = articolo.codice_articolo
        quantitaMax.value = articolo.quantita
        articoloId.value = articolo.id

        filterArticolo.value = ''
        }
    }

    const importo_totale = computed( () => {
      let netto = parseFloat(prezzo_netto.value)
      let piva = parseFloat(iva.value)
      let q = parseFloat(quantita.value)
      importo_netto.value = (netto*q)
      let tot = ((netto+(netto*piva/100))*q).toFixed(2)
      costo_iva.value = parseFloat(tot-importo_netto.value).toFixed(2)
      return tot
      })

    // watch([numeroArticolo, codice, quantita, prezzo_netto, importo_netto, iva, costo_iva], ([]) => {
    //   storeArticoli.value[numeroArticolo.value] = {
    //     articoloId: articoloId.value,
    //     numeroArticolo: numeroArticolo.value,
    //     codice: codice.value,
    //     quantita: quantita.value,
    //     prezzo_netto: prezzo_netto.value,
    //     importo_netto: importo_netto.value,
    //     iva: iva.value,
    //     costo_iva: costo_iva.value
    //   }
    // });

    // watch(() => numeroArticolo, (first, second) => {
    //   console.log(first);
    //   storeArticoli[numeroArticolo.value] = {
    //     numeroArticolo: numeroArticolo.value
    //   }
    // });


    return { articoloId, lotto_id, descrizione, numeroArticolo, codice, filterArticolo, iva, costo_iva, quantita, unita_di_misura, quantitaMax, prezzo_netto, importo_netto, searchArticolo, confermaArticolo, importo_totale}
  }
}
</script>

<style>

</style>
<template>
   <div class="mb-4 relative w-full bg-gray-100 rounded">
     <div class="flex flex-wrap">
      <div>
        <div class="m-6 flex flex-wrap">
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  codice articolo
              </p>
              <input v-model="codiceArticolo" @input="searchArticolo" class="input-small w-36" autocomplete="off" type="text" :name="'codice-'+numeroArticolo">
                <div v-if="filterArticolo.length" class="z-10 text-sm p-4 bg-white rounded border border-gray-400">
                  <div v-for="articolo in filterArticolo" :key="articolo.id">
                    <p @click="confermaArticolo(articolo.id)" class="hover:bg-blue-400 cursor-pointer">{{articolo.codice_articolo}}</p> 
                  </div>
                </div>
                <input type="hidden" :name="'articolo_id-'+numeroArticolo" :value="articoloId">
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  quantita
              </p>
              <input v-model="quantita" class="input-small w-24" min="0" :name="'quantita-'+numeroArticolo" autocomplete="off" type="number"><!--  min="0" :max="quantitaMax" -->
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  unita di misura
              </p>
              <input v-model="unita_di_misura" class="input-small w-28" :name="'unita_di_misura-'+numeroArticolo" autocomplete="off" type="text">
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  prezzo_netto
              </p>
              <input v-model="prezzo_netto" :name="'prezzo_netto-'+numeroArticolo" class="input-small w-24" autocomplete="off" type="text">
            </div>
        </div>
        <div class="m-6 flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                descrizione
            </p>
            <textarea rows="4" cols="50" :name="'descrizione-'+numeroArticolo" class="text-sm"></textarea>
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
            <select v-model="iva" :name="'iva-'+numeroArticolo" autocomplete="off" class="input-small rounded-md border-gray-200">
              <option :selected="iva == 22" value="22">22</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo netto
            </p>
            <input disabled v-model="importo_netto" :name="'importo_netto-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" :name="'importo_netto-'+numeroArticolo" :value="importo_netto">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IVA
            </p>
            <input disabled v-model="costo_iva" :name="'costo_iva-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" :name="'costo_iva-'+numeroArticolo" :value="costo_iva">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo totale
            </p>
            <input disabled v-model="importo_totale" :name="'importo_totale-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
            <input type="hidden" :name="'importo_totale-'+numeroArticolo" :value="importo_totale">
          </div>
        </div>
      </div>
    </div>
 </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { computed, watch, watchEffect } from '@vue/runtime-core'
import storeArticoli from '../../composable/storeArticoli'

export default {
  props:{
    numeroArticolo:{
      type: Number,
      required: true
    }
  },
  setup(props){
    const numeroArticolo = ref(props.numeroArticolo)
    const articoloId = ref('') // se è i lotto dal db
    const codiceArticolo = ref('')
      const listaArticoli = ref({})
      const filterArticolo = ref('')
    const quantita = ref(1)
    const quantitaMax = ref(0)
    const prezzo_netto = ref(0)
    const unita_di_misura = ref('')
    const importo_netto =ref(0)
    const iva = ref(22)
    const costo_iva = ref(0)



    const searchArticolo = () => {
      if(codiceArticolo){
        axios.get('/api/articoli').then(res => {
          listaArticoli.value = res.data
        }).then( ()=>{
          filterArticolo.value = listaArticoli.value.filter(articolo => articolo.codice_articolo.toLowerCase().indexOf(codiceArticolo.value.toLowerCase()) > -1)
        })
      }
    }
    
    const confermaArticolo = (id) =>{
      let articolo = listaArticoli.value.find( a => a.id == id)
      if(articolo){
        codiceArticolo.value = articolo.codice_articolo
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

    watch([numeroArticolo, codiceArticolo, quantita, prezzo_netto, importo_netto, iva, costo_iva], ([]) => {
      storeArticoli.value[numeroArticolo.value] = {
        articoloId: articoloId.value,
        numeroArticolo: numeroArticolo.value,
        codiceArticolo: codiceArticolo.value,
        quantita: quantita.value,
        prezzo_netto: prezzo_netto.value,
        importo_netto: importo_netto.value,
        iva: iva.value,
        costo_iva: costo_iva.value
      }
    });

    // watch(() => numeroArticolo, (first, second) => {
    //   console.log(first);
    //   storeArticoli[numeroArticolo.value] = {
    //     numeroArticolo: numeroArticolo.value
    //   }
    // });


    return { articoloId, numeroArticolo, codiceArticolo, filterArticolo, iva, costo_iva, quantita, unita_di_misura, quantitaMax, prezzo_netto, importo_netto, searchArticolo, confermaArticolo, importo_totale}
  }
}
</script>

<style>

</style>
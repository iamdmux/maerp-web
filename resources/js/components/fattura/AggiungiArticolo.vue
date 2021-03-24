<template>
   <div class="mt-4 relative w-full bg-gray-100 rounded p-4 mb-4">
   <div class="flex flex-wrap">
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            codice articolo
        </p>
        <input v-model="codiceArticolo" @input="searchArticolo" class="input-small w-36" autocomplete="off" type="text" :name="'codice-'+numeroArticolo">
          <div v-if="filterArticolo.length" class="z-10 p-4 bg-white">
            <div v-for="articolo in filterArticolo" :key="articolo.id">
              <p @click="confermaArticolo(articolo.id)" class="hover:bg-blue-400 cursor-pointer">{{articolo.codice_articolo}}</p> 
            </div>
          </div>
          <input type="hidden" :name="'articolo_id-'+numeroArticolo" :value="articoloId">
      </div>
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            quantita
        </p>
        <input v-model="quantita" class="input-small w-36" :name="'quantita-'+numeroArticolo" autocomplete="off" type="number" min="0" :max="quantitaMax">
      </div>
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            unita di misura
        </p>
        <input class="input-small w-36" :name="'unita_di_misura-'+numeroArticolo" autocomplete="off" type="text">
      </div>
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            prezzo_netto
        </p>
        <input v-model="prezzo_netto" :name="'prezzo_netto-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
      </div>
    </div>
    <div class="mt-4 flex flex-wrap">
      <div>
        <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            descrizione
        </p>
        <textarea rows="4" cols="50" :name="'descrizione-'+numeroArticolo" class="text-sm"></textarea>
      </div>
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              iva
          </p>
          <select v-model="iva" :name="'iva-'+numeroArticolo" autocomplete="off" class="input-small rounded-md border-gray-200">
            <option :selected="iva == 22" value="22">22</option>
          </select>
        </div>
        <div class="flex flex-col">
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              importo netto
          </p>
          <input v-model="importo_netto" :name="'importo_netto-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
        </div>
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              IVA
          </p>
          <input v-model="costo_iva" :name="'costo_iva-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
        </div>
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              importo totale
          </p>
          <input v-model="importo_totale" :name="'importo_totale-'+numeroArticolo" class="input-small w-36" autocomplete="off" type="text">
        </div>
        </div>

        <!-- <div class="flex mt-6">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="non_imponibile">
              articolo non_imponibile
          </label>
        </div> -->
    </div>
 </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { computed } from '@vue/runtime-core'
export default {
  props:{
    numeroArticolo:{
      type: Number,
      required: true
    }
  },
  setup(props){
    const numeroArticolo = ref(props.numeroArticolo)
    const articoloId = ref('')
    const codiceArticolo = ref('')
    const listaArticoli = ref({})
    const filterArticolo = ref('')
    const quantita = ref(1)
    const quantitaMax = ref(0)
    const prezzo_netto = ref(0)
    const importo_netto =ref(0)
    const iva = ref(22)
    const costo_iva = ref(0)


    const searchArticolo = () => {
      if(codiceArticolo){
        axios.get('/api/articoli').then(res => {
          console.log(res.data)
          listaArticoli.value = res.data
        }).then( ()=>{
          filterArticolo.value = listaArticoli.value.filter(articolo => articolo.codice_articolo.toLowerCase().startsWith(codiceArticolo.value.toLowerCase()))
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

    return { articoloId, numeroArticolo, codiceArticolo, filterArticolo, iva, costo_iva, quantita, quantitaMax, prezzo_netto, importo_netto, searchArticolo, confermaArticolo, importo_totale}
  }
}
</script>

<style>

</style>
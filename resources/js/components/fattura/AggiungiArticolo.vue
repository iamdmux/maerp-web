<template>
   <div class="mb-4 relative w-full bg-gray-100 rounded">
     <div class="flex flex-wrap">
      <div>
        <div class="m-6 flex flex-wrap">
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  codice articolo
              </p>
              <input :disabled="mView == 'show'" required v-model="codice" @input="searchArticolo" class=" w-36" autocomplete="off" type="text" name="codice[]">
                <div v-if="filterArticolo.length" class="z-10 text-sm p-4 bg-white rounded border border-gray-400">
                  <div v-for="articolo in filterArticolo" :key="articolo.id">
                    <p @click="confermaArticolo(articolo.id)" class="hover:bg-blue-400 cursor-pointer">{{articolo.codice_articolo}}</p>
                  </div>
                </div>
                <input type="hidden" name="lotto_id[]" :value="lottoChecked ? articoloId : ''">
                 <div class="text-xs">
                  <input type="checkbox" :disabled="!articoloId" v-model="lottoChecked">lotto
                </div>
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  quantita
              </p>
              <!-- non usato al momento -->
              <!-- <div v-if="quantita > quantitaMax && lottoChecked" class="absolute top-0 mt-1 text-xs text-red-500">quantità superata</div> -->
              <input :disabled="mView == 'show'" v-model="quantita" class=" w-24" min="0" name="quantita[]" autocomplete="off" type="number"><!--  min="0" :max="quantitaMax" -->
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  unita di misura
              </p>
              <input :disabled="mView == 'show'" v-model="unita_di_misura" class=" w-28" name="unita_di_misura[]" autocomplete="off" type="text">
            </div>
            <div class="mr-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  prezzo_netto
              </p>
              <input :disabled="mView == 'show'" v-model="prezzo_netto" name="prezzo_netto[]" class=" w-24" autocomplete="off" type="text">
            </div>
        </div>
        <div class="m-6 flex flex-wrap">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                descrizione
            </p>
            <textarea required :disabled="mView == 'show'" v-model="descrizione" rows="4" cols="50" name="descrizione[]" class="text-sm"></textarea>
          </div>

              <!-- <div class="flex mt-6">
                <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    <input type="checkbox" name="non_imponibile">
                    articolo non_imponibile
                </label>
              </div> -->
        </div>
      </div>
      <div class="my-6 flex flex-wrap">
        <div class="flex flex-col">
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                iva
            </p>
            <select :disabled="mView == 'show'" v-model="iva" name="iva[]" class="rounded-md border-gray-200">
              <option :selected="iva == 24" :value="24">24%</option>
              <option :selected="iva == 23" :value="23">23%</option>
              <option :selected="iva == 22" :value="22">22%</option>
              <option :selected="iva == 21" :value="21">21%</option>
              <option :selected="iva == 20" :value="20">20%</option>
              <option :selected="iva == 19" :value="19">19%</option>
              <option :selected="iva == 15" :value="15">15%</option>
              <option :selected="iva == 10" :value="10">10%</option>
              <option :selected="iva == 8" :value="8">8%</option>
              <option :selected="iva == 7" :value="7">7%</option>
              <option :selected="iva == 5" :value="5">5%</option>
              <option :selected="iva == 4" :value="4">4%</option>
              <option :selected="iva == 3.8" :value="3.8">3.8%</option>
              <option :selected="iva == 3" :value="3">3%</option>
              <option :selected="iva == 2.5" :value="2.5">2.5%</option>
              <option :selected="iva == 0" :value="0">0%</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo netto
            </p>
            <input disabled :value="Number((importo_netto).toFixed(2))" name="importo_netto[]" class=" w-36" autocomplete="off" type="text">
            <input type="hidden" name="importo_netto[]" :value="importo_netto">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IVA
            </p>
            <input disabled v-model="costo_iva_articolo" name="costo_iva_articolo[]" class=" w-36" autocomplete="off" type="text">
            <input type="hidden" name="costo_iva_articolo[]" :value="costo_iva_articolo">
          </div>
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                importo totale
            </p>
            <input disabled v-model="importo_totale_articolo" name="importo_totale_articolo[]" class=" w-36" autocomplete="off" type="text">
            <input type="hidden" name="importo_totale_articolo[]" :value="importo_totale_articolo">
          </div>
        </div>
        <div v-if="iva == 0">
          <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                0% iva
            </p>
            <select :disabled="mView == 'show'" name="zero_percento_iva[]" v-model="zeroPercentoIva" autocomplete="off" class="w-72 rounded-md border-gray-200">
              <option v-for="perc in listaZeroPercento" :key="perc.cod" :value="perc.cod">{{perc.val}}</option>
            </select>
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
      required: true
    },
    mView:{
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
    },
    zeroPercentoIva:{
      required: false
    }
  },
  setup(props){

    // props
    const numeroArticolo = ref(Number(props.numeroArticolo))

    // const lotto_id      = toRefs(props).lotto_id ?? ''
    // const codice        = toRefs(props).codice ?? ''
    // const quantita      = toRefs(props).quantita ?? 1
    // const unita_di_misura = toRefs(props).unita_di_misura ? toRefs(props).unita_di_misura : ''
    // const prezzo_netto  = toRefs(props).prezzo_netto ? toRefs(props).prezzo_netto : 0.00
    // const descrizione   = toRefs(props).descrizione ? toRefs(props).descrizione : ''
    // const iva           = toRefs(props).iva ?? '22'
    // const zeroPercentoIva = toRefs(props).zeroPercentoIva ?? 'N1'

    const lotto_id      = ref(props.lotto_id ? props.lotto_id : '')
    const codice        = ref(props.codice ? props.codice : '')
    const quantita      = ref(props.quantita ? props.quantita : 1)
    const unita_di_misura = ref(props.unita_di_misura ? props.unita_di_misura : '')
    const prezzo_netto  = ref(props.prezzo_netto ? Number(props.prezzo_netto) : 0.00)
    const descrizione   = ref(props.descrizione ? props.descrizione : '')
    const iva           = ref(props.iva ? Number(props.iva) : 22) // in edit, non riesca a caricare la prop -> vedi patch sotto
    const zeroPercentoIva = ref(props.zeroPercentoIva ? props.zeroPercentoIva : 'N1')

    //patch iva
    if(props.iva != undefined){
      iva.value =  Number(props.iva)
    }
    

    const articoloId = ref('') // se è i lotto dal db
    const listaArticoli = ref({})
    const filterArticolo = ref('')
    const lottoChecked = ref(false)
  
    const quantitaMax = ref(99999999)
    const importo_netto =ref(0)
    const costo_iva_articolo = ref(0)

    const listaZeroPercento = [
            {cod: 'N1', val: 'N1 – escluse ex art. 15'},
            {cod: 'N2.1', val: 'N2.1 non soggette ad IVA ai sensi degli artt. da 7 a 7-septies del DPR 633/72'},
            {cod: 'N2.2', val: 'N2.2 non soggette – altri casi'},
            {cod: 'N3.1', val: 'N3.1 non imponibili – esportazioni'},
            {cod: 'N3.2', val: 'N3.2 non imponibili – cessioni intracomunitarie'},
            {cod: 'N3.3', val: 'N3.3 non imponibili – cessioni verso San Marino'},
            {cod: 'N3.4', val: 'N3.4 non imponibili – operazioni assimilate alle cessioni all’esportazione'},
            {cod: 'N3.5', val: 'N3.5 non imponibili – a seguito di dichiarazioni d’intento'},
            {cod: 'N3.6', val: 'N3.6 non imponibili – altre operazioni che non concorrono alla formazione del plafond'},
            {cod: 'N4', val: 'N4 – esenti'},
            {cod: 'N5', val: 'N5 – regime del margine / IVA non esposta in fattura'},
            {cod: 'N6.1', val: 'N6.1 inversione contabile – cessione di rottami e altri materiali di recupero'},
            {cod: 'N6.2', val: 'N6.2 inversione contabile – cessione di oro e argento puro'},
            {cod: 'N6.3', val: 'N6.3 inversione contabile – subappalto nel settore edile'},
            {cod: 'N6.4', val: 'N6.4 inversione contabile – cessione di fabbricati'},
            {cod: 'N6.5', val: 'N6.5 inversione contabile – cessione di telefoni cellulari'},
            {cod: 'N6.6', val: 'N6.6 inversione contabile – cessione di prodotti elettronici'},
            {cod: 'N6.7', val: 'N6.7 inversione contabile – prestazioni comparto edile e settori connessi'},
            {cod: 'N6.8', val: 'N6.8 inversione contabile – operazioni settore energetico'},
            {cod: 'N6.9', val: 'N6.9 inversione contabile – altri casi'}
    ]

    const searchArticolo = () => {
      if(codice){
        lottoChecked.value = false
        articoloId.value = ''
        axios.post('/api/fattura/articoli', {}, { params: { query_articolo: codice.value }})
        .then(res => {
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
        lottoChecked.value = true
        filterArticolo.value = ''
        }
    }
    
    
    const importo_totale_articolo = computed( () => {
      let netto = parseFloat(prezzo_netto.value)
      let piva = parseFloat(iva.value)
      let q = parseFloat(quantita.value)
      importo_netto.value = (netto*q)
      let tot = ((netto+(netto*piva/100))*q).toFixed(2)
      costo_iva_articolo.value = parseFloat(tot-importo_netto.value).toFixed(2)
      return tot
      })

    watch(prezzo_netto, () => {
      return prezzo_netto.value = prezzo_netto.value.replace(",", ".")
    })

    return { 
      articoloId, lotto_id, descrizione, numeroArticolo, codice, filterArticolo, iva, costo_iva_articolo, quantita, unita_di_misura,
      quantitaMax, prezzo_netto, importo_netto, searchArticolo, confermaArticolo, importo_totale_articolo, lottoChecked, zeroPercentoIva, listaZeroPercento
      }
  }
}
</script>

<style>

</style>
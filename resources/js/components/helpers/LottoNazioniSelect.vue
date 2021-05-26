<template>
  <div class="flex">
    <div class="mr-3">
        <p class="flex pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            tipo visibilità
        </p>
        <select v-model="tipo_visibilità" name="visibilita">
            <option value="tutti">tutti i paesi</option>
            <option value="nessuno">nessun paese</option>
        </select>
    </div>
    <div class="relative">
        <p class="flex pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            {{tipo_visibilità == 'tutti' ? 'escludi nazione' : 'includi nazione' }}
            <svg v-if="okSelect" class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="ml-1" v-if="nazioneSigla">{{nazioneSigla}}</span>
        </p>

        <input :disabled="disable" v-model="nazione" @keyup="findNazione" autocomplete="off" type="text" placeholder="nazione">
        <!-- <input type="hidden" v-model="nazioneSigla"> -->

        <div v-if="nazioniFiltered.length" class="absolute p-2 bg-white border border-gray-400 rounded overflow-hidden" style="max-height: 150px">
            <p class="px-2 hover:bg-gray-300 cursor-pointer" @click="selectTheNazione(naz['sigla'])" v-for="(naz, i) in nazioniFiltered" :key="i">{{naz['nazione']}}</p>
        </div>
    </div>
  </div>
  <div class="pl-4">
      <p class="my-3 font-semibold">{{tipo_visibilità == 'tutti' ? 'tutti i paesi' : 'nessun paese' }} </p>
      <div v-if="lista_nazioni.length">
          <p class="my-2 text-sm">{{tipo_visibilità == 'tutti' ? 'escludi' : 'includi' }}</p>
        <div class="flex">
            <div v-for="(nazione, i) in lista_nazioni" :key="i">
                <p class="cursor-pointer text-sm text-white bg-gray-400 rounded px-1 mr-2" title="rimuovi" @click="removeNazione(nazione.sigla)">{{nazione.nazione}}</p>
                <input type="hidden" name="nazioni_tranne[]" :value="nazione.sigla" >
            </div>
        </div>
     </div>
        <!-- senza nazioni -->
        <div v-if="lista_nazioni.length == 0">
            <input type="hidden" name="nazioni_tranne[]" value="" >
        </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
export default {
    props:{
        nazioniArray:{
            required: true
        },
        enabledisable:{
            required: false
        },
        oldVisibilita:{
            required: false
        },
        oldNazioniTranne:{
            required: false
        }
    },

    setup(props){
        const nazioniArray = ref(props.nazioniArray)

        const nazione = ref('')
        const nazioniFiltered = ref([])
        const nazioneSigla = ref('')
        const okSelect = ref(false)
        const tipo_visibilità = ref(props.oldTipoVisibilita ? props.oldTipoVisibilita : 'tutti')
        const lista_nazioni = ref([])
        
        const isJson = (str) => {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
        const oldNazioniTranne = ref(props.oldNazioniTranne ? (isJson(props.oldNazioniTranne) ? JSON.parse(props.oldNazioniTranne) : props.oldNazioniTranne ) : [])

        // show and edit
        const disable = ref(props.enabledisable)
        disable.value = disable.value == 'disabled' ? true : false

        // ricarico l'array delle nazioni
        if(oldNazioniTranne.value.length){
            oldNazioniTranne.value.forEach( sigla => {
                let val = nazioniArray.value.find(naz => naz.sigla == sigla)
                if(val){
                    lista_nazioni.value.push(val)
                }
            })
        }

        if(props.oldVisibilita){
            tipo_visibilità.value = props.oldVisibilita
        }

        const findNazione = () => {
            okSelect.value = false
            nazioneSigla.value = ''
            nazioniFiltered.value = nazioniArray.value.filter(naz => naz.nazione.toLowerCase().indexOf(nazione.value.toLowerCase()) > -1)
        }

        const selectTheNazione = (sigla) => {
            let result = nazioniArray.value.find(naz => naz.sigla == sigla)

            let exists = lista_nazioni.value.find(naz => naz.sigla == result.sigla)

            if(!exists){
                lista_nazioni.value.push(result)
                // nazione.value = result['nazione']
                // nazioneSigla.value = result['sigla']
                nazione.value = ''
                nazioniFiltered.value = []
                // okSelect.value = true
            } else {
                nazione.value = ''
                nazioniFiltered.value = []
            }
        }

        const removeNazione = (nazioneSigla) => {
            lista_nazioni.value = lista_nazioni.value.filter( el => {
                return el.sigla !== nazioneSigla
            })
        }

        return { 
            nazione, nazioniArray, nazioniFiltered, findNazione, selectTheNazione, nazioneSigla, okSelect, disable,
            tipo_visibilità, lista_nazioni, removeNazione
        }
    }

}
</script>
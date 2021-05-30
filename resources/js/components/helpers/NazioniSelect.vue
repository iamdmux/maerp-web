<template>
    <div class="relative">
        <p :class="cssLab">
            nazione
            <svg v-if="okSelect" class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="ml-1" v-if="nazioneSigla">{{nazioneSigla}}</span>
        </p>
        <input :disabled="disable" v-model="nazione" @keyup="findNazione" autocomplete="off" type="text" name="nazione" placeholder="nazione">

        <input type="hidden" v-model="nazioneSigla" name="nazione_sigla">

        <div v-if="nazioniFiltered.length" class="absolute p-2 bg-white border border-gray-400 rounded overflow-hidden" style="max-height: 150px">
            <p class="px-2 hover:bg-gray-300 cursor-pointer" @click="selectTheNazione(naz['sigla'])" v-for="(naz, i) in nazioniFiltered" :key="i">{{naz['nazione']}}</p>
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
        oldnazionesigla:{
            required: false
        },
        oldnazione:{
            required: false
        },
        classLabel:{
            required: false
        }
    },

    setup(props){
        const nazioniArray = ref(props.nazioniArray)
        const nazione = ref('')
        const nazioniFiltered = ref([])
        const nazioneSigla = ref('')
        const okSelect = ref(false)

        const cssLab = ref("flex pt-5 pb-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider")
        if(props.classLabel){
            cssLab.value = props.classLabel
        }
        // show and edit
        const disable = ref(props.enabledisable)
        disable.value = disable.value == 'disabled' ? true : false

        if(props.oldnazione && props.oldnazionesigla){
            okSelect.value = true
            nazioneSigla.value = props.oldnazionesigla
            nazione.value = props.oldnazione
        }


        const findNazione = () => {
            okSelect.value = false
            nazioneSigla.value = ''
            nazioniFiltered.value = nazioniArray.value.filter(naz => naz.nazione.toLowerCase().indexOf(nazione.value.toLowerCase()) > -1)
        }

        const selectTheNazione = (sigla) => {
            let result = nazioniArray.value.find( naz => naz.sigla == sigla)
            nazione.value = result['nazione']
            nazioneSigla.value = result['sigla']
            nazioniFiltered.value = []
            okSelect.value = true
        }
        return { nazione, nazioniArray, nazioniFiltered, findNazione, selectTheNazione, nazioneSigla, okSelect, disable, cssLab}
    }

}
</script>
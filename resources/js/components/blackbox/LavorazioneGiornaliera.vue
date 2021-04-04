<template>
  <div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lavorazione
                        </th>
                        <th v-for="operatore in operatori" :key="operatore.id" scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                           {{operatore.nome}}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="capo in lavorazione.capi_scelti" :key="capo.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{capo.nome}} {{capo.tipo}}
                        </td>
                        <td v-for="operatore in operatori" :key="operatore.id" class="px-6 py-4 whitespace-nowrap">
                            <div class="relative flex flex-col items-center">
                                <button @click.prevent="aggiungiLavorazioneCapo(operatore.id, capo.pivot.id)">
                                    <svg class="w-8 h-8 m-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="mb-3" @click.prevent="togliLavorazioneCapo(operatore.id, capo.id)">
                                    <svg class="w-5 h-5 m-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <!-- <p>{{operatore.id}} {{capo.pivot.id}}</p> -->
                                <div class="absolute bottom-0 -mb-3" v-if="operatore.lavorazione_operatore">
                                    <div v-for="(lav, i) in operatore.lavorazione_operatore" :key="i">
                                        <p class="px-1 text-sm bg-blue-100 rounded" v-if="lav.pivot.lavorazionecapo_id == capo.pivot.id">{{lav.pivot.counter}}</p>
                                        <!-- <p v-else>0</p> -->
                                    </div>
                                </div>
                                <!-- <div v-else>
                                    <p>0</p>
                                </div> -->
                            </div>
                        </td>
                    </tr>
                <!-- More items... -->
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
export default {
    props:{
        lavorazione:{
            required: false
        },
        operatori: {
            required: true
        },
        // counters:{
        //     required: false
        // }
    },
    setup(props){
        const lavorazione = ref(props.lavorazione)
        const operatori = ref(props.operatori)
        // const counters = ref(props.counters)

        const aggiungiLavorazioneCapo = async(operatore_id, capo_pivot_id)=>{
            axios.post(`/api/blackbox/lavorazione/${lavorazione.value.id}`, {}, { params: {
                operatore_id: operatore_id,
                capo_pivot_id: capo_pivot_id
                }
            })
            .then( res => {
                // console.log(res.data)
                operatori.value = res.data // riprendo gli operatori con counter
                })
            .catch( e => console.log(e))
        }
        const togliLavorazioneCapo = async(operatore_id, capo_id)=>{
            
        }

        return {lavorazione, operatori, aggiungiLavorazioneCapo, togliLavorazioneCapo}
    }
}
</script>
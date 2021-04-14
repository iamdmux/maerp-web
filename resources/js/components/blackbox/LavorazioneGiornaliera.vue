<template>
  <div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th v-for="operatore in operatori" :key="operatore.id" scope="col" :class="{'bg-yellow-500' : operatoreInPausa(operatore.id)}" class="px-3 py-3 text-center text-xs font-medium text-gray-900 uppercase tracking-wider">
                           <p class="cursor-pointer mb-2" @click="showTotPause[operatore.id] = !showTotPause[operatore.id]">{{operatore.nome}}</p>
                           
                            <div class="absolute bg-white p-2 -ml-8 -mt-20 rounded-sm border border-gray-400" v-if="showTotPause[operatore.id]">
                                <p>{{operatore.nome}}</p>
                               <p>numero di pause: {{numeroDiPause(operatore.id).length}}</p>
                            </div>

                            <div>
                                <select :disabled="operatoreInPausa(operatore.id)" v-model="tipo_pausa[operatore.id]" class="text-xs w-22 h-6 p-0 mb-0.5">
                                    <option v-for="(pausa, i) in tipiPausa" :key="i" :value="pausa">{{pausa == 'pausafunzionale' ? 'pausa fun.' : pausa}}</option>
                                </select>
                                <div class="mt-1 flex flex-wrap justify-around">
                                    <button class="px-1 border border-1 rounded-sm" v-if="!operatoreInPausa(operatore.id)" @click="iniziaFinisciPausa(lavorazione.id, operatore.id, tipo_pausa[operatore.id], 'start')">inizia</button>
                                    <button class="px-1 border border-1 rounded-sm" v-if="operatoreInPausa(operatore.id)" :class="{'text-white' : operatoreInPausa(operatore.id)}" @click="iniziaFinisciPausa(lavorazione.id, operatore.id, tipo_pausa[operatore.id], 'end')">finisci</button>
                                </div>
                                 <!-- <div v-for="(pausa, i) in pauseFromApi" :key="i">
                                    <div v-if="pausa.pivot.operatore_id == operatore.id">
                                        <p v-if="pausa.pivot.alle != null">Pause fatte: {{pausa.length}}</p>
                                        <p v-else>Pause fatte: {{pausa.length-1}}</p>
                                        {{pausa.pivot}}
                                    </div>
                                </div> -->
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="capo in lavorazione.capi_scelti" :key="capo.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{capo.nome}} {{capo.tipo}}
                        </td>
                        <td v-for="operatore in operatori" :key="operatore.id" class="px-6 whitespace-nowrap">
                            <div class="relative flex flex-col items-center justify-between">
                                <button class="w-5 h-5 mt-1" @click.prevent="gestisciLavorazioneCapo(operatore.id, capo.pivot.id, 'sottrai')">
                                    <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="w-8 h-8 mt-1 mb-8" @click.prevent="gestisciLavorazioneCapo(operatore.id, capo.pivot.id, 'aggiungi')">
                                    <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <div class="absolute bottom-0 mb-1" v-if="operatore.lavorazione_operatore">
                                    <div v-for="(lav, i) in operatore.lavorazione_operatore" :key="i">
                                        <p class="px-1 text-sm border border-1 rounded" v-if="lav.pivot.lavorazionecapo_id == capo.pivot.id">{{lav.pivot.counter}}</p>
                                    </div>
                                </div>
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
import { computed, onMounted } from '@vue/runtime-core'
export default {
    props:{
        tipiPausa:{
            required: true
        },
        lavorazione:{
            required: false
        },
        operatori: {
            required: true
        },
        method:{
            required: true
        }
    },
    setup(props){
        const lavorazione = ref(props.lavorazione)
        const operatori = ref(props.operatori)
        const pauseFromApi = ref([])
        const tipo_pausa = ref([])
        const showTotPause = ref([])
        const tipiPausa = ref(props.tipiPausa)
        // const showNumeroPause = ref(false)

        // setting default per select pause
        if(operatori.value){
            operatori.value.forEach(op => {
                tipo_pausa.value[op.id] = 'bagno'
            });
        }

        if(operatori.value){
            operatori.value.forEach(op => {
                showTotPause[op.id] = false
            });
        }


        const gestisciLavorazioneCapo = async(operatore_id, capo_pivot_id, aggiungisottrai)=>{
            axios.post(`/api/blackbox/lavorazione/${lavorazione.value.id}`, {}, { params: {
                operatore_id: operatore_id,
                capo_pivot_id: capo_pivot_id,
                aggiungisottrai: aggiungisottrai,
                
                }
            })
            .then( res => {
                // console.log(res.data)
                operatori.value = res.data // riprendo gli operatori con counter
            })
            .catch( e => console.log(e))
        }

        const mountingLavorazioneCapo = async()=>{
            axios.post(`/api/blackbox/lavorazione/${lavorazione.value.id}`, {}, { params: {init: true} })
            .then( res => { operatori.value = res.data })
            .catch( e => console.log(e))
        }
        

        //
        // mounted
        const pauseFromApiFunc = async () => {
            await axios.get(`/api/blackbox/lavorazione/${props.lavorazione.id}/pause`)
            .then (res => {
                pauseFromApi.value = res.data
                console.log()
            })
            .catch( e => console.log(e))
        }

        onMounted(mountingLavorazioneCapo(), pauseFromApiFunc())



        const iniziaFinisciPausa = async(lavorazione_id, operatore_id, tipo_pausa, startend) => {
            axios.post(`/api/blackbox/lavorazione/${lavorazione_id}/pausa`, {}, { params: {
                operatore_id: operatore_id,
                tipo_pausa: tipo_pausa,
                startend: startend
                }
            })
            .then( () => {
                pauseFromApiFunc()
            })
            .catch( e => console.log(e))
        }

        const operatoreInPausa = (operatore_id) => {
            if(pauseFromApi.value){
                let pausaInCorso = false
                pauseFromApi.value.forEach( (pausa) => {
                    if(pausa.pivot.operatore_id == operatore_id){
                        if(pausa.pivot.alle == null){
                            pausaInCorso = true
                        }
                    }
                })
                return pausaInCorso
            }
        }

        const numeroDiPause = (operatore_id) => {
            // let tempoDiPausa = new Date()
            // tempoDiPausa.setHours(0,0,0,0)
            
            // pauseFromApi.value.filter(pausa => {
            //     if(pausa.pivot.operatore_id == operatore_id){
            //         let dalle = new Date(pausa.pivot.dalle)
            //         let alle = new Date(pausa.pivot.alle)
            //         tempoDiPausa.setDate(tempoDiPausa.getDate() + (alle-dalle))
            //         // return pausa
            //     }
            // });
            // return tempoDiPausa

            return pauseFromApi.value.filter(pausa => {
                if(pausa.pivot.operatore_id == operatore_id){
                    return pausa
                }
            });
        }


        return {lavorazione, operatori, tipiPausa, gestisciLavorazioneCapo, tipo_pausa, iniziaFinisciPausa, pauseFromApi, operatoreInPausa, showTotPause, numeroDiPause}
    }
}
</script>
<template>
  <p @click="toggleModal= !toggleModal">modifica pause</p>
  <div v-if="toggleModal">
      <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);">

                <!-- A basic modal dialog with title, body and one button to close -->
                <div class="h-auto p-4 mx-56 text-left bg-white rounded shadow-xl">

                    <div @click="toggleModal = false">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

                <div class="flex flex-wrap mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div v-for="(operatore) in merged" :key="operatore.id">
                        <div v-if="operatore.nome" style="min-width: 165px;" class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{operatore.nome}}
                            </p>
                            <div class="bg-white px-6 py-3">
                               <p>--</p>
                               <p @click="showAddPausa(operatore.id)" class="inline px-1 cursor-pointer rounded-full bg-gray-400">+</p>
                               <div v-if="addPauseToggle[operatore.id]">
                                    <div>
                                        <input v-model="pausaAdded[operatore.id].dalle" type="time"> <input v-model="pausaAdded[operatore.id].alle" type="time">
                                    </div>
                                    <select v-model="pausaAdded[operatore.id].tipo" class="w-20">
                                        <option class="text-xs" v-for="tipo in tipiPausa" :value="tipo" :key="tipo">{{tipo}}</option>
                                    </select>
                                    <p>{{pausaCorrect(operatore.id)}}</p>
                               </div>
                            </div>
                        </div>

                        <div v-else class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ operatore[0].nome}}
                            </p>
                            <div class="bg-white px-6 py-3">
                                <div v-for="pausa in operatore" :key="pausa.id">
                                    <!-- <input type="time" :value="parseDate(pausa.pivot.dalle)"> <input type="time" :value="parseDate(pausa.pivot.alle)"> -->
                                    <!-- <input id="appt-time" type="time" :value="new Date(pausa.pivot.dalle).getHours()+':'+new Date(pausa.pivot.dalle).getMinutes()">
                                    <input id="appt-time" type="time" :value="new Date(pausa.pivot.alle).getHours()+':'+new Date(pausa.pivot.alle).getMinutes()"> -->
                                    <p @click="removePausa(operatore[0].id, pausa.pivot.id)" :class="{'line-through' : isPausaRemoved(operatore[0].id, pausa.pivot.id)}">{{parseDate(pausa.pivot.dalle)}} - {{parseDate(pausa.pivot.alle)}} #{{pausa.pivot.tipo}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{pausaAdded}}
                <!-- One big close button.  --->
                <div class="mt-5 sm:mt-6">
                    <button @click.prevent="inviaModifiche" class="text-white bg-blue-500 rounded hover:bg-blue-700">
                        Modifica
                    </button>
                </div>
                </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { watch } from '@vue/runtime-core'
export default {
    props: {
        data:{
            required: true
        },
        lavorazioneId:{
            required: true
        },
        tipiPausa:{
            required: true
        },
        operatori:{
            required: true
        },
        operatoriPause:{
            required: true
        }
    },
    setup(props){
        const toggleModal = ref(false)
        const tipiPausa = ref(props.tipiPausa)

        const removedPauseObj = ref({})

        const addPauseToggle = ref([])
        const pausaAdded = ref({})

        let merged = props.operatori.map( operatore => {

            // // creo l'array per le rimozioni o le aggiunte
            removedPauseObj.value[operatore.id] = {}
            // pausaAdded.value[operatore.id] = {}
            pausaAdded.value[operatore.id] = {tipo: 'bagno'}

            if(props.operatoriPause[operatore.nome]){
                return props.operatoriPause[operatore.nome]
            } else {
                return operatore
            }
        })

        let parseDate = (data) => {
            let hours = (new Date(data).getHours()).toString().length == 1 ? '0' + new Date(data).getHours(): new Date(data).getHours()
            return hours + ':' + new Date(data).getMinutes()
        }


        // toggle rimozione pause
        const removePausa = (operatoreId, pausaId) => {
            let val = false
            if(removedPauseObj.value[operatoreId][pausaId]){
                val = true
            }
            removedPauseObj.value[operatoreId][pausaId] = !val
        }

        
        const isPausaRemoved = (operatoreId, pausaId) => {
            if(removedPauseObj.value[operatoreId][pausaId]){
                return true
            }
            return false
        }

        // aggiungi pause
        const showAddPausa = (operatoreId) => {
            addPauseToggle.value[operatoreId] = !addPauseToggle.value[operatoreId]
        }


        const pausaCorrect = (operatoreId) =>{
            if(pausaAdded.value[operatoreId].dalle && pausaAdded.value[operatoreId].alle){
                let data = props.data.split('-')
                let y = data[2]
                let m = data[1]
                let d = data[0]
                //1995-12-17
                let dalle = new Date(`${y}-${m}-${d}`+'T'+pausaAdded.value[operatoreId].dalle)
                let alle = new Date(`${y}-${m}-${d}`+'T'+pausaAdded.value[operatoreId].alle)
                if(dalle < alle ){
                    return true
                }
            }
            return false
        }

        watch(pausaAdded.value, () => {

        })

        // INVIA MODIFICA
        const inviaModifiche = () => {
            axios.post('/api/blackbox/lavorazione/'+ props.lavorazioneId +'/modifica-pausa', {}, { params: 
                { datirimozione: removedPauseObj.value, nuovepause: pausaAdded.value}
            } )
            .then( (res) => {
                location.reload();
            })
            .catch( e => console.log(e))
        }

        return { toggleModal, tipiPausa, merged, parseDate, removePausa, removedPauseObj, isPausaRemoved, inviaModifiche, showAddPausa, addPauseToggle, pausaAdded, pausaCorrect}
    }

}
</script>

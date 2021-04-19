<template>
  <p class="border border-gray-700 rounded py-1 px-2 font-sm text-sm cursor-pointer" @click="toggleModal= !toggleModal">modifica pause</p>
  <div v-if="toggleModal">
      <div class="fixed z-10 inset-0 overflow-y-auto" style="background-color: rgba(0,0,0,.5);" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="flex items-center justify-center w-full h-full">

                <div class="mt-12 h-auto p-8 mx-56 text-left bg-gray-200 rounded shadow-xl">

                <div class="flex flex-wrap mt-3 text-center sm:mt-0 sm:text-left">
                    <div v-for="(operatore) in merged" :key="operatore.id">
                        <div v-if="operatore.nome" style="min-width: 165px;" class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{operatore.nome}}
                            </p>
                            <div class="bg-white px-6 py-3">
                               <p class="pl-2">--</p>
                               <!-- <p @click="showAddPausa(operatore.id)" class="cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                               </p> -->
                               <div v-if="true" class="rounded p-2" :class="{'bg-yellow-400' : pausaCorretta(operatore.id)}"> <!--addPauseToggle[operatore.id]-->
                                    <div class="text-center">
                                        <input class="h-7 text-sm pl-3 pt-0 pb-0 pr-0 mr-1" v-model="pausaAdded[operatore.id].dalle" type="time">
                                        <input class="h-7 text-sm pl-3 pt-0 pb-0 pr-0" v-model="pausaAdded[operatore.id].alle" type="time">
                                    </div>
                                    <select style="max-width: 138px" class="mt-1 h-7 text-sm py-0" v-model="pausaAdded[operatore.id].tipo">
                                        <option class="text-xs" v-for="tipo in tipiPausa" :value="tipo" :key="tipo">{{tipo}}</option>
                                    </select>
                               </div>
                            </div>
                        </div>

                        <div v-else class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ operatore[0].nome}}
                            </p>
                            <div class="bg-white px-6 py-3">
                                <div v-for="pausa in operatore" :key="pausa.id" class="cursor-pointer" @click="removePausa(operatore[0].id, pausa.pivot.id)">
                                    <p
                                    :class="{'line-through bg-red-400 text-black' : isPausaRemoved(operatore[0].id, pausa.pivot.id)}"
                                    :title="isPausaRemoved(operatore[0].id, pausa.pivot.id) ? 'cancella questa pausa' : ''"
                                    class="px-2 py-1 text-sm leading-5 rounded mb-1">

                                        <span v-if="pausa.pivot.alle">{{parseDate(pausa.pivot.dalle)}} - {{parseDate(pausa.pivot.alle)}}</span>
                                        <span v-else>{{parseDate(pausa.pivot.dalle)}} <span class="text-yellow-500"> - in corso </span></span>

                                        <span class="inline-block font-semibold text-xs text-right ml-5" :class="{'line-through' : isPausaRemoved(operatore[0].id, pausa.pivot.id)}">
                                            #{{pausa.pivot.tipo}}
                                        </span>
                                    </p>
                                </div>

                                <div v-if="true" class="rounded p-2" :class="{'bg-yellow-400' : pausaCorretta(operatore.id)}">
                                    <div class="text-center">
                                        <input class="h-7 text-sm pl-3 pt-0 pb-0 pr-0 mr-1" v-model="pausaAdded[operatore.id].dalle" type="time">
                                        <input class="h-7 text-sm pl-3 pt-0 pb-0 pr-0" v-model="pausaAdded[operatore.id].alle" type="time">
                                    </div>
                                    <select style="max-width: 138px" class="mt-1 h-7 text-sm py-0" v-model="pausaAdded[operatore.id].tipo">
                                        <option class="text-xs" v-for="tipo in tipiPausa" :value="tipo" :key="tipo">{{tipo}}</option>
                                    </select>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>

                    <div class="mt-5 sm:mt-6">
                        <button @click="toggleModal= !toggleModal" class="mr-2 py-1 px-2 text-white text-sm bg-gray-300 rounded hover:bg-gray-700">
                            Annulla
                        </button>
                        <button @click.prevent="inviaModifiche" class="mr-2 py-1 px-2 text-white text-sm bg-blue-500 rounded hover:bg-blue-700">
                            Modifica
                        </button>
                        <input v-model="password" @input="error = ''" type="password" class="py-1 px-2 text-sm w-36 h-8 mt-1" placeholder="password">
                        <p class="my-2" v-if="error">{{error}}</p>
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
        const error = ref('')
        const password = ref()

        let premerged = props.operatori.map( operatore => {

                // creo l'array per le rimozioni o le aggiunte
                removedPauseObj.value[operatore.id] = {}
                // pausaAdded.value[operatore.id] = {}
                pausaAdded.value[operatore.id] = {tipo: 'bagno'}

            if(props.operatoriPause[operatore.nome]){
                // con pause
                return props.operatoriPause[operatore.nome]
            } else {
                // senza pause
                return operatore
            }
        })

        let merged = premerged.map( operatore  => {

            if(!operatore.id){
                // aggiunngo l'id perche v-model da problemi 
                operatore.id = operatore[0].id
               return operatore
            } else{
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

        const pausaCorretta = (operatoreId) =>{
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


        // INVIA MODIFICA
        const inviaModifiche = () => {
            axios.post('/api/blackbox/lavorazione/'+ props.lavorazioneId +'/modifica-pausa', {}, { params: 
                { datirimozione: removedPauseObj.value, nuovepause: pausaAdded.value, password: password.value}
            } )
            .then( (res) => {
                location.reload();
            })
            .catch( e => {
                    console.log(e.response.data.error)
                    error.value = e.response.data.error
            } )
        }

        return { toggleModal, tipiPausa, merged, parseDate, removePausa, removedPauseObj, isPausaRemoved, inviaModifiche, showAddPausa, addPauseToggle, pausaAdded, pausaCorretta, password, error}
    }

}
</script>

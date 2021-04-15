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
                                    <p>{{parseDate(pausa.pivot.dalle)}} - {{parseDate(pausa.pivot.alle)}} #{{pausa.pivot.tipo}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="mr-6 mb-6 align-top inline-block shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <p class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{operatore.nome}}</p>
                            <div class="bg-white">
                                {{operatore.nome}}
                            </div>
                        </div> -->
                    </div>
                </div>

                <!-- One big close button.  --->
                <div class="mt-5 sm:mt-6">
                    <span class="flex flex-wrap w-full rounded-md shadow-sm">
                    <!-- <button class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                        Close this modal!
                    </button> -->
                    </span>
                </div>

                </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
export default {
    props: {
        operatori:{
            required: true
        },
        operatoriPause:{
            required: true
        }
    },
    setup(props){
        const toggleModal = ref(false)
        // const operatori = ref(props.operatori)
        // const operatoriPause = ref(props.operatoriPause)

        let merged = props.operatori.map( operatore => {
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

        return { toggleModal, merged, parseDate}
    }

}
</script>

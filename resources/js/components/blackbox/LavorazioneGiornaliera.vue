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
                    <tr v-for="capo in lavorazione.capo_lavorati" :key="capo.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{capo.nome}} {{capo.tipo}}
                        </td>
                        <td v-for="operatore in operatori" :key="operatore.id" class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col items-center">
                                <button @click.prevent="aggiungiLavorazioneCapo(operatore.id, capo.id)">
                                    <svg class="w-8 h-8 m-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button @click.prevent="togliLavorazioneCapo(operatore.id, capo.id)">
                                    <svg class="w-5 h-5 m-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <p>{{operatore.id}} {{capo.id}}</p>
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
        }
    },
    setup(props){
        const lavorazione = ref(props.lavorazione)
        const operatori = ref(props.operatori)
console.log(lavorazione.value)
        const aggiungiLavorazioneCapo = async(operatore_id, capo_id)=>{
            axios.post(`/api/blackbox/lavorazione/${lavorazione.value.id}`, {}, { params: {
                operatore_id: operatore_id,
                capo_id: capo_id
                }
            })
            .then( res => console.log(res.data))
            .catch( e => console.log(e))
        }
        const togliLavorazioneCapo = async(operatore_id, capo_id)=>{
            
        }

        return {lavorazione, operatori, aggiungiLavorazioneCapo, togliLavorazioneCapo}
    }
}
</script>
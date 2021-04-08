<template>
  <div>
    <form :action="formUrl" method="POST">
        <div v-if="method == 'edit'">
            <input type="hidden" name="_method" value="patch">
        </div>
        <input type="hidden" name="_token" :value="csrf">
        <div class="mb-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                data
            </p>
            <input v-model="data" class="" type="date" name="data">
        </div>

        <div>
            <select ref="select" name="capo">
                <option v-for="capo in capiAdulto" :value="capo.id" :key="capo.id">{{capo.nome}} {{capo.tipo}}</option>
                <option v-for="capo in capiBambino" :value="capo.id" :key="capo.id">{{capo.nome}} {{capo.tipo}}</option>
            </select>
            <button @click.prevent="addCapo" class="ml-4 px-2 py-1 bg-gray-300 rounded-md font-medium hover:bg-gray-400">aggiungi capo</button>
        </div>

        <div class="my-10">
            <div v-if="capoSelected">
                <div class="flex my-3" v-for="(capo) in capoSelected" :key="capo.id">
                    <p class="bg-blue-400 py-2 px-3 rounded">{{capo.nome}} {{capo.tipo}} </p><button class="ml-6 border py-2 px-3 border-gray-300 rounded" @click.prevent="removeCapo(capo.id, capo.tipo)">annulla</button>
                    <input type="hidden" name="capo_selezionato_id[]" :value="capo.id">
                </div>
            </div>
            <div v-else>
                <p>nessun capo inserito</p>
            </div>
        </div>
        
        <div class="mt-4">
            <button class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium hover:bg-blue-400">
               <p v-if="method == 'create'">crea nuova lavorazione</p>
               <p v-if="method == 'edit'">Modifica lavorazione</p>
            </button>
        </div>
    </form>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'

export default {
    props:{
        method:{
            required: false
        },
        formUrl: {
            required: true
        },
        capiBambino: {
            required: true
        },
        capiAdulto:{
            required: true
        },
        lavorazione:{
            required: false
        }
    },
    setup(props){
        //props
        const formUrl = ref(props.formUrl)
        const capiBambino = ref(props.capiBambino)
        const capiAdulto = ref(props.capiAdulto)
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const dateToday = new Date().toISOString().split("T")[0]
        const method = ref(props.method)

        const data = ref(dateToday)
        const select = ref(null) // ref select
        const capoSelected = ref([])
        // edit
        const lavorazione = ref(props.lavorazione)

        const addCapo = () =>{
            let val = select.value.value

            let result = capiBambino.value.find(item => {
                return item.id == val
            })
            if(!result){
                result = capiAdulto.value.find(item => {
                    return item.id == val
                })
            }

            if((capoSelected.value).find( item => item.id == result.id )){
                return
            }
            capoSelected.value.push(result)
        }

        const removeCapo = (id, tipo) =>{
            if(tipo == 'bambino'){
             capoSelected.value = capoSelected.value.filter(el =>{
                    return el.id !== id
                })
            }
            else if(tipo == 'adulto'){
            capoSelected.value = capoSelected.value.filter( el => {
                    return el.id !== id
                })
            }
        }
        
        if(method.value == 'edit'){
            lavorazione.value.capi_scelti.map( capo => capoSelected.value.push(capo))
        }
        return { csrf, formUrl, data, capiBambino, capiAdulto, addCapo, select, capoSelected, removeCapo }
    }
}
</script>
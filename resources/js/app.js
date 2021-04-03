require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";

//components
import CreateFattura from './components/fattura/CreateFattura.vue'
import CreateLavorazione from './components/blackbox/CreateLavorazione.vue'
import LavorazioneGiornaliera from './components/blackbox/LavorazioneGiornaliera.vue'

const app = createApp({
    components: {
        CreateFattura, CreateLavorazione, LavorazioneGiornaliera
    }
})

app.mount("#app")


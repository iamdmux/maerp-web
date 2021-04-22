require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";

//components
import CreateFattura from './components/fattura/CreateFattura.vue'
import CreateLavorazione from './components/blackbox/CreateLavorazione.vue'
import LavorazioneGiornaliera from './components/blackbox/LavorazioneGiornaliera.vue'
import ModificaPausaGiornaliera from './components/blackbox/ModificaPausaGiornaliera.vue'
import NazioniSelect from './components/helpers/NazioniSelect.vue'

const app = createApp({
    components: {
        CreateFattura, CreateLavorazione, LavorazioneGiornaliera, ModificaPausaGiornaliera, ModificaPausaGiornaliera, NazioniSelect
    }
})

app.mount("#app")


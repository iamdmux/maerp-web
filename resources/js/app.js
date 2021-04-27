require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";

//components
import CreateEditFattura from './components/fattura/CreateEditFattura.vue'
import CreateEditLavorazione from './components/blackbox/CreateEditLavorazione.vue'
import LavorazioneGiornaliera from './components/blackbox/LavorazioneGiornaliera.vue'
import ModificaPausaGiornaliera from './components/blackbox/ModificaPausaGiornaliera.vue'
import NazioniSelect from './components/helpers/NazioniSelect.vue'

const app = createApp({
    components: {
        CreateEditFattura, CreateEditLavorazione, LavorazioneGiornaliera, ModificaPausaGiornaliera, ModificaPausaGiornaliera, NazioniSelect
    }
})

app.mount("#app")


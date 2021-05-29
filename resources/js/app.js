require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";
import Glide from '@glidejs/glide';

//components
import CreateEditFattura from './components/fattura/CreateEditFattura.vue'
import CreateEditLavorazione from './components/blackbox/CreateEditLavorazione.vue'
import LavorazioneGiornaliera from './components/blackbox/LavorazioneGiornaliera.vue'
import ModificaPausaGiornaliera from './components/blackbox/ModificaPausaGiornaliera.vue'
import NazioniSelect from './components/helpers/NazioniSelect.vue'
import LottoNazioniSelect from './components/helpers/LottoNazioniSelect.vue'

const app = createApp({
    components: {
        CreateEditFattura,
        CreateEditLavorazione,
        LavorazioneGiornaliera,
        ModificaPausaGiornaliera,
        ModificaPausaGiornaliera,
        NazioniSelect,
        LottoNazioniSelect
    }
})

app.mount("#app")

window.Glide = Glide;
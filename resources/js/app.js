require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";

//components
import CreateFattura from './components/fattura/CreateFattura.vue'
import CreateLavorazione from './components/blackbox/CreateLavorazione.vue'

const app = createApp({
    components: {
        CreateFattura, CreateLavorazione
    }
})

app.mount("#app")


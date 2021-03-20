require('./bootstrap');

require('alpinejs');


import { createApp } from "vue";

//components
import CreateFattura from './components/fattura/CreateFattura.vue'

const app = createApp({
    components: {
        CreateFattura
    }
})

app.mount("#app")


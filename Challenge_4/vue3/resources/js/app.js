require('./bootstrap');
window.Vue = require('vue').default;

import {createApp} from 'vue'
import AllFlight from "./Components/AllFlight.vue";
import createFlight from "./Components/CreateFlight.vue";
import editFlight from "./Components/EditFlight.vue";
import popUp from "./Components/PopUp.vue";

createApp({
    components: {
        AllFlight,
        createFlight,
        editFlight,
        popUp
    }
}).mount('#app')

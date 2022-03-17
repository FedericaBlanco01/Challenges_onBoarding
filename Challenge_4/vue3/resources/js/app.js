require('./bootstrap');
window.Vue = require('vue').default;

import {createApp} from 'vue'
import AllFlight from "./Components/AllFlight.vue";
import createFlight from "./Components/CreateFlight.vue";
import editFlight from "./Components/EditFlight.vue";
import popUp from "./Components/PopUp.vue";
import popUpEdit from "./Components/PopUpEdit.vue";
import errorMessageDisplay from "./Components/ErrorMessageDisplay.vue";

createApp({
    components: {
        AllFlight,
        createFlight,
        editFlight,
        popUp,
        popUpEdit,
        errorMessageDisplay
    }
}).mount('#app')

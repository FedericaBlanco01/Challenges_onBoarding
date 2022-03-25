<template>

<div>
    <pop-up v-if="seen" @cancelDelete="hidePopUp" @sureDelete="deleteFlight" :id="idToDelete"></pop-up>
    <pop-up-edit v-if="seeEditWindow" :flight="flightToEdit" :airlines="airlines" @successfullyUpdated="hidePopUp"></pop-up-edit>
<error-message-display v-if="show" :message="message" :title="title"></error-message-display>
    <div class="flex justify-center mb-3 w-1/3 inline-block">
    <VueMultiselect
        v-model="selected_city_filter"
        :options="cities"
        :close-on-select="true"
        :clear-on-select="false"
        value="id"
        placeholder="Filter search by City"
        label="name"
        track-by="name"/>

        <VueMultiselect
            v-model="selected_airline_filter"
            :options="airlines"
            :close-on-select="true"
            :clear-on-select="false"
            value="id"
            placeholder="Filter search by Airline"
            label="name"
            track-by="name"/>
        <button type="button"
                class=" hover:text-purple-800 text-xs font-bold text-purple-400"
                @click="filter_table()">
            SEARCH
        </button>
    </div>
    <table class="min-w-full border-collapse block md:table" id="TABLE">
        <caption></caption>
        <thead class="block md:table-header-group">
        <tr
            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">ID
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">Airline's Name
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Departure City
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Arrival City
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Departure Time
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Arrival Time
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="block md:table-row-group">
        <tr v-for="flight in flights" :key="flight.id">
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.id }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.airline.name }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.departure_city.name}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.arrival_city.name}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.departure_time}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ flight.arrival_time}}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                <div>
                    <button type="button" value="{{flight.id}}"  v-on:click="callPopUpEdit(flight.id)" class= "button_edit bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full">Edit</button>
                    <button type="button" value="{{flight.id}}"  v-on:click="callPopUp(flight.id)" class=" button_delete bg-red-500 hover:bg-red-700 text-white py-1 px-2 border rounded-full">Delete</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <create-flight :airlines=airlines @newflight="display"></create-flight>
</div>
</template>

<script>
import PopUp from "./PopUp";
import CreateFlight from "./CreateFlight";
import PopUpEdit from "./PopUpEdit";
import ErrorMessageDisplay from "./ErrorMessageDisplay";
import VueMultiselect from "vue-multiselect";

export default{
    name:'AllFlight',
    components: {PopUp, CreateFlight, PopUpEdit,ErrorMessageDisplay,VueMultiselect},
    props:{
        airlines:{
            type: Array,
            default: []
        },
        cities:{
            type: Array,
            default: []
        }
    },
    data() {
        return {
            flights: [],
            seen:false,
            seeEditWindow:false,
            seemessage:false,
            idToDelete:"",
            flightToEdit:null,
            message:"",
            title:"",
            show:false,
            selected_airline_filter:null,
            selected_city_filter:null
        };
    },
    mounted() {
       this.display();
    },
    methods: {
        filter_table(){
            axios
                .get('/getflights', {params:{
                    city: this.selected_city_filter ,
                    airline: this.selected_airline_filter
                }})
                .then(response => {
                    this.flights = response.data.flights;
                });
        },
        display(){
            axios
                .get('/getflights')
                .then(response => {
                    this.flights = response.data.flights;
                });

        },
        callPopUp(id){
            this.seen=true;
            this.idToDelete= id;
        },
        hidePopUp(){
            this.seen=false;
            this.seeEditWindow=false;
            this.display();
        },
        deleteFlight(id) {
            axios
                .delete('http://vue3.test/deleteFlight/'+ id)
                .then(response => {
                    // let i = this.flights.map(data => data.id).indexOf(id);
                    // this.flights.splice(i, 1);
                    // this.seen=false;
                    //MESSAGE
                    this.show=true;
                    this.message="You have successfully deleted a flight!"
                    this.title="Success"
                    this.hidePopUp();
                });
        },
        callPopUpEdit(flight){
            this.seeEditWindow=true;
            this.flightToEdit= flight;
        },
    }
}
</script>

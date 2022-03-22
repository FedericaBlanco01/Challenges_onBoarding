<template>
    <div>
        <error-message-display v-if="showIt" :message="message" :title="title"></error-message-display>

        <div class="flex justify-center py-10 ">
            <div class="mb-3 xl:w-96">
                <div class="py-3">
                    <VueMultiselect
                        v-model="selected_airline"
                        @change="getCities"
                        @click="clearFields"
                        :options="airlines"
                        :close-on-select="true"
                        :clear-on-select="false"
                        value="id"
                        label="name"
                        track-by="name"/>
                    <div class="py-3">
                        <VueMultiselect
                            v-model="selected_departure_city"
                            :options="cities"
                            :close-on-select="true"
                            :clear-on-select="false"
                            value="id"
                            label="name"
                            track-by="name"/>
                        <div class="py-3">
                            <VueMultiselect
                                v-model="selected_arrival_city"
                                :options="cities"
                                :close-on-select="true"
                                :clear-on-select="false"
                                value="id"
                                label="name"
                                track-by="name"/>
                            <div class="py-3">
                                <span
                                    class="text-sm inline-block mb-2 text-gray-500">Select your departure time: </span>
                                <input v-model="departure_time" type="datetime-local"
                                       class="
        form-control
        departure_time_airline
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-400
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                />
                                <div class="py-3">
                                    <span
                                        class="text-sm inline-block mb-2 text-gray-500">Select your arrival time: </span>
                                    <input type="datetime-local" v-model="arrival_time"
                                           class="
        form-control
        arrival_time_flight
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-400
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    />
                                    <div class="py-8">
                                        <button type="button"
                                                class="create_flight transition-colors duration-300 bg-purple-400 hover:bg-purple-800 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                                        @click="updateFlight">
                                            UPDATE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
import ErrorMessageDisplay from "./ErrorMessageDisplay";

export default {
    name: 'EditFlight',
    components: {VueMultiselect, ErrorMessageDisplay},
    props: {
        airlines: {
            type: Array,
            default: []
        },
        flight: {
            type: Number,
            default: 0
        },
    },
    data() {
        return {
            selected_airline: null,
            selected_departure_city: null,
            selected_arrival_city: null,
            departure_time: null,
            arrival_time: null,
            cities: [],
            showIt:false,
            message:"",
            title:""
        };
    },
    mounted() {
        this.getPreSelectedValues();

    },
    watch: {
        selected_airline: function (val) {
            this.getCities();
        },
    },
    methods: {
        getPreSelectedValues() {
            axios
                .get('/getValuesFromFlight/' + this.flight)
                .then(response => {
                    this.selected_airline = response.data.airline;
                    this.selected_departure_city = response.data.departure;
                    this.selected_arrival_city = response.data.arrival;
                    this.departure_time = (response.data.departureTime).replace(/\s+/g, 'T');
                    this.arrival_time= (response.data.arrivalTime).replace(/\s+/g, 'T');

                    this.getCities();
                });
        },
        getCities() {
            this.cities = this.selected_airline.available_cities;
        },
        clearFields() {
            this.selected_departure_city = null;
            this.selected_arrival_city = null;
            this.departure_time = null;
            this.arrival_time= null;
        },
        updateFlight(){
            this.seenError= false;
            let updateflight={
                flight_id:this.flight,
                airline_id: this.selected_airline.id,
                departure_city_id: this.selected_departure_city.id,
                arrival_city_id: this.selected_arrival_city.id,
                departure_time: this.departure_time,
                arrival_time: this.arrival_time
            };
            axios
                .patch('/updateflight',updateflight)
                .then(response => {
                    console.log(response.data.message);
                    this.showIt=true;
                    this.title="Success"
                    this.message="Flight updated successfully!";


                })
                .catch(response =>  {
                    console.log(response.message);
                    this.showIt=true;
                    this.title="Error"
                    this.message="Can't update the flight!";

                });
        },
    }
}
</script>

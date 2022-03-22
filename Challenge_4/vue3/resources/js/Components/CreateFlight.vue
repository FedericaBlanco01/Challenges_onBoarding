<template>
    <div class="flex justify-center py-10 ">

        <div class="mb-3 xl:w-96">
            <div class="py-2">
                <error-message-display v-if="show" :message="message" :title="title"></error-message-display>
            </div>
            <div id="successMessage" class="" role="alert"></div>
            <span class="form-label inline-block mb-2 text-gray-700">Register a new flight!</span>
            <div class="py-3">
                <VueMultiselect
                    v-model="selected_airline"
                    @change="getCities()"
                    :options="airlines"
                    :close-on-select="true"
                    :clear-on-select="false"
                    value="id"
                    placeholder="Select an Airline"
                    label="name"
                    track-by="name"/>
                <div class="py-3">
                    <VueMultiselect
                        v-model="selected_departure_city"
                        :options="cities"
                        :close-on-select="true"
                        :clear-on-select="false"
                        value="id"
                        placeholder="Select a departure city"
                        label="name"
                        track-by="name"/>
                    <div class="py-3">
                        <VueMultiselect
                            v-model="selected_arrival_city"
                            :options="cities"
                            :close-on-select="true"
                            :clear-on-select="false"
                            value="id"
                            placeholder="Select an arrival city"
                            label="name"
                            track-by="name"/>
                        <div class="py-3">
                            <span class="text-sm inline-block mb-2 text-gray-500">Select your departure time: </span>
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
                                <span class="text-sm inline-block mb-2 text-gray-500">Select your arrival time: </span>
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
                                            @click="createFlight()">
                                        REGISTER
                                    </button>
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
import VueMultiselect from 'vue-multiselect';
import ErrorMessageDisplay from "./ErrorMessageDisplay";

export default {
    components: {VueMultiselect, ErrorMessageDisplay},
    props: {
        airlines: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            cities: [],
            selected_airline: null,
            selected_departure_city: null,
            selected_arrival_city: null,
            departure_time: null,
            arrival_time: null,
            show: false,
            message: "",
            title: ""
        };
    },
    watch: {
        selected_airline: function (val) {
            this.getCities();
        }
    },
    methods: {
        getCities() {
            this.cities = this.selected_airline.available_cities;
        },
        createFlight() {
            let flight = {
                airline_id: this.selected_airline.id,
                departure_city_id: this.selected_departure_city.id,
                arrival_city_id: this.selected_arrival_city.id,
                departure_time: this.departure_time,
                arrival_time: this.arrival_time
            };
            axios
                .post('/addflight', flight)
                .then(response => {
                    console.log(response.data.message);
                    this.show = true;
                    this.title = "Success"
                    this.message = "Flight created successfully!"
                    this.$emit('newflight');
                    //clear fields
                    this.selected_airline = "";
                    this.selected_departure_city = "";
                    this.selected_arrival_city = "";
                    this.departure_time = "";
                    this.arrival_time = "";

                })
                .catch(response => {
                    console.log(response.message);
                    this.show = true;
                    this.title = "Error"
                    this.message = "Flight can't be created"
                    this.$emit('notcreate');
                });
        },

    }
}
</script>


<style src="vue-multiselect/dist/vue-multiselect.css"></style>

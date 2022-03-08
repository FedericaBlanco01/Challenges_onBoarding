@extends('components.layout')
@section('content')
    <table class="min-w-full border-collapse block md:table" id="TABLE">
        <caption></caption>
        <thead class="block md:table-header-group">
        <tr
            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">ID
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">Name
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Number of flights arriving
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Number of flights departing
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Actions
            </th>
        </tr>
        </thead>

        <div id="successMessage" class="" role="alert"></div>
        <tbody class="block md:table-row-group"></tbody>
    </table>
    {{-- -INPUT FIELD --}}
    <div class="flex justify-center py-10">
        <div class="mb-3 xl:w-96 ">
            <label for="label_input_city" class="form-label inline-block mb-2 text-gray-700">Register a new
                city!</label>

            <input type="text"
                   class="
        form-control
        name_city
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                   name="input_city" placeholder="Here" value=""/>
            <div class="inline-block py-5">
                <button type="button"
                        class="add_city transition-colors duration-300 bg-purple-400 hover:bg-purple-800 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                    Register
                </button>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            fetchCity();

            function fetchCity() {
                $.ajax({
                    type: "GET",
                    url: "/fetchcities",
                    datatype: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.cities, function (key, item) {
                            $('tbody').append(
                                '<tr>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">' + item.id + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">' + item.name + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">' + item.flights_as_arrival_count + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">' + item.flights_as_departure_count + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">\
                                <a href="/editCity/' + item.id + '" value="' + item.id + '" class= "button_edit bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full" > Edit </a>\
                                <button type="button" value="' + item.id + '" class=" button_delete bg-red-500 hover:bg-red-700 text-white py-1 px-2 border rounded-full">Delete</button>\
                                </td>\
                        </tr>');
                        })
                    }
                });
            }

            $(document).on('click', '.button_delete', function (e) {
                e.preventDefault();
                let city_id = $(this).val();

                $.ajax({
                    type: "DELETE",
                    url: "/deleteCity/" + city_id,
                    success: function (response) {
                        console.log(response);
                        $('#successMessage').html("");
                        $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                        $('#successMessage').text(response.message);
                        fetchCity();
                    }
                })
            });

            var data;
            $(document).on('click', '.add_city', function (e) {
                e.preventDefault();
                data = {name: $('.name_city').val()};
                $.ajax({
                    type: "POST",
                    url: "/cities",
                    data: data,
                    datatype: "json",
                    success: function (response) {
                        $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                        $('#successMessage').text(response.message);
                        fetchCity();
                    },
                    error: function (response) {
                        $('#successMessage').html("");
                        $('#successMessage').addClass("bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative");
                        $('#successMessage').text('The city name must be unique and not empty!');
                    }
                })
            });

        });
    </script>
@endsection

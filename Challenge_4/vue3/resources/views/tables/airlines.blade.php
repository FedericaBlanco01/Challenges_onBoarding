@extends('components.layout')
@section('content')
    <div class=" justify-center w-1/3 inline-block">
        <div class="mb-3 xl:w-96 ">
            <input type="text"  value="" class="formSelectFlights appearance-none
      block
      w-full
      px-3
      py-1.5
      text-base
      font-normal
      text-gray-700
      bg-white bg-clip-padding bg-no-repeat
      border border-solid border-gray-300
      rounded
      transition
      ease-in-out
      m-0
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   placeholder="Search by number of flights operated" aria-label="Default select">
            <button type="button"
                    class=" buttonSearch hover:text-purple-800 text-xs font-bold text-purple-400">
                SEARCH
            </button>
        </div>
    </div>

    <table class="min-w-full border-collapse block md:table">
        <caption></caption>
        <div id="successMessage" class="" role="alert"></div>
        <thead class="block md:table-header-group">
        <tr
            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">ID
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">Name
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell"
                width="50%">
                Description
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell"
                width="20%">
                Number of flights operated
            </th>
            <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                Actions
            </th>
        </tr>
        </thead>

        <tbody class="block md:table-row-group">
        </tbody>
    </table>

    {{-- -INPUT FIELD --}}
    <div class="flex justify-center py-10">
        <div class="mb-3 xl:w-96 ">
            <label for="label_input_city" class="form-label inline-block mb-2 text-gray-700">Register a new
                airline!</label>

            <input type="text"
                   class="
        form-control
        new_name_airline
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
        mb-2
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                   name="input_city" placeholder="Airlines name" value=""/>

            <input type="text"
                   class="
        form-control
        new_description_airline
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
                   name="input_city" placeholder="Airlines description" value=""/>
            <div class="py-3">
                {{--               select cities--}}

                <select class="js-class block
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
                        multiple="multiple">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>


                <div class="py-5">
                    <button type="button"
                            class="add_airline transition-colors duration-300 bg-purple-400 hover:bg-purple-800 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            fetchAirline("");
            $(".js-class").select2({ placeholder: "Available cities", allowClear: true});

            function fetchAirline(numberOperations) {
                let url = new URL('http://vue3.test/fetchairlines')
                url.searchParams.set('number', numberOperations);

                fetch(url)
                    .then(res => res.json())
                    .then(function (data) {
                        $('tbody').html("");
                        $.each(data.airlines, function (key, item) {
                            $('tbody').append(
                                '<tr>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">' + item.id + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">' + item.name + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">' + item.description + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">' + item.flights_count + '</td>\
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">\
                                <a href="/editAirline/' + item.id + '" value="' + item.id + '" class= "button_edit bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full" > Edit </a>\
                                <button type="button" value="' + item.id + '" class=" button_delete bg-red-500 hover:bg-red-700 text-white py-1 px-2 border rounded-full">Delete</button>\
                                </td>\
                        </tr>');
                        })
                    })
            }

            $(document).on('click', '.buttonSearch', function (e){
                e.preventDefault();
                data = {
                    number: $('.formSelectFlights').val(),
                };
                fetchAirline(data);
            });

            var data;
            $(document).on('click', '.add_airline', function (e) {
                e.preventDefault();
                data = {
                    name: $('.new_name_airline').val(),
                    description: $('.new_description_airline').val(),
                    cities:$('.js-class').val()
                };

                fetch('http://vue3.test/airlines', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(res => res.json())
                    .then(function (data) {
                        $('#successMessage').html("");
                        if (data.status == 200) {
                            $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                            $('#successMessage').text(data.message);
                            fetchAirline();
                            //pasar params
                        } else {
                            $('#successMessage').addClass("bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative");
                            $('#successMessage').text(data.message);
                        }
                    })
            });
            var airline_id;
            $(document).on('click', '.button_delete', function (e) {
                e.preventDefault();
                airline_id = $(this).val();
                fetch('http://vue3.test/deleteAirline/' + airline_id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: null
                })
                    .then(res => res.json())
                    .then(function (data) {
                        $('#successMessage').html("");
                        $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                        $('#successMessage').text(data.message);
                        fetchAirline();
                    //    pasar params
                    })
            });
        });
    </script>
@endsection


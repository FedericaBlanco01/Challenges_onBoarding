@extends('components.layout')
@section('content')
    <a href="/cities" class="button_edit bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full">Go
        Back</a>
    <div class="py-8">
        <div id="successMessage" class="" role="alert"></div>
        <span class="font-semibold text-xl tracking-tight text-black">Update city</span>
        <div py-5>
            <span class="font-semibold text-l tracking-tight text-black">Id:</span>
            <div class="py-3">
                <p id="id_city">{{$city->id}}</p>
                <div class="py-5">
                    <div py-5>
                        <span class="font-semibold text-l tracking-tight text-black">Name:</span>
                        <div class="py-3">
                            <input type="text"
                                   class="
        form-control
        new_name_city
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                   name="name" value="{{$city->name}}" />


                            <div class="py-8">
                                <button type="button"
                                        class=" update_city bg-purple-400 hover:bg-purple-800
                                        text-white py-1 px-2 border rounded-full">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--onclick mandar esa info al back y update base de datos--}}
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
        });
        var data;
        $(document).on('click', '.update_city', function (e) {
            e.preventDefault();
            data = {
                name: $('.new_name_city').val(),
                id: $('#id_city').html(),
            };
            $.ajax({
                type: "PATCH",
                url: "/editCity/"+data.id,
                data: data,
                datatype: "json",
                success: function (response) {
                    console.log(response);
                    $('#successMessage').html("");
                    $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                    $('#successMessage').text(response.message);
                    },
                error:  function(error){
                    $('#successMessage').html("");
                    $('#successMessage').addClass("bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative");
                    $('#successMessage').text('The city name must be unique and not empty!');
                }
            })
        });
    </script>
@endsection

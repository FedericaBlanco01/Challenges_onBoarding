@extends('components.layout')
@section('content')
    <a href="/airlines" class="button_edit bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full">Go
        Back</a>
    <div class="py-8">
        <div id="successMessage" class="" role="alert"></div>
        <span class="font-semibold text-xl tracking-tight text-black">Update airline</span>
        <div py-5>
            <span class="font-semibold text-l tracking-tight text-black">Id:</span>
            <div class="py-3">
                <p id="id_airline">{{$airline->id}}</p>
                <div class="py-5">
                    <div py-5>
                        <span class="font-semibold text-l tracking-tight text-black">Name:</span>
                        <div class="py-3">
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
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                   name="name"  value="{{$airline->name}}"/>
                            <div class="py-5">
                                <span class="font-semibold text-l tracking-tight text-black">Description:</span>
                                <div class="py-3">
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                           name="name" value="{{$airline->description}}"/>


                                    <div class="py-8">
                                        <button type="button"
                                                class="update_airline bg-purple-400 hover:bg-purple-800
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        var data;
        $(document).on('click', '.update_airline', function (e) {
            e.preventDefault();
            data = {
                name: $('.new_name_airline').val(),
                description: $('.new_description_airline').val(),
                id: $('#id_airline').html(),
            };
            console.log(data);
            fetch('http://127.0.0.1:8000/updateAirline',{
                method: 'PATCH',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(function (data) {
                $('#successMessage').html("");
                if(data.status == 200) {
                    $('#successMessage').addClass("bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative");
                    $('#successMessage').text(data.message);
                }else{
                    $('#successMessage').addClass("bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative");
                    $('#successMessage').text(data.message);
                }
            })

        });
        });
    </script>
@endsection

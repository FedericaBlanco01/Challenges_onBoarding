@extends('components.layout')
@section('content')
    <a href="/cities">Go Back</a>
    <span class="font-semibold text-xl tracking-tight text-black">Update city</span>
    <input type="text"
           class="
        form-control
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
           name="id" placeholder="{{$city->id}}" value="" />

    <input type="text"
           class="
        form-control
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
           name="name" placeholder="{{$city->name}}" value="" />
    <div py-8>

    <a href="" class="bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full">Update</a>
    </div>
@endsection
@section('scripts')
    //onclick mandar esa info al back y update base de datos
@endsection

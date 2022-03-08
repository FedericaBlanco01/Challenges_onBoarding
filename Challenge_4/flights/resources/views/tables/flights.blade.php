@extends('components.layout')
@section('content')
    <body>

    <div id="root">
        <ul>
            <li v-for="name in names">{{ name }}</li>
        </ul>
    </div>

    <script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
    <script>
        new Vue({
            el: '#root',
            data: {names:['jose','pedro','fefi']}
        })
    </script>

    </body>
@endsection

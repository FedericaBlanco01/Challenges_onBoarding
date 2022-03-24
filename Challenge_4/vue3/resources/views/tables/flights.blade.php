@extends('components.layout')
@section('content')
      <all-flight :airlines='@json($airlines)' :cities='@json($cities)'></all-flight>

@endsection

<script>

</script>

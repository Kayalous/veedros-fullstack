@extends('layout')

@section('content')
<section class="pt-5" style="height: 100vh; width: 100vw">

    <form class="pt-5 mt-5" action="{{route('test.upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control-file text-center">
        <input type="submit" class="btn btn-veedros-new btn-veedros-xl">
    </form>

</section>
@endsection

@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
@endsection
@section('content')

    <div class="container my-5 py-5">
        <form action="" method="get">
            <input type="text" name="q">
            <button type="submit">Submit</button>
        </form>
        @if($courses)
            @foreach($courses as $course)
            {{$course->name}}
            {{$course->about}}
            {{$course->price}}
                <br>
            @endforeach
        @endif
        @if($sessions)
            @foreach($sessions as $session)
                {{$session->name}}
                {{$session->about}}
                <br>
            @endforeach
        @endif
        @if($chapters)
            @foreach($chapters as $chapter)
                {{$chapter->name}}
                {{$chapter->about}}
                <br>
            @endforeach
        @endif
    </div>

@endsection

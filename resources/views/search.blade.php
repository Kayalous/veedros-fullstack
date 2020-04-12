@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
@endsection
@section('content')
            
    <div class="container my-5 py-5">
        <div class="veedros-search-form-sm w-75 m-auto ">
        
        
        <form action="" method="get">
            <input class=" form-control profile-form-field email-field-props border-light border-radius-sm is-valid" placeholder="type here..." type="text" name="q">
            <button class="search-button-sm border-0" type="submit">
            <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        </div>
        @if($courses)
            @foreach($courses as $course)
            {{$course->name}}
            {{$course->about}}
            {{$course->price}}
                <br>
                <br>
                <br>
            @endforeach
        @endif
        @if($sessions)
            @foreach($sessions as $session)
                {{$session->name}}
                {{$session->about}}
                <br>
                <br>
                <br>
            @endforeach
        @endif
        @if($chapters)
            @foreach($chapters as $chapter)
                {{$chapter->name}}
                {{$chapter->about}}
                <br>
                <br>
                <br>
            @endforeach
        @endif
    </div>

@endsection

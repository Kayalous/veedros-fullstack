@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
    <link rel="stylesheet" href="{{asset('styles/search.css')}}">
@endsection
@section('content')

    <div class="container my-5 py-5">
        <div class="btn-search-veedros-sm w-75 m-auto ">
        <form action="" method="get">
            <input class=" form-control profile-form-field email-field-props border-light border-radius-sm is-valid" placeholder="type here..." type="text" name="q">
            <button class="btn-search-sm border-0" type="submit">
            <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        </div>
        @if($sessions)
            @foreach($sessions as $session)
                <div class="row shadow-lg my-5  rounded-lg-mine">
                            <div class="col-lg-4 col-12">
                            <div class="card course-card development-card noJquery" style="background-image: url({{$session->chapter->course->img}})">

                                <div class="card-body m-0">
                                    <a href="{{$session->getLink()}}" class="card-body-inner noscroll card-bg-img">
                                        <div class="play-circle play-circle-1"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""> </div>
                                    </a>
                                </div>
                            </div>
                            </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="w-100 mt-5">
                                    <a href="{{$session->getLink()}}" class="p-title">{{$session->name}}</a>
                                    <p class="p-description d-none-mine">{{$session->about}}</p>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <a href="{{\App\Course::getFirstSession($session->chapter->course)}}" class="btn btn-veedros btn-veedros-md border-0 ml-auto ">
                                        Watch from the start
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if($courses)
            @foreach($courses as $course)
                <div class="row shadow-lg my-5  rounded-lg-mine">
                    <div class="col-lg-4 col-12">
                        <div class="card course-card development-card noJquery" style="background-image: url({{$course->img}})">

                            <div class="card-body m-0">
                                <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img">
                                    <div class="play-circle play-circle-1"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="container">
                            <div class="w-100 mt-5">
                                <a href="{{\App\Course::getFirstSession($course)}}" class="p-title">{{$courses->name}}</a>
                                <p class="p-description d-none-mine">{{$course->about}}</p>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <a href="{{\App\Course::getFirstSession($course)}}" class="btn btn-veedros btn-veedros-md border-0 ml-auto ">
                                    Watch from the start
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection

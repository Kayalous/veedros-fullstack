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
        <div class="row shadow-lg my-5  rounded-lg-mine">
                            <div class="col-lg-4 col-12">
                            <div class="card course-card development-card noJquery" style="background-image: url(https://veedros.s3.eu-central-1.amazonaws.com/courses/2/hellloo/images/tdzHq4nTU7zkOOmjoTEXVq8ZFlpqoTBAxIljBlhl.jpeg)">
                                
                                <div class="card-body m-0">
                                    <a href="http://127.0.0.1:8000/watch/keshaun-cartwright/everett-mohr/ova-botsford/waldo-jaskolski" class="card-body-inner noscroll card-bg-img">
                                        <div class="play-circle play-circle-1"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""> </div>
                                        <h4 class="card-title title-mine w-100">
                                            Everett Mohr
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="w-100">
                                    <p class="p-title">Everett Mohr</p>
                                    <p class="p-description d-none-mine">999 Erin Field
New Damaris, TN 03450</p>
                                </div>

                                <hr class="my-4">
                               
                                
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <div class="d-flex " id="course-info">
                                        <div class="">
                                            <div class="badge tip-badge py-1">
                                                <h4 class="badge-item">
                                                    <i class="fas fa-hand-holding-usd"></i>
                                                    <span>6000 EGP</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="mx-3">
                                            <div class="badge tip-badge py-1">
                                                <h4 class="badge-item">
                                                    <i class="far fa-clock"></i>
                                                    <span>12</span>
                                                </h4>
                                            </div>
                                        </div>
                                        </div>
                                    <a href="" class="btn btn-veedros btn-veedros-md border-0 " type="button">
                                         Explore
                                    </a>
                                </div>

                           

                        </div>
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

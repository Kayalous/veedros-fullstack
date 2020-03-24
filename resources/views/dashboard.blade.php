@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="styles/dashboard.css" />
@endsection

@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0"></script>
    <div class="new-bg"></div>
    <section class="info-bar">
        <div class="container ">
            <div class="content-info-bar">
                <div class="row">
                    <div class="col-12 col-md-6 ">
                        <div class="user-photo " style="background-image: url({{asset('uploads/profilePictures/') . '/'.Auth::user()->img}});">
                            <div class="edit-container">
                            </div>

                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center align-items-center col-md-6">
                        <ul class="user-name">
                            <li>
                                <p class="p1">{{Auth::user()->name}}</p>
                            </li>
                            @if(Auth::user()->location)
                            <li class="d-flex my-2">
                                <img src="{{asset('images/Icons')}}/Location.svg" alt="">
                                <P class="p2 px-4 text-muted">
                                    {{Auth::user()->location}}</P>
                            </li>
                            @endif
                            <li>
                                <a href="{{asset("profile")}}" class="btn btn-veedros-new btn-veedros-regular  btn- border-0 my-1 "
                                        type="button">
                                        <span>view profile</span>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>



        </div>
    </section>
    <!-- ================ END =================== information bar ================== END ====================== -->

    <!-- ================  =================== TABS ==================  ====================== -->

    <div class="container">
        <ul class="nav nav-pills nav-justified justify-content-center">
            <li id="courses-tab" class="nav-item nav-item-edit shadow-sm m-1">
                <a href="#My_Courses" class="nav-link d-none-tab active" data-toggle="tab">
                    <p class="p1 container-notification">
                        <i class="far iconsize-mine fa-play-circle" aria-hidden="true"></i>

                        <!-- <span id="courses-notification" class="notification">2</span> -->

                    </p>

                    <p class="target">My Courses</p>
                </a>
            </li>
            <li id="saved-tab" class="nav-item nav-item-edit shadow-sm m-1">
                <a href="#Saved" class="nav-link d-none-tab" data-toggle="tab">
                    <p class="p1 container-notification">
                        <i class="far fa-bookmark" aria-hidden="true"></i>

                        <span id="saved-notification" class="notification">2</span>

                    </p>

                    <p class="target">Saved</p>
                </a>
            </li>
            <!-- <li id="recommended-tab" class="nav-item nav-item-edit disabled shadow-sm m-1">
                <a href="#Recommended" class="nav-link d-none-tab" data-toggle="tab">
                    <p class="p1 container-notification"><i class="far fa-thumbs-up" aria-hidden="true"></i>

                        <span id="recommended-notification" class="notification">+5</span>

                    </p>
                    <p class="target">Recommended</p>
                </a>
            </li> -->
        </ul>
        <div class="tab-content ">
            <!-- My Courses -->
            <!-- My Courses -->
            <!-- My Courses -->
            <div id="My_Courses" class="tab-pane fade in active show" style="overflow: initial !important;">
                <div class="dashboard-land ">
                    @foreach(Auth::user()->courses as $course)
                        <div class="row shadow-lg  rounded-lg-mine">
                            <div class="col-lg-4 col-12">
                            <div class="card course-card development-card noJquery" style="background-image: url({{asset('/uploads/courses/1/pokemon-td8v2/images/1584209495.png')}})">
                                {{--                                . $course->instructor_id . '/' . $course->slug . '/images/' . $course->img--}}
                                <div class="card-body m-0">
                                    <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img"  >
                                        <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""/> </div>
                                        <h4 class="card-title title-mine w-100">
                                            {{$course->name}}
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="w-100">
                                    <p class="p-title">{{$course->name}}</p>
                                    <p class="p-description d-none-mine">{{$course->about}}</p>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <p class="p-prog">My Progress</p>
                                    <br>
                                    <div id="prog-bar1" class="progress-bar" style="--width:50;"></div>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-end mb-3 ">
                                    <button class="btn btn-veedros-new btn-veedros-sm btn- border-0 mx-2" type="button">
                                        share
                                    </button>
                                    <!-- <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                                    data-layout="button" data-size="large"><a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore">Share</a></div> -->

                                    <a href="{{\App\Course::getFirstSession($course)}}" class="btn btn-veedros btn-veedros-md border-0 " type="button">
                                        Keep Going
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            <!-- Saved -->
            <!-- Saved -->
            <!-- Saved -->
            <div id="Saved" class="tab-pane fade">
                <div class="dashboard-land">
                    <div class="container">
                        <div class="row ">
                            @if(Auth::user()->saves()->count() > 0)
                            <div class="card-columns m-auto">
                                @foreach(Auth::user()->saves as $saveCourse)
                                    <div class="card course-card development-card noJquery" style="background-image: url({{asset('/uploads/courses/1/pokemon-td8v2/images/1584209495.png')}})">
                                        {{--                                . $course->instructor_id . '/' . $course->slug . '/images/' . $course->img--}}
                                        <div class="card-body m-0">
                                            <a href="{{\App\Course::getFirstSession($saveCourse)}}" class="card-body-inner noscroll card-bg-img"  >
                                                <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""/> </div>
                                                <h4 class="card-title title-mine w-100">
                                                    {{$saveCourse->name}}
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <h1 class="my-5 py-5 text-muted">You don't have any saved courses yet.</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recommended -->
            <!-- Recommended -->
            <!-- Recommended -->
            <!-- <div id="Recommended" class="tab-pane fade">
                <div class="dashboard-land">
                    <div class="container">
                        <div class="row ">
                            <div class="card-columns m-auto ">
                                <div class=" card-kmine">
                                    <div class="card course-card development-card noJquery"
                                         style="background-image: url('images/img_02.png')" data-toggle="modal"
                                         data-target="#exampleModal">
                                        <div class="course-card-overlay overlay-2"></div>
                                        <div class="card-body m-0">
                                            <div class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-4"> <img
                                                        style="height:40px; width:40px " src="images/Play_button.svg"
                                                        alt=""> </div>
                                                <h4 class="card-title title-mine">
                                                    Full Stack Web Development
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" card-kmine">
                                    <div class="card course-card development-card noJquery"
                                         style="background-image: url('images/img_04.png')" data-toggle="modal"
                                         data-target="#exampleModal">
                                        <div class="course-card-overlay overlay-3"></div>
                                        <div class="card-body m-0">
                                            <div class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-2"> <img
                                                        style="height:40px; width:40px " src="images/Play_button.svg"
                                                        alt=""> </div>
                                                <h4 class="card-title title-mine">
                                                    Full Stack Web Development
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" card-kmine">
                                    <div class="card course-card development-card noJquery"
                                         style="background-image: url('images/img_03.png')" data-toggle="modal"
                                         data-target="#exampleModal">
                                        <div class="course-card-overlay overlay-4"></div>
                                        <div class="card-body m-0">
                                            <div class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-5"> <img
                                                        style="height:40px; width:40px " src="images/Play_button.svg"
                                                        alt=""> </div>
                                                <h4 class="card-title title-mine">
                                                    Full Stack Web Development
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-kmine">
                                    <div class="card course-card development-card noJquery"
                                         style="background-image: url('images/img_01.png')" data-toggle="modal"
                                         data-target="#exampleModal">
                                        <div class="course-card-overlay overlay-1"></div>
                                        <div class="card-body m-0">
                                            <div class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-1"> <img
                                                        style="height:40px; width:40px " src="images/Play_button.svg"
                                                        alt=""> </div>
                                                <h4 class="card-title title-mine">
                                                    Full Stack Web Development
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-kmine">
                                    <div class="card course-card development-card noJquery"
                                         style="background-image: url('images/img_04.png')" data-toggle="modal"
                                         data-target="#exampleModal">
                                        <div class="course-card-overlay overlay-1"></div>
                                        <div class="card-body m-0">
                                            <div class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-1"> <img
                                                        style="height:40px; width:40px " src="images/Play_button.svg"
                                                        alt=""> </div>
                                                <h4 class="card-title title-mine">
                                                    Full Stack Web Development
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
@endsection

@section('customJS')
    <script src="scripts/dashboard.js"></script>
@endsection

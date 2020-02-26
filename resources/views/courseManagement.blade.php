@extends('layout')

@section('libraryCSS')
    <!-- video js CSS  -->
    <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />
@endsection
@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/player.css">
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection
@section('content')
    <div class="container mt-5">

    <h1>Manage {{$course->name}} </h1>
    </div>
    <section class="player-container my-5 px-3">
        <div class="video-wrapper my-auto">
            <video id="player" class="video-js vjs-default-skin vjs-16-9" controls preload="auto"
                   width="640" height="264" data-setup="{}">
                <source src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" type="video/mp4" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading
                    to a web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports
                        HTML5 video</a>
                </p>
            </video>
        </div>
        <section class="sidebar ml-3 py-3 px-2">
            <div class="sidebar-wrapper">
                <h5 class="ml-5">12 Lessons (1h 19m)</h5>
                <div class="list-group">
                    <button class="list-group-item collapse-button mx-auto" data-toggle="collapse"
                            href="#collapse1">
                        <span>Section 1 </span>
                        <div class="vertical-seperator"></div>
                        Some lesson
                        <div class="chevron"><i data-feather="chevron-down"></i></div>
                    </button>
                    <div class="list-group collapse py-2 show" id="collapse1">
                        <a href="#" class="list-group-item list-group-item-action active"><i
                                data-feather="play" class="mr-3"></i>Introduction</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="container" id="course-info">
        <hr class="mb-5 d-md-block d-none" />
        <div>
            <div class="row flex-column-reverse-mine">
                <div class="col-12 pb-5">
                    <h2>About this course</h2>
                    <div class="row">
                    <h5 class="col-10">
                        {{$course->about}}
                    </h5>
                        <button id="edit-about"
                           class="btn btn-secondary-veedros border-medium edit-btn"><i
                                data-feather="edit"></i>
                            Edit</button>
                    </div>
                    <br>
                    <h2>You will learn</h2>
                    <ul class="ml-5">
                        <li class="row">
                            <h5 class="col-10"><i data-feather="check" class="mr-3"></i>Scene transitions
                            </h5>
                            <button id="edit-obj-0"
                                    class="btn btn-secondary-veedros border-medium edit-btn"><i
                                    data-feather="edit"></i>
                                Edit</button>
                        </li>

                    </ul>
                    <div class="w-100 row">
                        <button id="add-obj"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3">
                            <h2 class="m-0">
                            <i data-feather="plus"></i>
                                Add a new objective.
                            </h2>

                        </button>
                    </div>
                    <br>
                    <hr>
                    <div class="row w-md-100 w-75 mx-auto ">
                        <div class="col-6">
                            <div class="badge tip-badge">
                                <h4 class="badge-item">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>{{$course->price}} EGP</span>
                                    <button id="edit-price"
                                            class="btn btn-secondary-veedros border-medium edit-btn"><i
                                            data-feather="edit"></i></button>
                                </h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="badge tip-badge">
                                <h4 class="badge-item">
                                    <i class="far fa-clock"></i>
                                    <span>16 Hours</span>
                                    <button id="edit-price"
                                            class="btn btn-secondary-veedros border-medium edit-btn opacity-0"><i
                                            data-feather="edit"></i></button>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h2>Recommended to</h2>
                    <ul class="ml-5">
                        <li class="row">
                            <h5 class="col-10"><i data-feather="arrow-right" class="mr-3" ></i>AAST Students
                                -
                                Computer Engineering department 7th term
                            </h5>
                            <button id="edit-recommended-0"
                                    class="btn btn-secondary-veedros border-medium edit-btn"><i
                                    data-feather="edit"></i>
                                Edit</button>
                        </li>
                    </ul>
                    <div class="w-100 row">
                        <button id="add-obj"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3">
                            <h2 class="m-0">
                                <i data-feather="plus"></i>
                                Add a new recommendation.
                            </h2>

                        </button>
                    </div>


                </div>

        </div>
    </section>
@endsection

@section('libraryJS')
    <!-- video js -->
    <script src="https://vjs.zencdn.net/7.6.6/video.js"></script>
@endsection
@section('customJS')
    <script src="{{asset('scripts')}}/player.js"></script>
@endsection

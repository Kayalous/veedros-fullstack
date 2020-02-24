@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="styles/dashboard.css" />
@endsection

@section('content')
    <section>
        <div class="info-bar">
            <div class="content-info-bar">
                <div class="left-content">
                    <div class="container zbi-kbeer">
                        <div class="row justify-content-end zbi">
                            <a href="{{route('manage')}}" class="btn btn-veedros btn-Edit">
                                <p>Edit</p>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-5 ">
                                <div class="user-photo " style="background-image: url(uploads/profilePictures/{{Auth::user()->avatar}});">
                                </div>
                            </div>
                            <div class="col-12 col-md-7  ml-auto">
                                <div class="user-name">
                                    <p class="p1">{{Auth::user()->name}}</p>
                                    @if(Auth::user()->location != null)
                                    <p class="p2 text-muted"><i
                                            class="fas fa-globe-americas mr-2"></i>{{Auth::user()->location}}</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="right-content">
                    <div class="">
                        <div class="row">
                            <div class="col-6 ">
                                <div class=" text-center "">
                                <p class=" p1"><i class=" far fa-play-circle"></i> 3</p>
                                <P class="p2 ">Registered <br> Courses</P>
                            </div>
                        </div>
                        <div class=" col-6 ">
                            <div class=" text-center">
                                <div class="user-photo ">
                                    <a href="#">
                                        <p class="p1">2</p>
                                    </a>
                                    <div class='text'>
                                        <p><i class="fas fa-plus"></i></p>
                                    </div>

                                </div>
                                <P class="p2 ">to reach your discount</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        </div>
        </div>
    </section>
    <!-- ================ END =================== information bar ================== END ====================== -->

    <!-- ================  =================== TABS ==================  ====================== -->



    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item shadow m-1">
                <a href="#My_Courses" class="nav-link active" data-toggle="tab"> <i
                        class="far iconsize-mine fa-play-circle"></i> My Courses</a>
            </li>
            <li class="nav-item shadow m-1">
                <a href="#Saved" class="nav-link " data-toggle="tab"><i class="far fa-bookmark" aria-hidden="true"></i>
                    Saved</a>
            </li>
            <li class="nav-item disabled shadow m-1">
                <a href="#Recommended" class="nav-link" data-toggle="tab"><i class="far fa-thumbs-up"></i> Recommended
                </a>
            </li>
        </ul>
        <div class="tab-content ">
            <!-- My Courses -->
            <!-- My Courses -->
            <!-- My Courses -->
            <div id="My_Courses" class="tab-pane fade in  active show">
                <div class="dashboard-land ">

                    <div class="row shadow-lg  rounded-lg-mine">
                        <div class="col-lg-4 col-12 card-kmine">
                            <div class="card course-card development-card noJquery"
                                 style="background-image: url('images/img_03.png')" data-toggle="modal"
                                 data-target="#exampleModal">
                                <div class="course-card-overlay overlay-2"></div>
                                <div class="card-body m-0">
                                    <div class="card-body-inner noscroll card-bg-img">
                                        <div class="play-circle play-circle-2"> <img style="height:40px; width:40px "
                                                                                     src="images/Play_button.svg" alt=""> </div>
                                        <h4 class="card-title title-mine">
                                            Full Stack Web Development
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="row">
                                    <p class="p-title">Microprocessor</p>
                                    <br>
                                    <p class="p-description d-none-mine">To help fit your needs, this works with-based
                                        markup, as
                                        shown
                                        above, or
                                        with
                                        any arbitrary
                                        “roll your own” markup. Note that if you’re using, you shouldn’t
                                        add
                                        role="tablist" directly to it</p>
                                </div>

                                <hr>

                                <div class="row">
                                    <p class="p-prog">My Progress</p>
                                    <br>
                                    <div id="prog-bar1" class="progress-bar" style="--width:50;"></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end mb-3 ">
                                    <button class="btn btn-veedros btn-veedros-sm btn- border-0 mx-2" type="button">
                                        share
                                    </button>
                                    <button class="btn btn-veedros btn-veedros-sm border-0 " type="button">
                                        Keep Going
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row shadow-lg  rounded-lg-mine">
                        <div class="col-lg-4 col-12 card-kmine">
                            <div class="card course-card development-card noJquery"
                                 style="background-image: url('images/img_01.png')" data-toggle="modal"
                                 data-target="#exampleModal">
                                <div class="course-card-overlay overlay-2"></div>
                                <div class="card-body m-0">
                                    <div class="card-body-inner noscroll card-bg-img">
                                        <div class="play-circle play-circle-2"> <img style="height:40px; width:40px "
                                                                                     src="images/Play_button.svg" alt=""> </div>
                                        <h4 class="card-title title-mine">
                                            Full Stack Web Development
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="row">
                                    <p class="p-title">Microprocessor</p>
                                    <br>
                                    <p class="p-description d-none-mine">To help fit your needs, this works with-based
                                        markup, as
                                        shown
                                        above, or
                                        with
                                        any arbitrary
                                        “roll your own” markup. Note that if you’re using, you shouldn’t
                                        add
                                        role="tablist" directly to it</p>
                                </div>

                                <hr>

                                <div class="row">
                                    <p class="p-prog">My Progress</p>
                                    <br>
                                    <div id="prog-bar1" class="progress-bar" style="--width:50;"></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end mb-3 ">
                                    <button class="btn btn-veedros btn-veedros-sm btn- border-0 mx-2" type="button">
                                        share
                                    </button>
                                    <button class="btn btn-veedros btn-veedros-sm border-0 " type="button">
                                        Keep Going
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row shadow-lg  rounded-lg-mine">
                        <div class="col-lg-4 col-12 card-kmine">
                            <div class="card course-card development-card noJquery"
                                 style="background-image: url('images/img_02.png')" data-toggle="modal"
                                 data-target="#exampleModal">
                                <div class="course-card-overlay overlay-2"></div>
                                <div class="card-body m-0">
                                    <div class="card-body-inner noscroll card-bg-img">
                                        <div class="play-circle play-circle-2"> <img style="height:40px; width:40px "
                                                                                     src="images/Play_button.svg" alt=""> </div>
                                        <h4 class="card-title title-mine">
                                            Full Stack Web Development
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="container">
                                <div class="row">
                                    <p class="p-title">Microprocessor</p>
                                    <br>
                                    <p class="p-description d-none-mine">To help fit your needs, this works with-based
                                        markup, as
                                        shown
                                        above, or
                                        with
                                        any arbitrary
                                        “roll your own” markup. Note that if you’re using, you shouldn’t
                                        add
                                        role="tablist" directly to it</p>
                                </div>

                                <hr>

                                <div class="row">
                                    <p class="p-prog">My Progress</p>
                                    <br>
                                    <div id="prog-bar1" class="progress-bar" style="--width:50;"></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end mb-3 ">
                                    <button class="btn btn-veedros btn-veedros-sm btn- border-0 mx-2" type="button">
                                        share
                                    </button>
                                    <button class="btn btn-veedros btn-veedros-sm border-0 " type="button">
                                        Keep Going
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <!-- Saved -->
            <!-- Saved -->
            <!-- Saved -->
            <div id="Saved" class="tab-pane fade ">
                <div class="dashboard-land">
                    <div class="container">
                        <div class="row ">
                            <div class="card-columns m-auto">
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
            </div>
            <!-- Recommended -->
            <!-- Recommended -->
            <!-- Recommended -->
            <div id="Recommended" class="tab-pane fade">
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
            </div>

        </div>
    </div>

    <!-- ================ END =================== TABS ================== END ====================== -->
@endsection

@section('customJS')
    <script src="scripts/dashboard.js"></script>
@endsection

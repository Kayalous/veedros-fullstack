@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="styles/profile.css">
@endsection
@section('content')
    <div class="slash slash-to-right"></div>

    <!-- Profile  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <div class="card profile-card py-5">
                        <a href="{{route('manage')}}" class="btn btn-secondary-veedros border-medium edit-btn mr-4 mt-4"><i
                                data-feather="edit"></i>
                            Edit</a>
                        <div class="card-body">

                            <div class="mx-auto text-center">
                                <div class="instructor-img-wrapper mx-auto">
                                    <img src=" images/05.jpg" alt="instructor" class="round-lg mx-auto img-fluid" />
                                </div>
                                <h1 class="mt-3">Ahmed Saeed</h1>
                                <h5>Teaching assistant at AAST</h5>
                                <h6><i class="mr-1" data-feather="globe"></i>Alexandria, Egypt</h6>
                                <hr class="my-5">
                                <div class="container mx-2">
                                    <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum iste impedit
                                        nostrum
                                        in magni facilis quo. In id dolore nesciunt sed, aut, ullam iure qui totam omnis
                                        sit, rem magnam.</h5>
                                </div>

                                <hr class="my-5">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="#">
                                        <h1><i data-feather="twitter"></i></h1>
                                    </a>
                                    <a href="#">
                                        <h1><i data-feather="facebook"></i></h1>
                                    </a>
                                    <a href="#">
                                        <h1><i data-feather="linkedin"></i></h1>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured courses mt-5 pt-5">

        <div class="container container-mine">
            <div class="row">
                <div class="header-text ml-5">
                    <h1>
                        Courses by this instructor
                    </h1>
                </div>
                <div class="col-12">
                    <div class="course-cards-container card-columns mb-5 py-3">
                        <div class="card course-card development-card noJquery"
                             style="background-image: url('images/img_01.png')" data-toggle="modal"
                             data-target="#exampleModal">
                            <div class="course-card-overlay overlay-0"></div>
                            <div class="card-body m-0">
                                <div class="card-body-inner noscroll card-bg-img">
                                    <div class="play-circle play-circle-0"> <img style="height:40px; width:40px "
                                                                                 src="images/Play_button.svg" alt="" /> </div>
                                    <h4 class="card-title title-mine">
                                        Full Stack Web Development
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card course-card development-card noJquery"
                             style="background-image: url('images/img_02.png')" data-toggle="modal"
                             data-target="#exampleModal">
                            <div class="course-card-overlay overlay-1"></div>
                            <div class="card-body m-0">
                                <div class="card-body-inner noscroll card-bg-img">
                                    <div class="play-circle play-circle-1"> <img style="height:40px; width:40px "
                                                                                 src="images/Play_button.svg" alt="" /> </div>
                                    <h4 class="card-title title-mine">
                                        Full Stack Web Development
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card course-card development-card noJquery"
                             style="background-image: url('images/img_03.png')" data-toggle="modal"
                             data-target="#exampleModal">
                            <div class="course-card-overlay overlay-2"></div>
                            <div class="card-body m-0">
                                <div class="card-body-inner noscroll card-bg-img">
                                    <div class="play-circle play-circle-2"> <img style="height:40px; width:40px "
                                                                                 src="images/Play_button.svg" alt="" /> </div>
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

    </section>
@endsection

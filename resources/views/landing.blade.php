@extends('layout')

@section('libraryCSS')
    <!-- Owl CSS  -->
    <link rel="stylesheet" href="owlCarousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="owlCarousel/css/owl.theme.default.min.css" />
@endsection

@section('content')
    <!-- Hero  -->
    <section class="hero pt-5 overflow-hidden">
        <div class="container mt-5">
            <div class="row ">
                <div class="col-lg-6 hero-header-text ">
                    <h1 class="mb-3">
                        Learn, easily
                    </h1>
                    <p class="">With Veedros learning's as easy as it gets.</p>

                    <a href="#featured-courses" class="btn btn-veedros-new btn-veedros-md border-0 mt-5 mr-auto"
                       >
                       <span>Explore now</span>
                    </a>
                </div>
                <div class="col-lg-6 hero-illustrations mx-auto">
                    <div class="illustration-container illustration-container-lg d-md-flex-center "
                         >
                        <canvas id="blob"> </canvas>
                        <img src="{{asset('images')}}/hero-01-withoutbg.png" alt=""
                             class="img-fluid illustration illustration-lg illustration-anim-1" />
                    </div>
                    <div class="row w-100 d-md-flex-center">
                        <div class="illustration-container illustration-container-sm  " data-wow-delay="0.4s">
                            <canvas id="blob2" class="blob-position-md "> </canvas>
                            <img src="{{asset('images')}}/hero-02-withoutbg.png" alt=""
                                 class="img-fluid illustration illustration-md illustration-position-md illustration-anim-2" />
                        </div>
                        <div class="illustration-container col-4 illustration-container-sm mt-illustration  "
                             data-wow-delay="0.6s">
                            <canvas id="blob3"> </canvas>
                            <img src="{{asset('images')}}/hero-03.png" alt=""
                                 class="img-fluid illustration illustration-sm illustration-position-sm illustration-anim-3" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="happy-users my-3">
        <div>
            <h1 class="text-center mb-0">6K<span>+</span></h1>
            <h2 class="mt-0">Happy students</h2>
        </div>
    </section>
    <!-- Featured courses  -->
    <section class="featured-courses my-5 py-5" id="featured-courses">
        <div class="container container-mine pt-3">
            <div class="row">
                <div class="header-text d-block mb-2 ">
                    <h1>
                        A powerful set of courses
                    </h1>
                    <h4>that will change your career.</h4>
                </div>
                <div class="col-12">
                    <div class="course-cards-container card-columns my-5 py-3">
                        @foreach($courses as $course)
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
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="courses/" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto">
                    <span >All courses</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ===================================== Sign up instructor ===================================== -->


    <section class="mt-5">
        <div class="row">
            <div class="col-lg-6 m-0 px-0 overflow-hidden teach-img">
{{--                <img class="teach-img" src="{{asset('images/')}}/Teach-960x775.jpg" alt="Teach with us image">--}}
            </div>
            <div class="col-lg-6 m-0 py-5 teach-with-us-container d-flex flex-column justify-content-center align-items-center">
                <div class="teach-with-us-content">
                    <div class="container">
                        <h1>Have content?</h1>
                        <br>
                        <h2>If you...</h2>
                        <h4><i data-feather="check" class="mr-2"></i>Don't know how to organize your content.</h4>
                        <h4><i data-feather="check" class="mr-2"></i>Don't know how/where to start.</h4>
                        <h4><i data-feather="check" class="mr-2"></i>Don't know how to promote your vision.</h4>
                        <br>
                        <h4>We can give you a hand with that!</h4>
                        <div class="row">
                            <a href="{{asset("teach")}}" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto " type="button">
                                <span class="mx-3">Let's talk!</span>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>



    <!-- ============== END ================== Sign up instructor =============== END ================== -->
    <div class="faq row justify-content-center align-items-center py-3">
        <a class="text-center" href="#">FAQ?</a>
    </div>

    <section class="testimonials my-5 py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 mx-auto pl-5">
                <div class="container">
                <h1>Hey, you help us too.</h1>
                <br>
                <h4>We really appreciate your feedback. Don't hesitate to let us know what you think, it really helps.</h4>
                <br>
                <div class="row">
                    <button class="btn btn-veedros-new btn-veedros-md border-0 mx-auto " type="button">
                        <span class="mx-3">Give us a review</span>
                    </button>
                </div>
                </div>
            </div>
            <div class="col-lg-8">
                <section class="carousel">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="review-carousel owl-carousel owl-theme w-100">
                                @for($i = 0; $i<5; $i++)
                                <div class="carousel-column">
                                    @for($j = 0; $j<2; $j++)
                                        <div class="review p-3 mx-2 my-4 ">
                                        <div class="user-info row py-3">
                                        <div class="tip-instructor-avatar col-lg-2 ml-4 ">
                                            <img src="{{asset('images')}}/05.jpg" alt="" class="round">
                                        </div>
                                            <div class="rating-container ml-2 col-lg-8 d-flex flex-column justify-content-center">
                                                <h6 class="m-0">Ahmed Zakii</h6>
                                                <div class="d-flex ratings col-6 px-0 m-0">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                    <img src="{{asset('images/Icons')}}/Star.svg" alt="star">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequatur ea et, expedita facilis inventore labore molestias officia praesentium quasi qui quidem repellat repellendus rerum sapiente sequi soluta totam voluptas.</div>
                                    </div>
                                    @endfor
                                </div>
                                @endfor







                            </div>
                        </div>

                    </div>
                    <!-- style="background-image: url('images/01.png')" -->

                </section>
            </div>
        </div>
    </section>
    <!-- =====================================  instructor carousel ===================================== -->

    <!-- =============== END ===============  instructor carousel ======== END ========---========== -->

    <section class="academies">
        <div class="container h-100">
            <div class="d-flex justify-content-center align-items-center flex-column h-100 w-100">
                <h1 class="text-center">We help Academies to expand online</h1>
                <br>
                <h4 class="text-center">We can help you reach a broader audience and increase your passive income.</h4>
                <br>
                <div class="row">
                    <a href="{{asset('academic')}}" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto " type="button">
                        <span class="mx-3">Let's talk</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('libraryJS')
    <!-- Owl js -->
    <script src="owlCarousel/js/owl.carousel.min.js"></script>
@endsection

@section('customJS')
    <script src="scripts/landing.js"></script>
@endsection

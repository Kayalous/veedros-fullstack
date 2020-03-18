@extends('layout')

@section('libraryCSS')
    <!-- Owl CSS  -->
    <link rel="stylesheet" href="owlCarousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="owlCarousel/css/owl.theme.default.min.css" />
    <!-- Wow.js CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
@endsection

@section('content')
    <div class="slash slash-to-right"></div>

    <!-- Hero  -->
    <section class="hero">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 hero-header-text ">
                    <h1 class="d-lg-block d-none wow fadeInUp">
                        Learning <br />
                        has never been so easy.
                    </h1>
                    @if(!Auth::check())
                    <div class="input-group signup-field mr-auto wow fadeInUp" data-wow-delay="0.2s">
                        <input type="email" size="5" class="form-control email-input email-field-props border-0"
                               placeholder="Enter your email" />
                        <div class="btn-container email-field-props">
                            <button class="btn btn-veedros btn-veedros-inline-input border-0" type="button">
                                Get started
                            </button>
                        </div>
                    </div>
                    @endif
                    <a href="#featured-courses" class="btn btn-veedros btn-veedros-round border-0 mt-5 wow fadeInUp"
                       data-wow-delay="0.6s">
                        <img class="img-fluid" style="width: 20px;" src="images/down_arrow.svg" alt="">
                    </a>
                </div>
                <div class="col-lg-6 hero-illustrations mx-auto">
                    <h1 class="d-lg-none d-block text-center wow fadeInUp">
                        Learning
                        has never been so easy.
                    </h1>

                    <div class="illustration-container illustration-container-lg d-md-flex-center wow fadeInUp"
                         data-wow-delay="0.2s">
                        <canvas id="blob"> </canvas>
                        <img src="images/hero-01-withoutbg.png" alt=""
                             class="img-fluid illustration illustration-lg illustration-anim-1" />
                    </div>
                    <div class="row w-100 d-md-flex-center">
                        <div class="illustration-container illustration-container-sm  wow fadeInUp" data-wow-delay="0.4s">
                            <canvas id="blob2" class="blob-position-md "> </canvas>
                            <img src="images/hero-02-withoutbg.png" alt=""
                                 class="img-fluid illustration illustration-md illustration-position-md illustration-anim-2" />
                        </div>
                        <div class="illustration-container col-4 illustration-container-sm mt-illustration  wow fadeInUp"
                             data-wow-delay="0.6s">
                            <canvas id="blob3"> </canvas>
                            <img src="images/hero-03.png" alt=""
                                 class="img-fluid illustration illustration-sm illustration-position-sm illustration-anim-3" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Featured courses  -->
    <section class="featured-courses my-5 pt-5" id="featured-courses">
        <div class="container container-mine pt-3">
            <div class="row">
                <div class="header-text mb-2 wow fadeInUp">
                    <h1>
                        A powerful set of courses<br />
                        presented to you.
                    </h1>
                </div>
                <div class="col-12">
                    <div class="course-cards-container card-columns my-5 py-3">
                        @foreach($courses as $course)
                            <div class="card course-card development-card noJquery" style="background-image: url({{asset('/uploads/courses/1/pokemon-td8v2/images/1584209495.png')}})">
{{--                                . $course->instructor_id . '/' . $course->slug . '/images/' . $course->img--}}
                                 <div class="course-card-overlay overlay-1 w-100"></div>
                                 <div class="card-body m-0">
                                       <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img"  >
                                             <div class="play-circle play-circle-1"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""/> </div>
                                             <h4 class="card-title title-mine w-100">
                                                   {{$course->slug}}
                                                 </h4>
                                           </a>
                                     </div>
                                 </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-veedros btn-veedros-lg border-0 mx-auto wow fadeInUp" type="button">
                    More courses.
                </button>
            </div>
        </div>
    </section>

    <!-- ===================================== Sign up instructor ===================================== -->


    <div class="Instructor-slash Instructor-slash-to-right"></div>
    <div class=" Instructor_join">
        <div class="container">
            <div class=" row mb-5">
                <div class="col-xl-6 col-12 Instructor-text ">
                    <h1 class="wow fadeInUp">
                        Have content? <br>
                        Don't hesitate to join us!
                    </h1>
                    <p class="p-d-none wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet, pede suspendisse vivamus quis voluptas excepturi,
                        quisque pede est neque class rhoncus,
                        neque sollicitudin etiam felis elementum cras eu, varius eros at, mauris dictum tempus. Nec consectetuer</p>
                </div>
                <div class="col-xl-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="py-4 img-fluid-mine" src="images/sector_2_hero.png">
                </div>
            </div>
            <div class="col-lg-6 m-auto">
                <div class="input-group signup-field mr-auto wow fadeInUp" data-wow-delay="0.4s"
                     style="visibility: visible; animation-delay: 0.2s; opacity: 1;">
                    <input type="email" size="5" class="form-control email-input email-field-props border-0"
                           placeholder="Enter your email">
                    <div class="btn-container email-field-props">
                        <button class="btn btn-veedros btn-veedros-inline-input border-0" type="button" data-toggle="modal"
                                data-target="#signupModal">
                            Join us
                        </button>
                    </div>
                </div>
            </div>

        </div>



    </div>

    <!-- ============== END ================== Sign up instructor =============== END ================== -->

    <!-- =====================================  instructor carousel ===================================== -->
    <section class="carousel mb-5">
        <div class="container">
            <div class="row wow carousel-header ml-5 mb-4 fadeInUp">
                <h1>Meet our heroes</h1>
            </div>
            <div class="row wow fadeIn" data-wow-delay="0.6s">
                <div class="owl-carousel owl-theme contener_general">

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/01.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-0"></div>
                    </div>

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/02.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-1"></div>
                    </div>

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/04.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-2"></div>
                    </div>

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/05.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-3"></div>
                    </div>

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/07.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-4"></div>
                    </div>

                    <div class=" carreaux_presentation_light carousel-card" style="background-image:url(images/07.jpg)">
                        <div class="sliding-info">
                            <div class="deroul_left">Ahmed saad</div>
                            <div class="deroul_right">Weed development</div>
                        </div>
                        <div class="carousel-card-overlay overlay-5"></div>
                    </div>

                </div>
            </div>

        </div>
        <!-- style="background-image: url('images/01.png')" -->

    </section>
    <!-- =============== END ===============  instructor carousel ======== END ========---========== -->

@endsection

@section('libraryJS')
    <!-- paper js  -->
    <script src="node_modules/paper/dist/paper-full.js"></script>
    <!-- Owl js -->
    <script src="owlCarousel/js/owl.carousel.min.js"></script>
    <!-- Wow.js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
@endsection

@section('customJS')
    <script src="scripts/landing.js"></script>

@endsection

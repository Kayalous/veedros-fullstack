@extends('layout')

@section('libraryCSS')
    <!-- Owl CSS  -->
    <link rel="stylesheet" href="owlCarousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="owlCarousel/css/owl.theme.default.min.css" />
@endsection

@section('content')
    <div class="anti-lo2">
    <section class="py-5 overflow-hidden hero">
        <div class="container my-5 mt-5">
            <div class="row ">
                <div class="col-lg-6 hero-header-text ">
                    <h1 class="mb-3">
                        Learn, easily
                    </h1>

                    <p style="color: #4C616B;">With Veedros learning's as easy as it gets.</p>

                    <a href="#featured-courses" class="mt-5 mr-auto border-0 btn btn-veedros-new btn-veedros-md">
                       <span>Explore now</span>
                    </a>

                </div>
                <div class="mx-auto col-lg-6 hero-illustrations">
                    <div class="illustration-container illustration-container-lg d-md-flex-center "
                         >
                        <canvas id="blob"> </canvas>
                        <img src="/images/hero-01-withoutbg.png" alt=""
                             class="img-fluid illustration illustration-lg illustration-anim-1" />
                    </div>
                    <div class="row w-100 d-md-flex-center">
                        <div class="illustration-container illustration-container-sm " data-wow-delay="0.4s">
                            <canvas id="blob2" class="blob-position-md "> </canvas>
                            <img src="/images/hero-02-withoutbg.png" alt=""
                                 class="img-fluid illustration illustration-md illustration-position-md illustration-anim-2" />
                        </div>
                        <div class="illustration-container col-4 illustration-container-sm mt-illustration "
                             data-wow-delay="0.6s">
                            <canvas id="blob3"> </canvas>
                            <img src="/images/hero-03.png" alt=""
                                 class="img-fluid illustration illustration-sm illustration-position-sm illustration-anim-3" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="mb-3 partners-logo">

    <div class="py-3 row justify-content-center">
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/ACCA.png" alt="ACCA">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/DME.png" alt="DME">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/edexcel.png" alt="edexcel">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/Northampton.png" alt="Northampton">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/OTRAC.png" alt="OTRAC">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/Pearson.png" alt="Pearson">
            </div>
            <div class="col-lg-1 col-md-2 col-sm-3 col-5">
                <img class="" src="/images/partners/Trade.png" alt="Trade">
            </div>

        </div>
    </section>
    <section class="happy-users">
        <div>
            <h1 class="mb-0 text-center">6K<span>+</span></h1>
            <h2 class="mt-0 text-center">Happy students</h2>
        </div>
    </section>
    <section class="pb-5 mb-5 featured-courses" style="overflow-y: visible" id="featured-courses">
        <div class="container pt-3 container-mine">
            <div class="row">
                <div class="mb-2 header-text d-block ">
                    <h4 style="color: #4C616B;"> A powerful</h4>
                    <h1>
                        set of courses
                    </h1>
                    <h4 style="color: #4C616B;">that will change your career.</h4>
                </div>
                <script>
                    var instructors = [];
                    var recommendations = [];
                </script>
                <div class="col-12">
                    <div class="py-3 my-5 course-cards-container card-columns">
                        @foreach($courses as $course)
                            <div class="card course-card development-card noJquery a{{$loop->index}}" style="background-image: url({{$course->img}});">
                                 <div class="m-0 card-body">
                                       <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img"  >
                                             <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""/> </div>
                                             <h4 class="card-title title-mine w-100">
                                                   {{$course->name}}
                                                 </h4>
                                           </a>
                                     </div>
                                 </div>
                            <script>
                                instructors.push({!! json_encode($course->instructor->user->toArray()) !!});
                                recommendations.push({!! json_encode($course->recommendations->toArray()) !!})
                            </script>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="courses/" class="mx-auto border-0 btn btn-veedros-new btn-veedros-md">
                    <span >All courses</span>
                </a>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <div class="row">
            <div class="px-0 m-0 overflow-hidden col-lg-6 teach-img">
{{--                <img class="teach-img" src="{{asset('images/')}}/Teach-960x775.jpg" alt="Teach with us image">--}}
            </div>
            <div class="py-5 m-0 col-lg-6 teach-with-us-container d-flex flex-column justify-content-center align-items-center">
                <div class="teach-with-us-content">
                    <div class="container">
                        <h1>Have <br> content?</h1>
                        <br>
                        <h2>If you...</h2>
                        <h4><img class="mr-2 " src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how to organize your content.</h4>
                        <h4><img class="mr-2 " src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how/where to start.</h4>
                        <h4><img class="mr-2 " src="{{('images/Icons/Correct.svg')}}" alt="">Don't know how to promote your vision.</h4>
                        <br>
                        <h4>We can give you a hand with that!</h4>
                        <div class="mt-5 row">
                            <a href="{{asset("teach")}}" class="border-0 btn btn-veedros-new btn-veedros-md ">
                                <span class="mx-3">Okay, Let's talk!</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 our_services">
            <div class="container">
                <div class="my-5 row d-block">
                    <h1>Get a team of experts</h1>
                    <p>looking out for your content</p>
                </div>
                <div class="row ">
                    <div class="my-3 col-12 col-md-4">
                        <div class="content">
                            <div class="card d-inline-block">
                                <div>
                                    <img src="{{('images/our_services/icon_features_hosting.svg')}}" alt="">
                                </div>
                                <div class="my-3 content-header">
                                    <h4>Seamless hosting</h4>
                                </div>
                                <div class="description ">
                                    <p>Veedros hosts your course content for you and backs up
                                         student data so you don't have to worry about it.</p>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="my-3 col-12 col-md-4 ">
                        <div class="content">
                            <div class="card d-inline-block">
                            <ul>
                                <li>
                                    <img src="{{('images/our_services/icon_features_data.svg')}}" alt="">
                                </li>
                                <li class="my-3 content-header">
                                    <h4>Data ownership</h4>
                                </li>
                                <li class="description ">
                                    <p>You own and control all of the content and
                                         data on your Veedros account.</p>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 col-12 col-md-4 ">
                        <div class="content">
                        <div class="card d-inline-block">
                            <ul>
                                <li>
                                    <img src="{{('images/our_services/icon_features_marketing.svg')}}" alt="">
                                </li>
                                <li class="my-3 content-header">
                                    <h4>24/7 monitoring</h4>
                                </li>
                                <li class="description ">
                                    <p>We work around the clock to fix issues as they arise
                                         and make sure your virtual school doors stay open.</p>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 col-12 col-md-4 ">
                        <div class="content">
                        <div class="card d-inline-block">
                            <ul>
                                <li>
                                    <img src="{{('images/our_services/icon_features_upgrades.svg')}}" alt="">
                                </li>
                                <li class="my-3 content-header">
                                    <h4>Instant upgrades</h4>
                                </li>
                                <li class="description ">
                                    <p>Automatically receive the latest features immediately,
                                         without having to manually update.</p>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 col-12 col-md-4 ">
                        <div class="content">
                        <div class="card d-inline-block">
                            <ul>
                                <li>
                                    <img src="{{('images/our_services/icon_features_payments.svg')}}" alt="">
                                </li>
                                <li class="my-3 content-header">
                                    <h4>Secured payment data</h4>
                                </li>
                                <li class="description ">
                                    <p>We only work with trusted payment organizations,
                                        so your and your users' data is safe and secure.</p>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    <section class="py-5 my-5 testimonials">
        <div class="row justify-content-center align-items-center">
            <div class="pl-5 mx-auto col-lg-4">
                <div class="container">
                <h1>Hey, you <br> help us<br>too.</h1>
                <br>
                <h4>We really appreciate your feedback. Don't hesitate to let us know what you think, it really helps.</h4>
                <br>
                <div class="row bt-5">
                <a class="border-0 btn btn-veedros-new btn-veedros-md" data-toggle="modal" data-target="#rateModal"
                       >
                       <span class="text-white">Give us a review</span>
                    </a>
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
                                        <div class="p-3 mx-2 my-4 review ">
                                        <div class="py-3 user-info row">
                                        <div class="ml-4 tip-instructor-avatar col-lg-2 ">
                                            <img src="/images/05.jpg" alt="" class="round">
                                        </div>
                                            <div class="ml-2 rating-container col-lg-8 d-flex flex-column justify-content-center">
                                                <h6 class="m-0">Ahmed Zakii</h6>
                                                <div class="px-0 m-0 d-flex ratings col-6">
                                                    <img src="/images/Icons/Star.svg" alt="star">
                                                    <img src="/images/Icons/Star.svg" alt="star">
                                                    <img src="/images/Icons/Star.svg" alt="star">
                                                    <img src="/images/Icons/Star.svg" alt="star">
                                                    <img src="/images/Icons/Star.svg" alt="star">
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
    <section class="academies">
        <div class="container h-100">
            <div class="my-5 d-flex justify-content-center align-items-center flex-column h-50 w-100">
                <h1 class="text-center">We help Academies to expand online</h1>
                <br>
                <h4 class="text-center ">We can help you reach a broader audience and increase your passive income.</h4>
                <br>
                <div class="row">
                    <a href="{{asset('academic')}}" class="mx-auto border-0 btn btn-veedros btn-veedros-md ">
                        <span class="mx-3">Let's help you</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('libraryJS')
    <!-- Owl js -->
    <script src="owlCarousel/js/owl.carousel.min.js"></script>
@endsection

@section('customJS')
    <script>
        let courses = {!! json_encode($courses->toArray()) !!};
    </script>
    <script src="{{asset('scripts')}}/landing.js"></script>
    <script src="{{asset('scripts')}}/course-tooltips.js"></script>
@endsection

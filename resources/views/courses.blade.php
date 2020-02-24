@extends('layout')


@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection


@section('content')
<section class="my-5">
    <div class="container">
        <h1>
            Hey, {{Auth::user()->name}}!
        </h1>
        <h2>Here are your current courses:</h2>
        <div class="row">
            <div class="col-12">
                <div class="course-cards-container card-columns my-5 py-3">
                    <div class="card course-card development-card noJquery"
                         style="background-image: url('{{asset('images')}}/img_01.png')">
                    <div class="course-card-overlay overlay-0"></div>
                    <div class="card-body m-0">
                        <a href="player.html" class="card-body-inner noscroll card-bg-img"  >
                            <div class="play-circle play-circle-0"> <i data-feather="edit"></i> </div>
                            <h4 class="card-title title-mine">
                                Full Stack Web Development
                            </h4>
                        </a>
                    </div>
                </div>
                        <div class="card course-card development-card noJquery">
                            <div class="card-body m-0">
                                <a href="{{route('')}}" class="card-body-inner noscroll card-bg-img"  >
                                    <div class="play-circle play-circle-05"> <i data-feather="plus"></i></div>
                                    <h4 class="card-title title-mine">
                                        Create a new course.
                                    </h4>
                                </a>
                            </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

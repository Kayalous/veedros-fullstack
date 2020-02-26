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
                <div class="course-cards-container row my-5 py-3">
                    @foreach(Auth::user()->instructor->courses as $course)
                        <div class="col-lg-4">

                    <div class="card course-card development-card noJquery"
                         style="background-image: url('{{asset('uploads/courses'). '/' . Auth::user()->id .'/' . $course->slug . '/images/' . $course->img}}')">
                    <div class="card-body m-0">
                        <a href="{{asset('/manage/instructor/courses/') ."/" . $course->slug}}" class="card-body-inner noscroll card-bg-img"  >
                            <div class="play-circle play-circle-0"> <i data-feather="edit"></i> </div>
                            <h4 class="card-title title-mine">
                                {{$course->name}}
                            </h4>
                        </a>
                    </div>
                </div>
                        </div>
                    @endforeach
                    <div class="w-100">
                        <div class="card course-card development-card noJquery mx-auto">
                            <div class="card-body m-0">
                                <a href="{{route('manage.courses.new')}}" class="card-body-inner noscroll card-bg-img"  >
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
    </div>
</section>
@endsection

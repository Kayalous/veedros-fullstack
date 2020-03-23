@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection


@section('content')


    <div class="Courses-header">
        <div class="content px-3">
            <h1>Build/Change</h1>
            <h1>Your career</h1>
            <br>
            <p>A set of courses that will change your life and career.</p>
        </div>
    </div>
    <!-- courses -->
    <section class="my-5">
        <div class="container">

            <div class="card-columns">
                @foreach($courses as $course)
                <div class="card-kmine">
                    <div class="card course-card development-card noJquery" style="background-image: url({{asset('/uploads/courses/1/pokemon-td8v2/images/1584209495.png')}})">
                        {{--                                . $course->instructor_id . '/' . $course->slug . '/images/' . $course->img--}}
                        <div class="card-body m-0">
                            <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img"  >
                                <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="{{asset("images")}}/Play_button.svg" alt=""/> </div>
                                <h4 class="card-title title-mine w-100">
                                    {{$course->name}}
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>

            {!! $courses->render() !!}

        </div>
    </section>

@endsection
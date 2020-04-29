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
            <div class="btn-search-veedros-sm w-75 m-auto ">
                <form method="GET" action="{{route('search')}}">
                    <input class=" form-control profile-form-field email-field-props border-light border-radius-sm" name="q" placeholder="Search" type="text">
                    <button class="btn-search-sm border-0">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- courses -->
    <section class="my-5">
        <div class="container">

            <div class="card-columns">
                @foreach($courses as $course)
                    <div class="card course-card development-card noJquery" style="background-image: url({{$course->img}})">
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
                    @endforeach
            </div>

            {!! $courses->render() !!}

        </div>
    </section>

@endsection

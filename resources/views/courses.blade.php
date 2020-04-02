@extends('layout')


@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection


@section('content')

<section class="my-5 py-5">
<div class="container">
    <table class="w-75 m-auto">
  <tr>
    <th>Num of courses</th>
    <th>Total veiws</th>
    <th>Total profit</th>
  </tr>
  <tr>
    <td>2</td>
    <td>780</td>
    <td>750 EGP</td>
  </tr>
</div>
    <div class="container">
        <h1>
            Hey, {{explode(' ',Auth::user()->name)[0]}}!
        </h1>
        <div class="w-100 my-5">
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
        @if(Auth::user()->instructor->courses->count() > 0)
            <h2 class="mb-2">Here are your current courses:</h2>
            <div class="row">
                <div class="col-12">
                    <div class="course-cards-container row py-3">
                        @foreach(Auth::user()->instructor->courses as $course)
                            <div class="col-lg-4">

                                <div class="card course-card development-card noJquery"
                                     style="background-image: url('{{$course->img}}')">
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
                    </div>
                </div>
            </div>
        @endif

        </div>

</section>
@endsection

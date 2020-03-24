@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
@endsection
@section('content')
    <div class="new-bg"></div>

    <!-- Profile  -->
    <section class="profile my-5 py-5" @if(!$user->instructor)style="height: 100vh"@endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <div class="card profile-card py-5">
    @if($user == Auth::user())
    <a href="{{route('manage')}}"
       class="btn btn-secondary-veedros border-medium edit-btn mr-4 mt-4"><i
            data-feather="edit"></i>
        Edit</a>
        @endif
    <div class="card-body">

        <div class="mx-auto text-center">
            <div class="instructor-img-wrapper mx-auto">
                <img src="{{asset('uploads/profilePictures/'). '/' .$user->img}}" alt="profile image" class="round-lg mx-auto img-fluid"/>
            </div>
            @if($user->name != null)
            <h1 class="mt-3">{{$user->name}}</h1>
            @endif()
            @if($user->position != null)
                <h5>{{$user->position}}</h5>
            @endif()
            @if($user->location != null)
            <h6><img class="mr-2" src="{{asset('images/Icons')}}/Location.svg" alt="">{{$user->location}}</h6>
            @endif
            @if($user->about != null)
            <div class="container mx-2">
                <h5>{{$user->about}}</h5>
            </div>
            @endif

            @if($user->twitter != null || $user->facebook != null || $user->linkedin != null)
            @endif
            <div class="d-flex justify-content-center align-items-center">
                @if($user->twitter != null)
                    <a target="_blank" rel="noopener" href="//{{$user->twitter}}">
                        <h1><img src="{{asset('images/Icons')}}/twitter.svg"></h1>
                    </a>
                @endif
                @if($user->facebook != null)
                    <a target="_blank" rel="noopener" href="//{{$user->facebook}}">
                        <h1><img src="{{asset('images/Icons')}}/facebook.svg"></h1>
                    </a>
                @endif
                @if($user->linkedin != null)
                    <a target="_blank" rel="noopener" href="//{{$user->linkedin}}">
                        <h1><img src="{{asset('images/Icons')}}/LinkedIn.svg"></h1>
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</section>

    @if($user->instructor)
<section class="featured courses mt-5 pt-5">

<div class="container container-mine">
<div class="row">
<div class="header-text ml-5">
<h3>
    Courses by this instructor
</h3>
</div>
<div class="col-12">
<div class="course-cards-container card-columns mb-5 py-3">
    @foreach($courses as $course)
        <div class="card course-card development-card noJquery" style="background-image: url({{asset('/uploads/courses/1/pokemon-td8v2/images/1584209495.png')}})">
            {{--                                . $course->instructor_id . '/' . $course->slug . '/images/' . $course->img--}}
            <div class="card-body m-0">
                <a href="{{\App\Course::getFirstSession($course)}}" class="card-body-inner noscroll card-bg-img"  >
                    <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="{{asset('images')}}/Play_button.svg" alt=""/> </div>
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
</div>
</section>
@endif
@endsection

@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/profile.css')}}">
    <link rel="stylesheet" href="{{asset('styles/search.css')}}">
    <link rel="stylesheet" href="{{asset('styles')}}/404.css" />
@endsection
@section('content')
    <div class="new-bg" style="z-index: -1"></div>
    <div class="container my-5 py-5">
        <div class="btn-search-veedros-sm w-75 m-auto ">
        <form action="" method="get">
            <input class=" form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Search" type="text" name="q">
            <button class="btn-redeem-icon btn-redeem-icon-lg border-0" type="submit">
            <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        </div>
        @if($results)
            @if($results->count() > 0)
                @foreach($results as $result)
                @if($result instanceof \App\Session)
                        <div class="row shadow-lg my-5 rounded-lg bg-white py-2">
                                    <div class="col-lg-4 col-12">
                                    <div class="card course-card development-card noJquery" style="background-image: url({{$result->chapter->course->img}})">

                                        <div class="card-body m-0">
                                            <a href="{{$result->getLink()}}" class="card-body-inner noscroll card-bg-img">
                                                <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""> </div>
                                            </a>
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-lg-8 col-12">
                                    <div class="container">
                                        <div class="w-100 mt-5">
                                            <a href="{{$result->getLink()}}" class="p-title">{{$result->name}}</a>
                                            <p class="p-description d-none-mine">{{$result->about}}</p>
                                        </div>
                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                                            <a href="{{\App\Course::getFirstSession($result->chapter->course)}}" class="btn btn-veedros btn-veedros-md border-0 ml-auto ">
                                                Watch from the start
                                            </a>
                                        </div>
                                </div>
                            </div>
                        </div>

                @endif

                @if($result instanceof \App\Course)
                        <div class="row shadow-lg my-5 rounded-lg bg-white py-2">
                            <div class="col-lg-4 col-12">
                                <div class="card course-card development-card noJquery" style="background-image: url({{$result->img}})">

                                    <div class="card-body m-0">
                                        <a href="{{\App\Course::getFirstSession($result)}}" class="card-body-inner noscroll card-bg-img">
                                            <div class="play-circle play-circle-{{$loop->iteration % 6}}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""> </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="container">
                                    <div class="w-100 mt-5">
                                        <a href="{{\App\Course::getFirstSession($result)}}" class="p-title">{{$result->name}}</a>
                                        <p class="p-description d-none-mine">{{$result->about}}</p>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                                        <a href="{{\App\Course::getFirstSession($result)}}" class="btn btn-veedros btn-veedros-md border-0 ml-auto ">
                                            Watch from the start
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @endforeach
                {{ $results->links() }}
            @else
                <section class="my-5 py-5">
                        <div class="row">
                            <div class="col-lg-6 position-relative error-text text-center d-flex justify-content-center align-items-center flex-column">
                                <h1 class="text-muted" style="font-size: 72px; font-weight: 700">No results were found.</h1>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block">
                                <img class="img-fluid" src="{{asset('images')}}/error.png" alt="Error image">
                            </div>
                        </div>
                        <div class="row mt-5 justify-content-center align-items-center">
                            <a href="{{asset("/courses")}}" class="btn btn-veedros-new btn-veedros-md border-0 my-1"
                               type="button">
                                <span>Show all courses</span>

                            </a>
                        </div>
                </section>
            @endif
        @endif
    </div>




@endsection

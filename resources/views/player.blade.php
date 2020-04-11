@extends('layout')

@section('libraryCSS')
     <!-- video js CSS  -->
{{--    <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />--}}
     <link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
    <link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">

@endsection
@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/player.css">
    <link rel="stylesheet" href="{{asset('styles')}}/profile.css">
@endsection
@section('content')
    <div class="new-bg"></div>
    <section class="player-container my-5 pt-5 px-3">
        <div class="video-wrapper my-auto">
            <video id="player" class="" controls preload="auto"
                   width="640" height="264"
                   controls data-plyr-config="{ 'settings': '['captions', 'quality', 'speed', 'loop']' }">
                <source src="{{$controllerSession->video->link_720}}" type="video/mp4" size="720" default>
                <source src="{{$controllerSession->video->link_480}}" type="video/mp4" size="480">
                <source src="{{$controllerSession->video->link_360}}" type="video/mp4" size="360">
            </video>
        </div>
        <section class="sidebar ml-3 py-3 px-2">
            <div class="sidebar-wrapper">
                <h5 class="ml-5">{{\App\Course::getTotalSessionCount($controllerCourse)}} Sessions ({{$controllerCourse->duration}})</h5>
                <div class="list-group">
                    @for($i = 0; $i < count($controllerCourse->chapters); $i++)
                    <button class="list-group-item collapse-button mx-auto {{($controllerCourse->chapters[$i]->slug === $controllerChapter->slug)? 'watching ' : ''}}" aria-expanded="{{($controllerCourse->chapters[$i]->slug === $controllerChapter->slug)? "true" : "false"}}" data-toggle="collapse"
                            href="#collapse{{$i}}" title="{{$controllerCourse->chapters[$i]->name}}" >
                        <span>Chapter {{$i + 1}} </span>
                        <div class="vertical-seperator"></div>
                        <span class="chapter-name">
                        {{$controllerCourse->chapters[$i]->name}}
                        </span>
                        <div class="chevron"><i data-feather="chevron-down"></i></div>
                    </button>
                    <div class="list-group collapse my-2 {{($controllerCourse->chapters[$i]->slug === $controllerChapter->slug)? 'show' : ''}}" id="collapse{{$i}}">
                        @foreach($controllerCourse->chapters[$i]->sessions as $session)
                        <a href="{{asset('watch/') . '/' . $instructor->display_name . '/' . $session->chapter->course->slug . "/" . $session->chapter->slug . '/' . $session->slug}}" class="list-group-item list-group-item-action
                        {{ ( Request::url() === asset('watch/') . '/' . $instructor->display_name . '/' . $session->chapter->course->slug . "/" . $session->chapter->slug . '/' . $session->slug) ? 'active' : '' }}
                            ">
                            <span>
                                @if(Auth::user())
                                    @if($loop->iteration <= 3 && $i === 0 || Auth::user()->isEnrolledInCourse($controllerCourse))
                                        <img class="mr-2" src="{{asset('images/Icons')}}/VideoPlay.svg" alt="Play icon">
                                    @else
                                        <img class="mr-2" src="{{asset('images/Icons')}}/VideoLock.svg" alt="Lock icon">
                                    @endif
                                @else
                                    @if($loop->iteration <= 3 && $i === 0)
                                        <img class="mr-2" src="{{asset('images/Icons')}}/VideoPlay.svg" alt="Play icon">

                                    @else
                                        <img class="mr-2" src="{{asset('images/Icons')}}/VideoLock.svg" alt="Lock icon">

                                    @endif
                                @endif
                                    {{$session->name}}
                            </span>
                            <span class="duration">{{$session->video->duration}}</span>
                        </a>
                        @endforeach
                    </div>
                    @endfor
                </div>
            </div>
        </section>
    </section>
    <section class="container" id="course-info">
        <hr class="mb-5 d-md-block d-none" />
        <div>
            <div class="row flex-column-reverse-mine">
                <div class="col-xl-8 col-lg-7 seperator-right">
                    @if(!$controllerSession->isFirstSession())
                    <h2>About this course</h2>
                    <h5>
                        {{$controllerCourse->about}}
                    </h5>
                    <br>
                    <h2>You will learn</h2>
                    <ul class="ml-5">
                        @foreach($controllerCourse->objectives as $objective)
                        <li>
                            <h5><i data-feather="check" class="mr-3"></i>{{$objective->objective}}</h5>
                        </li>
                        @endforeach
                    </ul>
                    <br>
                    <h2>Recommended to</h2>
                    <ul class="ml-5">
                        @foreach($controllerCourse->recommendations as $rec)
                        <li>
                            <h5><i data-feather="circle" style="color: #65D3BF; fill: currentColor; width: 22px; height: 22px" class="mr-3"></i>{{$rec->recommendation}}</h5>
                        </li>
                        @endforeach
                    </ul>
                    <br>
                    <div class="row w-md-100 w-75 mx-auto">
                        <div class="col-6">
                            <div class="badge tip-badge py-1">
                                <h4 class="badge-item">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>{{$controllerCourse->price}} EGP</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="badge tip-badge py-1">
                                <h4 class="badge-item">
                                    <i class="far fa-clock"></i>
                                    <span>{{$controllerCourse->hoursOnly()}}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>


                    @else
                        <h2>Session Milestones</h2>
                        <ul class="ml-5 mt-3">
                            @foreach($controllerSession->objectives as $objective)
                            <li class="row mt-3">
                                <div class="col-1">
                                    <i data-feather="check"></i>
                                </div>
                                <div class="col-11 pr-5">
                                    <h5>
                                        {{$objective->title}}
                                    </h5>
                                    <h6>
                                        {{$objective->objective}}
                                    </h6>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="w-100 text-center my-5 mx-auto">
                            <button class="btn btn-veedros btn-veedros-xxl btn-veedros-alt-white border-0">
                                Download session attachments<i data-feather="download"></i></button>
                        </div>

                    @endif
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class=" d-lg-block d-md-flex flex-reverse-mine w-100 ">

                        <div class=" mb-lg-4 mr-lg-5-mine pt-5">
                            <div class="row">
                                    <div class="col-6">
                                    <label class="menu-text" for="menu-btn">
                                                        <p class="btn btn-veedros-new btn-veedros-small border-0 text-white mb-0">Share <img class="ml-2" src="{{asset('images/Icons')}}/share.svg" alt="Save icon"></p>
                                    </label>
                                    </div>
                                <div class="col-6">
                                    <a href="{{asset('save') . '/' . $controllerCourse->id}}" class="btn btn-veedros btn-veedros-small border-0 py-3">
                                        @if(!Auth::user())
                                            Save <img class="ml-2" src="{{asset('images/Icons')}}/saved.svg" alt="Save icon">
                                        @else
                                            @if(!Auth::user()->hasSavedThisCourse($controllerCourse))
                                                Save <img class="ml-2" src="{{asset('images/Icons')}}/saved.svg" alt="Save icon">
                                            @else
                                                Saved <i class="ml-2" data-feather="check"></i>
                                            @endif
                                        @endif
                                    </a>
                                </div>
                                </div>
                                <div class="row justify-content-center">
                                            <div class=" share-menu w-80 mx-auto">
                                        <input class="menu-btn " type="checkbox" id="menu-btn" />

                                                <div class="menu my-3">

                                                                <div class="sharethis-inline-share-buttons w-100"
                                                    data-url=""
                                                    data-title=""
                                                    data-image=""
                                                    data-description=""
                                                    data-message=""
                                                    ></div>


                                                </div>
                                        </div>
                                </div>

                            <hr class="d-md-none mt-5">



                        </div>

                        <div class="ml-lg-5-mine">

                            <h2 class="ml-5">Author</h2>
                            <div class="mx-3 mt-3">
                                <div
                                    class="row box-shadow-md py-3 pl-4 pr-5 border-radius-md">
                                    <div class="col-8">
                                        <div class="tip-instructor h-100">
                                            <div class="h-100">
                                                <h5 style="line-height: 1">
                                                    <b>{{$instructor->user->name}}</b>
                                                    <br />
                                                    <span>{{$instructor->user->position}}</span>
                                                    <br />
                                                </h5>
                                                <a href="{{route('profile') . '/' . $instructor->user->id}}"
                                                   class="btn btn-veedros-new btn-veedros-sm border-0 mt-auto">
                                                    Visit profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tip-instructor-avatar col-4">
                                        <img src="{{$instructor->user->img}}"
                                             alt="instructor"
                                             class="round" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr class="d-lg-none mt-5">
                    <br>

                    <div class="d-none d-lg-block">
                        <section class="happy-users my-3">
                            <div>
                                <h1 class="text-center mb-0">500<span>+</span></h1>
                                <h2 class="mt-0">Happy students</h2>
                            </div>
                        </section>
                        <div class="text-center">
                            <button class="btn btn-veedros-new btn-veedros-md border-0 py-2 mx-auto">
                                Explore more</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-lg-none d-block mx-auto mb-5 w-100">

                <section class="happy-users my-3">
                    <div>
                        <h1 class="text-center mb-0">500<span>+</span></h1>
                        <h2 class="mt-0">Happy students</h2>
                    </div>
                </section>
                <div class="text-center">
                    <button class="btn btn-veedros-new btn-veedros-md border-0 py-2 mx-auto">
                        Explore more</button>
                </div>
            </div>
            @if(Auth::user())
                @if(!Auth::user()->isEnrolledInCourse($controllerCourse))
                    <br>
                    <div class="w-100 text-center my-5">
                        <a href="{{asset('enroll/') . '/' . $controllerCourse->id}}" class="btn btn-veedros-new btn-veedros-xl border-0">
                            Enroll now<i data-feather="shopping-cart" class="ml-3"></i></a>
                    </div>
                @endif
            @else
                <br>
                <div class="w-100 text-center my-5">
                    <a href="{{asset('enroll/') . '/' . $controllerCourse->id}}" class="btn btn-veedros-new btn-veedros-xl border-0">
                        Enroll now<i data-feather="shopping-cart" class="ml-3"></i></a>
                </div>
            @endif

        </div>
        @if($controllerSession->isFirstSession())
        <br>
        <h2 class="mt-5">Leave a comment</h2>
        <form action="{{asset("/comment")}}" method="POST" class="row mt-4 px-4" id="comments">
            @csrf
            <div class="col-12 profile-form-field  border-light border-radius-sm py-3 px-4">
                <div class="my-2 px-1 row">
                    <div class="col-12 m-0 pl-4 p-0">
                                    <textarea class="border-0 w-100 outline-0 text-muted" rows="5" cols="50" id="comment-textarea"
                                              name="body"
                                              maxlength="1000" style="resize: none;"
                                              placeholder="Your comment on this session."></textarea>
                        <input class="d-none" id="session-id" name="session_id" value="{{$controllerSession->id}}">
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-secondary-veedros ml-auto submit" id="comment-submit" type="submit"><i
                            data-feather="arrow-right"></i></button>
                </div>
            </div>
        </form>
        <br>
        <hr>
        <h2 class="mb-5">Comments ({{$controllerSession->comments->count()}})</h2>
        <div class="container mb-5 pb-5">
            @foreach($controllerSession->comments as $comment)
                <div class="row mb-4">
                    <div class="tip-instructor-avatar align-items-start col-2">
                        <img src="{{$comment->user->img}}" alt="comment avatar" class="round round-sm" />
                    </div>
                    <div class="col-10 d-flex align-items-center w-100">
                        <div class="card card-comment border-0">
                            <div class="card-body row">
                                <div class="col-9">
                                    <a href="{{asset('profile') . '/' . $comment->user->id}}">{{$comment->user->name}}</a>
                                    <p class="mt-2">{!! nl2br(e($comment->body)) !!}</p>
                                </div>
                                <div class="col-3 d-flex flex-column justify-content-end">
                                    <div class="likes d-flex justify-content-center align-items-center">
                                    <button class="btn btn-secondary-veedros like-btn more {{Auth::user() ?  $comment->isLikedBy(Auth::user()) ? 'liked' : '' : ''}}" id="{{$comment->id}}"><i
                                            data-feather="heart"></i>
                                        <span class="ml-2 text-muted">{{$comment->likes()->count()}}</span>
                                    </button>

                                    </div>
                                    <h6><i data-feather="globe" class="mr-1"></i>{{$comment->created_at->diffForHumans()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </section>
@endsection

@section('libraryJS')
    <!-- video js -->
{{--    <script src="https://vjs.zencdn.net/7.6.6/video.min.js"></script>--}}
{{--    <script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>--}}
    <script src="https://cdn.plyr.io/3.5.10/plyr.polyfilled.js"></script>
    <!-- Axios JS -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@section('customJS')
<script type='text/javascript'
src='https://platform-api.sharethis.com/js/sharethis.js#property=5e792c766caf2b00125bec34&product=inline-share-buttons' async='async'></script>
    <script>
        let baseUrl = `{{asset("")}}`;
    </script>
    <script src="{{asset('scripts')}}/player.js"></script>
@endsection

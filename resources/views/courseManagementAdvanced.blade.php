@extends('layout')

@section('libraryCSS')
    <!-- video js CSS  -->
    <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />
    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">

@endsection
@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/player.css">
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection

@section('content')
    <section class="container my-5 py-5" id="course-info">

    <h1 class="mt-5"> Chapters & Sessions </h1>
    <br>
    <h2>Basic course chapter and session structure</h2>
    <ul id="chapters-container">
        @foreach($course->chapters as $chapter)
            <li class="mb-3">
                <div class="row justify-content-center align-items-center">
            <button class="list-group-item collapse-button mx-auto my-3" aria-expanded="false" data-toggle="collapse"
                    href="#collapse{{$loop->iteration}}" >
                <span>Chapter {{$loop->iteration}} </span>
                <div class="vertical-seperator"></div>
                <span class="chapter-name">
                {{$chapter->name}}
                </span>
                <div class="chevron"><i data-feather="chevron-down"></i></div>
            </button>
                <div class="m-auto">
                    <button
                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn delete-session" type="button" onclick="deleteChapter({{$chapter->id}})"><i
                            data-feather="trash" style="stroke: #dc3545"></i></button>
                </div>
                </div>
                <div class="list-group collapse show my-2 px-5" id="collapse{{$loop->iteration}}">
                    <div>
                <h2 class="mb-2">Chapter's name</h2>
                <div class="row">
                    <div class="col-10">
                        <h5 class="align-items-center row">
                            <textarea class="chapter-name-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter name here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->name}}</textarea>
                        </h5>
                    </div>
                    <div>
                        <button
                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn edit-chapter-name" type="button"><i
                                data-feather="edit"></i>
                            Edit</button>
                    </div>
                </div>
                <br>
                <h2 class="mb-2">Chapter's description</h2>
                <div class="row">
                    <div class="col-10">
                        <h5 class="align-items-center row">
                            <textarea class="chapter-desc-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter description here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->about}}</textarea>
                        </h5>
                    </div>
                    <div>
                        <button
                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn edit-chapter-desc" type="button"><i
                                data-feather="edit"></i>
                            Edit</button>
                    </div>
                </div>
                    </div>
                    <br>
                    <h2>Sessions</h2>
                    @foreach($chapter->sessions as $session)
                        <div class="row justify-content-center align-items-center">
                        <button class="list-group-item collapse-button mx-auto my-2" aria-expanded="false" data-toggle="collapse"
                                href="#collapse-sessions-{{$loop->iteration}}">
                            <span>Session {{$loop->iteration}} </span>
                            <div class="vertical-seperator"></div>
                            <span class="chapter-name">
                                {{$session->name}}
                            </span>
                            <div class="chevron"><i data-feather="chevron-down"></i></div>
                        </button>
                            <div class="m-auto">
                                <button
                                    class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn delete-session" type="button" onclick="deleteSession({{$session->id}})"><i
                                        data-feather="trash" style="stroke: #dc3545"></i></button>
                            </div>
                        </div>
                            <div class="list-group collapse py-4 px-5" id="collapse-sessions-{{$loop->iteration}}">
                                <h2 class="mb-2">Session's name</h2>
                                <div class="row">
                                    <div class="col-10">
                                        <h5 class="align-items-center row">
                                            <textarea class="session-name-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type session name here" oninput="auto_grow(this)" readonly id="{{$session->id}}">{{$session->name}}</textarea>
                                        </h5>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn edit-session-name" type="button"><i
                                                data-feather="edit"></i>
                                            Edit</button>
                                    </div>
                                </div>
                                <br>
                                <h2 class="mb-2">Session's description</h2>
                                <div class="row">
                                    <div class="col-10">
                                        <h5 class="align-items-center row">
                                            <textarea class="session-desc-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type session description here" oninput="auto_grow(this)" readonly id="{{$session->id}}">{{$session->about}}</textarea>
                                        </h5>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn edit-session-desc" type="button"><i
                                                data-feather="edit"></i>
                                            Edit</button>
                                    </div>
                                </div>

                                <div class="w-100 row m-0">
                                    <button class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3 add-milestone" type="button">
                                        <h2 class="m-0">
                                            <i data-feather="plus"></i>
                                            Add a new milestone.
                                        </h2>
                                    </button>
                                </div>
                                <br>
                            </div>

                    @endforeach
                    <div class="w-100 mt-5 row mx-auto">
                        <button id="{{$chapter->id}}"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3 add-session" type="button">
                            <h2 class="m-0">
                                <i data-feather="plus"></i>
                                Add a new session.
                            </h2>
                        </button>
                    </div>
                    <br>
                    <hr>
                    <br>
                </div>

            </li>
        @endforeach

    </ul>


        <br>
    <div class="w-100 row m-0">
        <button id="add-chapter"
                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
            <h2 class="m-0">
                <i data-feather="plus"></i>
                Add a new chapter.
            </h2>
        </button>
    </div>
    </section>

    <form class="mb-5" action="300/upload-video" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file"
               class="filepond"
               name="vid"/>
        <div class="row text-center mt-5">
            <button type="submit" class="btn btn-veedros-new btn-veedros-lg border-0 mx-auto">
                <h4 class="my-0 mx-5">Upload video</h4>
            </button>
        </div>
    </form>
@endsection

@section('libraryJS')
    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <!-- Axios JS -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@section('customJS')
    <script>
        let baseUrl = `{{asset("")}}`;
        let slug = `{{$course->slug}}`;
    </script>
    <script src="{{asset('scripts')}}/manage-course-advanced.js"></script>
@endsection

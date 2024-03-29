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
    <div class="new-bg" style="z-index: -1; opacity: 0.25"></div>


    <section class="container" id="course-info">
        <nav class="mt-5 pt-5" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent">
                <li class="breadcrumb-item"><a href="{{asset('/manage/instructor/courses')}}">My courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$course->name}}</li>
            </ol>
        </nav>
        <h1 class="mt-5">Basic information for {{$course->name}} </h1>

        <div class="col-12 py-5">

                    <h2 id="thumb">Edit course thumbnail</h2>
                    <form action="{{url()->current()}}/thumbnail" method="POST" id="img-form">
                        @csrf
                    <div class="row mb-5" id="img-edit-container">
                        <div class="col-md-6 mx-auto d-none" id="img">
                        <input type="file"
                           class="filepond"
                           name="img"
                           accepted-file-types="image/png, image/jpeg, image/jpg"/>
                            <div class="row">
                            <div class="w-50 px-3">
                                <button id="img-cancel"
                                        class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn mx-0 py-3" type="button">
                                    <h2 class="m-0">
                                        <i style="stroke: rgb(255, 148, 148)" data-feather="x"></i>
                                        Cancel
                                    </h2>
                                </button>
                            </div>
                                <div class="w-50 px-3">
                                <button id="img-submit"
                                        class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn mx-0 py-3" type="submit">
                                    <h2 class="m-0">
                                        <i style="stroke: rgb(13, 152, 79)" data-feather="check"></i>
                                        Confirm
                                    </h2>
                                </button>
                            </div>
                            </div>
                        </div>
                        <div id="edit-img" class="col-lg-4 mx-auto">
                            <div class="card course-card development-card noJquery"
                                 style="background-image: url('{{$course->img}}')">
                                <div class="card-body m-0">
                                    <a href="#thumb" class="card-body-inner noscroll card-bg-img"  >
                                        <div class="play-circle play-circle-0"> <i style="stroke: #313c8b" data-feather="edit"></i> </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
            <h2>Course's price in EGP</h2>
            <div class="row w-md-100 my-5 w-75 mx-auto ">
                <div class="col-md-8 mx-auto">
                    <div class="badge tip-badge py-1">
                        <h4 class="badge-item">
                            <i class="fas fa-hand-holding-usd mr-auto ml-4"></i>
                            <input id="price" type="number" class="price form-control course-form-field border-light border-radius-sm mr-2" placeholder="Price" value="{{$course->price}}" readonly> <span>EGP</span>
                            <button id="edit-price"
                                    class="btn btn-secondary-veedros border-medium edit-btn ml-auto mr-3" type="button"><i
                                    data-feather="edit"></i></button>
                        </h4>
                    </div>
                </div>
            </div>

                    <h2>Describe your course</h2>
                    <div class="row justify-content-center flex-nowrap">
                    <textarea id="about" rows="7" maxlength="500" class="about form-control course-form-field border-light border-radius-sm col-12" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;" readonly>{{$course->about}}</textarea>
                        <div class="d-flex justify-content-center align-items-center">
                            <button id="edit-about"
                                    class="btn btn-secondary-veedros btn-secondary-veedros-normal edit-btn h-100 w-100"
                                    style="border-top-left-radius: 0px !important; border-bottom-left-radius: 0px !important;"
                                    type="button"><i data-feather="edit" style="stroke: #1565C0 !important; color: #1565C0 !important;"></i></button>
                        </div>
                    </div>
                    <br>
                    <h2>What topics will you cover through this course?</h2>
                    <ul class="ml-5" id="obj-container">
                        @foreach($course->objectives as $objective)
                        <li class="row mb-2 single-obj">
                            <div class="col-12 mx-2">
                                <h5 class="align-items-center row flex-nowrap mb-0">
                                    <textarea rows="1" class="objective form-control course-form-field border-light border-radius-sm" placeholder="Type your objective here" oninput="auto_grow(this)" readonly id="{{$objective->id}}">{{$objective->objective}}</textarea>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button
                                            class="btn btn-secondary-veedros btn-secondary-veedros-normal edit-btn ml-3 mr-1 del-obj" type="button" id="{{$objective->id}}"><i
                                                data-feather="trash" style="stroke: #D36565"></i></button>
                                        <button
                                            class="btn btn-secondary-veedros btn-secondary-veedros-normal edit-btn edit-obj mr-3 ml-1"  type="button"><i
                                                data-feather="edit" style="stroke: #1565C0"></i></button>
                                    </div>
                                </h5>
                            </div>
                        </li>
                            @endforeach
                    </ul>

                    <div class="w-100 row">
                        <button id="add-obj"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
                            <h2 class="m-0">
                            <i data-feather="plus"></i>
                                Add a new objective.
                            </h2>
                        </button>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <h2>Who would you recommend this course to?</h2>
                    <ul class="ml-5" id="rec-container">
                        @foreach($course->recommendations as $recommendation)
                            <li class="row mb-2 single-rec">
                                <div class="col-12">
                                    <h5 class="align-items-center row flex-nowrap">
                                        <textarea rows="1" class="rec form-control course-form-field border-light border-radius-sm col-10" placeholder="Type your recommendation here" oninput="auto_grow(this)" readonly id="{{$recommendation->id}}">{{$recommendation->recommendation}}</textarea>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button
                                                class="btn btn-secondary-veedros btn-secondary-veedros-normal edit-btn ml-3 mr-1 del-rec" type="button" id="{{$recommendation->id}}"><i
                                                    data-feather="trash" style="stroke: #D36565"></i></button>
                                            <button
                                                class="btn btn-secondary-veedros btn-secondary-veedros-normal edit-btn edit-rec" type="button"><i
                                                    data-feather="edit" style="stroke: #1565C0"></i></button>
                                        </div>
                                    </h5>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="w-100 row">
                        <button id="add-rec"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
                            <h2 class="m-0">
                                <i data-feather="plus"></i>
                                Add a new recommendation.
                            </h2>
                        </button>
                    </div>

                    <div class="row text-center mt-5">
                        <a href="{{asset('manage/instructor/courses') . '/' . $course->slug . '/advanced'}}" type="submit" id="btnsubmit" class="btn btn-veedros-new btn-veedros-lg border-0 mx-auto">
                            <h4 class="my-0 mx-5">Continue</h4>
                        </a>
                    </div>
                </div>

    </section>
@endsection

@section('libraryJS')
    <!-- video js -->
    <script src="https://vjs.zencdn.net/7.6.6/video.js"></script>
    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <!-- Axios JS -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
@section('customJS')
{{--    <script src="{{asset('scripts')}}/player.js"></script>--}}
    <script>
        let baseUrl = `{{asset("")}}`;
        let slug = `{{$course->slug}}`;
        let courseImgUrl = `${baseUrl}/uploads/courses/{{$course->instructor_id}}/${slug}/images/{{$course->img}}`;
    </script>
    <script src="{{asset('scripts')}}/manage-course.js"></script>
@endsection

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
    <ul class="ml-5" id="rec-container">
        @foreach($course->chapters as $chapter)
            <h2>Chapter {{$loop->iteration}}</h2>
            <li class="mb-2">
                <h3>Chapter's name</h3>
                <div class="row">
                <div class="col-10">
                    <h5 class="align-items-center row">
                        <textarea rows="1" class="rec form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter name here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->name}}</textarea>
                    </h5>
                </div>
                <div>
                    <button
                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-rec" type="button"><i
                            data-feather="edit"></i>
                        Edit</button>
                </div>
                </div>
                <br>
                    <h3>Chapter's description</h3>
                <div class="row">
                <div class="col-10">
                    <h5 class="align-items-center row">
                        <textarea rows="1" class="rec form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter description here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->about}}</textarea>
                    </h5>
                </div>
                <div>
                    <button
                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-rec" type="button"><i
                            data-feather="edit"></i>
                        Edit</button>
                </div>
                </div>
                <div class="w-75 row mx-auto">
                    <button id="add-rec"
                            class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
                        <h2 class="m-0">
                            <i data-feather="plus"></i>
                            Add a new session.
                        </h2>
                    </button>
                </div>
            </li>
        @endforeach

    </ul>
        
    <div class="w-100 row">
        <button id="add-rec"
                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
            <h2 class="m-0">
                <i data-feather="plus"></i>
                Add a new chapter.
            </h2>
        </button>
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

    lol
@endsection
@section('customJS')
    <script src="{{asset('scripts')}}/player.js"></script>
    <script>
        let baseUrl = `{{asset("")}}`;
        let slug = `{{$course->slug}}`;
        let courseImgUrl = `${baseUrl}/uploads/courses/{{$course->instructor_id}}/${slug}/images/{{$course->img}}`;
    </script>
    <script src="{{asset('scripts')}}/manage-course.js"></script>
@endsection

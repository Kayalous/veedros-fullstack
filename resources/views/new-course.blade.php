@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/profile.css">
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
@endsection

@section('libraryCSS')
    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
@endsection

@section('content')
    <div class="new-bg" style="z-index: -1;"></div>

    <!-- Profile edit  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto">
                    <div class="card profile-card px-4 py-5">
                        <div class="card-body">
                            <form id="form" action="{{route('manage.courses.new')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mx-auto text-center">
                                        <h1 class="text-center text-header-lg">Basic course information</h1>
                                    <div class="row">
                                        <div class="col-lg-8  m-auto">
                                            <h5>Course thumbnail</h5>

                                            <input type="file"
                                                   class="filepond"
                                                   name="img"
                                                   accept="image/png, image/jpeg, image/jpg"/>

                                        </div>

                                        <div class="col-lg-7 mt-5 mx-auto">
                                            <div class="input-group mb-2">
                                                <h5>Course title</h5>
                                                <input type="text"
                                                       name="name"
                                                       id="name"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="Digital electronics I" />
                                            </div>

                                            <div class="input-group mb-2">
                                                <h5>Price in EGP</h5>
                                                <input type="number"
                                                       name="price"
                                                       id="price"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm col-10"
                                                       placeholder="399"
                                                style=""/>
                                                <div class="col-2 py-auto d-flex justify-content-center align-items-center">
                                                <h5 class="m-0">
                                                    EGP
                                                </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-10 mx-auto">
                                            <div class="input-group mb-2">
                                                <h5>Course description</h5>
                                                <textarea id="description" rows="5" cols="50" maxlength="500" name="about"
                                                          class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                          placeholder="Describe your amazing course!"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100 text-center mt-5">
                                    <button type="submit" id="btnsubmit" class="btn btn-veedros-new btn-veedros-lg border-0 mx-auto" disabled>
                                        <h4 class="my-0 mx-5">Continue</h4>
                                    </button>
                                </div>




                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('libraryJS')
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
@endsection
@section('customJS')
    <script src="{{asset('scripts')}}/new-course.js"></script>
@endsection

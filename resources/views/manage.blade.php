@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="styles/profile.css">
@endsection

@section('libraryCSS')
    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
@endsection

@section('content')
    <div class="slash slash-to-right"></div>

    <!-- Profile edit  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto">
                    <div class="card profile-card px-4 py-5">
                        <div class="card-body">
                            <form id="form" action="{{route('manage')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mx-auto text-center">
                                    <div class="row">
                                        <div class="col-lg-5 my-auto">
                                            <input type="file"
                                                   class="filepond"
                                                   name="img"
                                                   accept="image/png, image/jpeg, image/gif"/>                                        </div>
                                        <div class="col-lg-7 col-md-9 mx-auto">
                                            <div class="input-group mb-2">
                                                <h5>Name</h5>
                                                <input type="text"
                                                       name="name"
                                                       id="name"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="Yassen Ali" />
                                            </div>
                                            <div class="input-group mb-2">
                                                <h5>Phone number</h5>
                                                <input type="text"
                                                       name="phone"
                                                       id="phone"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="+20 114 720 0863" />
                                            </div>
                                            <div class="input-group mb-2">
                                                <h5>Email</h5>
                                                <input type="text"
                                                       name="email"
                                                       id="email"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="abdulrhmanelkayal88@gmail.com" />
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group mb-2">
                                                <h5>Password</h5>
                                                <div class="d-flex w-100">
                                                    <input type="password"
                                                           name="password"
                                                           id="password"
                                                           class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                           placeholder="● ● ● ● ● ● ● ●" /> <button
                                                        class="btn btn-secondary-veedros ml-2" id="show-password-btn" type="button"><i
                                                            data-feather="eye-off"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-2">
                                                <h5>Repeat password</h5>
                                                <input type="password"
                                                       id="password-repeat"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="● ● ● ● ● ● ● ●" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>Position</h5>
                                                <input type="text"
                                                       id="position"
                                                       name="position"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="Computer Engineering student at AAST" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>Location</h5>
                                                <input type="text"
                                                       id="location"
                                                       name="location"
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="Alexandria, Egypt" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>About you</h5>
                                                <textarea id="about" rows="5" cols="50" maxlength="500" name="about"
                                                          class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                          placeholder="Tell us more about you!"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-7 col-md-9 mx-auto my-3">
                                        <div class="input-group border-light profile-social-field">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="twitter"></i></span>
                                            </div>
                                            <input name="twitter" id="twitter" type="text" class="form-control form-control-social border-0">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-9 mx-auto my-3">
                                        <div class="input-group border-light profile-social-field">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="linkedin"></i></span>
                                            </div>
                                            <input name="linkedin" id="linkedin" type="text" class="form-control form-control-social border-0">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-9 mx-auto my-3">
                                        <div class="input-group border-light profile-social-field">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="facebook"></i></span>
                                            </div>
                                            <input name="facebook" id="facebook" type="text" class="form-control form-control-social border-0">
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100 text-center mt-5">
                                    <button type="submit" id="btnsubmit" class="btn btn-veedros btn-veedros-lg border-0">
                                        <h4 class="my-0 mx-5">Save</h4>
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
    <script>
        let currentAvatar = `{{Auth::user()->img}}`;
    </script>
    <script src="scripts/manage.js"></script>

@endsection

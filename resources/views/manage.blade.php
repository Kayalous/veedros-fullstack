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
    <div class="new-bg"></div>

    <!-- Profile edit  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto">
                    <div class="card profile-card px-4 py-5">
                        <div class="card-body">
                            <form id="form" action="{{route('manage')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h2 class="text-center" style="font-size: 35px;font-weight: 700;color: #313c8b;">Edit your profile</h2>
                                <h5 class="text-center">Fill in any details you want to edit and leave other fields blank</h5>
                                <br>
                                <div class="mx-auto text-center">
                                    <div class="row">
                                        <div class="col-lg-5 my-auto">
                                            <input type="file" class="filepond" name="img" accept="image/png, image/jpeg, image/gif" /> 
                                        </div>
                                        <div class="col-lg-7 col-md-9 mx-auto">
                                            <div class="input-group mb-2">
                                                <h5>Name</h5>
                                                <input type="text" name="name" id="name" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="John Smith" />
                                            </div>
                                            <div class="input-group mb-2">
                                                <h5>Phone number</h5>
                                                <input type="text" name="phone" id="phone" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Your phone number here" />
                                            </div>
                                            <div class=" my-4 change-email">
                                                <input class="menu-btn" type="checkbox" id="email-menu-btn" />
                                                <h5>{{Auth::user()->email}}</h5>
                                                <label class="menu-text" for="email-menu-btn">
                                                <a>change Email</a>
                                                </label>
                                                <ul class="menu pt-3">
                                                    <li>
                                                        <div class="input-group ">
                                                            <h5>Enter your new Email</h5>
                                                            <input type="text" name="email" id="email" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="example@gmail.com" />
                                                        </div>
                                                    </li>
                                                    <li>
                                                    <div class=" text-center my-3">
                                                            <a  class="btn btn-veedros-new  btn-veedros-md border-0 mx-auto ">
                                                                    <span class="mx-3 text-white">Submit</span>
                                                                </a>
                                                                
                                                    </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" my-4 change-pass">
                                                <input class="menu-btn" type="checkbox" id="pass-menu-btn" />
                                                <label class="menu-text" for="pass-menu-btn">
                                                    <a>change password</a>
                                                </label>
                                                <ul class="menu">

                                                    <li>
                                                                        <div class="row mt-4">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-2">
                                                                            <h5>New password</h5>
                                                                            <div class="d-flex w-100">
                                                                                <input type="password" name="password" id="password" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="● ● ● ● ● ● ● ●"> <button class="btn btn-secondary-veedros ml-2" id="show-password-btn" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-2">
                                                                    <h5>Repeat password</h5>
                                                                    <input type="password" id="password-repeat" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="● ● ● ● ● ● ● ●">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    <div class=" text-center my-3">
                                                            <a  class="btn btn-veedros-new  btn-veedros-md border-0 mx-auto ">
                                                                    <span class="mx-3 text-white">Submit</span>
                                                                </a>
                                                                
                                                    </div>
                                                    </li>
                                                </ul>
                                            </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>Position</h5>
                                                <input type="text" id="position" name="position" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Computer Engineering student at AAST" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>Location</h5>
                                                <input type="text" id="location" name="location" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Alexandria, Egypt" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <h5>About you</h5>
                                                <textarea id="about" rows="5" cols="50" maxlength="500" name="about" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Tell us more about you!" style="resize: none"></textarea>
                                                <h6 class="mt-1"><span id="about-counter">0</span>/500 characters</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                        <div class="col-lg-7 col-md-9 mx-auto my-3">
                                            <div class="input-group border-light profile-social-field">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><img style="width: 25px; height: 25px" src="{{asset('images/Icons')}}/twitter.svg"></span>
                                                </div>
                                                <input name="twitter" id="twitter" type="text" class="form-control form-control-social border-0 my-auto">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-9 mx-auto my-3">
                                            <div class="input-group border-light profile-social-field">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><img style="width: 25px; height: 25px " src="{{asset('images/Icons')}}/LinkedIn.svg"></span>
                                                </div>
                                                <input name="linkedin" id="linkedin" type="text" class="form-control form-control-social border-0 my-auto">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-9 mx-auto my-3">
                                            <div class="input-group border-light profile-social-field">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><img style="width: 25px; height: 25px " src="{{asset('images/Icons')}}/facebook.svg"></span>
                                                </div>
                                                <input name="facebook" id="facebook" type="text" class="form-control form-control-social border-0 my-auto">
                                            </div>
                                        </div>
                                </div>


                                <div class="w-100 text-center mt-5">
                                    <button type="submit" id="btnsubmit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">
                                        <h4 class="my-0 mx-5">Save</h4>
                                    </button>
                                </div>
                            </form>
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

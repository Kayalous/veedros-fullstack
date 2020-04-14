@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/Route.css">
@endsection

@section('content')

    <div class="route-header">
        <div class="content">
            <h1>Welcome to Route</h1>
            <img src="{{asset('images')}}/Route_logo.png" alt="">
        </div>
    </div>

    <section class="avalible-sessions my-5">
        <div class="container">
            <div class="row">
                <div class="header">
                    <h2>Hi, {{  explode(" ", Auth::user()->name)[0]  }}</h2>
                    <br>
                    <p>Available sessions</p>
                    <small>Please enter course's passcode to see the updates</small>
                </div>
            </div>

            <!-- <div class="row justify-content-center">
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="card course-card development-card noJquery" style="background-color: #A7A7A7"
                        data-toggle="modal" data-target="#exampleModal">
                        <div class="card-body m-0">
                            <div class="card-body-inner noscroll card-bg-img">
                                <div class="form-group py-4">
                                    <label for="">Passcode</label>
                                    <input type="text" name="" id=""
                                        class="form-control profile-form-field m-auto border-light border-radius-sm"
                                        placeholder="" aria-describedby="helpId">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <ul>
                            <li>
                                <h3>
                                    Full stack diploma
                                </h3>
                            </li>
                            <li class="my-2">
                                <p>Round 30 Alex</p>
                            </li>
                            <li>
                                <button class=" btn btn-veedros-new btn-veedros-sm border-0 m-auto" type="button">
                                    Go
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->

            <div class="container my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-8 col-lg-4 my-2">
                <div class="card-body-outter">
                    <div class="header">
                        <div class="row">
                            <div class="col-2 menu-icon">
                                <div class="icon-overlayer"></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="col-10 header-content">
                                <a href="">Data and Comp Comm Spring 2019 2020</a></div>
                        </div>
                        <p class="">Khaled Tag</p>
                    </div>
                    <div class="quick-task p-3">
                        <div class="instructor-pic"></div>
                        <div>
                            <p class="text-muted">مطلوب تسليمه غدا</p>
                            <a href="">Assignment</a>
                        </div>
                    </div>
                    <div class="body-footer">
                        <div class=" folder-icon mx-4">
                            <div class="icon-overlay"></div>
                            <i class="far fa-folder"></i>
                        </div>
                        <div class=" id-icon mx-2">
                            <div class="icon-overlay"></div>
                            <i class="far fa-id-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
    </section>
@endsection


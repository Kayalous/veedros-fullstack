<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158058878-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-158058878-2');
    </script>
    <title>Veedros</title>
    <link rel="icon" href="https://veedros.s3.eu-central-1.amazonaws.com/images/Veedros_Logo.png">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- feather icons  -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    @yield('libraryCSS')
    <!-- Font Awesome  -->
    <script src="https://kit.fontawesome.com/04f7d66693.js" crossorigin="anonymous"></script>
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('styles')}}/style.css" />
    <link rel="stylesheet" href="{{asset('styles')}}/new_style.css" />
    @yield('customCSS')
</head>

<body>
@if(!Auth::check())
<!-- Modals  -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content login-body">
            <div class="modal-body px-5">
                <form class="login" action="{{ route('login') }}" method="POST" novalidate>
                    @csrf
                    <h1 class="text-center mb-0 mt-3 text-muted">Sign in</h1>
                    <p class="text-center login-modal-header mt-5">
                        Enter your email and password to sign in. <br />
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="form-control email-input email-field email-field-props modal-field-props border-0 mx-auto"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="login-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="input-group password-cont mt-3" id="login-password-cont">
                        <input type="password"
                               class="form-control email-input password-field email-field-props modal-field-props border-0 mx-auto mt-"
                               placeholder="● ● ● ● ● ● ● ●" aria-label="password" name="password" id="login-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                    </div>
                    <div class="d-flex jusift-content-center mt-3 mb-4">
                        <button type="submit" id="login-button" class="btn btn-veedros-new btn-veedros-md mx-auto btn-submit">
                            Sign in
                        </button>
                    </div>
                </form>
                <div class="register-prompt forgot-password mb-3" id="login-alt-cont">
                    <h6>Forgot password?</h6>
                    <a class="dot-hover dot-hover-red" href="{{asset('/password/reset')}}">Reset now</a>
                </div>
                <div class="register-prompt mb-3">
                    <h6>Don't have an account?</h6>
                    <a class="signup-toggle dot-hover dot-hover-red" href="#">Sign up
                        instead</a>
                </div>
                <div class="register-prompt magic-link mb-3" id="login-magic-link">
                    <h6>Want to sign in using just your email?</h6>
                    <a class="login-with-password dot-hover dot-hover-red" href="#">Sign in with magic link</a>
                </div>

                <hr>
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can login with:</h6>
                    <div class="d-flex flex-wrap justify-content-around align-items-center w-100 mt-3 border-0">
                        <a href="{{ route('login.facebook') }}" title="Facebook" class="btn btn-facebook btn-lg border-0 my-2"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
                        <a href="{{ route('login.google') }}" title="Google" class="btn btn-google btn-lg border-0 my-2"><i class="fab fa-google mr-2"></i>Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="signupModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content login-body">
            <div class="modal-body px-5">
                <form class="signup" action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <h1 class="text-center mb-0 mt-3 text-muted">Sign up</h1>
                    <p class="text-center signup-modal-header mt-5">
                        Sign up by entering your email and password. <br />
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="form-control email-input email-field email-field-props modal-field-props border-0 mx-auto"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="signup-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="input-group password-cont mt-4" id="signup-password-cont">

                        <input type="password"
                               class="form-control email-input password-field email-field-props modal-field-props border-0 mx-auto mt-"
                               placeholder="● ● ● ● ● ● ● ●" aria-label="password" name="password" id="signup-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                    </div>

                    <div class="d-flex jusift-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-veedros-new btn-veedros-md mx-auto btn-submit" id="signup-button">
                            Sign up
                        </button>
                    </div>
                </form>

                <div class="register-prompt mb-4">
                    <h6>Already have an account?</h6>
                    <a class="signin-toggle dot-hover dot-hover-red" href="#">Sign in instead</a>
                </div>
                <div id="signup-alt-cont"></div>
                <div class="register-prompt magic-link mb-3" id="signup-magic-link">
                    <h6>Want to sign up using just your email?</h6>
                    <a class="signup-with-password dot-hover dot-hover-red" href="#">Sign up with just email</a>
                </div>
                <hr>
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can sign up with:</h6>
                    <div class="d-flex justify-content-around align-items-center w-100 mt-3 border-0">
                        <a href="{{ route('login.facebook') }}" title="Facebook" class="btn btn-facebook btn-lg border-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
                        <a href="{{ route('login.google') }}" title="Google" class="btn btn-google btn-lg border-0"><i class="fab fa-google mr-2"></i>Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endif
<div class="modal fade" id="rateModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content login-body">
            <div class="modal-body px-5">
                @if(Auth::check())
                <form class="signup" action="{{asset('review')}}" method="POST" novalidate>
                    @csrf
                    <div class="container">
                    <h3 class="text-center text-muted">We really appreciate your feedback!</h3>
                    <br>
                        <div class="row mb-3">
                        <div class="tip-instructor-avatar col-lg-2 ml-4 ">
                            <img src="{{Auth::user()->img}}" alt="User avatar" class="round">
                        </div>
                            <h4 class="text-muted my-auto">{{Auth::user()->name}}</h4>
                        </div>
                        <br>
                    <h5 class="text-muted">What do you think about our service?</h5>
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <textarea id="review-body" rows="5" cols="50" maxlength="500" name="body" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Let us know what you think about Veedros! (Optional)" style="resize: none"></textarea>
                                <h6 class="ml-auto mt-1 text-muted">500 characters</h6>
                            </div>
                        </div>
                    </div>
                        <h5 class="text-muted text-center">How would you rate our service?</h5>

                        <div class="rating">
                        <input name="rating" value="5" id="e5" type="radio"></a><label for="e5">★</label>
                        <input name="rating" value="4" id="e4" type="radio"></a><label for="e4">★</label>
                        <input name="rating" value="3" id="e3" type="radio"></a><label for="e3">★</label>
                        <input name="rating" value="2" id="e2" type="radio"></a><label for="e2">★</label>
                        <input name="rating" value="1" id="e1" type="radio"></a><label for="e1">★</label>
                    </div>
                    <div class="row bt-5">
                        <button type="submit" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto" data-toggle="modal" data-target="#rateModal"
                        >
                            <span class="text-white">Send</span>
                        </button>
                    </div>
                    </div>
                </form>
                @else
                    <div class="container">
                        <h3 class="text-center text-muted">You need to sign in to review us.</h3>
                        <br>
                        <li class="nav-item d-flex align-items-center justify-content-center">
                            <a href="{{asset('login')}}" class="btn btn-veedros-new btn-veedros-md border-0">Sign in now</a> </li>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Navbar  -->
<nav class="navbar navbar-expand-lg absolute-top main-navbar navbar-light">
    <a class="navbar-brand logo" href="{{route('landing')}}"><img class="img-fluid" style="width: 120px;" src="https://veedros.s3.eu-central-1.amazonaws.com/images/Veedros Logo.svg"
                                               alt="Logo"></a>
    <button class="navbar-toggler border-0 d-lg-none" type="button" data-toggle="collapse"
            data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
        <div class="burger burger-rotate open">
            <div class="burger-lines"></div>
        </div>
    </button>
    <div class="collapse navbar-collapse no-flex-grow" id="collapsibleNavId">
        <ul class="navbar-nav nav-items-container">
            @if(Auth::user())
                @if(!Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{asset("search")}}">Search</a>
                    </li>
            <li class="nav-item">
                <a class="nav-link" href="{{asset("courses")}}">Courses</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{asset("teach")}}">Teach</a>

            </li>
            @if(Auth::user()->instructor)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('manage.courses')}}">Manage my courses</a>
                        </li>
                    @else
            <li class="nav-item">
            <a class="nav-link" href="{{asset("academic")}}">Academic</a>
            </li>
                @endif
                @else
                <li class="nav-item">
                    <a class="nav-link dot-hover dot-hover-red" href="{{route('veedros.admin')}}">Manage users</a>
                </li>
            @endif
            @else
                <li class="nav-item">
                    <div class="search-form ">
                        <form>
                            <input class="search-input" type="text">
                            <button class="btn-nav-search">
                                <div class="search__rectangle"></div>
                            </button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset("search")}}">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset("courses")}}">Courses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{asset("teach")}}">Teach</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{asset("academic")}}">Academic</a>
                </li>


                @endif

            @if(!Auth::check())
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a href="#" class="btn btn-veedros-new btn-veedros-sm border-0" data-toggle="modal" data-target="#loginModal">Sign in </a> </li>
                @else
                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link dot-hover dot-hover-red" href="{{route("voyager.dashboard")}}">Admin dashboard</a>
                    </li>
                        @if(Auth::user()->instructor)
                            <li class="nav-item">
                                <a class="nav-link dot-hover dot-hover-black" href="{{route('manage.courses')}}">Manage my courses</a>
                            </li>
                            @endif
                @endif
                <li class="nav-item d-none d-lg-flex align-items-center justify-content-around">
                    <div class="row">
                        <div class="col-6">
                                <img id="singleElement" class="nav-photo" src="{{Auth::user()->img}}" alt="profile picture">
                        </div>
                    </div>
                </li>
                    <li class="nav-item tip pb-4 mx-auto d-flex flex-column d-lg-none align-items-center justify-content-around">
                        <div class="row">
                            <div class="col-6">
                                <img class="nav-photo" src="{{Auth::user()->img}}" alt="profile picture">
                            </div>
                        </div>
                        <a class="w-100 mx-auto" href="/profile">
                            <div class="row w-100">
                                <div class="col-8">
                                    <h6 class="text-left">My profile</h6>
                                </div>
                                <div class=" text-center col-4">
                                    <i class="far iconsize-mine fa-user-circle"></i>
                                </div>
                            </div>
                        </a>
                        <a class="w-100 mx-auto" href="/dashboard">
                            <div class="row w-100">
                                <div class="col-8">

                                    <h6 class="text-left">My dashboard</h6>
                                </div>
                                <div class="text-center col-4">
                                    <i class="far iconsize-mine fa-play-circle"></i>
                                </div>
                            </div>
                        </a>
                        <br>
                        <button class=" btn btn-veedros-new btn-veedros-sm border-0 m-auto" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
                        </button>                    </li>


            @endif
        </ul>
    </div>
</nav>
@yield('content')
<!-- =====================================  FOOTER ========================================= -->
<section>
<div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 align-self-center">
                    <div class="footer-img-media">
                        <img class="img-fluid-mine" style="width: 120px;" src="https://veedros.s3.eu-central-1.amazonaws.com/images/Veedros Logo.svg"
                                               alt="Logo">
                     </div>

                </div>
                <div class="col-12 col-lg-8 align-self-center">
                    <div class="">
                        <div class="row">
                            <div class="col-12 col-lg-3 ">
                                <ul>
                                    <li class="footer-list-header ">
                                        <p>LINKS</p>
                                    </li>
                                    <li class="w-33-mine my-3">
                                    <a class="" href="{{asset("courses")}}">Courses</a>
                                    </li >
                                    <li class="w-33-mine my-3">
                                    <a class="" href="{{asset("teach")}}">Teach</a>
                                    </li >
                                    <li class="w-33-mine my-3">
                                    <a class="" href="{{asset("academic")}}">Academic</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-12 col-lg-4">
                                <ul>
                                    <li class="footer-list-header">
                                        <p>KNOWLEDGE</p>
                                    </li>
                                    <li class="w-50-mine my-3">
                                    <a class="" href="{{asset("privacy")}}">Privacy Policy</a>
                                    </li>
                                    <li class="w-50-mine my-3">
                                    <a class="" href="#" data-toggle="modal" data-target="#rateModal">Review Us</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-5 ">
                                <ul class="contact-email">
                                    <li class="footer-list-header">
                                        <p>CONTACTS</p>
                                    </li>
                                    <li class="my-1">
                                        <a href="mailto:support@veedros.com">support@veedros.com</a>
                                    </li>
                                    <li class="my-1">
                                        <a href="mailto:khaled@veedros.comm">khaled@veedros.com</a>
                                    </li>
                                    <li class="my-1">
                                        <a href="mailto:alaa@veedros.com">alaa@veedros.com</a>
                                    </li>
                                    <li class="my-1">
                                        <a href="mailto:abdulrhman@veedros.com">abdulrhman@veedros.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3 mt-5 copyrights">
                    <div class="d-flex justify-content-between">
                        <p>Veedros copyrights reserved 2020</p>
                        <div>
                            <a href="https://www.facebook.com/veedrosedu/" target="_blank"><i  class="fab fa-facebook-square"></i></a>
                            <a href=""><i class="fab fa-twitter" target="_blank"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

<!-- ============== END ====================  FOOTER ============== END ================= -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<!-- tippy js  -->
<script src="https://unpkg.com/tippy.js@5"></script>
<script src="https://unpkg.com/tooltip.js"></script>
<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@yield('libraryJS')
<!-- App javascript  -->
<script src="{{asset('scripts')}}/app.js"></script>
@if(!Auth::check())
<script src="{{asset('scripts')}}/auth.js"></script>
@endif
<script>
    feather.replace();
</script>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '236599884010438',
            cookie     : true,
            xfbml      : true,
            version    : 'v6.0'
        });


        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>
@yield('customJS')

@if(Session::has('success'))
    <script>
        Swal.fire({
            toast:true,
            position: 'top',
            icon: 'success',
            title: '{{ Session::get('success') }}',
            @if(Session::has('inbox-link'))
            html: '<br />',
            allowOutsideClick:true,
            showCloseButton:true,

            showConfirmButton: true,
            confirmButtonText: '<a target="_blank" rel="noopener" href="//{{Session::get('inbox-link')}}">Go to your inbox now!</a>',
            timer: 10000,

            @else
            showConfirmButton: false,
            timer: 10000
            @endif
        })
    </script>
@endif

@if(Session::has('failure'))
    <script>
        Swal.fire({
            toast:true,
            position: 'top',
            icon: 'error',
            title: '{{ Session::get('failure') }}',
            showConfirmButton: false,
            timer: 10000,
            allowOutsideClick:true,
            showCloseButton:true
        })
    </script>
@endif

@if(Session::has('message'))
    <script>
        Swal.fire({
            toast:true,
            position: 'top',
            icon: 'warning',
            title: '{{ Session::get('message') }}',
            showConfirmButton: false,
            timer: 10000,
            allowOutsideClick:true,
            showCloseButton:true,
        })
    </script>
@endif

@if(Session::has('email-sendback'))
    <script>
    document.querySelector('#login-email-field').value = '{{Session::get('email-sendback')}}';
    </script>
@endif

@if(Session::has('login-form'))
        <script>
            $('#loginModal').modal('show')
        </script>
@endif

</body>

</html>

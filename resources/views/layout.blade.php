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

    <link rel="icon" href="{{asset('images')}}/veedros_play.svg">

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
            <div class="px-5 modal-body">
                <form class="login" action="{{ route('login') }}" method="POST" novalidate>
                    @csrf
                    <h1 class="mt-3 mb-0 text-center text-muted">Sign in</h1>
                    <p class="mt-5 text-center login-modal-header">
                        Enter your email and password to sign in. <br />
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="mx-auto border-0 form-control email-input email-field email-field-props modal-field-props"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="login-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="mt-3 input-group password-cont" id="login-password-cont">
                        <input type="password"
                               class="mx-auto border-0 form-control email-input password-field email-field-props modal-field-props mt-"
                               placeholder="● ● ● ● ● ● ● ●" aria-label="password" name="password" id="login-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                    </div>
                    <div class="mt-2 register-prompt align-items-end forgot-password" id="login-alt-cont">
                    <a class="dot-hover dot-hover-red" href="{{asset('/password/reset')}}">Forgot password?</a>
                    </div>
                    <div class="mt-2 mb-4 d-flex jusift-content-center">
                        <button type="submit" id="login-button" class="mx-auto btn btn-veedros-new btn-veedros-md btn-submit">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="d-none" id="login-alt-cont">
                    <h6>Want to sign in using your email and password?</h6>
                    <a class="dot-hover dot-hover-red" href="#">Regular sign in</a>
                </div>
                <div class="mb-3 register-prompt magic-link" id="login-magic-link">
                    <h6>Want to sign in using just your email?</h6>
                    <a class="login-with-password dot-hover dot-hover-red" href="#">Sign in with magic link</a>
                </div>

                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can login with:</h6>
                    <div class="flex-wrap mt-3 border-0 d-flex justify-content-around align-items-center w-100">
                        <a href="{{ route('login.facebook') }}" title="Facebook" class="my-2 border-0 btn btn-facebook btn-lg"><i class="mr-2 fab fa-facebook-f"></i>Facebook</a>
                        <a href="{{ route('login.google') }}" title="Google" class="my-2 border-0 btn btn-google btn-lg"><i class="mr-2 fab fa-google"></i>Google</a>
                    </div>
                </div>
                <hr>
                <div class="mb-3 register-prompt">
                    <h6>Don't have an account?</h6>
                    <a class="signup-toggle dot-hover dot-hover-red" href="#">Sign up
                        instead</a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="signupModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content login-body">
            <div class="px-5 modal-body">
                <form class="signup" action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <h1 class="mt-3 mb-0 text-center text-muted">Sign up</h1>
                    <p class="mt-5 text-center signup-modal-header">
                        Sign up by entering your email and password. <br />
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="mx-auto border-0 form-control email-input email-field email-field-props modal-field-props"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="signup-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="mt-4 input-group password-cont" id="signup-password-cont">

                        <input type="password"
                               class="mx-auto border-0 form-control email-input password-field email-field-props modal-field-props mt-"
                               placeholder="● ● ● ● ● ● ● ●" aria-label="password" name="password" id="signup-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                    </div>

                    <div class="mt-3 mb-3 d-flex jusift-content-center">
                        <button type="submit" class="mx-auto btn btn-veedros-new btn-veedros-md btn-submit" id="signup-button">
                            Sign up
                        </button>
                    </div>
                </form>

                <div class="mb-4 register-prompt">
                    <h6>Already have an account?</h6>
                    <a class="signin-toggle dot-hover dot-hover-red" href="#">Sign in</a>
                </div>
                <div class="d-none" id="signup-alt-cont">
                    <h6>Want to sign up using your email and password?</h6>
                    <a class="signup-with-password dot-hover dot-hover-red" href="#">Regular sign up</a>
                </div>
                <div class="mb-3 register-prompt magic-link" id="signup-magic-link">
                    <h6>Want to sign up using just your email?</h6>
                    <a class="signup-with-password dot-hover dot-hover-red" href="#">Sign up with just email</a>
                </div>
                <hr>
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can sign up with:</h6>
                    <div class="mt-3 border-0 d-flex justify-content-around align-items-center w-100">
                        <a href="{{ route('login.facebook') }}" title="Facebook" class="border-0 btn btn-facebook btn-lg"><i class="mr-2 fab fa-facebook-f"></i>Facebook</a>
                        <a href="{{ route('login.google') }}" title="Google" class="border-0 btn btn-google btn-lg"><i class="mr-2 fab fa-google"></i>Google</a>
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
            <div class="px-5 modal-body">
                @if(Auth::check())
                <form class="signup" action="{{asset('review')}}" method="POST" novalidate>
                    @csrf
                    <div class="container">
                    <h3 class="text-center text-muted">We really appreciate your feedback!</h3>
                    <br>
                        <div class="mb-3 row">
                        <div class="ml-4 tip-instructor-avatar col-lg-2 ">
                            <img src="{{Auth::user()->img}}" alt="User avatar" class="round">
                        </div>
                            <h4 class="my-auto text-muted">{{Auth::user()->name}}</h4>
                        </div>
                        <br>
                    <h5 class="text-muted">What do you think about our service?</h5>
                    <div class="my-2 row">
                        <div class="col-12">
                            <div class="mb-2 input-group">
                                <textarea id="review-body" rows="5" cols="50" maxlength="500" name="body" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Let us know what you think about Veedros! (Optional)" style="resize: none"></textarea>
                                <h6 class="mt-1 ml-auto text-muted">500 characters</h6>
                            </div>
                        </div>
                    </div>
                        <h5 class="text-center text-muted">How would you rate our service?</h5>

                        <div class="rating">
                        <input name="rating" value="5" id="e5" type="radio"></a><label for="e5">★</label>
                        <input name="rating" value="4" id="e4" type="radio"></a><label for="e4">★</label>
                        <input name="rating" value="3" id="e3" type="radio"></a><label for="e3">★</label>
                        <input name="rating" value="2" id="e2" type="radio"></a><label for="e2">★</label>
                        <input name="rating" value="1" id="e1" type="radio"></a><label for="e1">★</label>
                    </div>
                    <div class="row bt-5">
                        <button type="submit" class="mx-auto border-0 btn btn-veedros-new btn-veedros-md" data-toggle="modal" data-target="#rateModal"
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
                            <a href="{{asset('login')}}" class="border-0 btn btn-veedros-new btn-veedros-md">Sign in now</a> </li>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Navbar  -->
<nav class="navbar navbar-expand-lg fixed-top main-navbar navbar-light">
    <a class="navbar-brand logo" href="{{route('landing')}}"><img class="img-fluid" style="width: 120px; stroke: #0D984F" src="/images/Veedros Logo.svg"
                                               alt="Logo"></a>
    <button class="border-0 navbar-toggler d-lg-none" type="button" data-toggle="collapse"
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
                        <div class="search-form ">
                            <form method="GET" action="{{route('search')}}">
                                <input class="search-input" type="text" name="q" placeholder="Search">
                                <button class="btn-nav-search">
                                    <i data-feather="search" style="stroke-width: 3"></i>
                                </button>
                            </form>
                        </div>
                    </li>
            <li class="nav-item">
                <a class="nav-link" href="{{asset("courses")}}">Courses</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{asset("teach")}}">Teach</a>

            </li>
            @if(Auth::user()->instructor)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('manage.courses')}}">Instructor dashboard</a>
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
                <li class="nav-item d-none d-lg-block">
                    <div class="my-auto search-form">
                        <form method="GET" action="{{route('search')}}">
                            <input class="search-input" type="text" name="q" placeholder="Search">
                            <button class="btn-nav-search">
                                <i data-feather="search" style="stroke-width: 3"></i>
                            </button>
                        </form>
                    </div>
                </li>
                <li class="my-3 nav-item d-block d-lg-none">
                    <div class="my-auto search-form active">
                        <form method="GET" action="{{route('search')}}">
                            <input class="shadow-lg search-input" type="text" name="q" placeholder="Search">
                            <button class="btn-nav-search">
                                <i data-feather="search" style="stroke-width: 3"></i>
                            </button>
                        </form>
                    </div>
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
                    <a href="#" class="border-0 btn btn-veedros-new btn-veedros-sm" data-toggle="modal" data-target="#loginModal">Sign in </a> </li>
                @else
                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link dot-hover dot-hover-red" href="{{route("voyager.dashboard")}}">Admin dashboard</a>
                    </li>
                        @if(Auth::user()->instructor)
                            <li class="nav-item">
                                <a class="nav-link dot-hover dot-hover-black" href="{{route('manage.courses')}}">Instructor dashboard</a>
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

                    <li id="fixed-cart" class="pb-4 mx-auto nav-item tip d-flex flex-column d-lg-none align-items-center justify-content-around">
                        <div class="row">
                            <div class="col-6">
                                <img class="nav-photo" src="{{Auth::user()->img}}" alt="profile picture">
                            </div>
                        </div>
                        <a class="mx-auto w-100" href="/profile">
                            <div class="row w-100">
                                <div class="col-8">
                                    <h6 class="text-left">My profile</h6>
                                </div>
                                <div class="text-center  col-4">
                                    <i class="far iconsize-mine fa-user-circle"></i>
                                </div>
                            </div>
                        </a>
                        <a class="mx-auto w-100" href="/dashboard">
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
                        <button class="m-auto border-0  btn btn-veedros-new btn-veedros-sm" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
                        </button>                    </li>
                    <li class="nav-item d-none d-lg-flex align-items-center justify-content-around">
                        <div class="row">
                            <div class="col-6">
                                <div id="cartTip" class="text-white nav-photo d-flex justify-content-center align-items-center" style="background-color: #65D3BF" alt="Cart icon"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </div>
                    </li>

            @endif
        </ul>
    </div>
</nav>
@yield('content')
<section class="footer-bg" >
<div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 align-self-center">
                    <div class="footer-img-media">
                        <img class="img-fluid-mine" src="/images/Veedros Logo.svg"
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
                                    <li class="my-3 w-33-mine">
                                    <a class="" href="{{asset("courses")}}">Courses</a>
                                    </li >
                                    <li class="my-3 w-33-mine">
                                    <a class="" href="{{asset("teach")}}">Teach</a>
                                    </li >
                                    <li class="my-3 w-33-mine">
                                    <a class="" href="{{asset("academic")}}">Academic</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-12 col-lg-4">
                                <ul>
                                    <li class="footer-list-header">
                                        <p>KNOWLEDGE</p>
                                    </li>
                                    <li class="my-3 w-50-mine">
                                    <a class="" href="{{asset("privacy")}}">Privacy Policy</a>
                                    </li>
                                    <li class="my-3 w-50-mine">
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
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 mb-3 col-12 copyrights">
                    <div class="d-flex justify-content-between">
                        <p>Veedros copyrights reserved 2020</p>
                        <div>
                            <a class="mr-3" href="https://www.facebook.com/veedrosedu/" target="_blank"><i  class="fab fa-facebook-square"></i></a>
                            <a href=""><i class="fab fa-twitter" target="_blank"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="{{asset('clamp')}}/clamp.min.js"></script>
<!-- tippy js  -->
<script src="https://unpkg.com/tippy.js@5"></script>
<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@yield('libraryJS')
<script>
    let csrfToken = '@csrf';
</script>
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

@if(Auth::check())
    <script>
        let subtotal = 0;
        let cartItemContainer = '';
        @if(count(Auth::user()->carted) > 0)
            let cartItems = {!! json_encode(Auth::user()->carted->toArray()) !!};
            for(let i = 0; i < cartItems.length; i++){
                subtotal += cartItems[i].price;
                cartItemContainer += `<div class="my-3 row cart-card ">
                        <div class="p-0 m-0 col-4 align-self-start ">
                            <div class="card course-card development-card noJquery" style="background-image: url(${cartItems[i].img})">
                            </div>
                        </div>
                        <div class="p-0 m-0 col-8 align-self-center ">

                                <div class="tip-cart-content">

                                        <p class="pr-4 text-left P-title">${cartItems[i].name}</p>

                                            <p class="pr-4 text-left P-description">${cartItems[i].about}
                                            </p>

                                </div>
                                <div class="p-0 tip-meta">
              <div class="row justify-content-start">
                <div class="p-0 col-6">
                  <div class="shadow-sm badge tip-badge">
                    <div class="tip-badge-item">  <i class="fas fa-hand-holding-usd"></i> <span>${cartItems[i].price} EGP</span></div>
                  </div>
                </div>
                </div>
                </div>
                    </div>
            </div>`
            }
        @else
            cartItemContainer = `<div class="px-3 d-flex w-100 h-100 justify-content-center align-items-center">
<h2 class="my-auto text-center text-muted">You don't have any courses in your cart yet.</h2>
</div>`;
        @endif
        let cart_tip_content = `<div class="tip">
        <div class="cart-container">
        ${cartItemContainer}
        </div>
    <div class="cart-footer">
        <div class="container">
            <p class="text-left font-weight-bold text-muted">Sub total: <span>${subtotal}</span> EGP</p>
        </div>
        <div class="px-3 d-flex w-100">
            <a href="/cart" class="mx-auto border-0 btn btn-veedros-new btn-veedros-md" style="max-width: 100%">
                                Go to cart</a>
        </div>
    </div>
</div>`;
        let cart_tip = document.createElement('div');
        cart_tip.innerHTML = cart_tip_content;
        if(document.querySelector('#cartTip'))
            tippy('#cartTip', {
                allowTitleHTML: true,
                content: cart_tip_content,
                interactive: true,
                placement: "bottom",
                theme: "veedros-cart",
                trigger: "click focus",
                boundary: 'viewport'
            });

    </script>
@endif

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

<script>
    feather.replace();
</script>
</body>

</html>

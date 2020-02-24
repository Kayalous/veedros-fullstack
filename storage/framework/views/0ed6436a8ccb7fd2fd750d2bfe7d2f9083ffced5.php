<!DOCTYPE html>
<html lang="en">

<head>
    <title>Veedros</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- feather icons  -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet" />
    <?php echo $__env->yieldContent('libraryCSS'); ?>
    <!-- Font Awesome  -->
    <script src="https://kit.fontawesome.com/04f7d66693.js" crossorigin="anonymous"></script>
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('styles/style.css')); ?>" />
    <?php echo $__env->yieldContent('customCSS'); ?>
</head>

<body>
<?php if(!Auth::check()): ?>
<!-- Modals  -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content login-body">
            <div class="modal-body px-5">
                <form class="login" action="<?php echo e(route('login')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    <p class="text-center mt-5">
                        Enter your email. <br />
                        We'll send you a magic login link.
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="form-control email-input email-field email-field-props modal-field-props border-0 mx-auto"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="login-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="input-group password-cont mt-4 d-none" id="login-password-cont">
                        <input type="password"
                               class="form-control email-input password-field email-field-props modal-field-props border-0 mx-auto mt-"
                               placeholder="hunter1" aria-label="password" name="password" id="login-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                    </div>
                    <div class="d-flex jusift-content-center mt-3 mb-3">
                        <button type="submit" id="login-button" class="btn btn-veedros btn-veedros-md mx-auto btn-submit">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="register-prompt mb-4">
                    <h6>Don't have an account?</h6>
                    <a class="signup-toggle dot-hover dot-hover-red" href="#">Sign up
                        instead</a>
                </div>
                <div class="register-prompt magic-link mb-3" id="login-magic-link">
                    <h6>Not recieving your magic link?</h6>
                    <a class="login-with-password dot-hover dot-hover-red" href="#">Sign in with password</a>
                </div>
                <div class="register-prompt forgot-password d-none mb-3" id="login-alt-cont">
                    <h6>Forgot password?</h6>
                    <a class="dot-hover dot-hover-red" href="#">Reset now</a>
                </div>
                <hr>
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can login with:</h6>
                    <div class="d-flex justify-content-around align-items-center w-100 mt-3 border-0">
                        <a href="<?php echo e(route('login.facebook')); ?>" title="Facebook" class="btn btn-facebook btn-lg border-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
                        <a href="<?php echo e(route('login.google')); ?>" title="Google" class="btn btn-google btn-lg border-0"><i class="fab fa-google mr-2"></i>Google</a>
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
                <form class="signup" action="<?php echo e(route('register')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    <p class="text-center mt-5">
                        Sign up using your email. <br />
                        We'll send you a link to create your new account.
                    </p>
                    <div class="input-group">
                        <input type="email"
                               class="form-control email-input email-field email-field-props modal-field-props border-0 mx-auto"
                               placeholder="johndoe@gmail.com" aria-label="email" name="email" id="signup-email-field" />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="input-group password-cont mt-4 d-none" id="signup-password-cont">

                        <input type="password"
                               class="form-control email-input password-field email-field-props modal-field-props border-0 mx-auto mt-"
                               placeholder="● ● ● ● ● ● ● ●" aria-label="password" name="password" id="signup-password-field" />
                        <div class="invalid-feedback">
                            Your password must be more than 8 characters long.
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="d-flex jusift-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-veedros btn-veedros-md mx-auto btn-submit" id="signup-button">
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
                    <h6>Prefer using a password?</h6>
                    <a class="signup-with-password dot-hover dot-hover-red" href="#">Sign up with password</a>
                </div>
                <hr>
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <h6>Or you can sign up with:</h6>
                    <div class="d-flex justify-content-around align-items-center w-100 mt-3 border-0">
                        <a href="<?php echo e(route('login.facebook')); ?>" title="Facebook" class="btn btn-facebook btn-lg border-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
                        <a href="<?php echo e(route('login.google')); ?>" title="Google" class="btn btn-google btn-lg border-0"><i class="fab fa-google mr-2"></i>Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
<?php endif; ?>
<!-- Navbar  -->
<nav class="navbar navbar-expand-lg absolute-top main-navbar navbar-light">
    <a class="navbar-brand logo" href="<?php echo e(route('landing')); ?>"><img class="img-fluid" style="width: 120px;" src="<?php echo e(asset('images/Veedros Logo.svg')); ?>"
                                               alt="Logo"></a>
    <button class="navbar-toggler border-0 d-lg-none" type="button" data-toggle="collapse"
            data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
        <i data-feather="menu"></i>
    </button>
    <div class="collapse navbar-collapse no-flex-grow pb-3" id="collapsibleNavId">
        <ul class="navbar-nav nav-items-container">
            <?php if(Auth::user()): ?>
                <?php if(!Auth::user()->hasRole('admin')): ?>
            <li class="nav-item">
                <a class="nav-link dot-hover dot-hover-black" href="#">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link dot-hover dot-hover-black" href="#">How it works</a>
            </li>
            <?php if(Auth::user()->instructor): ?>
                        <li class="nav-item">
                            <a class="nav-link dot-hover dot-hover-black" href="<?php echo e(route('manage.courses')); ?>">Manage your courses</a>
                        </li>
                    <?php else: ?>
            <li class="nav-item">
                <a class="nav-link dot-hover dot-hover-black" href="#">Teach</a>
            </li>
                <?php endif; ?>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link dot-hover dot-hover-red" href="<?php echo e(route('veedros.admin')); ?>">Manage users</a>
                </li>
            <?php endif; ?>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link dot-hover dot-hover-black" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dot-hover dot-hover-black" href="#">How it works</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link dot-hover dot-hover-black" href="#">Teach</a>
                </li>
                <?php endif; ?>

            <?php if(!Auth::check()): ?>
                <li class="nav-item d-flex align-items-center justify-content-center">
                    <a href="#" class="btn btn-veedros btn-veedros-sm border-0" data-toggle="modal" data-target="#loginModal">Sign in </a> </li>
            <?php else: ?>
                <?php if(Auth::user()->hasRole('admin')): ?>
                    <li class="nav-item">
                        <a class="nav-link dot-hover dot-hover-red" href="<?php echo e(route("voyager.dashboard")); ?>">Admin dashboard</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item d-flex align-items-center justify-content-around">
                    <div class="row">
                        <div class="col-6">
                                <img id="singleElement" class="nav-photo" src="<?php echo e(asset('uploads/profilePictures/') . '/'.Auth::user()->img); ?>" alt="profile picture">
                        </div>
                        <div class="col-6">
                            <i class="far fa-bookmark" aria-hidden="true"></i>
                        </div>
                    </div>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php echo $__env->yieldContent('content'); ?>
<!-- =====================================  FOOTER ========================================= -->
<section>

    <div class=" footer px-2  py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <ul class="text-center-mine">
                        <li>
                            <img class="img-fluid responsive-mine" src="<?php echo e(asset('images/Veedros Logo.svg')); ?>" alt="">
                        </li>
                        <li class="footer-contactus-responsive">
                            Lorem Ipsum is tandard dummy text ever since the 1500s,
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-lg-4">
                    <ul class=" text-center footer-CHT">
                        <li class="w-33">
                            <a class="footer-text" href="">Courses</a>
                        </li>
                        <li class="w-33 ">
                            <a class="footer-text footer-text-color" href=""> How it works</a>
                        </li>
                        <li class="w-33 ">
                            <a class="footer-text footer-text-color" href=""> Teach</a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-lg-4">
                    <ul class="text-center footer-md-respon footer-contactus-responsive">
                        <li class="d-flex justify-content-center d-inline-block-mine">
                            <div class="w-footer-icon m-auto ">
                                <div class="row">
                                    <div class="col-3 col-lg-6">
                                        <a href="#"><i class="fab fa-facebook-f " aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-3 col-lg-6">
                                        <a href=" #"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-3 col-lg-6">
                                        <a href="#"><i class="fab fa-facebook-f " aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-3 col-lg-6">
                                        <a href=" #"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>


                        </li>

                        <li class="d-inline-block-mine">
                            <button type="button" class="btn nav-btn btn-outline-dark btn-sm rounded-mine">contact
                                Us</button>
                        </li>
                    </ul>
                    </divc>
                </div>
            </div>
        </div>
</section>

<div class="text-center Copyright">
    <p class="">Veedros All rights reseved 2020</p>
</div>
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
<?php echo $__env->yieldContent('libraryJS'); ?>
<!-- App javascript  -->
<script src="<?php echo e(asset('scripts/app.js')); ?>"></script>
<?php if(!Auth::check()): ?>
<script src="<?php echo e(asset('scripts/auth.js')); ?>"></script>
<?php endif; ?>
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
<?php echo $__env->yieldContent('customJS'); ?>

</body>

</html>
<?php /**PATH /Users/k/Documents/Web/Laravel/veedros/resources/views/layout.blade.php ENDPATH**/ ?>
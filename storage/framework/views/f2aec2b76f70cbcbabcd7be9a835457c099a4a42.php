<?php $__env->startSection('customCSS'); ?>
    <link rel="stylesheet" href="styles/profile.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="slash slash-to-right"></div>

    <!-- Profile edit  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 mx-auto">
                    <div class="card profile-card px-4 py-5">
                        <div class="card-body">
                            <div class="mx-auto text-center">
                                <div class="row">
                                    <div class="col-lg-5 my-auto">
                                        <img src=" images/05.jpg" alt="instructor" class="round-md img-fluid" />
                                    </div>
                                    <div class="col-lg-7 col-md-9 mx-auto">
                                        <div class="input-group mb-2">
                                            <h5>Name</h5>
                                            <input type="text"
                                                   class="form-control profile-form-field email-field-props border-light border-radius-sm is-valid"
                                                   placeholder="Yassen Ali" />
                                        </div>
                                        <div class="input-group mb-2">
                                            <h5>Phone number</h5>
                                            <input type="text"
                                                   class="form-control profile-form-field email-field-props border-light border-radius-sm is-invalid"
                                                   placeholder="+20 114 720 0863" />
                                        </div>
                                        <div class="input-group mb-2">
                                            <h5>Email</h5>
                                            <input type="text"
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
                                                       class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                       placeholder="● ● ● ● ● ● ● ●" /> <button
                                                    class="btn btn-secondary-veedros ml-2"><i
                                                        data-feather="eye-off"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-2">
                                            <h5>Repeat password</h5>
                                            <input type="password"
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
                                                   class="form-control profile-form-field email-field-props border-light border-radius-sm"
                                                   placeholder="Alexandria, Egypt" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="input-group mb-2">
                                            <h5>About you</h5>
                                            <textarea rows="5" cols="50" maxlength="400"
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
                                        <input type="text" class="form-control form-control-social border-0">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-9 mx-auto my-3">
                                    <div class="input-group border-light profile-social-field">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="linkedin"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-social border-0">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-9 mx-auto my-3">
                                    <div class="input-group border-light profile-social-field">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="facebook"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-social border-0">
                                    </div>
                                </div>
                            </div>


                            <div class="w-100 text-center mt-5">
                                <a href="<?php echo e(route('profile')); ?>" class="btn btn-veedros btn-veedros-lg border-0">
                                    <h4 class="my-0 mx-5">Save</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/k/Documents/Web/Laravel/veedros/resources/views/manage.blade.php ENDPATH**/ ?>
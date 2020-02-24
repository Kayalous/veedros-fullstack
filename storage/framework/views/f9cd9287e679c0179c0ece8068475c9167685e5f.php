<?php $__env->startSection('customCSS'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('styles/profile.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="slash slash-to-right"></div>

    <!-- Profile  -->
    <section class="profile my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <div class="card profile-card py-5">
    <?php if($user == Auth::user()): ?>
    <a href="<?php echo e(route('manage')); ?>"
       class="btn btn-secondary-veedros border-medium edit-btn mr-4 mt-4"><i
            data-feather="edit"></i>
        Edit</a>
        <?php endif; ?>
    <div class="card-body">

        <div class="mx-auto text-center">
            <div class="instructor-img-wrapper mx-auto">
                <img src="<?php echo e(asset('uploads/profilePictures/'). '/' .$user->img); ?>" alt="profile image" class="round-lg mx-auto img-fluid"/>
            </div>
            <?php if($user->name != null): ?>
            <h1 class="mt-3"><?php echo e($user->name); ?></h1>
            <?php endif; ?>
            <?php if($user->position != null): ?>
                <h5><?php echo e($user->position); ?></h5>
            <?php endif; ?>
            <?php if($user->location != null): ?>
            <h6><i class="mr-1" data-feather="globe"></i><?php echo e($user->location); ?></h6>
            <?php endif; ?>
            <?php if($user->about != null): ?>
            <hr class="my-5">
            <div class="container mx-2">
                <h5><?php echo e($user->about); ?></h5>
            </div>
            <?php endif; ?>

            <?php if($user->twitter != null || $user->facebook != null || $user->linkedin != null): ?>
                <hr class="my-5">
            <?php endif; ?>
            <div class="d-flex justify-content-center align-items-center">
                <?php if($user->twitter != null): ?>
                    <a target="_blank" href="//<?php echo e($user->twitter); ?>">
                        <h1><i data-feather="twitter"></i></h1>
                    </a>
                <?php endif; ?>
                <?php if($user->facebook != null): ?>
                    <a target="_blank" href="//<?php echo e($user->facebook); ?>">
                        <h1><i data-feather="facebook"></i></h1>
                    </a>
                <?php endif; ?>
                <?php if($user->linkedin != null): ?>
                    <a target="_blank" href="//<?php echo e($user->linkedin); ?>">
                        <h1><i data-feather="linkedin"></i></h1>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</section>

<section class="featured courses mt-5 pt-5">

<div class="container container-mine">
<div class="row">
<div class="header-text ml-5">
<h1>
    Courses by this instructor
</h1>
</div>
<div class="col-12">
<div class="course-cards-container card-columns mb-5 py-3">
    <div class="card course-card development-card noJquery"
         style="background-image: url('images/img_01.png')" data-toggle="modal"
         data-target="#exampleModal">
        <div class="course-card-overlay overlay-0"></div>
        <div class="card-body m-0">
            <div class="card-body-inner noscroll card-bg-img">
                <div class="play-circle play-circle-0"><img style="height:40px; width:40px "
                                                            src="<?php echo e(asset('images')); ?>/Play_button.svg" alt="play button"/>
                </div>
                <h4 class="card-title title-mine">
                    Full Stack Web Development
                </h4>
            </div>
        </div>
    </div>
    <div class="card course-card development-card noJquery"
         style="background-image: url('images/img_02.png')" data-toggle="modal"
         data-target="#exampleModal">
        <div class="course-card-overlay overlay-1"></div>
        <div class="card-body m-0">
            <div class="card-body-inner noscroll card-bg-img">
                <div class="play-circle play-circle-1"><img style="height:40px; width:40px "
                                                            src="<?php echo e(asset('images')); ?>/Play_button.svg" alt="play button"/>
                </div>
                <h4 class="card-title title-mine">
                    Full Stack Web Development
                </h4>
            </div>
        </div>
    </div>
    <div class="card course-card development-card noJquery"
         style="background-image: url('images/img_03.png')" data-toggle="modal"
         data-target="#exampleModal">
        <div class="course-card-overlay overlay-2"></div>
        <div class="card-body m-0">
            <div class="card-body-inner noscroll card-bg-img">
                <div class="play-circle play-circle-2"><img style="height:40px; width:40px "
                                                            src="<?php echo e(asset('images')); ?>/Play_button.svg" alt="play button"/>
                </div>
                <h4 class="card-title title-mine">
                    Full Stack Web Development
                </h4>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/k/Documents/Web/Laravel/veedros/resources/views/profile.blade.php ENDPATH**/ ?>


<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
        <div class="container">
            <div class="hero-content">
                <h2 class="hero-title"></h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                    </li>
                    <li>
                        <?php echo app('translator')->get('Registration'); ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Hero -->

    <!-- Account -->
    <section class="account-section pt-100 pb-100">
        <div class="container">
            <div class="account-wrapper bg--body">
                <div class="section-title mb-3">
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('Sign Up'); ?></h6>
                    <h3 class="title"><?php echo app('translator')->get('Create Account Now'); ?></h3>
                </div>
                <form id="registerform" class="account-form row gy-3 gx-4 align-items-center" action="<?php echo e(route('user.register.submit')); ?>" method="POST">
                    <?php if ($__env->exists('includes.user.form-both')) echo $__env->make('includes.user.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo csrf_field(); ?>
                    <div class="col-sm-6">
                        <label for="name" class="form-label"><?php echo app('translator')->get('Your Name'); ?></label>
                        <input type="text" id="name" name="name" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="email" class="form-label"><?php echo app('translator')->get('Your Email'); ?></label>
                        <input type="text" id="email" name="email" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="phone" class="form-label"><?php echo app('translator')->get('Your Phone'); ?></label>
                        <input type="text" id="phone" name="phone" class="form-control form--control">
                    </div>

                    <div class="col-sm-6">
                        <label for="password" class="form-label"><?php echo app('translator')->get('Your Password'); ?></label>
                        <input type="password" id="password" name="password" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="confirm-password" class="form-label"><?php echo app('translator')->get('Confirm Password'); ?></label>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            class="form-control form--control">
                    </div>
                    <div class="col-sm-12 d-flex flex-wrap justify-content-between align-items-center">
                        <button type="submit" class="cmn--btn bg--base me-3">
                            <?php echo app('translator')->get('Register Now'); ?>
                        </button>
                        <div class="text-end">
                            <a href="<?php echo e(route('user.login')); ?>" class="text--base"><?php echo app('translator')->get('Already have
                                an account '); ?>?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="form-check mt-3 mb-0">
                            <input type="checkbox" id="accept" class="form-check-input" checked>
                            <label class="form-check-label" for="accept"><?php echo app('translator')->get('I accept all the'); ?> <a href="#0"
                                    class="text--base"><?php echo app('translator')->get('privacy & policy'); ?></a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Account -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/register.blade.php ENDPATH**/ ?>
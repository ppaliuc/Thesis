

<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
        <div class="container">
            <div class="hero-content">
                <h2 class="hero-title"><?php echo app('translator')->get('Login'); ?></h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                    </li>
                    <li>
                        <?php echo app('translator')->get('Login'); ?>
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
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('Sign In'); ?></h6>
                    <h3 class="title"><?php echo app('translator')->get('Login Now'); ?></h3>
                </div>
                <form class="account-form row gy-3 gx-4 align-items-center" id="loginform" action="<?php echo e(route('user.login.submit')); ?>" method="POST">
                    <?php if ($__env->exists('includes.user.form-both')) echo $__env->make('includes.user.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo csrf_field(); ?>
                    <div class="col-sm-12">
                        <label for="email" class="form-label"><?php echo app('translator')->get('Your Email'); ?></label>
                        <input type="text" id="email" name="email" class="form-control form--control">
                    </div>
                    <div class="col-sm-12">
                        <label for="password" class="form-label"><?php echo app('translator')->get('Your Password'); ?></label>
                        <input type="password" id="password" name="password" class="form-control form--control">
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn bg--base me-3">
                            <?php echo app('translator')->get('Login Now'); ?>
                        </button>
                        <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                            <a href="<?php echo e(route('user.forgot')); ?>" class="text--base mt-1"><?php echo app('translator')->get('Forget Password'); ?></a>
                            <a href="<?php echo e(route('user.register')); ?>" class="text--base mt-1"><?php echo app('translator')->get("Don't have
                                an account ?"); ?></a>
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
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/login.blade.php ENDPATH**/ ?>
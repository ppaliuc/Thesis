

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
      <div class="container">
          <div class="hero-content">
              <h2 class="hero-title"> <?php echo app('translator')->get('OTP'); ?> </h2>
              <ul class="breadcrumb">
                  <li>
                      <a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                  </li>
                  <li>
                      <?php echo app('translator')->get('Two Factor Authentication'); ?>
                  </li>
              </ul>
          </div>
      </div>
  </section>
  <!-- Hero -->

  <section class="about-section pt-100 pb-50">
		<div class="container">
			<div class="row gy-5">
				<div class="col-lg-12">
          <form action="<?php echo e(route('user.otp.submit')); ?>" method="POST">
            <?php echo $__env->make('includes.admin.form-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo e(csrf_field()); ?>

            <div class="row">
              <div class="col-lg-12">
                <div class="form-input">
                  <input type="text" class="form-control" name="otp" placeholder="<?php echo app('translator')->get('Type Your otp'); ?>" required="">
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <button type="submit" class="submit-btn btn btn-primary mt-4"><?php echo app('translator')->get('Submit'); ?></button>
            </div>

          </form>
				</div>
			</div>
		</div>
	</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script src="<?php echo e(asset('assets/user/js/sweetalert2@9.js')); ?>"></script>

<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
          "use strict";
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
            Toast.fire({
            icon: 'error',
            title: '<?php echo e($error); ?>'
            })
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/otp.blade.php ENDPATH**/ ?>
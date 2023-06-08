<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Update Profile')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-3 py-4 px-sm-4">
                    <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form id="request-form" action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                          <div class="col-md-6 mx-auto">
                              <div class="form-group">
                                <label class="font-weight-bold"><?php echo e(__('Set Image')); ?> </label>
                                <div class="wrapper-image-preview">
                                    <div class="box">
                                        <div class="back-preview-image" style="background-image: url(<?php echo e(auth()->user()->photo ? asset('assets/images/'.auth()->user()->photo) : asset('assets/images/placeholder.jpg')); ?>);"></div>
                                        <div class="upload-options">
                                            <label class="img-upload-label" for="img-upload"> <i class="fa fa-camera"></i> <?php echo e(__('Upload Picture')); ?> </label>
                                            <input id="img-upload" type="file" class="image-upload" name="photo" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row g-3">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('User Name')); ?></label>
                              <input name="name" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('User Name')); ?>" type="text" value="<?php echo e($user->name); ?>" required readonly>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('Email Address')); ?></label>
                              <input name="email" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Email Address')); ?>" type="email" value="<?php echo e($user->email); ?>" required readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('Phone Number')); ?></label>
                              <input name="phone" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Phone Number')); ?>" type="tel" value="<?php echo e($user->phone); ?>" required>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('Zip')); ?></label>
                              <input name="zip" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Zip')); ?>" type="text" value="<?php echo e($user->zip); ?>" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('City')); ?></label>
                              <input name="city" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('City')); ?>" type="text" value="<?php echo e($user->city); ?>" required>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('Fax')); ?></label>
                              <input name="fax" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Fax')); ?>" type="text" value="<?php echo e($user->fax); ?>" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label required"><?php echo e(__('Address')); ?></label>
                              <input name="address" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Address')); ?>" type="text" value="<?php echo e($user->address); ?>" required>
                            </div>
                          </div>
                        </div>




                        <div class="form-footer">
                          <button type="submit" class="btn btn-primary submit-btn"><?php echo e(__('Submit')); ?></button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
  'use strict';
  
  $('.edit-profile').on('click',function(){
    $('.upload').click();

  });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/profile.blade.php ENDPATH**/ ?>
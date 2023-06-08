<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Changed Password')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-4">
                    <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form id="request-form" action="" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('Change Password')); ?></label>
                            <input name="cpass" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Change Password')); ?>" type="password" required>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('New Password')); ?></label>
                            <input name="newpass" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Change Password')); ?>" type="password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required"><?php echo e(__('Re-Type New Password')); ?></label>
                            <input name="renewpass" class="form-control form--control" autocomplete="off" placeholder="<?php echo e(__('Re-Type New Password')); ?>" type="password" required>
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

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/changepassword.blade.php ENDPATH**/ ?>
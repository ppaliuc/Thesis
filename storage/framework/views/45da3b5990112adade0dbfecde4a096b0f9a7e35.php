<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">
          <?php echo e(__('KYC Form')); ?>

        </h2>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container-xl">
      <div class="row row-cards">
          <div class="col-12">
              <div class="card p-5">
                  <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      <form action="<?php echo e(route('user.kyc.submit')); ?>" method="POST" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>

                          <?php $__currentLoopData = $userForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($field->type == 1 || $field->type == 3 ): ?>
                              <div class="form-group mb-3 mt-3">
                                <label class="form-label <?php echo e($field->required == 1 ? 'required':'Optional'); ?>"><?php echo app('translator')->get($field->label); ?></label>
                                <?php if($field->type == 1): ?>
                                  <input type="text" name="<?php echo e(strtolower(str_replace(' ', '_', $field->label))); ?>" class="form-control" autocomplete="off" placeholder="<?php echo app('translator')->get($field->label); ?>" min="1" <?php echo e($field->required == 1 ? 'required':'Optional'); ?>>
                                  <?php else: ?> 
                                  <textarea class="form-control" name="<?php echo e(strtolower(str_replace(' ', '_', $field->label))); ?>" placeholder="<?php echo app('translator')->get($field->label); ?>"></textarea>
                                <?php endif; ?>
                              </div>
                            <?php elseif($field->type == 2): ?>
                              <div class="form-group mb-3 mt-3">
                                <label class="form-label <?php echo e($field->required == 1 ? 'required':'Optional'); ?>"><?php echo app('translator')->get($field->label); ?></label>
                                <input type="file" name="<?php echo e(strtolower(str_replace(' ', '_', $field->label))); ?>" class="form-control" autocomplete="off" <?php echo e($field->required == 1 ? 'required':'Optional'); ?>>
                              </div>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
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

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/kyc/index.blade.php ENDPATH**/ ?>
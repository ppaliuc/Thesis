<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Withdraw Now')); ?>

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

                        <?php if($gs->withdraw_status == 0): ?>
                            <p class="text-center text-danger"><?php echo e(__('WithDraw is temporary Off')); ?></p>
                        <?php else: ?>
                            <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <form action="<?php echo e(route('user.withdraw.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label class="form-label required"><?php echo e(__('Withdraw Method')); ?></label>
                                    <select name="methods" id="withmethod" class="form-select" required>
                                        <option value=""><?php echo e(__('Select Withdraw Method')); ?></option>
                                        <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data->method); ?>"><?php echo e($data->method); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <input type="hidden" name="currency_sign" value="<?php echo e($currency->sign); ?>">
                                <input type="hidden" id="currencyCode" name="currency_code" value="<?php echo e($currency->name); ?>">
                                <input type="hidden" name="currency_id" value="<?php echo e($currency->id); ?>">

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required"><?php echo e(__('Withdraw Amount')); ?></label>
                                    <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" min="1" required>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required"><?php echo e(__('Description')); ?></label>
                                    <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="<?php echo e(__('Receive account details')); ?>" required></textarea>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
                                </div>


                            </form>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/withdraw/create.blade.php ENDPATH**/ ?>
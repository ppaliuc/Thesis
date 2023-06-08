<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <div class="page-pretitle">
            <?php echo e(__('Overview')); ?>

          </div>
          <h2 class="page-title">
            <?php echo e(__('Other Bank Transfer')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-5">
                <div class="card p-3 p-lg-4">
                    <table class="table table-transparent table-responsive">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Minimum Amount')); ?></p>
                                </td>
                                <td class="text-end"> <?php echo e(showNameAmount($data->bank->min_limit)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Maximum Amount')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showNameAmount($data->bank->max_limit)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Daily Amount Limit')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showNameAmount($data->bank->daily_maximum_limit)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Daily Monthly Limit')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showNameAmount($data->bank->monthly_maximum_limit)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Daily Limit')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($data->bank->daily_total_transaction); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Monthly Limit')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($data->bank->monthly_total_transaction); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card p-3 p-lg-4">
                    <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form action="<?php echo e(route('user.other.send.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="other_bank_id" value="<?php echo e($data->other_bank_id); ?>">
                        <input type="hidden" name="beneficiary_id" value="<?php echo e($data->id); ?>">
                        <div class="form-group mb-3">
                            <label class="form-label required"><?php echo e(__('Bank Name')); ?></label>
                            <input name="bank_name" id="bank_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Wells Fargo')); ?>" type="text" value="<?php echo e($data->bank->title); ?>" min="1" required readonly>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('Name')); ?></label>
                            <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Jhon Doe')); ?>" type="text" value="<?php echo e($data->account_name); ?>" min="1" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label required"><?php echo e(__('Amount')); ?></label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" min="1" required>
                        </div>

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


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/otherbank/send.blade.php ENDPATH**/ ?>
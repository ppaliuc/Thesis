<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('DPS Apply Form')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card p-4">
                    <table class="table table-transparent table-responsive">

                        <tbody>
                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Plan Title')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($data->title); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Per Installment Amount')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showprice($data->per_installment,$currency)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Total Deposit Amount')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showprice($data->final_amount,$currency)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('User Profit')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e(showprice(($data->final_amount + $data->user_profit),$currency)); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Total Installment')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($data->total_installment); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Interest Rate')); ?></p>
                                </td>
                                <td class="text-end"> <?php echo e($data->interest_rate); ?> (%)</td>
                            </tr>


                        </tbody>
                    </table>

                    <form action="<?php echo e(route('user.loan.dpsSubmit')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="dps_plan_id" value="<?php echo e($data->id); ?>">
                        <input type="hidden" name="per_installment" value="<?php echo e($data->per_installment); ?>">
                        <input type="hidden" name="deposit_amount" value="<?php echo e($data->final_amount); ?>">
                        <input type="hidden" name="matured_amount" value="<?php echo e($data->final_amount + $data->user_profit); ?>">


                        <button type="submit" id="submit-btn" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/dps/apply.blade.php ENDPATH**/ ?>
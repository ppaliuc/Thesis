<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Loan Apply Form')); ?>

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
                                    <p class="strong mb-1"><?php echo e(__('Loan Amount')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($loanAmount.' '.$currency->sign); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Total Installment')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($data->total_installment); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1"><?php echo e(__('Per Installment')); ?></p>
                                </td>
                                <td class="text-end"><?php echo e($perInstallment.' '.$currency->sign); ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1 text-danger"><?php echo e(__('Total Amount To Pay')); ?></p>
                                </td>
                                <td class="text-end text-danger"><?php echo e($perInstallment * $data->total_installment.' '.$currency->sign); ?></td>
                            </tr>

                        </tbody>
                    </table>

                    <form action="<?php echo e(route('user.loan.request')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="plan_id" value="<?php echo e($data->id); ?>">
                        <input type="hidden" name="total_installment" value="<?php echo e($data->total_installment); ?>">
                        <input type="hidden" name="loan_amount" value="<?php echo e($loanAmount); ?>">
                        <input type="hidden" name="per_installment_amount" value="<?php echo e($perInstallment); ?>">
                        <input type="hidden" name="total_amount" value="<?php echo e($perInstallment * $data->total_installment); ?>">

                        <?php if($data->required_information): ?>
                            <?php $__currentLoopData = json_decode($data->required_information,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value['type'] == 'file'): ?>
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" <?php echo e($value['validation']); ?>> <?php echo e($value['field_name']); ?> </label>
                                        <input type="file" name="<?php echo e($value['field_name']); ?>" class="form-control" autocomplete="off" <?php echo e($value['validation']); ?>>
                                    </div>
                                <?php endif; ?>

                                <?php if($value['type'] == 'text'): ?>
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" <?php echo e($value['validation']); ?>> <?php echo e($value['field_name']); ?> </label>
                                        <input type="text" name="<?php echo e($value['field_name']); ?>" placeholder="<?php echo e($value['field_name']); ?>" class="form-control" autocomplete="off" <?php echo e($value['validation']); ?>>
                                    </div>
                                <?php endif; ?>

                                <?php if($value['type'] == 'textarea'): ?>
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" <?php echo e($value['validation']); ?>> <?php echo e($value['field_name']); ?> </label>
                                        <textarea type="text" name="<?php echo e($value['field_name']); ?>" placeholder="<?php echo e($value['field_name']); ?>" cols="30" class="form-control" <?php echo e($value['validation']); ?>></textarea>
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

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


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/loan/apply.blade.php ENDPATH**/ ?>
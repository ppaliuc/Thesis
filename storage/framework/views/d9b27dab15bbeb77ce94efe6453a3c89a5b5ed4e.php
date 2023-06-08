<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Commissions Log')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <?php if(count($commissions) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('From')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $receiver = App\Models\User::whereId($data->from_user_id)->first();
                                    ?>
                                        <tr>
                                            <td data-label="<?php echo e(__('Date')); ?>">
                                                <div>
                                                    <?php echo e($data->created_at->toDateString()); ?>

                                                </div>
                                            </td>

                                            <td data-label="<?php echo e(__('Type')); ?>">
                                                <div>
                                                    <?php echo e(ucfirst($data->type)); ?>

                                                </div>
                                            </td>

                                            <td data-label="<?php echo e(__('From')); ?>">
                                                <div>
                                                    <?php echo e($receiver != NULL ? $receiver->name : ''); ?>

                                                </div>
                                            </td>

                                            <td data-label="<?php echo e(__('Amount')); ?>">
                                                <div>
                                                    <?php echo e(showNameAmount($data->amount)); ?>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($commissions->render()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/referral/commission.blade.php ENDPATH**/ ?>
<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Withdraw Details')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
          <div class="col-12">
              <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('WithDraw Method')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e($data->method); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('User Name')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e($data->user->name); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Amount')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(showNameAmount($data->amount)); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Fees')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(showNameAmount($data->fee)); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Status')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">
                                  <?php if($data->status == 'completed'): ?>
                                    <span class="badge bg-success"><?php echo e(__('Completed')); ?></span>
                                  <?php elseif($data->status == 'pending'): ?>
                                    <span class="badge bg-warning"><?php echo e(__('Pending')); ?></span>
                                  <?php else: ?>
                                    <span class="badge bg-danger"><?php echo e(__('Rejected')); ?></span>
                                  <?php endif; ?>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/withdraw/details.blade.php ENDPATH**/ ?>
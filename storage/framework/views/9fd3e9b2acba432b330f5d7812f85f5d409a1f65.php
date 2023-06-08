<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Request Money Details')); ?>

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
                    <div class="heading-area">
                        <h4 class="title">
                        <?php echo e(__('Request Money')); ?>

                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Request From')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e($from->name); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Request To')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e($to->name); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Amount')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(showNameAmount($data->amount)); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Cost')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(showNameAmount($data->cost)); ?></td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%"><?php echo e(__('Amount To Get')); ?></th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%"><?php echo e(showNameAmount(($data->amount - $data->cost))); ?></td>
                            </tr>

                            <tr>
                                <th width="45%"><?php echo e(__('Details')); ?></th>
                                <td width="10%">:</td>
                                <td width="45%"><?php echo e($data->details); ?></td>
                            </tr>

                            <tr>
                                <th width="45%"><?php echo e(__('Request Date')); ?></th>
                                <td width="10%">:</td>
                                <td width="45%"><?php echo e($data->created_at->diffForHumans()); ?></td>
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


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/requestmoney/details.blade.php ENDPATH**/ ?>
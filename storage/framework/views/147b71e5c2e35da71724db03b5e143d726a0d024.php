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
            <?php echo e(__('Transfer Logs')); ?>

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
                    <?php if(count($logs) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Transfer Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Transaction Number')); ?></th>
                                    <th><?php echo e(__('Account No')); ?></th>
                                    <th><?php echo e(__('Account Name')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Date')); ?>"><?php echo e($data->created_at->toFormattedDateString()); ?></td>
                                          <td data-label="<?php echo e(__('Transaction Number')); ?>"><?php echo e($data->transaction_no); ?></td>
                                          <?php if($data->receiver_id): ?>
                                            <?php
                                              $receiver = App\Models\User::whereId($data->receiver_id)->first();
                                            ?>

                                            <td data-label="<?php echo e(__('Account No')); ?>"><?php echo e($receiver != NULL ? $receiver->account_number : 'User Deleted'); ?></td>
                                            <td data-label="<?php echo e(__('Account Name')); ?>"><?php echo e($receiver != NULL ? $receiver->name : 'User Deleted'); ?></td>
                                          <?php endif; ?>

                                          <?php if(!$data->receiver_id): ?>
                                            <?php
                                              $beneficiary = App\Models\Beneficiary::whereId($data->beneficiary_id)->first();
                                            ?>
                                            <td data-label="<?php echo e(__('Account No')); ?>"><?php echo e($beneficiary != NULL ? $beneficiary->account_number : 'deleted'); ?></td>
                                            <td data-label="<?php echo e(__('Account Name')); ?>"><?php echo e($beneficiary != NULL ? $beneficiary->account_name : 'deleted'); ?></td>
                                          <?php endif; ?>
                                          <td data-label="<?php echo e(__('Type')); ?>"><?php echo e($data->type); ?> <?php echo e(__('Bank')); ?></td>
                                          <td data-label="<?php echo e(__('Amount')); ?>"><?php echo e(showNameAmount($data->amount)); ?></td>
                                          <td data-label="<?php echo e(__('Status')); ?>">
                                            <?php if($data->status == 1): ?>
                                              <span class="badge bg-success"><?php echo e(__('Completed')); ?></span>
                                            <?php elseif($data->status == 2): ?>
                                              <span class="badge bg-danger"><?php echo e(__('Rejected')); ?></span>
                                            <?php else: ?>
                                              <span class="badge bg-warning"><?php echo e(__('Pending')); ?></span>
                                            <?php endif; ?>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($logs->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/transfer/index.blade.php ENDPATH**/ ?>


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
            <?php echo e(__('Loan Installment Log')); ?>

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
                        <h3 class="text-center py-5"><?php echo e(__('No Loan Log Found')); ?></h3>
                    <?php else: ?> 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-sm card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Transaction No')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-label="<?php echo e(__('Date')); ?>">
                                            <div>
                                              <?php echo e($data->created_at->toDateString()); ?>

                                            </div>
                                        </td>
                                        <td data-label="<?php echo e(__('Transaction No')); ?>">
                                            <div>
                                              <?php echo e($data->transaction_no); ?>

                                            </div>
                                        </td>
                                        <td data-label="<?php echo e(__('Amount')); ?>">
                                          <div>
                                            <?php echo e($currency->sign); ?> <?php echo e($data->amount); ?>

                                          </div>
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


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/loan/log.blade.php ENDPATH**/ ?>
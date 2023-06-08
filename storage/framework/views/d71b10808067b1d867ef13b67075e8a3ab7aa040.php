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
            <?php echo e(__('FDR Manage')); ?>

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
                    <?php if(count($fdr) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Dps Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Plan No')); ?></th>
                                    <th><?php echo e(__('FDR Amount')); ?></th>
                                    <th><?php echo e(__('Profit Type')); ?></th>
                                    <th><?php echo e(__('Profit')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $fdr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Plan No')); ?>">
                                            <div>

                                              <?php echo e($data->transaction_no); ?>

                                              <br>
                                            <span class="text-info"><?php echo e($data->plan->title); ?></span>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('FDR Amount')); ?>">
                                            <div>

                                              <?php echo e(showprice($data->amount,$currency)); ?>

                                              <br>
                                              <span class="text-info"><?php echo app('translator')->get('Profit Rate'); ?> <?php echo e($data->interest_rate); ?> (%) </span>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Profit Type')); ?>">
                                            <div>
                                              <?php echo e(strtoupper($data->profit_type)); ?>

                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Profit')); ?>">
                                            <div class="text-center text-md-start">

                                              <?php echo e(showprice($data->profit_amount,$currency)); ?>

                                              <br>
                                              <?php if($data->profit_type == 'partial'): ?>
                                                  <span class="text-info"> <?php echo app('translator')->get('Next Frofit Days'); ?> (<?php echo e($data->next_profit_time->toDateString()); ?>)</span>
                                              <?php else: ?>
                                                  <span class="text-info"> <?php echo app('translator')->get('Profit will get after locked period'); ?> </span>
                                              <?php endif; ?>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Status')); ?>">
                                            <div>
                                              <?php if($data->status == 1): ?>
                                                <span class="badge bg-success"><?php echo app('translator')->get('Running'); ?></span>
                                              <?php else: ?>
                                                <span class="badge bg-danger"><?php echo app('translator')->get('Closed'); ?></span>
                                              <?php endif; ?>
                                            </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($fdr->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/fdr/index.blade.php ENDPATH**/ ?>
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
            <?php echo e(__('Loan Manage')); ?>

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
                    <?php if(count($loans) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Loan Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Plan No')); ?></th>
                                    <th><?php echo e(__('Loan Amount')); ?></th>
                                    <th><?php echo e(__('Per Installment')); ?></th>
                                    <th><?php echo e(__('Total Installement')); ?></th>
                                    <th><?php echo e(__('Next Installment')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Plan No')); ?>">
                                              <div>
                                                <?php echo e($data->transaction_no); ?>

                                                <br>
                                              <span class="text-info"><?php echo e($data->plan->title); ?></span>
                                              </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Loan Amount')); ?>">
                                            <div>
                                              <?php echo e(showNameAmount($data->loan_amount)); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Per Installment')); ?>">
                                            <div>
                                              <?php echo e(showNameAmount($data->per_installment_amount)); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Total Installement')); ?>">
                                              <div>
                                                <?php echo e($data->total_installment); ?>

                                                <br>
                                                <span class="text-info"><?php echo e($data->given_installment); ?> <?php echo app('translator')->get('Given'); ?></span>
                                              </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Next Installment')); ?>">
                                            <div>
                                              <?php echo e($data->next_installment ?  $data->next_installment->toDateString() : '--'); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Status')); ?>">
                                            <div>
                                              <?php if($data->status == 0): ?>
                                                <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                              <?php elseif($data->status == 1): ?>
                                                  <span class="badge bg-success"><?php echo app('translator')->get('Running'); ?></span>
                                              <?php elseif($data->status == 3): ?>
                                                  <span class="badge bg-info"><?php echo app('translator')->get('Paid'); ?></span>
                                              <?php else: ?>
                                                  <span class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                              <?php endif; ?>
                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('View Log')); ?>">
                                            <div class="btn-list flex-nowrap">
                                              <a href="<?php echo e(route('user.loans.logs',$data->id)); ?>" class="btn">
                                                <?php echo app('translator')->get('Logs'); ?>
                                              </a>
                                            </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($loans->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/loan/index.blade.php ENDPATH**/ ?>
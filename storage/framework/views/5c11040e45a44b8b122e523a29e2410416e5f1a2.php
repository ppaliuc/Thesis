

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
            <?php echo e(__('DPS Manage')); ?>

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
                    <?php if(count($dps) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Dps Data Found')); ?></h3>
                    <?php else: ?> 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Plan No')); ?></th>
                                    <th><?php echo e(__('Deposit Amount')); ?></th>
                                    <th><?php echo e(__('Matured Amount')); ?></th>
                                    <th><?php echo e(__('Total Installement')); ?></th>
                                    <th><?php echo e(__('Next Installment')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $dps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Plan No')); ?>">
                                              <div>
                                                  <?php echo e($data->transaction_no); ?>

                                                  <br>
                                                  <span class="text-info"><?php echo e($data->plan->title); ?></span>
                                              </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Deposit Amount')); ?>">
                                            <div>
                                              <?php echo e(showprice($data->deposit_amount,$currency)); ?>

                                              <br>
                                              <span class="text-info"><?php echo e(showprice($data->per_installment,$currency)); ?> <?php echo e(__('each')); ?></span>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Matured Amount')); ?>">
                                            <div>
                                              <?php echo e(showprice($data->matured_amount,$currency)); ?>

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
                                              <?php if($data->status == 1): ?>
                                                <span class="badge bg-info"><?php echo app('translator')->get('Running'); ?></span>
                                              <?php else: ?> 
                                                <span class="badge bg-success"><?php echo app('translator')->get('Matured'); ?></span>
                                              <?php endif; ?>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('View Logs')); ?>">
                                            <div class="btn-list flex-nowrap">
                                              <a href="<?php echo e(route('user.dps.logs',$data->id)); ?>" class="btn">
                                                <?php echo app('translator')->get('Logs'); ?>
                                              </a>
                                            </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($dps->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/dps/index.blade.php ENDPATH**/ ?>
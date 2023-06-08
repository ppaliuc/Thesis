<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="d-flex flex-wrap justify-content-between">
        <div class="me-3">
          <div class="page-pretitle">
            <?php echo e(__('Overview')); ?>

          </div>
          <h2 class="page-title">
            <?php echo e(__('Withdraws')); ?>

          </h2>
        </div>
        <div class="d-print-none">
          <div class="btn-list">
            <a href="<?php echo e(route('user.withdraw.create')); ?>" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              <?php echo e(__('Create new Withdraw')); ?>

            </a>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <?php if(count($withdraws) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Withdraw Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Withdraw Date')); ?></th>
                                    <th><?php echo e(__('Method')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Fee')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Details')); ?></th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Withdraw Date')); ?>"><?php echo e(date('d-M-Y',strtotime($withdraw->created_at))); ?></td>
                                          <td data-label="<?php echo e(__('Method')); ?>"><?php echo e($withdraw->method); ?></td>
                                          <td data-label="<?php echo e(__('Amount')); ?>"><?php echo e(showNameAmount($withdraw->amount)); ?></td>
                                          <td data-label="<?php echo e(__('Fee')); ?>"><?php echo e(showNameAmount($withdraw->fee)); ?></td>
                                          <td data-label="<?php echo e(__('Status')); ?>"><?php echo e(ucfirst($withdraw->status)); ?></td>

                                          <td data-label="<?php echo e(__('Details')); ?>">
                                            <a href="<?php echo e(route('user.withdraw.details',$withdraw->id)); ?>" class="btn btn-primary">
                                              <?php echo e(__('Details')); ?>

                                            </a>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($withdraws->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/withdraw/index.blade.php ENDPATH**/ ?>
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
            <?php echo e(__('Wire Transfer')); ?>

          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="<?php echo e(route('user.wire.transfer.create')); ?>" class="btn btn-primary d-none d-sm-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              <?php echo e(__('Add Wire Transfer')); ?>

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
                    <?php if(count($transfers) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Wire Transfer Data Found')); ?></h3>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Bank Name')); ?></th>
                                    <th><?php echo e(__('Account Name')); ?></th>
                                    <th><?php echo e(__('Account Number')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Details')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                          <td data-label="<?php echo e(__('Date')); ?>">
                                            <div>
                                              <?php echo e($data->created_at->toFormattedDateString()); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Bank Name')); ?>">
                                            <div>
                                              <?php echo e($data->bank->title); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Account Name')); ?>">
                                            <div>
                                              <?php echo e($data->account_holder_name); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Account Number')); ?>">
                                            <div>
                                              <?php echo e($data->account_number); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Amount')); ?>">
                                            <div>
                                              <?php echo e(showNameAmount($data->amount)); ?>

                                            </div>
                                          </td>
                                          <td data-label="<?php echo e(__('Status')); ?>">
                                            <div>
                                              <span class="badge bg-<?php echo e($data->status == 1 ? 'success' : 'warning'); ?>"><?php echo e($data->status == 1 ? 'completed' : 'pending'); ?></span>
                                            </div>
                                          </td>

                                          <td data-label="<?php echo e(__('Details')); ?>">
                                            <div class="btn-list">
                                                <a href="<?php echo e(route('user.wire.transfer.show',$data->id)); ?>" class="btn btn-primary">
                                                  <?php echo e(__('Details')); ?>

                                                </a>
                                            </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($transfers->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/wiretransfer/index.blade.php ENDPATH**/ ?>
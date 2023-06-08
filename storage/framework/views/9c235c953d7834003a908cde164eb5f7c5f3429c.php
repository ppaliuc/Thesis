<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Loan Plan')); ?>

          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row mb--25-none">
          <?php if(count($plans) == 0): ?>
              <div class="card">
                  <h3 class="text-center"><?php echo e(__('NO LOAN PLAN FOUND')); ?></h3>
              </div>
            <?php else: ?>

            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="plan__item position-relative">
                        <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                        </div>
                        <div class="plan__item-header">
                            <div class="left">
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                            </div>
                            <div class="right">
                                <h5 class="title"><?php echo e($data->per_installment); ?> %</h5>
                                <span><?php echo app('translator')->get('Per Installment'); ?></span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Minimum Amount'); ?>
                                    </div>

                                    <div class="info">
                                      <?php echo e(showAmountSign($data->min_amount)); ?>

                                    </div>
                                </li>
                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Maximum Amount'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e(showAmountSign($data->max_amount)); ?>

                                    </div>
                                </li>
                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Installment Interval'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e($data->installment_interval); ?> <?php echo e(__('Days')); ?>

                                    </div>
                                </li>
                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Total Installment'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e($data->total_installment); ?>

                                    </div>
                                </li>
                            </ul>
                            <a href="javascript:;" class="btn btn-green w-100 apply-loan" data-id="<?php echo e($data->id); ?>" data-bs-toggle="modal" data-bs-target="#modal-apply">
                                <?php echo e(__('Apply')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="modal modal-blur fade" id="modal-apply" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo e(('Apply for Loan')); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?php echo e(route('user.loan.amount')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
              <div class="form-group">
                <label class="form-label required"><?php echo e(__('Amount')); ?></label>
                <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" min="1" required>
              </div>

              <input type="hidden" name="planId" id="planId" value="">
            </div>

            <div class="modal-footer">
                <button type="submit" id="submit-btn" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script>
    'use strict';

    $('.apply-loan').on('click',function(){
        let id = $(this).data('id');
        $('#planId').val(id);
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/loan/plan.blade.php ENDPATH**/ ?>
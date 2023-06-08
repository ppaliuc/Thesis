<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Dps Plan')); ?>

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
                  <h3 class="text-center"><?php echo e(__('NO DPS PLAN FOUND')); ?></h3>
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
                                <h5 class="title">
                                    <?php echo e($data->interest_rate); ?> %
                                </h5>
                                <span><?php echo app('translator')->get('Interest Rate'); ?></span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Per Installment'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e(showAmountSign($data->per_installment)); ?>

                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('Total Deposit'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e(showAmountSign($data->final_amount)); ?>

                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        <?php echo app('translator')->get('After Matured'); ?>
                                    </div>

                                    <div class="info">
                                        <?php echo e(showprice(round($data->final_amount + $data->user_profit,2),$currency)); ?>

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
                                <a href="<?php echo e(route('user.dps.planDetails',$data->id)); ?>" class="btn btn-green w-100"><?php echo e(__('Apply')); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/dps/plan.blade.php ENDPATH**/ ?>
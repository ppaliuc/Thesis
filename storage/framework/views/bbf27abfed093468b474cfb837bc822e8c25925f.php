<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Pricing Plans')); ?>

          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row">
          <?php if(count($packages) == 0): ?>
              <div class="card">
                  <h3 class="text-center"><?php echo e(__('NO PLAN FOUND')); ?></h3>
              </div>
            <?php else: ?>

            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
                                    <?php echo e(showAmountSign($data->amount)); ?>

                                </h5>
                                <span><?php echo e($data->days); ?> <?php echo app('translator')->get('Days'); ?></span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                <?php if($data->attribute): ?>
                                    <?php $__currentLoopData = json_decode($data->attribute,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="w-100">
                                                <?php echo e($attribute); ?>

                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                            <?php if(auth()->user()->bank_plan_id == $data->id): ?>
                                <a href="javascript:;" class="btn btn-green w-100">
                                    <?php echo e(__('Current Plan')); ?>

                                </a>

                                <div class="text-end mt-2">
                                    (<?php echo e(auth()->user()->plan_end_date ? auth()->user()->plan_end_date->toDateString() : ''); ?>) <a href="<?php echo e(route('user.package.subscription',$data->id)); ?>" class="text--base"><?php echo app('translator')->get('Renew Plan'); ?></a>
                                </div>
                            <?php else: ?>
                                <a href="<?php echo e(route('user.package.subscription',$data->id)); ?>" class="btn btn-green w-100">
                                    <?php echo e(__('Get Started')); ?>

                                </a>
                            <?php endif; ?>
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


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/package/index.blade.php ENDPATH**/ ?>
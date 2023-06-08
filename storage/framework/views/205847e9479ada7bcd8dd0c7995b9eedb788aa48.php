<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Beneficiary Details')); ?>

          </h2>
        </div>

      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
            <div class="card mb-4">
              <div class="card-body">
                  <div class="table-responsive-sm">
                      <table class="table mb-0">
                          <tbody>
                            <tr>
                              <th class="45%" width="45%"><?php echo app('translator')->get('Bank Name'); ?></th>
                              <td width="10%">:</td>
                              <td class="45%" width="45%"><?php echo e($data->bank->title); ?></td>
                            </tr>

                            <tr>
                              <th class="45%" width="45%"><?php echo app('translator')->get('Account Name'); ?></th>
                              <td width="10%">:</td>
                              <td class="45%" width="45%"><?php echo e($data->account_name); ?></td>
                            </tr>

                            <tr>
                              <th class="45%" width="45%"><?php echo app('translator')->get('Account Number'); ?></th>
                              <td width="10%">:</td>
                              <td class="45%" width="45%"><?php echo e($data->account_number); ?></td>
                            </tr>

                            <tr>
                              <th class="45%" width="45%"><?php echo e(__('Nick Name')); ?></th>
                              <td width="10%">:</td>
                              <td class="45%" width="45%"><?php echo e($data->nick_name); ?></td>
                            </tr>


                            <?php $__currentLoopData = json_decode($data->details,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($value[1] == 'file'): ?>
                              <tr>
                                  <th width="45%"><?php echo e($key); ?></th>
                                  <td width="10%">:</td>
                                  <td width="45%"><a href="<?php echo e(asset('assets/images/'.$value[0])); ?>" download=""><img src="<?php echo e(asset('assets/images/'.$value[0])); ?>" class="img-thumbnail"></a></td>
                              </tr>
                              <?php else: ?>
                                  <tr>
                                      <th width="45%"><?php echo e($key); ?></th>
                                      <td width="10%">:</td>
                                      <td width="45%"><?php echo e($value[0]); ?></td>
                                  </tr>
                              <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/beneficiaries/show.blade.php ENDPATH**/ ?>
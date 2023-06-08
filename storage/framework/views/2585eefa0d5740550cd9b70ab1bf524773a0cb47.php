<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Send Money')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-4">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#other-account" class="nav-link active" data-bs-toggle="tab"><?php echo e(__('Other Account')); ?></a>
                      </li>
                      <li class="nav-item">
                        <a href="#saved-account" class="nav-link" data-bs-toggle="tab"><?php echo e(__('Saved Account')); ?></a>
                      </li>
                    </ul>

                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active show" id="other-account">
                            <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <form action="<?php echo e(route('send.money.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required"><?php echo e(__('Account Number')); ?></label>
                                    <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="<?php echo e(__('000.000.0000')); ?>" type="text" value="<?php echo e($savedUser ? $savedUser->account_number : ''); ?>" min="1" required>
                                </div>

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required"><?php echo e(__('Account Name')); ?></label>
                                    <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Jhon Doe')); ?>" type="text" value="<?php echo e($savedUser ? $savedUser->name : ''); ?>" min="1" required readonly>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label required"><?php echo e(__('Amount')); ?></label>
                                    <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="saved-account">
                          <div class="row g-3">
                            <?php if(count($saveAccounts) == 0): ?>
                                <p class="text-center"><?php echo e(__('NO SAVED ACCOUNT FOUND')); ?></p>
                              <?php else: ?>
                              <?php $__currentLoopData = $saveAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php
                                  $reciver = App\Models\User::whereId($data->receiver_id)->first();
                              ?>
                                <?php if($reciver): ?>
                                  <div class="col-6">
                                    <a href="<?php echo e(route('send.money.savedUser',$reciver->account_number)); ?>">
                                      <div class="row g-3 align-items-center">
                                        <span class="col-auto">
                                          <span class="avatar" style="background-image: url(<?php echo e(asset('assets/images/'.$reciver->photo)); ?>)">
                                            <span class="badge bg-red"></span></span>
                                        </span>
                                        <div class="col text-truncate">
                                          <span><?php echo e($reciver->name); ?></span>
                                          <br>
                                          <small class="text-muted text-truncate mt-n1"><?php echo e($reciver->account_number); ?></small>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
  'use strict';

  $("#account_name").on('click',function(){
    let accountNumber = $("#account_number").val();

    let url = `${mainurl}/user/username/${accountNumber}`;

    $.get(url, function(data){
      $("#account_name").val(data);
    });
  })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/sendmoney/create.blade.php ENDPATH**/ ?>
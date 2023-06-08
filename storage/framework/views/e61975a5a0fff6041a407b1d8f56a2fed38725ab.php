<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Request Now')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-5">
                    <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form id="request-form" action="<?php echo e(route('user.money.request.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('Account Number')); ?></label>
                            <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="<?php echo e(__('000.000.0000')); ?>" type="text" value="<?php echo e(old('account_number')); ?>" min="1" required>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('Account Name')); ?></label>
                            <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Jhon Doe')); ?>" type="text" value="<?php echo e(old('account_name')); ?>" min="1" required readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required"><?php echo e(__('Request Amount')); ?></label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" required>
                        </div>

                        <div class="form-group mb-3 ">
                            <label class="form-label"><?php echo e(__('Description')); ?></label>
                            <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="<?php echo e(__('Receive account details')); ?>"></textarea>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary submit-btn w-100" disabled><?php echo e(__('Submit')); ?></button>
                        </div>


                    </form>
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
        $(".submit-btn").prop( "disabled", false );
      });
    })
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/requestmoney/create.blade.php ENDPATH**/ ?>
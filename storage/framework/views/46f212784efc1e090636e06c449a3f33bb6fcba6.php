

<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Wire Transfer')); ?>

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
                    <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                    <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form action="<?php echo e(route('user.wire.transfer.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label class="form-label required"><?php echo e(__('Bank')); ?></label>
                            <select name="wire_transfer_bank_id" id="bankmethod" class="form-select" required>
                                <option value=""><?php echo e(__('Select Bank')); ?></option>
                                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($bank->id); ?>" data-swift=<?php echo e($bank->swift_code); ?> data-currency="<?php echo e($bank->currency->name); ?>" data-country="<?php echo e($bank->country->name); ?>" data-routing=<?php echo e($bank->routing_number); ?>><?php echo e($bank->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                            </select>
                        </div>

                        <?php $__errorArgs = ['wire_transfer_bank_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Swift Code')); ?></label>
                                    <input type="text" id="swiftCode" name="swift_code" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Swift Code')); ?>" value="">
                                </div>
                                <?php $__errorArgs = ['swift_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Currency')); ?></label>
                                    <input type="text" id="currency" name="currency" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Currency')); ?>" value="">
                                </div>
                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Routing Number')); ?></label>
                                    <input type="text" id="routingNumber" name="routing_number" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Routing Number')); ?>" value="">
                                </div>
                                <?php $__errorArgs = ['routing_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Country')); ?></label>
                                    <input type="text" id="country" name="country" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Country')); ?>" value="">
                                </div>
                                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Account Number')); ?></label>
                                    <input type="text" name="account_number" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Account Number')); ?>" value="<?php echo e(old('account_number')); ?>">
                                </div>
                                <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label"><?php echo e(__('Account Holder Name')); ?></label>
                                    <input type="text" name="account_holder_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Enter Account Holder Name')); ?>" value="<?php echo e(old('account_holder_name')); ?>">
                                </div>
                                <?php $__errorArgs = ['account_holder_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required"><?php echo e(__('Amount')); ?></label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="<?php echo e(__('0.0')); ?>" type="number" value="<?php echo e(old('amount')); ?>" min="1" required>
                        </div>
                        <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="form-group mb-3 ">
                            <label class="form-label"><?php echo e(__('Note')); ?></label>
                            <textarea name="note" class="form-control nic-edit" cols="30" rows="5" placeholder="<?php echo e(__('Note')); ?>"></textarea>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
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
        $("#bankmethod").on('change',function(){
            $("#swiftCode").val($(this).find('option:selected').data('swift'));
            $("#currency").val($(this).find('option:selected').data('currency'));
            $("#routingNumber").val($(this).find('option:selected').data('routing'));
            $("#country").val($(this).find('option:selected').data('country'));
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/wiretransfer/create.blade.php ENDPATH**/ ?>
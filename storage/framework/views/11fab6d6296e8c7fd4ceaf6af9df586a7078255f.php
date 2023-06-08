<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('New Beneficiary')); ?>

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
                        <form action="<?php echo e(route('user.beneficiaries.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="form-label required"><?php echo e(__('Others Bank')); ?></label>
                                <select name="other_bank_id" class="form-select bankId" required>
                                    <option value=""><?php echo e(__('Select Bank')); ?></option>
                                    <?php $__currentLoopData = $othersBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($data->id); ?>" data-requirements="<?php echo e(json_decode(json_encode($data->required_information,true))); ?>"><?php echo e($data->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required"><?php echo e(__('Account Number')); ?></label>
                                <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="<?php echo e(__('000.000.0000')); ?>" type="text" value="<?php echo e(old('account_number')); ?>" min="1" required>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required"><?php echo e(__('Account Name')); ?></label>
                                <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Jhon Doe')); ?>" type="text" value="<?php echo e(old('account_name')); ?>" min="1" required>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required"><?php echo e(__('Nick Name')); ?></label>
                                <input name="nick_name" id="nick_name" class="form-control" autocomplete="off" placeholder="<?php echo e(__('Doe')); ?>" type="text" value="<?php echo e(old('nick_name')); ?>" min="1" required>
                            </div>

                            <div id="required-form-element">

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
        $(".bankId").on('change',function(){
            let requirements = $(this).find('option:selected').data('requirements');
            console.log(requirements);

            let output = ``;

            if(requirements.length>0){

                requirements.forEach(element => {

                        if(element.type == 'text') {
                            output +=
                            `
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label ${element.validation}"><?php echo e(__('${element.field_name}')); ?></label>
                                    <input type="text" name="${element.field_name}" class="form-control" autocomplete="off" placeholder="<?php echo e(__('${element.field_name}')); ?>" min="1" ${element.validation}>
                                </div>
                            `;
                        }else if(element.type == 'textarea'){
                            output +=
                            `
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label ${element.validation}"><?php echo e(__('${element.field_name}')); ?></label>
                                    <textarea type="text" name="${element.field_name}" class="form-control" autocomplete="off" placeholder="<?php echo e(__('${element.field_name}')); ?>" ${element.validation}></textarea>
                                </div>
                            `;
                        }else if(element.type == 'file'){
                            output +=
                            `
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label ${element.validation}"><?php echo e(__('${element.field_name}')); ?></label>
                                    <input type="file" name="${element.field_name}" class="form-control" autocomplete="off" ${element.validation}>
                                </div>
                            `
                        }
                    });
                    $('#required-form-element').html(output).hide().fadeIn(500);
            }else{
                alert('here');
                $('#required-form-element').html(``).hide().fadeIn(500);
            }
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/beneficiaries/create.blade.php ENDPATH**/ ?>
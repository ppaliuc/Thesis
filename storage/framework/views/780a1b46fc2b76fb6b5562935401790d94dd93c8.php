<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Edit Payment Gateway')); ?> <a class="btn btn-primary btn-rounded btn-sm" href="<?php echo e(route('admin.payment.index')); ?>"><i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?></a></h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.payment.index')); ?>"><?php echo e(__('Payment Gateways')); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.payment.edit',$data->id)); ?>"><?php echo e(__('Edit Payment')); ?></a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit Payment Form')); ?></h6>
      </div>

      <div class="card-body">
        
        <form class="geniusform"  action="<?php echo e(route('admin.payment.update',$data->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo e(csrf_field()); ?>



            <?php if($data->type == 'automatic'): ?>


            <div class="form-group">
              <label for="inp-name"><?php echo e(__('Name')); ?></label>
              <input type="text" class="form-control" id="inp-name" name="name"  placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($data->name); ?>" required>
            </div>


            <?php if($data->information != null): ?>

              <?php $__currentLoopData = $data->convertAutoData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkey => $pdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if($pkey == 'sandbox_check'): ?>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="pkey[<?php echo e(__($pkey)); ?>]" class="custom-control-input" <?php echo e($pdata == 1  ? 'checked' : ''); ?> id="<?php echo e($pkey); ?>">
                    <label class="custom-control-label" for="<?php echo e($pkey); ?>">
                      <?php echo e(__( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) )); ?>

                    </label>
                  </div>
                </div>


              <?php else: ?>

              <div class="form-group">
                <label for="inp-<?php echo e(__($pkey)); ?>"><?php echo e(__( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) )); ?></label>
                <input type="text" class="form-control" id="inp-<?php echo e(__($pkey)); ?>" name="pkey[<?php echo e(__($pkey)); ?>]"  placeholder="<?php echo e(__( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) )); ?>" value="<?php echo e($pdata); ?>" required>
              </div>


              <?php endif; ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

            <?php else: ?>

              <div class="form-group">
                <label for="inp-title"><?php echo e(__('Name')); ?></label>
                <input type="text" class="form-control" id="inp-title" name="title"  placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($data->title); ?>" required>
              </div>

              <div class="form-group">
                <label for="inp-subtitle"><?php echo e(__('Subtitle')); ?></label>
                <input type="text" class="form-control" id="inp-subtitle" name="subtitle"  placeholder="<?php echo e(__('Enter Subtitle')); ?>" value="<?php echo e($data->subtitle); ?>" required>
              </div>

              <?php if($data->keyword == null): ?>


              <div class="form-group">
                <label for="inp-details"><?php echo e(__('Description')); ?></label>
                <textarea name="details" class="form-control summernote" id="inp-details" cols="30" rows="10" ><?php echo e($data->details); ?></textarea>
              </div>

              <?php endif; ?>


            <?php endif; ?>

            <button type="submit" id="submit-btn" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
        </form>
      </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/admin/payment/edit.blade.php ENDPATH**/ ?>
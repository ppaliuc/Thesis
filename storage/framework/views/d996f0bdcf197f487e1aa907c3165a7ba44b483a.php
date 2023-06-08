

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Edit KYC Module')); ?> </h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:;"><?php echo e(__('Manage User KYC Module')); ?></a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit User KYC Module')); ?></h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="<?php echo e(route('admin.gs.update')); ?>" method="POST" enctype="multipart/form-data">

            <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo e(csrf_field()); ?>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="module_section[]" value="Loan" <?php echo e($data->sectionCheck('Loan') ? 'checked' : ''); ?> class="custom-control-input" id="Loan">
                  <label class="custom-control-label" for="Loan"><?php echo e(__('Loan')); ?></label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="module_section[]" value="Request Money" <?php echo e($data->sectionCheck('Request Money') ? 'checked' : ''); ?> class="custom-control-input" id="Request Money">
                  <label class="custom-control-label" for="Request Money"><?php echo e(__('Request Money')); ?></label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="module_section[]" value="Wire Transfer" <?php echo e($data->sectionCheck('Wire Transfer') ? 'checked' : ''); ?> class="custom-control-input" id="Wire Transfer">
                  <label class="custom-control-label" for="Wire Transfer"><?php echo e(__('Wire Transfer')); ?></label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="module_section[]" value="Transfer" <?php echo e($data->sectionCheck('Transfer') ? 'checked' : ''); ?> class="custom-control-input" id="Transfer">
                  <label class="custom-control-label" for="Transfer"><?php echo e(__('Transfer')); ?></label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="module_section[]" value="Withdraw" <?php echo e($data->sectionCheck('Withdraw') ? 'checked' : ''); ?> class="custom-control-input" id="Withdraw">
                  <label class="custom-control-label" for="Withdraw"><?php echo e(__('Withdraw')); ?></label>
                  </div>
              </div>
            </div>

          </div>
            


            <button type="submit" id="submit-btn" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>

        </form>
      </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/admin/user/modules.blade.php ENDPATH**/ ?>
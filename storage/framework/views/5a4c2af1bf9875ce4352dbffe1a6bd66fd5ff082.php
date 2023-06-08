<?php $__env->startSection('content'); ?>
<div class="card">
  <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Edit Bank')); ?> <a class="btn btn-primary btn-rounded btn-sm" href="<?php echo e(route('admin.other.banks.index')); ?>"><i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?></a></h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.other.banks.index')); ?>"><?php echo e(__('Other Bank')); ?></a></li>
    </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit Bank Form')); ?></h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="<?php echo e(route('admin.other.banks.update',$data->id)); ?>" method="POST" enctype="multipart/form-data">

          <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php echo e(csrf_field()); ?>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="title"><?php echo e(__('Bank Name')); ?></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo e(__('Enter Bank Name')); ?>" value="<?php echo e($data->title); ?>" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="processing_time"><?php echo e(__('Processing Time')); ?></label>
                    <input type="text" class="form-control" id="processing_time" name="processing_time" placeholder="<?php echo e(__('Enter Processing Time')); ?>" min="1" value="<?php echo e($data->processing_time); ?>" required>
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="min_limit"><?php echo e(__('Minimum Amount')); ?> (<?php echo e($currency->name); ?>)</label>
                    <input type="number" class="form-control" id="min_limit" name="min_limit" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->min_limit); ?>" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="max_limit"><?php echo e(__('Maximum Amount')); ?> (<?php echo e($currency->name); ?>)</label>
                    <input type="number" class="form-control" id="max_limit" name="max_limit" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->max_limit); ?>" required>
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="daily_maximum_limit"><?php echo e(__('Daily Maximum Amount')); ?> (<?php echo e($currency->name); ?>)</label>
                    <input type="number" class="form-control" id="daily_maximum_limit" name="daily_maximum_limit" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->daily_maximum_limit); ?>" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="daily_total_transaction"><?php echo e(__('Daily Transaction Limit')); ?></label>
                    <input type="number" class="form-control" id="daily_total_transaction" name="daily_total_transaction" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->daily_total_transaction); ?>" required>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="monthly_maximum_limit"><?php echo e(__('Monthly Maximum Amount')); ?> (<?php echo e($currency->name); ?>)</label>
                  <input type="number" class="form-control" id="monthly_maximum_limit" name="monthly_maximum_limit" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->monthly_maximum_limit); ?>" required>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="monthly_total_transaction"><?php echo e(__('Monthly Transaction Limit')); ?></label>
                  <input type="number" class="form-control" id="monthly_total_transaction" name="monthly_total_transaction" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->monthly_total_transaction); ?>" required>
                </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="fixed_charge"><?php echo e(__('Fixed Charge')); ?></label>
                  <input type="number" class="form-control" id="fixed_charge" name="fixed_charge" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->fixed_charge); ?>" required>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="percent_charge"><?php echo e(__('Percent Charge')); ?> (%)</label>
                  <input type="number" class="form-control" id="percent_charge" name="percent_charge" placeholder="<?php echo e(__('0')); ?>" min="1" value="<?php echo e($data->percent_charge); ?>" required>
                </div>
            </div>
         </div>

         <div class="lang-tag-top-filds" id="lang-section">
          <label for="instruction"><?php echo e(__("Required Information")); ?></label>

          <?php if($informations == NULL || count($informations) == 0): ?>

            <?php else: ?>
              <?php $__currentLoopData = $informations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lang-area mb-3">
                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="form_builder[<?php echo e($key); ?>][field_name]" class="form-control" placeholder="<?php echo e(__('Field Name')); ?>" value="<?php echo e($info['field_name']); ?>">
                    </div>

                    <div class="col-md-3">
                      <select name="form_builder[<?php echo e($key); ?>][type]" class="form-control">
                          <option value="text" <?php echo e($info['type'] == 'text' ? 'selected' : ''); ?>> <?php echo e(__('Input')); ?> </option>
                          <option value="textarea" <?php echo e($info['type'] == 'textarea' ? 'selected' : ''); ?>> <?php echo e(__('Textarea')); ?> </option>
                          <option value="file" <?php echo e($info['type'] == 'file' ? 'selected' : ''); ?>> <?php echo e(__('File upload')); ?> </option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <select name="form_builder[<?php echo e($key); ?>][validation]" class="form-control">
                          <option value="required" <?php echo e($info['validation'] == 'required' ? 'selected' : ''); ?>> <?php echo e(__('Required')); ?> </option>
                          <option value="nullable" <?php echo e($info['validation'] == 'nullable' ? 'selected' : ''); ?>>  <?php echo e(__('Optional')); ?> </option>
                      </select>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>


        </div>


        <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> <?php echo e(__('Add More Field')); ?></a>

          <div class="row d-flex justify-content-center">
              <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-3"><?php echo e(__('Submit')); ?></button>
          </div>

      </form>
    </div>
  </div>
</div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
  'use strict';
  function isEmpty(el){
      return !$.trim(el.html())
  }

  let id = '<?php echo e($information_count); ?>';

$("#lang-btn").on('click', function(){

    $("#lang-section").append(''+
            `<div class="lang-area mb-3">
            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="form_builder[${id}][field_name]" class="form-control" placeholder="<?php echo e(__('Field Name')); ?>">
              </div>

              <div class="col-md-3">
                <select name="form_builder[${id}][type]" class="form-control rounded-0">
                    <option value="text"> Input </option>
                    <option value="textarea"> Textarea </option>
                    <option value="file"> File upload </option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="form_builder[${id}][validation]" class="form-control rounded-0">
                    <option value="required"> Required </option>
                    <option value="nullable">  Optional </option>
                </select>
              </div>
            </div>
          </div>`+
          '');
      id ++;
});

$(document).on('click','.lang-remove', function(){

    $(this.parentNode).remove();
    if(id && id >1){
      id --;
    }
    if (isEmpty($('#lang-section'))) {

      $("#lang-section").append(''+
            `<div class="lang-area mb-3">
            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="form_builder[1][field_name]" class="form-control" placeholder="<?php echo e(__('Field Name')); ?>">
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][type]" class="form-control rounded-0">
                    <option value="text"> Input </option>
                    <option value="textarea"> Textarea </option>
                    <option value="file"> File upload </option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][validation]" class="form-control rounded-0">
                    <option value="required"> Required </option>
                    <option value="nullable">  Optional </option>
                </select>
              </div>
            </div>
          </div>`+
          '');
    }

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/otherbank/edit.blade.php ENDPATH**/ ?>
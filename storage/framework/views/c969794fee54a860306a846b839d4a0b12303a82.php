

<?php $__env->startSection('content'); ?>
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
  <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Edit Plan')); ?> <a class="btn btn-primary btn-rounded btn-sm" href="<?php echo e(route('admin.loan.plan.index')); ?>"><i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?></a></h5>
  <ol class="breadcrumb m-0 py-0">
      <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('admin.loan.plan.index')); ?>"><?php echo e(__('Loan Plan')); ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('admin.loan.plan.edit',$data->id)); ?>"><?php echo e(__('Edit Plan')); ?></a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit Plan Form')); ?></h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="<?php echo e(route('admin.loan.plan.update',$data->id)); ?>" method="POST" enctype="multipart/form-data">

          <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php echo e(csrf_field()); ?>


          <div class="form-group">
            <label for="title"><?php echo e(__('Title')); ?></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo e(__('Enter Title')); ?>" value="<?php echo e($data->title); ?>" required>
          </div>

          <div class="form-group">
            <label for="min_amount"><?php echo e(__('Minimum Price in')); ?> (<?php echo e($currency->name); ?>)</label>
            <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="<?php echo e(__('Enter Minimum Price')); ?>" min="1" step="0.01" value="<?php echo e($data->min_amount); ?>" required>
          </div>

          <div class="form-group">
            <label for="max_amount"><?php echo e(__('Maximum Price in')); ?> (<?php echo e($currency->name); ?>)</label>
            <input type="number" class="form-control" id="max_amount" name="max_amount" placeholder="<?php echo e(__('Enter Maximum Price')); ?>" min="1" step="0.01" value="<?php echo e($data->max_amount); ?>" required>
          </div>

          <div class="form-group">
            <label for="per_installment"><?php echo e(__('Per Installment')); ?> (%)</label>
            <input type="number" class="form-control" id="per_installment" name="per_installment" placeholder="<?php echo e(__('Per Installment')); ?>" min="1" step="0.01" value="<?php echo e($data->per_installment); ?>" required>
          </div>

          <div class="form-group">
            <label for="installment_interval"><?php echo e(__('Installment Interval')); ?></label>
            <input type="number" class="form-control" id="installment_interval" name="installment_interval" placeholder="<?php echo e(__('Installment Interval')); ?>" min="1" step="0.01" value="<?php echo e($data->installment_interval); ?>" required>
          </div>

          <div class="form-group">
            <label for="total_installment"><?php echo e(__('Total Installment')); ?></label>
            <input type="number" class="form-control" id="total_installment" name="total_installment" placeholder="<?php echo e(__('Total Installment')); ?>" min="1" value="<?php echo e($data->total_installment); ?>" required>
          </div>
          
          <div class="form-group">
            <h3 id="profitShow" class="text-center"></h3>
          </div>


          <div class="lang-tag-top-filds" id="lang-section">
            <label for="instruction"><?php echo e(__("Required Information")); ?></label>
            <?php if(count($informations) != 0): ?>
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

          <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-2"><?php echo e(__('Submit')); ?></button>

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

  let id = '<?php echo e(count($informations) == 0 ? 1 : count($informations) + 1); ?>';

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

$("#per_installment").on('input',()=>{
  profitCalculation();
})

$("#total_installment").on('input',()=>{
  profitCalculation();
})

function profitCalculation(){
  let perInstallment = parseFloat($("#per_installment").val());
  let totalInstallment = parseFloat($("#total_installment").val());

  if(perInstallment && totalInstallment){
    let profitLoss = (perInstallment * totalInstallment).toFixed(2);

    if(profitLoss>100){
      let profit = profitLoss - 100;
      $("#profitShow").text(`You will get ${profit} % profit`).removeClass('text-danger').addClass('text-success');
    }else if(profitLoss == 100){
      $("#profitShow").text(`You will get 0 % profit`).removeClass('text-danger').addClass('text-success');
    }else{
      let loss = 100 - profitLoss;
      $("#profitShow").text(`You will get ${loss} % loss`).removeClass('text-success').addClass('text-danger');
    }
  }
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/admin/loanplan/edit.blade.php ENDPATH**/ ?>
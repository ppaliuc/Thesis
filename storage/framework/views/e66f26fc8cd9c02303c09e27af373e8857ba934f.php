

<?php $__env->startSection('content'); ?>

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
	<h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Loan Logs of')); ?> <span class="text-info"><?php echo e($loan->transaction_no); ?></span></h5>
	<ol class="breadcrumb m-0 py-0">
		<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(route('admin.loan.index')); ?>"><?php echo e(__('Loans')); ?></a></li>
	</ol>
	</div>
</div>


<div class="row mt-3">
  <div class="col-lg-12">

	<?php echo $__env->make('includes.admin.form-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
				<th><?php echo e(__('Serial No')); ?></th>
				<th><?php echo e(__('Date')); ?></th>
				<th><?php echo e(__('Amount')); ?></th>
			</tr>
		  </thead>

          <tbody>
              <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><span class="text-info"><?php echo e($loop->iteration); ?></span></td>
                    <td><?php echo e($data->created_at->toDateString()); ?></td>
                    <td><?php echo e($currency->sign); ?> <?php echo e($data->amount); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
		</table>
	  </div>
      <?php echo e($logs->links()); ?>

	</div>
  </div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/loan/log.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
	<h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Loan Plan')); ?></h5>
	<ol class="breadcrumb m-0 py-0">
		<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>

		<li class="breadcrumb-item"><a href="<?php echo e(route('admin.loan.plan.index')); ?>"><?php echo e(__('Loan Plan')); ?></a></li>
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
				<th><?php echo e(__('Title')); ?></th>
				<th><?php echo e(__('Limit')); ?></th>
				<th><?php echo e(__('Installment')); ?></th>
				<th><?php echo e(__('Status')); ?></th>
				<th><?php echo e(__('Actions')); ?></th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>



<div class="modal fade confirm-modal" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo e(__("Update Status")); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center"><?php echo e(__("You are about to change the status.")); ?></p>
				<p class="text-center"><?php echo e(__("Do you want to proceed?")); ?></p>
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Cancel")); ?></a>
				<a href="javascript:;" class="btn btn-success btn-ok"><?php echo e(__("Update")); ?></a>
			</div>
		</div>
	</div>
</div>




<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo e(__("Confirm Delete")); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p class="text-center"><?php echo e(__("You are about to delete this Plan.")); ?></p>
				<p class="text-center"><?php echo e(__("Do you want to proceed?")); ?></p>
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Cancel")); ?></a>
				<a href="javascript:;" class="btn btn-danger btn-ok"><?php echo e(__("Delete")); ?></a>
			</div>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
	"use strict";

    var table = $('#geniustable').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           searching: true,
           ajax: '<?php echo e(route('admin.loan.plan.datatables')); ?>',
           columns: [
				{ data: 'title', name: 'title' },
				{ data: 'min_amount', name: 'min_amount' },
				{ data: 'total_installment', name: 'total_installment' },
				{ data: 'status', name: 'status' },
				{ data: 'action', searchable: false, orderable: false }
            ],
            language : {
                processing: '<img src="<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>">'
            }
        });

        $(function() {
        $(".btn-area").append('<div class="col-sm-12 col-md-4 pr-3 text-right">'+
            '<a class="btn btn-primary" href="<?php echo e(route('admin.loan.plan.create')); ?>">'+
        '<i class="fas fa-plus"></i> <?php echo e(__('Add New Plan')); ?>'+
        '</a>'+
        '</div>');
    });


</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/admin/loanplan/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Loan Details')); ?> <a class="btn btn-primary btn-rounded btn-sm" href="<?php echo e(route('admin.loan.index')); ?>"><i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?></a></h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo e(__('Loan Details')); ?></a></li>
        </ol>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <?php echo $__env->make('includes.admin.form-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            <?php echo e(__('Required Information')); ?>

                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>

                                <?php $__currentLoopData = $requiredInformations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($value[1] == 'file'): ?>
                                    <tr>
                                        <th width="45%"><?php echo e($key); ?></th>
                                        <td width="10%">:</td>
                                        <td width="45%"><a href="<?php echo e(asset('assets/images/'.$value[0])); ?>" download><img src="<?php echo e(asset('assets/images/'.$value[0])); ?>" class="img-thumbnail"></a></td>
                                    </tr>
                                    <?php else: ?> 
                                        <tr>
                                            <th width="45%"><?php echo e($key); ?></th>
                                            <td width="10%">:</td>
                                            <td width="45%"><?php echo e($value[0]); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="footer-area">
                        <?php if($data->status == 0): ?>
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="<?php echo e(route('admin.loan.status',['id1' => $data->id, 'id2' => 1])); ?>" class="btn btn-primary"><i class="far fa-check-circle"></i> <?php echo e(__('Approve')); ?></a>
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="<?php echo e(route('admin.loan.status',['id1' => $data->id, 'id2' => 2])); ?>" class="btn btn-danger ml-3"><i class="fas fa-minus-circle"></i> <?php echo e(__('Reject')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                        <?php echo e(__('Loan Details')); ?>

                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Plan No')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($data->transaction_no); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Plan Name')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($data->plan->title); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('User')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($data->user->name); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Request Amount')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($currency->sign); ?> <?php echo e($data->loan_amount); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Pay Amount')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($currency->sign); ?> <?php echo e(round($data->total_installment * $data->per_installment_amount,2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Total Installment')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($data->total_installment); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Per Installment')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($currency->sign); ?> <?php echo e($data->per_installment_amount); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="45%"><?php echo e(__('Given Installment')); ?></th>
                                        <th width="10%">:</th>
                                        <td width="45%"><?php echo e($data->given_installment); ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade status-modal" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
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




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/loan/show.blade.php ENDPATH**/ ?>
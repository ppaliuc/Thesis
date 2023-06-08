<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Transaction')); ?>

          </h2>
        </div>
		<div class="col-auto ms-auto d-print-none">
			<div class="btn-list">

			  <a href="<?php echo e(route('user.export.pdf')); ?>" class="btn btn-primary d-none d-sm-inline-block">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
				<?php echo e(__('Export pdf')); ?>

			  </a>
			</div>
		  </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap datatable">
						  <thead>
							<tr>
							  <th class="w-1"><?php echo app('translator')->get('No'); ?>.
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
							  </th>
							  <th><?php echo app('translator')->get('Type'); ?></th>
							  <th><?php echo app('translator')->get('Txnid'); ?></th>
							  <th><?php echo app('translator')->get('Amount'); ?></th>
							  <th><?php echo app('translator')->get('Date'); ?></th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
							<?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							  <tr>
								<td data-label="<?php echo app('translator')->get('No'); ?>">
								  <div>

									<span class="text-muted"><?php echo e($loop->iteration); ?></span>
								  </div>
								</td>

								<td data-label="<?php echo app('translator')->get('Type'); ?>">
								  <div>
									<?php echo e(strtoupper($data->type)); ?>

								  </div>
								</td>

								<td data-label="<?php echo app('translator')->get('Txnid'); ?>">
								  <div>
									<?php echo e($data->txnid); ?>

								  </div>
								</td>

								<td data-label="<?php echo app('translator')->get('Amount'); ?>">
								  <div>
									<p class="text-<?php echo e($data->profit == 'plus' ? 'success' : 'danger'); ?>"><?php echo e(showNameAmount($data->amount)); ?></p>
								  </div>
								</td>

								<td data-label="<?php echo app('translator')->get('Date'); ?>">
								  <div>
									<?php echo e(date('d M Y',strtotime($data->created_at))); ?>

								  </div>
								</td>

							  </tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							  <p><?php echo app('translator')->get('NO DATA FOUND'); ?></p>
							<?php endif; ?>

						  </tbody>
						</table>
					  </div>
                      <?php echo e($transactions->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/transactions.blade.php ENDPATH**/ ?>
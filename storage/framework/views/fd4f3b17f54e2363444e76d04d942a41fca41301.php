<?php $__env->startSection('content'); ?>


    <div class="card">
        <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Conversation With')); ?> <?php echo e($conv->user->name); ?></h5>
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo e(__('Manage Message')); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.user.message')); ?>"><?php echo e(__('All Message')); ?></a></li>
        </ol>
        </div>
    </div>


    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12">



        <div class="order-table-wrap support-ticket-wrapper ">
            <div class="panel panel-primary">
            <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="panel-body" id="messages">
                    <?php $__currentLoopData = $conv->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->user_id != 0): ?>
                            <div class="single-reply-area user">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="reply-area">
                                            <div class="left">
                                                <p><?php echo e($message->message); ?></p>
                                            </div>
                                            <div class="right">
                                        <?php if($message->conversation->user): ?>
                                        <img class="img-circle" src="<?php echo e($message->conversation->user->photo != null ? asset('assets/images/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
                                        <?php else: ?>
        
                                        <img class="img-circle" src="<?php echo e(Auth::guard('admin')->user()->photo != null ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png')); ?>" alt="">
        
                                        <?php endif; ?>
                                                <a target="_blank" class="d-block profile-btn mt-1" href="<?php echo e(route('admin-user-show',$message->conversation->user->id)); ?>" class="d-block"><?php echo e(__('View Profile')); ?></a>
                                                <p class="ticket-date"><?php echo e($message->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <br>

                    <?php else: ?>

                    <div class="single-reply-area admin">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="reply-area">
                                    <div class="left">
                                        <img class="img-circle" src="<?php echo e(Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png')); ?>" alt="">
                                        <p class="ticket-date"><?php echo e($message->created_at->diffForHumans()); ?></p>
                                    </div>
                                    <div class="right">
                                        <p><?php echo e($message->message); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="panel-footer">
                    <form id="messageform" action="<?php echo e(route('admin.message.store')); ?>" data-href="<?php echo e(route('admin-message-load',$conv->id)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <input type="hidden" name="user_id" value="0">
                            <input type="hidden" name="conversation_id" value="<?php echo e($conv->id); ?>">
                            <textarea class="form-control" name="message" id="wrong-invoice" rows="5" required="" placeholder="<?php echo e(__('Message')); ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-rounded">
                                <?php echo e(__('Add Reply')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <!-- DataTable with Hover -->

    </div>
    <!--Row-->

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
				<p class="text-center"><?php echo e(__("You are about to delete this Product.")); ?></p>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/message/create.blade.php ENDPATH**/ ?>
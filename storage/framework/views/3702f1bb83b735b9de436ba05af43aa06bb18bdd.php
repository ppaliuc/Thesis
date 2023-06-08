

<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Support Ticket')); ?>

          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            <a href="javascript:;" class="btn btn-primary w-100 apply-loan" data-bs-toggle="modal" data-bs-target="#modal-message">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              <?php echo e(__('Create New Ticket')); ?>

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
                <div class="support-ticket-wrapper ">
                    <div class="panel panel-primary">
                          <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>                  
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
                                                <img class="img-circle" src="<?php echo e($message->conversation->user->photo != null ? asset('assets/images/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')); ?>" alt="">
                                                <p class="ticket-date"><?php echo e($message->conversation->user->name); ?></p>
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
                                                <img class="img-circle" src="<?php echo e(asset('assets/images/'.$admin->photo)); ?>" alt="">
                                                <p class="ticket-date"><?php echo e(__('Admin')); ?></p>
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
                            <form id="messageform" data-href="<?php echo e(route('user.message.load',$conv->id)); ?>" action="<?php echo e(route('user.message.store')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <input type="hidden" name="conversation_id" value="<?php echo e($conv->id); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo e($conv->user->id); ?>">
                                    <textarea class="form-control" name="message" id="wrong-invoice" rows="5" style="resize: vertical;" required="" placeholder="<?php echo e(__('Your Message')); ?>"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="mybtn1 btn btn-primary">
                                        <?php echo e(__('Send')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
    
    
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/message/create.blade.php ENDPATH**/ ?>
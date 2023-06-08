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
                <div class="card">
                    <?php if(count($convs) == 0): ?>
                        <h3 class="text-center py-5"><?php echo e(__('No Data Found')); ?></h3>
                    <?php else: ?> 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Message')); ?></th>
                                    <th><?php echo e(__('Time')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $convs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="conv">
                                      <input type="hidden" value="<?php echo e($conv->id); ?>">
                                      <td data-label="<?php echo e(__('Subject')); ?>">
                                        <div>
                                          <?php echo e($conv->subject); ?>

                                        </div>
                                      </td>
                                      <td data-label="<?php echo e(__('Message')); ?>">
                                        <div>
                                          <?php echo e($conv->message); ?>

                                        </div>
                                      </td>
      
                                      <td data-label="<?php echo e(__('Time')); ?>">
                                        <div>
                                          <?php echo e($conv->created_at->diffForHumans()); ?>

                                        </div>
                                      </td>
                                      <td data-label="<?php echo e(__('Action')); ?>">
                                        <div class="d-flex">
                                          <a href="<?php echo e(route('user.message.show',$conv->id)); ?>" class="link view me-1 btn d-block btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                          <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="<?php echo e(route('user.message.delete1',$conv->id)); ?>"class="link remove-btn btn d-block btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                      </td>
      
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($convs->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



<div class="modal modal-blur fade" id="modal-message" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo e(('Create Ticket')); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="emailreply1">
          <?php echo csrf_field(); ?>
          <div class="modal-body">
            <div class="form-group mb-2">
              <input type="text" class="form-control" name="subject" placeholder="<?php echo e(__('Subject')); ?>" autocomplete="off" required="">
            </div>
  
            <div class="form-group">
              <textarea class="form-control" name="message" name="message" placeholder="<?php echo e(__('Your Message')); ?>" rows="10"></textarea>
            </div>
          </div>
  
          <div class="modal-footer">
              <button type="submit" id="submit-btn" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
          </div>
      </form>
    </div>
  </div>
</div>


<div class="modal modal-blur fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
        <h3><?php echo e(__('Are you sure')); ?>?</h3>
        <div class="text-muted"><?php echo e(__("You are about to delete this Ticket.")); ?></div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                <?php echo e(__('Cancel')); ?>

              </a></div>
            <div class="col">
              <a href="javascript:;" class="btn btn-danger w-100 btn-ok">
                <?php echo e(__('Delete')); ?>

              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script type="text/javascript">
'use strict';

          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "<?php echo e(URL::to('/user/admin/user/send/message')); ?>",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                  },
            success: function( data) {
                      $('#subj1').prop('disabled', false);
                      $('#msg1').prop('disabled', false);
                      $('#subj1').val('');
                      $('#msg1').val('');
                      $('#emlsub1').prop('disabled', false);
                      if(data == 0)
                      $.notify("Oops Something Goes Wrong !!","error");
                      else
                      $.notify("Message Sent !!","success");
                      $('.close').click();
                      location.reload();
            }

        });
          return false;
        });

</script>

<script type="text/javascript">
    'use strict';

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/user/message/index.blade.php ENDPATH**/ ?>
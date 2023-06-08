<?php $__env->startSection('content'); ?>


    <div class="card">
        <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Message History')); ?></h5>
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

        <?php echo $__env->make('includes.admin.form-success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card mb-4">
          <div class="table-responsive p-3">
            <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                    <th><?php echo e(__('Name')); ?></th>
                    <th><?php echo e(__('Subject')); ?></th>
                    <th><?php echo e(__('Date')); ?></th>
                    <th><?php echo e(__('Options')); ?></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- DataTable with Hover -->

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
            <p class="text-center"><?php echo e(__("You are about to delete this Message.")); ?></p>
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
               ajax: '<?php echo e(route('admin.message.datatables')); ?>',
               columns: [
                  { data: 'name', name: 'name' },
                  { data: 'subject', name: 'subject' },
                  { data: 'created_at', name: 'created_at'},
                  { data: 'action', searchable: false, orderable: false }

                     ],
               language: {
                  processing: '<img src="<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>">'
                },

            });





    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/message/index.blade.php ENDPATH**/ ?>
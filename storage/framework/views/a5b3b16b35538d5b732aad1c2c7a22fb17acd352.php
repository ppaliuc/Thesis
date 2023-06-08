<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">

    <div class="page-header d-print-none">

    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">

      <?php if(auth()->user()->kyc_status != 1): ?>
        <div class="row mb-3">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                        <div class="form-group w-100 d-flex flex-wrap align-items-center justify-content-evenly justify-content-sm-between">
                          <h3 class="my-1 text-center text-sm-start"><?php echo e(__('You have a information to submit for kyc verification.')); ?></h3>
                          <div class="my-1">
                            <a href="<?php echo e(route('user.kyc.form')); ?>" class="btn btn-warning"><?php echo app('translator')->get('Submit'); ?></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row row-deck row-cards mb-2">

        <div class="col-sm-6 col-md-6">
          <div class="card mb-2">
            <div class="card-body p-3 p-md-4">
                <div class="balence--item">
                  <div class="icon">
                    <i class="fas fa-wallet"></i>
                  </div>
                  <div class="content">
                    <div class="subheader"><?php echo e(__('Account Number')); ?></div>
                    <div class="h1 mb-0 mt-2"><?php echo e($user->account_number); ?></div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6">
          <div class="card mb-2">
              <div class="card-body p-3 p-md-4">
                <div class="balence--item">
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <div class="content">
                    <div class="subheader"><?php echo e(__('Available Balance')); ?></div>
                    <div class="h1 mb-0 mt-2"><?php echo e(showNameAmount($user->balance)); ?></div>
                  </div>
                </div>
              </div>
          </div>
        </div>

      </div>

      <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="fas fa-money-check"></i>
            </div>
            <div class="card-body">
              <div class="h1 m-0"><?php echo e(count($user->deposits)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('Deposits'); ?></div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-body p-3 p-md-4">
              <div class="h1 m-0"><?php echo e(count($user->withdraws)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('Withdraws'); ?></div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-body">
              <div class="h1 m-0"><?php echo e(count($user->transactions)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('Transactions'); ?></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="card-body">
              <div class="h1 m-0"><?php echo e(count($user->loans)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('Loan'); ?></div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="fas fa-wallet"></i>
            </div>
            <div class="card-body">
              <div class="h1 m-0"><?php echo e(count($user->dps)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('DPS'); ?></div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100 card--info-item">
            <div class="text-end icon">
              <i class="far fa-credit-card"></i>
            </div>
            <div class="card-body">
              <div class="h1 m-0"><?php echo e(count($user->fdr)); ?></div>
              <div class="text-muted"><?php echo app('translator')->get('FDR'); ?></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <p><?php echo e(__('Your Referral Link')); ?></p>
                        <div class="input-group input--group">
                            <input type="text" name="key" value="<?php echo e(url('/').'?reff='.$user->affilate_code); ?>" class="form-control" id="cronjobURL" readonly>
                            <button class="btn btn-sm copytext input-group-text" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><?php echo app('translator')->get('Recent Transaction'); ?></h3>
            </div>

            <?php if(count($transactions) == 0): ?>
                <p class="text-center p-2"><?php echo app('translator')->get('NO DATA FOUND'); ?></p>
              <?php else: ?>
              <div class="table-responsive">
                <table class="table card-table table-vcenter table-mobile-md text-nowrap datatable">
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
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td data-label="<?php echo app('translator')->get('No'); ?>">
                          <div>

                            <span class="text-muted"><?php echo e($loop->iteration); ?></span>
                          </div>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Type'); ?>">
                          <div>
                            <?php echo e($data->type); ?>

                          </div>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Txnid'); ?>">
                          <div>
                            <?php echo e($data->txnid); ?>

                          </div>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                          <div>
                            <p class="m-0 text-<?php echo e($data->profit == 'plus' ? 'success' : 'danger'); ?>"><?php echo e(showNameAmount($data->amount)); ?></p>
                          </div>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Date'); ?>">
                          <div>
                            <?php echo e(date('d M Y',strtotime($data->created_at))); ?>

                          </div>
                        </td>

                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </tbody>
                </table>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>

    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
      'use strict';

      function myFunction() {
        var copyText = document.getElementById("cronjobURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert('copied');
    }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/dashboard.blade.php ENDPATH**/ ?>
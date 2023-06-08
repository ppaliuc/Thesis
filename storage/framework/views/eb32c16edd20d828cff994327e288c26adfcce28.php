<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Two factor authentication')); ?>

          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php if(Auth::user()->twofa): ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title text-dark text-center"><?php echo app('translator')->get('Two Factor Authenticator'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mx-auto text-center">
                                <a href="javascript:void(0)"  class="btn w-100 btn-md btn--danger" data-bs-toggle="modal" data-bs-target="#disableModal">
                                    <?php echo app('translator')->get('Disable Two Factor Authenticator'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title text-dark text-center"><?php echo app('translator')->get('Two Factor Authenticator'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mx-auto text-center">
                                <div class="input-group input--group">
                                    <input type="text" name="key" value="<?php echo e($secret); ?>" class="form-control" id="referralURL" readonly>
                                    <button class="btn input-group-text btn--secondary btn-sm copytext" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </button>
                                </div>
                            </div>
                            <div class="form-group mx-auto text-center mt-3">
                                <img class="mx-auto" src="<?php echo e($qrCodeUrl); ?>">
                            </div>
                            <div class="form-group mx-auto text-center">
                                <a href="javascript:void(0)" class="btn btn--base btn-md mt-3 mb-1" data-bs-toggle="modal" data-bs-target="#enableModal"><?php echo app('translator')->get('Enable Two Factor Authenticator'); ?></a>
                            </div>

                            <div class="form-group mx-auto text-center">
                                <a class="btn btn--base btn-md mt-3" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"><?php echo app('translator')->get('DOWNLOAD APP'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!--Enable Modal -->
        <div id="enableModal" class="modal modal-blur fade" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog ">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo app('translator')->get('Verify Your Otp'); ?></h4>
                    </div>
                    <form action="<?php echo e(route('user.createTwoFactor')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body ">
                            <div class="form-group">
                                <input type="hidden" name="key" value="<?php echo e($secret); ?>">
                                <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo app('translator')->get('close'); ?></button>
                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('verify'); ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!--Disable Modal -->
        <div id="disableModal" class="modal modal-blur fade" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo app('translator')->get('Verify Your Otp Disable'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="<?php echo e(route('user.disableTwoFactor')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="<?php echo app('translator')->get('Enter Google Authenticator Code'); ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Verify'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script>
    "use strict";
    function myFunction() {
        var copyText = document.getElementById("referralURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert('copied');
    }
</script>

<script src="<?php echo e(asset('assets/user/js/sweetalert2@9.js')); ?>"></script>

    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
                Toast.fire({
                icon: 'error',
                title: '<?php echo e($error); ?>'
                })
            </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


    <?php if(Session::has('success')): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
    })
    Toast.fire({
        icon: 'success',
        title: '<?php echo e(Session::get('success')); ?>'
    })
  </script>
<?php endif; ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/twofactor/index.blade.php ENDPATH**/ ?>
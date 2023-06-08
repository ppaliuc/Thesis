<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo e($gs->title); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/'.$gs->favicon)); ?>">
    <link href="<?php echo e(asset('assets/user/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/user/css/tabler.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-flags.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-payments.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-vendors.min.css')); ?>" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/toastr.min.css')); ?>">
    <link href="<?php echo e(asset('assets/user/css/demo.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/custom.css')); ?>" rel="stylesheet"/>
    <?php echo $__env->yieldPushContent('css'); ?>
  </head>
  
  <body >
    <div class="wrapper">
      <?php if ($__env->exists('includes.user.header')) echo $__env->make('includes.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <?php if ($__env->exists('includes.user.nav')) echo $__env->make('includes.user.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="page-wrapper">

        <?php echo $__env->yieldContent('contents'); ?>
        <?php if ($__env->exists('includes.user.footer')) echo $__env->make('includes.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>

	<script>
		let mainurl = '<?php echo e(url('/')); ?>';
	</script>
    <script src="<?php echo e(asset('assets/user/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/user/js/tabler.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/user/js/demo.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/user/js/notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>


<script>
	'use strict';

	<?php if(Session::has('message')): ?>
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true
	}
		toastr.success("<?php echo e(session('message')); ?>");
	<?php endif; ?>
  
	<?php if(Session::has('error')): ?>
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true
	}
		toastr.error("<?php echo e(session('error')); ?>");
	<?php endif; ?>
  
	<?php if(Session::has('info')): ?>
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true
	}
		toastr.info("<?php echo e(session('info')); ?>");
	<?php endif; ?>
  
	<?php if(Session::has('warning')): ?>
	toastr.options =
	{
		"closeButton" : true,
		"progressBar" : true
	}
		toastr.warning("<?php echo e(session('warning')); ?>");
	<?php endif; ?>
  </script>
  </body>
</html><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/layouts/user.blade.php ENDPATH**/ ?>
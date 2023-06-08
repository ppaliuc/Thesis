<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo e($gs->title); ?></title>
    <link href="<?php echo e(asset('assets/user/css/tabler.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-flags.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-payments.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/tabler-vendors.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/user/css/demo.min.css')); ?>" rel="stylesheet"/>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-header"><?php echo app('translator')->get('404'); ?></div>
          <p class="empty-title"><?php echo app('translator')->get('Oops… You just found an error page'); ?></p>
          <p class="empty-subtitle text-muted">
            <?php echo app('translator')->get('We are sorry but the page you are looking for was not found'); ?>
          </p>
          <div class="empty-action">
            <a href="<?php echo e(route('front.index')); ?>" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="12" x2="19" y2="12" /><line x1="5" y1="12" x2="11" y2="18" /><line x1="5" y1="12" x2="11" y2="6" /></svg>
              <?php echo app('translator')->get('Take me home'); ?>
            </a>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo e(asset('assets/user/js/tabler.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/user/js/demo.min.js')); ?>"></script>
  </body>
</html><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/errors/404.blade.php ENDPATH**/ ?>
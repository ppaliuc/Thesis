<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo e($gs->title); ?>">
  <meta name="author" content="<?php echo e(url('/')); ?>">
  <link href="<?php echo e(asset('assets/images/'.$gs->favicon)); ?>" rel="icon">
  <title><?php echo e($gs->title); ?></title>
  <link href="<?php echo e(asset('assets/admin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('assets/admin/css/toastr.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/admin/css/select2.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/admin/css/tagify.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.css')); ?>">
  <link href="<?php echo e(asset('assets/admin/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/admin/css/color-picker.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/toastr.min.css')); ?>">
  <link href="<?php echo e(asset('assets/admin/css/plugin.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/admin/css/ruang-admin.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/admin/css/custom.css')); ?>" rel="stylesheet">

  <?php echo $__env->yieldContent('styles'); ?>

</head>

<body id="page-top">
    <?php if($gs->is_admin_loader==1): ?>
        <div class="Loader" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center #FFF;"></div>
    <?php endif; ?>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('admin.dashboard')); ?>">
        <div class="sidebar-brand-icon">
          <img src="<?php echo e(asset('assets/images/'.$gs->logo)); ?>">
        </div>
      </a>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><?php echo e(__('Dashboard')); ?></span></a>
      </li>

      <?php if(Auth::guard('admin')->user()->IsSuper()): ?>
        <?php echo $__env->make('includes.admin.roles.super', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php else: ?>
        <?php echo $__env->make('includes.admin.roles.normal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link" href="#">
            
          <span><?php echo e(__('Version :')); ?> 3.0</span></a>
      </li>

    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link pr-0" target="_blank" href="<?php echo e(url('/')); ?>">
                  <i class="fas fa-globe fa-fw"></i>
              </a>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?php echo e(Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png')); ?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo e(Auth::guard('admin')->user()->name); ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo e(__('Profile')); ?>

                  </a>
                <a class="dropdown-item" href="<?php echo e(route('admin.password')); ?>">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php echo e(__('Change Password')); ?>

                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php echo e(__('Logout')); ?>

                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">

            <?php echo $__env->yieldContent('content'); ?>

        </div>
        <!---Container Fluid-->
      </div>

    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <script type="text/javascript">
    'use strict';
    var form_error   = "<?php echo e(__('Please fill all the required fields')); ?>";
    var mainurl = "<?php echo e(url('/')); ?>";
    var admin_loader = <?php echo e($gs->is_admin_loader); ?>;

  </script>

  <script src="<?php echo e(asset('assets/admin/vendor/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/plugin.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/toastr.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/bootstrap-colorpicker.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/colorpicker.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/select2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/tagify.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/summernote.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/sortable.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/bootstrap-datepicker.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/ruang-admin.js')); ?>"></script>

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

  <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/layouts/admin.blade.php ENDPATH**/ ?>
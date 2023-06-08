<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php if(isset($page->meta_tag) && isset($page->meta_description)): ?>
        <meta name="keywords" content="<?php echo e($page->meta_tag); ?>">
        <meta name="description" content="<?php echo e($page->meta_description); ?>">
    <?php elseif(isset($blog->meta_tag) && isset($blog->meta_description)): ?>
        <meta name="keywords" content="<?php echo e($blog->meta_tag); ?>">
        <meta name="description" content="<?php echo e($blog->meta_description); ?>">
    <?php else: ?>
        <meta name="keywords" content="<?php echo e($seo->meta_keys); ?>">
        <meta name="author" content="GeniusOcean">
    <?php endif; ?>
    <title><?php echo e($gs->title); ?></title>

    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/all.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/lightbox.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/odometer.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/owl.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/main.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/toastr.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors))); ?>">

    <?php if($default_font->font_value): ?>
        <link href="https://fonts.googleapis.com/css?family=<?php echo e($default_font->font_value); ?>&display=swap" rel="stylesheet">
    <?php else: ?>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <?php endif; ?>

    <?php if($default_font->font_family): ?>
        <link rel="stylesheet" id="colorr" href="<?php echo e(asset('assets/front/css/font.php?font_familly='.$default_font->font_family)); ?>">
    <?php else: ?>
        <link rel="stylesheet" id="colorr" href="<?php echo e(asset('assets/front/css/font.php?font_familly='."Open Sans")); ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/custom.css')); ?>" />
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/'.$gs->favicon)); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
    <!-- Overlayer -->
    <span class="toTopBtn">
        <i class="fas fa-angle-up"></i>
    </span>
    <div class="overlayer"></div>
    <div class="loader">
        <h2>
            <span class="let1">l</span>
            <span class="let2">o</span>
            <span class="let3">a</span>
            <span class="let4">d</span>
            <span class="let5">i</span>
            <span class="let6">n</span>
            <span class="let7">g</span>
        </h2>
    </div>
    <!-- Overlayer -->

    <!-- Header -->
    <header class="position-relative">
        <div class="navbar-top bg--title">
            <div class="container">
                <?php echo $__env->make('partials.front.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="navbar-bottom">
            <div class="container">
                <?php echo $__env->make('partials.front.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </header>
    <!-- Header -->

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <?php echo $__env->make('partials.front.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Footer -->

    <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Modal -->
    <div class="modal fade" id="modal-apply">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg--section">
                    <h5 class="modal-title loan-title m-0"><?php echo app('translator')->get('Basic'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('user.loan.amount')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="pt-3 pb-4">
                            <label for="amount" class="form-label"><?php echo app('translator')->get('Amount'); ?></label>
                            <div class="input-group input--group">
                                <input type="number" name="amount" class="form-group-input form-control form--control"
                                    placeholder="0.00" id="amount">
                                <button type="button" class="input-group-text"><?php echo e($currency->name); ?></button>
                            </div>
                            <input type="hidden" name="planId" id="planId" value="">
                        </div>
                    </div>
                    <div class="modal-footer bg--section">
                        <button type="button" class="btn shadow-none btn--danger" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn shadow-none btn--success"><?php echo app('translator')->get('Proceed'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="modal-pension">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg--section">
                    <h5 class="modal-title loan-title m-0"><?php echo app('translator')->get('Basic'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('user.fdr.amount')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="pt-3 pb-4">
                            <label for="amount" class="form-label"><?php echo app('translator')->get('Amount'); ?></label>
                            <div class="input-group input--group">
                                <input type="number" name="amount" class="form-group-input form-control form--control"
                                    placeholder="0.00" id="amount">
                                <button type="button" class="input-group-text"><?php echo e($currency->name); ?></button>
                            </div>
                            <input type="hidden" name="planId" id="fdrplan" value="">
                        </div>
                    </div>
                    <div class="modal-footer bg--section">
                        <button type="button" class="btn shadow-none btn--danger" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn shadow-none btn--success"><?php echo app('translator')->get('Proceed'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <script src="<?php echo e(asset('assets/front/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/viewport.jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/odometer.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/lightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/owl.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/notify.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/custom.js')); ?>"></script>

    <script>
        'use strict';
		let mainurl = '<?php echo e(url('/')); ?>';
        let tawkto = '<?php echo e($gs->is_talkto); ?>';
	</script>

    <script type="text/javascript">
        if(tawkto == 1){
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/<?php echo e($gs->talkto); ?>';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        }
    </script>

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

    <script>
        'use strict';

        $('.apply-loan').on('click',function(){
            let id = $(this).data('id');
            let title = $(this).data('title');

            $('#planId').val(id);
            $('.loan-title').text(title);
        });

        $('.apply-pension').on('click',function(){
            let id = $(this).data('id');
            let title = $(this).data('title');

            $('#fdrplan').val(id);
            $('.loan-title').text(title);
        });
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html>
<?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/layouts/front.blade.php ENDPATH**/ ?>
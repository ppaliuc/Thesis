<section class="ctas-section bg--overlay bg_img bg_fixed" data-img="<?php echo e(asset('assets/images/'.$ps->quick_background)); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="cta-img">
                    <img src="<?php echo e(asset('assets/images/'.$ps->quick_photo)); ?>" alt="about">
                </div>
            </div>
            <div class="col-md-6">
                <div class="ctas-content">
                    <div class="section-title text-white">
                        <h6 class="subtitle text--base"><?php echo app('translator')->get('Quick Start'); ?></h6>
                        <h3 class="title"><?php echo e($ps->quick_title); ?></h3>
                        <p>
                            <?php echo e($ps->quick_subtitle); ?>

                        </p>
                    </div>
                    <div>
                        <a href="<?php echo e($ps->quick_link); ?>" class="cmn--btn"><?php echo app('translator')->get('Get Started Now'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/partials/front/cta.blade.php ENDPATH**/ ?>
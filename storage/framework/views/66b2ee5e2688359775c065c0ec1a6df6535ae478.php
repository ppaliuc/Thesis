

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<!-- Hero -->
	<section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
		<div class="container">
			<div class="hero-content">
				<h2 class="hero-title"><?php echo app('translator')->get('About US'); ?></h2>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
					</li>
					<li>
						<?php echo app('translator')->get('About US'); ?>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Hero -->

    <!-- About -->
    <section class="about-section pt-100 pb-50">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="about-thumb h-100">
                        <div class="thumb">
                            <img src="<?php echo e(asset('assets/images/'.$ps->about_photo)); ?>" alt="about">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <h6 class="subtitle text--base"><?php echo app('translator')->get('Who We are'); ?></h6>
                            <h2 class="title"><?php echo e($ps->about_title); ?></h2>
                            <p>
                                <?php
                                    echo $ps->about_text;
                                ?>
                            </p>
                        </div>
                        <ul class="about-list">
                            <?php if($ps->about_attributes): ?>
                                <?php $__currentLoopData = json_decode($ps->about_attributes,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <span>
                                            <?php echo e($attribute); ?>

                                        </span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </ul>
                        <div class="btn__grp mt-4 pt-3">
                            <a href="<?php echo e($ps->about_link); ?>" class="cmn--btn btn-outline"><?php echo app('translator')->get('Get Started'); ?></a>
                            <a href="<?php echo e(route('front.about')); ?>" class="cmn--btn"><?php echo app('translator')->get('More About Us'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About -->

    <!-- About -->
    <section class="about-section-2 pt-50 pb-100">
        <div class="container">
            <div class="about__item">
                <?php
                    echo $ps->about_details;
                ?>
            </div>
        </div>
    </section>
    <!-- About -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/frontend/about.blade.php ENDPATH**/ ?>


<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Hero -->
	<section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
		<div class="container">
			<div class="hero-content">
				<h2 class="hero-title"><?php echo app('translator')->get('Service'); ?></h2>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
					</li>
					<li>
						<?php echo app('translator')->get('Service'); ?>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Hero -->

	<!-- Service -->
	<section class="service-section pt-100 pb-100">
		<div class="container">
			<div class="row g-4 g-xxl-4 g-xl-3 justify-content-center">
				<?php if(count($services) == 0): ?>
					<div class="card">
						<div class="card-body">
							<h3 class="text-center"><?php echo e(__('No Service Found')); ?></h3>
						</div>
					</div>
				<?php else: ?> 
					<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-6 col-xl-4">
							<div class="service-item">
								<div class="service-item__icon">
									<i class="fas fa-piggy-bank"></i>
								</div>
								<div class="service-item__cont">
									<h5 class="service-item__cont-title">
										<?php echo e($data->title); ?>

									</h5>
									<p>
										<?php
											echo $data->details;
										?>
									</p>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- Service -->

	<!-- CTAs -->
	<?php if ($__env->exists('partials.front.cta')) echo $__env->make('partials.front.cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- CTAs -->

	<!-- Faqs -->
	<section class="faqs-section pt-100 pb-100">
		<div class="container">
			<div class="row justify-content-center gy-3">
				<?php $__currentLoopData = $faqs->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faqs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-lg-6">
						<div class="accordion-wrapper">
								<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="accordion-item <?php echo e($loop->first ? 'active open' : ''); ?>">
									<div class="accordion-title">
										<h6 class="title">
											<?php echo e($data->title); ?>

										</h6>
										<span class="icon"></span>
									</div>
									<div class="accordion-content">
										<?php
											echo $data->details;
										?>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</section>
	<!-- Faqs -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/frontend/services.blade.php ENDPATH**/ ?>
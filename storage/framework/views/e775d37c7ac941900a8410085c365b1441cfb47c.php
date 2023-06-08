

<?php $__env->startPush('css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

		    <!-- Hero -->
			<section class="hero-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$gs->breadcumb_banner)); ?>">
				<div class="container">
					<div class="hero-content">
						<h2 class="hero-title"><?php echo e($data->title); ?></h2>
						<ul class="breadcrumb">
							<li>
								<a href="<?php echo e(route('front.index')); ?>"><?php echo app('translator')->get('Home'); ?></a>
							</li>
							<li>
								<a href="<?php echo e(route('front.blog')); ?>"><?php echo app('translator')->get('Blogs'); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- Hero -->
		
			<!-- Blog -->
			<section class="blog-section pt-100 pb-100">
				<div class="container">
					<div class="row gy-5">
						<div class="col-lg-8">
							<div class="blog__item blog__item-details">
								<div class="blog__item-img">
									<img src="<?php echo e(asset('assets/images/'.$data->photo)); ?>" alt="blog">
								</div>
								<div class="blog__item-content">
									<div class="d-flex flex-wrap justify-content-between meta-post">
										<span><i class="far fa-user"></i> <?php echo app('translator')->get('Admin'); ?></span>
									</div>
									<h5 class="blog__item-content-title">
										<?php echo e($data->title); ?>

									</h5>
								</div>
								<div class="blog__details">
									<?php
										echo $data->details;
									?>

									<div class="d-flex align-items-center flex-wrap pt-4">
										<h6 class="m-0 me-2 align-items-center"><?php echo app('translator')->get('Share Now'); ?></h6>
										<ul class="social-icons social-icons-dark">
											<li>
												<a href="#0"><i class="fab fa-facebook-f"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-twitter"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-instagram"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-linkedin-in"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-youtube"></i></a>
											</li>
										</ul>
									</div>
									<div id="disqus_thread"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-4">
							<aside class="blog-sidebar ps-xxl-5">
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white"><?php echo app('translator')->get('Latest Blog Posts'); ?></h5>
									</div>
									<div class="widget-body">
										<ul class="latest-posts">
											<?php $__currentLoopData = $rblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
												<a href="<?php echo e(route('blog.details',$data->slug)); ?>">
													<div class="img">
														<img src="<?php echo e(asset('assets/images/'.$data->photo)); ?>" alt="blog">
													</div>
													<div class="cont">
														<h5 class="subtitle"><?php echo e(Str::limit($data->title,50)); ?></h5>
														<span class="date"><?php echo e($data->created_at->format('M d, Y')); ?></span>
													</div>
												</a>
											</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white"><?php echo app('translator')->get('Category'); ?></h5>
									</div>
									<div class="widget-body">
										<ul class="archive-links">
											<?php $__currentLoopData = $bcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li>
													<a href="<?php echo e(route('front.blogcategory',$data->slug)); ?>">
														<span><?php echo e($data->name); ?></span>
														<span>&nbsp;</span>
													</a>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white"><?php echo app('translator')->get('Archive'); ?></h5>
									</div>
									<div class="widget-body">
										<ul class="archive-links">
											<?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li>
													<a href="<?php echo e(route('front.blogarchive',$key)); ?>">
														<span><?php echo e($key); ?></span>
														<span>&nbsp;</span>
													</a>
												</li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white"><?php echo app('translator')->get('Tags'); ?></h5>
									</div>
									<div class="widget-body">
										<ul class="widget-tags">
											<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if(!empty($tag)): ?>
													<li>
														<a class="<?php echo e(isset($slug) ? ($slug == $tag ? 'active' : '') : ''); ?>" href="<?php echo e(route('front.blogtags',$tag)); ?>"><?php echo e($tag); ?> </a>
													</li>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
								</div>
							</aside>
						</div>
					</div>
				</div>
			</section>
			<!-- Blog -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php if($gs->is_disqus == 1): ?>
<script>
	'use strict';
	(function () {
		var d = document,
		s = d.createElement('script');
		s.src = 'https://<?php echo e($gs->disqus); ?>.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
	})();
</script>
<noscript><?php echo e(__('Please enable JavaScript to view the')); ?> <a href="https://disqus.com/?ref_noscript"><?php echo e(__('comments powered by Disqus.')); ?></a></noscript>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/frontend/blogdetails.blade.php ENDPATH**/ ?>
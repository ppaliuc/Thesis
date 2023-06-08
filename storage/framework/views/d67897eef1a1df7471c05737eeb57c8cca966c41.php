<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(in_array('Banner', $home_modules)): ?>
        <!-- Banner -->
        <section class="banner-section bg--overlay bg_img" data-img="<?php echo e(asset('assets/images/'.$ps->hero_photo)); ?>">
            <div class="container">
                <div class="banner-wrapper">
                    <div class="banner-content">
                        <h1 class="banner-title"><?php echo e($ps->hero_title); ?></h1>
                        <p>
                            <?php echo e($ps->hero_subtitle); ?>

                        </p>
                        <div class="btn__grp">
                            <a href="<?php echo e($ps->hero_btn_url); ?>" class="cmn--btn">
                                <?php echo app('translator')->get('Get Started'); ?>
                            </a>
                            <a href="<?php echo e($ps->hero_link); ?>" class="video--btn" data-lightbox>
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner -->
    <?php endif; ?>
    

    <?php if(in_array('Feature', $home_modules)): ?>
        <!-- Feature -->
        <section class="feature-section pt-100 pb-50">
            <div class="container">
                <div class="mt--120">
                    <div class="row justify-content-center g-3 g-md-4 g-lg-3 g-xl-4">
                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="feature-item">
                                    <div class="feature-item__icon">
                                        <img src="<?php echo e(asset('assets/images/'.$data->photo)); ?>" alt="download bitcoin">
                                    </div>
                                    <div class="feature-item__cont">
                                        <h5 class="feature-item__cont-title"><?php echo e($data->title); ?></h5>
                                        <p>
                                            <?php echo e($data->details); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature -->
    <?php endif; ?>

    <?php if(in_array('About', $home_modules)): ?>
        <!-- About -->
        <section class="about-section pt-50 pb-50">
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
    <?php endif; ?>

    <?php if(in_array('Service', $home_modules)): ?>
        <!-- Service -->
        <section class="service-section pt-50 pb-100">
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('Smart Banking'); ?>
                    </h6>
                    <h2 class="title"><?php echo e($ps->service_title); ?></h2>
                    <p>
                        <?php
                            echo $ps->service_subtitle;
                        ?>
                    </p>
                </div>
                <div class="row g-4 g-xxl-4 g-xl-3 justify-content-center">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="service-item">
                                <div class="service-item__icon">
                                    <img src="<?php echo e(asset('assets/images/'.$service->photo)); ?>" alt="strong"/>
                                </div>
                                <div class="service-item__cont">
                                    <h5 class="service-item__cont-title">
                                        <?php echo e($service->title); ?>

                                    </h5>
                                    <p>
                                        <?php
                                            echo $service->details;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- Service -->
    <?php endif; ?>

    <?php if(in_array('How It Works', $home_modules)): ?>
        <!-- How It Works -->
        <section class="how-it-works overflow-hidden bg--section pt-100 pb-50">
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('Strategy'); ?></h6>
                    <h2 class="title"><?php echo e($ps->strategy_title); ?></h2>
                    <?php
                        echo $ps->strategy_details;
                    ?>
                </div>
                <div class="row flex-wrap-reverse">
                    <div class="col-lg-6">
                        <div class="how-it-wrapper">
                            <div class="how-it-header bg--title">
                                <h3 class="title text--white m-0"><?php echo app('translator')->get('Create Account'); ?></h3>
                                <p><?php echo app('translator')->get('Veniam laudantium cumque quasi, fuga magni esse.'); ?></p>
                            </div>
                            <div class="how-it-body">
                                <ul class="how-it-area">
                                    <?php $__currentLoopData = $process; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e($loop->first ? 'open active' : ''); ?>">
                                            <h6 class="subtitle"><?php echo e($loop->iteration); ?>. <?php echo e($data->title); ?></h6>
                                            <div class="text">
                                                <?php echo e($data->details); ?>

                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="how-it-img text-lg-end">
                            <img src="<?php echo e(asset('assets/images/'.$ps->strategy_banner)); ?>" alt="about">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- How It Works -->
    <?php endif; ?>

    <?php if(in_array('Plan', $home_modules)): ?>
        <!-- Plan -->
        <section class="plan-section bg--section pt-50 pb-100">
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('Pricing Plan'); ?></h6>
                    <h2 class="title"><?php echo e($ps->plan_title); ?></h2>
                    <p>
                        <?php
                            echo $ps->plan_subtitle;
                        ?>
                    </p>
                    <div class="pricing-checkbox">
                        <ul class="nav nav-tabs nav--tabs">
                            <li>
                                <a href="#deposit" class="active" data-bs-toggle="tab" data-bs-="#deposit"><?php echo app('translator')->get('Deposit'); ?></a>
                            </li>
                            <li>
                                <a href="#pension" data-bs-toggle="tab" data-bs-="#pension"><?php echo app('translator')->get('Pension'); ?></a>
                            </li>
                            <li>
                                <a href="#loan" data-bs-toggle="tab" data-bs-="#loan"><?php echo app('translator')->get('Loan'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="deposit">
                        <div class="row g-4 justify-content-center pricing--wrapper">
                            <?php $__currentLoopData = $depositsplans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-sm-10 col-md-6">
                                    <div class="plan__item">
                                        <div class="plan__item-header">
                                            <div class="left">
                                                <h5 class="title"><?php echo e($data->title); ?></h5>
                                            </div>
                                            <div class="right">
                                                <h5 class="title"><?php echo e($data->interest_rate); ?> %</h5>
                                                <span><?php echo app('translator')->get('Interest Rate'); ?></span>
                                            </div>
                                        </div>
                                        <div class="plan__item-body">
                                            <ul>
                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Per Installment'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e(showprice($data->per_installment,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Total Deposit'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e(showprice($data->final_amount,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('After Matured'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e(showprice(round($data->final_amount + $data->user_profit,2),$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Installment Interval'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->installment_interval); ?> <?php echo e(__('Days')); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Total Installment'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->total_installment); ?>

                                                    </div>
                                                </li>
                                            </ul>
                                            <a href="<?php echo e(route('user.dps.planDetails',$data->id)); ?>" class="cmn--btn bg--base w-100 text--white"><?php echo e(__('Apply')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="pension">
                        <div class="row g-4 justify-content-center pricing--wrapper">
                            <?php $__currentLoopData = $fdrplans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-sm-10 col-md-6">
                                    <div class="plan__item">
                                        <div class="plan__item-header">
                                            <div class="left">
                                                <h5 class="title"><?php echo e($data->title); ?></h5>
                                            </div>
                                            <div class="right">
                                                <h5 class="title"><?php echo e($data->interest_rate); ?> %</h5>
                                                <span><?php echo app('translator')->get('Interest Rate'); ?></span>
                                            </div>
                                        </div>
                                        <div class="plan__item-body">
                                            <ul>
                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Minimum Amount'); ?>
                                                    </div>

                                                    <div class="info">
                                                    <?php echo e(showprice($data->min_amount,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Maximum Amount'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e(showprice($data->max_amount,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Interval Type'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->interval_type); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Locked In Period'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->matured_days); ?> <?php echo e(__('Days')); ?>

                                                    </div>
                                                </li>

                                                <?php if($data->interest_interval): ?>
                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Get Profit every'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->interest_interval); ?> <?php echo e(__('Days')); ?>

                                                    </div>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                            <button class="cmn--btn w-100 apply-pension" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-pension" data-id="<?php echo e($data->id); ?>" data-title="<?php echo e($data->title); ?>">
                                                <?php echo app('translator')->get('Apply Now'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="loan">
                        <div class="row g-4 justify-content-center pricing--wrapper">
                            <?php $__currentLoopData = $loanplans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-sm-10 col-md-6">
                                    <div class="plan__item">
                                        <div class="plan__item-header">
                                            <div class="left">
                                                <h5 class="title"><?php echo e($data->title); ?></h5>
                                            </div>
                                            <div class="right">
                                                <h5 class="title"><?php echo e($data->per_installment); ?> %</h5>
                                                <span><?php echo app('translator')->get('Per Installment'); ?></span>
                                            </div>
                                        </div>
                                        <div class="plan__item-body">
                                            <ul>
                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Minimum Amount'); ?>
                                                    </div>

                                                    <div class="info">
                                                    <?php echo e(showprice($data->min_amount,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Maximum Amount'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e(showprice($data->max_amount,$currency)); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Installment Interval'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->installment_interval); ?> <?php echo e(__('Days')); ?>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="name">
                                                        <?php echo app('translator')->get('Total Installment'); ?>
                                                    </div>

                                                    <div class="info">
                                                        <?php echo e($data->total_installment); ?>

                                                    </div>
                                                </li>
                                            </ul>
                                            <button class="cmn--btn w-100 apply-loan" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-apply" data-id="<?php echo e($data->id); ?>" data-title="<?php echo e($data->title); ?>">
                                                <?php echo app('translator')->get('Apply Now'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Plan -->
    <?php endif; ?>

    <?php if(in_array('Apps', $home_modules)): ?>
        <!-- Apps -->
        <section class="apps-section pt-100 pb-50">
            <div class="container">
                <div class="row align-items-center justify-content-between flex-wrap-reverse gy-5">
                    <div class="col-lg-4 col-md-5">
                        <div class="app-img">
                            <img src="<?php echo e(asset('assets/images/'.$ps->app_banner)); ?>" alt="app">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="section-title">
                            <h6 class="subtitle text--base"><?php echo app('translator')->get('Apps'); ?></h6>
                            <h2 class="title"><?php echo e($ps->app_title); ?></h2>

                            <?php
                                echo $ps->app_details;
                            ?>

                        </div>
                        <div class="app__btns">
                            <a href="<?php echo e($ps->app_store_link); ?>">
                                <img src="<?php echo e(asset('assets/images/'.$ps->app_store_photo)); ?>" alt="about">
                            </a>
                            <a href="<?php echo e($ps->app_google_link); ?>">
                                <img src="<?php echo e(asset('assets/images/'.$ps->app_google_store)); ?>" alt="about">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Apps -->
    <?php endif; ?>

    <?php if(in_array('Testimonials', $home_modules)): ?>
        <!-- Clients -->
        <section class="clients-section pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="section-title">
                            <h6 class="subtitle text--base"><?php echo app('translator')->get('Testimonials'); ?></h6>
                            <h2 class="title"><?php echo e($ps->review_title); ?></h2>
                            <p>
                                <?php
                                    echo $ps->review_text;
                                ?>
                            </p>
                            <div class="owl-trigger">
                                <div class="owl-prev"></div>
                                <div class="owl-next active"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="clients-slider bg--title client-slider-bg owl-theme owl-carousel">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="clients-item h-100">
                                    <div class="clients-content">
                                        <blockquote>
                                            <?php
                                                echo $data->details;
                                            ?>
                                        </blockquote>
                                        <h4 class="name text--base"><?php echo e($data->title); ?></h4>
                                    </div>
                                    <div class="clients-thumb">
                                        <div class="thumb">
                                            <img src="<?php echo e(asset('assets/images/'.$data->photo)); ?>" alt="clients">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clients -->
    <?php endif; ?>

    <?php if(in_array('Counter', $home_modules)): ?>
        <!-- Counter -->
        <section class="counter-section pb-100 pt-50">
            <div class="container">
                <div class="row g-4">
                    <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="counter-item">
                                <div class="counter-icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                                <div class="counter-content">
                                    <h3 class="counter-title">
                                        <?php if($data->is_money == 1): ?>
                                            <span class="count">$</span>
                                        <?php endif; ?>
                                        <span class="odometer count" data-odometer-final="<?php echo e($data->count); ?>"></span>
                                        <span class="count">M</span>
                                    </h3>
                                    <h6 class="counter-subtitle"><?php echo e($data->title); ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- Counter -->
    <?php endif; ?>

    <?php if(in_array('CTAs', $home_modules)): ?>
        <!-- CTAs -->
        <?php if ($__env->exists('partials.front.cta')) echo $__env->make('partials.front.cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- CTAs -->
    <?php endif; ?>

    <?php if(in_array('Blogs', $home_modules)): ?>
        <!-- Blogs -->
        <section class="blogs-section pt-100 pb-50">1
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="subtitle text--base"><?php echo app('translator')->get('News & Tips'); ?></h6>
                    <h2 class="title"><?php echo e($ps->blog_title); ?></h2>
                    <p>
                        <?php
                            echo $ps->blog_text;
                        ?>
                    </p>
                </div>
                <div class="row justify-content-center gy-4">
                    <?php $__currentLoopData = $blogs->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-10">
                            <div class="blog__item">
                                <div class="blog__item-img">
                                    <a href="<?php echo e(route('blog.details',$blog->slug)); ?>">
                                        <img src="<?php echo e(asset('assets/images/'.$blog->photo)); ?>" alt="blog">
                                    </a>
                                </div>
                                <div class="blog__item-content">
                                    <div class="d-flex flex-wrap justify-content-between meta-post">
                                        <span><i class="far fa-user"></i> <?php echo app('translator')->get('Admin'); ?></span>
                                    </div>
                                    <h5 class="blog__item-content-title">
                                        <a href="<?php echo e(route('blog.details',$blog->slug)); ?>">
                                            <?php echo e(Str::limit($blog->title,50)); ?>

                                        </a>
                                    </h5>
                                    <a href="<?php echo e(route('blog.details',$blog->slug)); ?>" class="read-more"><?php echo app('translator')->get('Read More'); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- Blogs -->
    <?php endif; ?>

    <?php if(in_array('Faqs', $home_modules)): ?>
        <!-- Faqs -->
        <section class="faqs-section pt-50 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center">
                            <h6 class="subtitle text--base"><?php echo app('translator')->get('FAQs'); ?></h6>
                            <h2 class="title"><?php echo e($ps->faq_title); ?></h2>
                            <p>
                                <?php
                                    echo $ps->faq_subtitle;
                                ?>
                            </p>
                        </div>
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
                </div>
            </div>
        </section>
        <!-- Faqs -->
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/frontend/index.blade.php ENDPATH**/ ?>
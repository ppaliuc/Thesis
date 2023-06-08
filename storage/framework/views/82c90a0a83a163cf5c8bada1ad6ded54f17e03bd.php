<footer class="bg--section">
    <div class="footer-top position-relative">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-logo">
                    <a href="index.html">
                        <img src="<?php echo e(asset('assets/images/'.$gs->footer_logo)); ?>" alt="logo">
                    </a>
                </div>
                <div class="footer-links">
                    <h5 class="title"><?php echo app('translator')->get('About'); ?></h5>
                    <ul>
                        <?php $__currentLoopData = DB::table('pages')->whereStatus(1)->orderBy('id','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('front.page',$data->slug)); ?>"><?php echo e($data->title); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>
                <div class="footer-links mobile-second-item">
                    <h5 class="title"><?php echo app('translator')->get('Contact'); ?></h5>
                    <ul>
                        <li>
                            <a href="#0"><?php echo e($ps->street); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e($ps->contact_email); ?>"><?php echo e($ps->contact_email); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e($ps->phone); ?>"><?php echo e($ps->phone); ?></a>
                        </li>
                    </ul>
                </div>
                
                <div class="footer-comunity">
                    <h5 class="title"><?php echo app('translator')->get('Community'); ?></h5>
                    <ul class="social-icons justify-content-start mt-0 mb-4">
                        <?php if($social->f_status): ?>
                            <li>
                                <a href="<?php echo e($social->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if($social->t_status): ?>
                            <li>
                                <a href="<?php echo e($social->twitter); ?>"><i class="fab fa-twitter"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if($social->l_status): ?>
                            <li>
                                <a href="<?php echo e($social->linkedin); ?>"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <p>
                        <?php echo app('translator')->get('Stay Excited, Subscribe to our Newsletter'); ?>
                    </p>
      
                        
                    <form class="input-group mt-3 footer-input-group" action="<?php echo e(route('front.subscriber')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="email" name="email" class="form-control" placeholder="<?php echo app('translator')->get('Your email address...'); ?>">
                        <button class="input-group-text bg--white border-0 text--base">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom position-relative pb-5">
        <div class="container text-center">
            <p>
                <?php
                    echo $gs->copyright;
                ?>
            </p>
        </div>
    </div>
</footer><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/partials/front/footer.blade.php ENDPATH**/ ?>
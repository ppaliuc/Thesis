<div class="d-flex flex-wrap justify-content-evenly justify-content-md-between">
    <div class="d-flex flex-wrap align-items-center">
        <ul class="social-icons py-1 py-md-0">
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
        <div class="change-language me-md-auto">
            <select name="currency" class="currency selectors nice language-bar">
                <?php $__currentLoopData = DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(route('front.currency',$currency->id)); ?>" <?php echo e(Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '')); ?>>
                        <?php echo e($currency->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <ul class="contact-bar py-1 py-md-0">
        <li>
            <a href="Tel:<?php echo e($ps->phone); ?>"><?php echo e($ps->phone); ?></a>
        </li>
        <li>
            <a href="Mailto:<?php echo e($ps->email); ?>"><?php echo e($ps->email); ?></a>
        </li>
        <li>
            <div class="change-language d-none d-sm-block">
                <select name="language" class="language selectors nice language-bar">
                    <?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(route('front.language',$language->id)); ?>" <?php echo e(Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '')); ?> >
                            <?php echo e($language->language); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </li>
    </ul>
</div><?php /**PATH C:\wamp\htdocs\bank\project\resources\views/partials/front/navbar.blade.php ENDPATH**/ ?>
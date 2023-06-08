<div class="navbar-wrapper">
    <div class="logo">
        <a href="<?php echo e(route('front.index')); ?>">
            <img src="<?php echo e(asset('assets/images/'.$gs->logo)); ?>" alt="logo" />
        </a>
    </div>
    <div class="change-language d-sm-none ms-auto me-3 text--title">
        <select name="language" class="language selectors nice language-bar">
            <?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route('front.language',$language->id)); ?>" <?php echo e(Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '')); ?> >
                    <?php echo e($language->language); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="nav-toggle d-lg-none">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="nav-menu-area">
        <div class="menu-close text--danger d-lg-none">
            <i class="fas fa-times"></i>
        </div>
        <ul class="nav-menu">
            <?php $__currentLoopData = json_decode($gs->menu,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(url($menue['href'])); ?>" target="<?php echo e($menue['target'] == 'blank' ? '_blank' : '_self'); ?>"><?php echo e($menue['title']); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($gs->is_contact): ?>
                <li>
                    <a href="<?php echo e(route('front.contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                </li>
            <?php endif; ?>
            
            <li>
                <div class="btn__grp ms-lg-3">
                    <?php if(!auth()->user()): ?>
                        <a href="<?php echo e(route('user.login')); ?>" class="cmn--btn"><?php echo app('translator')->get('Login Now'); ?></a>
                    <?php else: ?> 
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="cmn--btn"><?php echo app('translator')->get('Dashboard'); ?></a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</div><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/partials/front/nav.blade.php ENDPATH**/ ?>
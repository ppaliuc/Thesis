<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3"><?php echo e(__('Edit Profile')); ?></h5>
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a></li>
        </ol>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Edit Profile Form')); ?></h6>
        </div>

        <div class="card-body">
        <div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">

            <?php echo $__env->make('includes.admin.form-both', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo e(csrf_field()); ?>


            <div class="form-group">
                <label><?php echo e(__('Profile Picture')); ?> <small class="small-font">(<?php echo e(__('Preferred Size 600 X 600')); ?>)</small></label>
                <div class="wrapper-image-preview">
                    <div class="box">
                        <div class="back-preview-image" style="background-image: url(<?php echo e($data->photo ? asset('assets/images/'.$data->photo):asset('assets/images/placeholder.jpg')); ?>);"></div>
                        <div class="upload-options">
                            <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> <?php echo e(__('Upload Picture')); ?> </label>
                            <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inp-name"><?php echo e(__('Name')); ?></label>
                <input type="text" class="form-control" id="inp-name" name="name"  placeholder="<?php echo e(__('Enter Name')); ?>" value="<?php echo e($data->name); ?>" required>
            </div>

            <div class="form-group">
                <label for="inp-eml"><?php echo e(__('Email Address')); ?></label>
                <input type="email" class="form-control" id="inp-eml" name="email"  placeholder="<?php echo e(__('Enter Email Address')); ?>" value="<?php echo e($data->email); ?>" required>
            </div>

            <div class="form-group">
                <label for="inp-phn"><?php echo e(__('Phone')); ?></label>
                <input type="text" class="form-control" id="inp-phn" name="phone"  placeholder="<?php echo e(__('Phone Number')); ?>" value="<?php echo e($data->phone); ?>" required>
            </div>

            

            <button type="submit" id="submit-btn" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>

        </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/admin/profile.blade.php ENDPATH**/ ?>
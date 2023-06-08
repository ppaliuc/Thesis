

<?php $__env->startSection('content'); ?>
<center><h1><?php echo e(__('Please do not refresh this page...')); ?></h1></center>
<form method="post" action="<?php echo e($paytm_txn_url); ?>" name="f1">
    <?php echo e(csrf_field()); ?>

    <table border="1">
        <tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </tbody>
    </table>
    
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
    'use strict';
    document.f1.submit();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/frontend/paytm-merchant-form.blade.php ENDPATH**/ ?>
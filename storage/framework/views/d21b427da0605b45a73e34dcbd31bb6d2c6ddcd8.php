<?php if(\Session::has('success')): ?>
<div class="alert alert-success" role="alert">
    <p class="text-success">
        <?php
           echo \Session::get('success');
        ?>
    </p>
</div>
<?php endif; ?>

<?php if(\Session::has('unsuccess')): ?>
<div class="alert alert-warning" role="alert">
    <p class="text-danger">
        <?php
        echo \Session::get('unsuccess');
        ?>
    </p>
</div>
<?php endif; ?><?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/includes/flash.blade.php ENDPATH**/ ?>
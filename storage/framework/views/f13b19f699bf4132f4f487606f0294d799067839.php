<div class="cookie-bar-wrap show js-cookie-consent cookie-consent">
    <div class="container d-flex justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="row justify-content-center">
                <div class="cookie-bar">
                    <div class="cookie-bar-text cookie-consent__message">
                        <?php
                            echo $gs->cookie_text;
                        ?>
                    </div>
                    <div class="cookie-bar-action js-cookie-consent-agree cookie-consent__agree">
                        <button class="btn btn-primary btn-accept my-2">
                            <?php echo e($gs->cookie_button); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/vendor/spatie/laravel-cookie-consent/src/../resources/views/dialogContents.blade.php ENDPATH**/ ?>
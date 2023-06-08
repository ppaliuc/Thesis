<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo e(asset('assets/user/css/tabler.min.css')); ?>" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/toastr.min.css')); ?>">
    <title>Document</title>
</head>

<body>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card p-3 p-sm-4 p-lg-5">
                        <?php if ($__env->exists('includes.flash')) echo $__env->make('includes.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form class="deposit-form" action="" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="form-label required"><?php echo e(__('Payment Method')); ?></label>
                                <select name="method" id="withmethod" class="form-select" required>
                                    <option value=""><?php echo e(__('Select Payment Method')); ?></option>
                                    <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($gateway->type == 'manual'): ?>
                                            <option value="Manual" data-details="<?php echo e($gateway->details); ?>"><?php echo e($gateway->title); ?></option>
                                        <?php endif; ?>
                                        <?php if(in_array($gateway->keyword,$availableGatways)): ?>
                                            <option value="<?php echo e($gateway->keyword); ?>"><?php echo e($gateway->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-12 mt-4 manual-payment d-none">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="row">

                                      <div class="col-lg-12 pb-2 manual-payment-details">
                                      </div>

                                      <div class="col-lg-12">
                                        <label class="form-label required"><?php echo app('translator')->get('Transaction ID'); ?>#</label>
                                        <input class="form-control" name="txn_id4" type="text" placeholder="Transaction ID#" id="manual_transaction_id">
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>

                            <div id="card-view" class="col-lg-12 pt-3 d-none">
                                <div class="row">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="no_note" value="1">
                                    <input type="hidden" name="lc" value="UK">
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

                                    <div class="col-lg-6 mb-3">
                                        <input type="text" class="form-control card-elements" name="cardNumber" placeholder="<?php echo e(__('Card Number')); ?>" autocomplete="off" required autofocus oninput="validateCard(this.value);"/>
                                        <span id="errCard"></span>
                                    </div>

                                    <div class="col-lg-6 cardRow mb-3">
                                        <input type="text" class="form-control card-elements" placeholder="<?php echo e(('Card CVC')); ?>" name="cardCVC" oninput="validateCVC(this.value);">
                                        <span id="errCVC"></span>
                                    </div>

                                    <div class="col-lg-6">
                                        <input type="text" class="form-control card-elements" placeholder="<?php echo e(__('Month')); ?>" name="month" >
                                    </div>

                                    <div class="col-lg-6">
                                        <input type="text" class="form-control card-elements" placeholder="<?php echo e(__('Year')); ?>" name="year">
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="deposit_id" value="<?php echo e($deposit->id); ?>">
                            <input type="hidden" id="amount" name="amount" value="<?php echo e($deposit->amount); ?>">
                            <input type="hidden" name="currency_sign" value="<?php echo e($deposit_currency->sign); ?>">
                            <input type="hidden" id="currencyCode" name="currency_code" value="<?php echo e($deposit_currency->name); ?>">
                            <input type="hidden" name="currency_id" value="<?php echo e($deposit_currency->id); ?>">
                            <input type="hidden" id="UserEmail" name="email" value="<?php echo e($user->email); ?>">
                            <input type="hidden" id="ref_id" name="paystack_txn" value="">
                            <input type="hidden" name="paystackInfo" id="paystackInfo" value="<?php echo e($paystackKey); ?>">

                            <div class="form-group mb-3 ">
                                <label class="form-label"><?php echo e(__('Description')); ?></label>
                                <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="<?php echo e(__('Receive account details')); ?>"></textarea>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/user/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>
    <script type="text/javascript">
        'use strict';

        $(document).on('change','#withmethod',function(){
            var val = $(this).val();

            if(val == 'stripe')
            {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.stripe.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').removeClass('d-none');
                $('.card-elements').prop('required',true);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'flutterwave')
            {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.flutter.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'authorize.net')
            {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.authorize.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').removeClass('d-none');
                $('.card-elements').prop('required',true);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'paypal') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.paypal.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'mollie') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.molly.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'paytm') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.paytm.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);

                $('.manual-payment').addClass('d-none');
            }

            if(val == 'paystack') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.paystack.submit')); ?>');
                $('.deposit-form').prop('id','step1-form');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'instamojo') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.instamojo.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'razorpay') {
                $('.deposit-form').prop('action','<?php echo e(route('api.deposit.razorpay.submit')); ?>');
                $('.deposit-form').prop('id','');
                $('#card-view').addClass('d-none');
                $('.card-elements').prop('required',false);
                $('#manual_transaction_id').prop('required',false);
                $('.manual-payment').addClass('d-none');
            }

            if(val == 'Manual'){
              $('.deposit-form').prop('action','<?php echo e(route('api.deposit.manual.submit')); ?>');
              $('.deposit-form').prop('id','');
              $('.manual-payment').removeClass('d-none');
              $('#card-view').addClass('d-none');
              $('.card-elements').prop('required',false);
              $('#manual_transaction_id').prop('required',true);
              const details = $(this).find(':selected').data('details');
              $('.manual-payment-details').empty();
              $('.manual-payment-details').append(`<font size="3">${details}</font>`)
            }

        });
    </script>

    <script>
        closedFunction=function() {
            alert('Payment Cancelled!');
        }

        successFunction=function(transaction_id) {
            window.location.href = '<?php echo e(url('order/payment/return')); ?>?txn_id=' + transaction_id;
        }

        failedFunction=function(transaction_id) {
            alert('Transaction was not successful, Ref: '+transaction_id)
        }
    </script>

    <script>
        'use strict';
        $(document).on('submit','#step1-form',function(){

            var total = $('#amount').val();
            var paystackInfo = $('#paystackInfo').val();
            var curr = $('#currencyCode').val();

            total = Math.round(total);

            var handler = PaystackPop.setup({
                key: paystackInfo,
                email: $('#UserEmail').val(),
                amount: total * 100,
                currency: curr,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response){
                    $('#ref_id').val(response.reference);
                    $('#step1-form').prop('id','');
                    $('.deposit-form').submit();
                },
                onClose: function(){
                    window.location.reload();
                }
            });
            handler.openIframe();
                return false;

        });
    </script>

    <script type="text/javascript" src="<?php echo e(asset('assets/front/js/payvalid.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/front/js/paymin.js')); ?>"></script>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/front/js/payform.js')); ?>"></script>

    <script type="text/javascript">
        'use strict';

        var cnstatus = false;
        var dateStatus = false;
        var cvcStatus = false;

        function validateCard(cn) {
            cnstatus = Stripe.card.validateCardNumber(cn);
            if (!cnstatus) {
                $("#errCard").html('Card number not valid<br>');
            } else {
                $("#errCard").html('');
            }
            btnStatusChange();
        }

        function validateCVC(cvc) {
            cvcStatus = Stripe.card.validateCVC(cvc);
            if (!cvcStatus) {
                $("#errCVC").html('CVC number not valid');
            } else {
                $("#errCVC").html('');
            }
            btnStatusChange();
        }

    </script>

    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        'use strict';

        <?php if(Session::has('message')): ?>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.success("<?php echo e(session('message')); ?>");
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>
    </script>
</body>
</html>
<?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/deposit/api_deposit.blade.php ENDPATH**/ ?>
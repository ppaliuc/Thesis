<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            <?php echo e(__('Package Details')); ?>

          </h2>
        </div>

      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Plan Title')); ?></th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e($data->title); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Plan Amount')); ?></th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->amount)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Send Money')); ?> (<?php echo app('translator')->get('Daily'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->daily_send)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Send Money')); ?> (<?php echo app('translator')->get('Monthly'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->monthly_send)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Receive Money')); ?> (<?php echo app('translator')->get('Daily'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->daily_receive)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Receive Money')); ?> (<?php echo app('translator')->get('Monthly'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->monthly_receive)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Withdraw Amount')); ?> (<?php echo app('translator')->get('Daily'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->daily_withdraw,$currency)); ?></td>
                        </tr>

                        <tr>
                            <th class="45%" width="45%"><?php echo e(__('Maximum Withdraw Amount')); ?> (<?php echo app('translator')->get('Monthly'); ?>)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%"><?php echo e(showNameAmount($data->monthly_withdraw)); ?></td>
                        </tr>

                        <tr>
                            <th width="45%"><?php echo e(__('Maximum Loan Amount')); ?> (<?php echo app('translator')->get('Monthly'); ?>)</th>
                            <td width="10%">:</td>
                            <td width="45%"><?php echo e(showNameAmount($data->loan_amount)); ?></td>
                        </tr>

                        <tr>
                            <th width="45%"><?php echo e(__('End Days')); ?></th>
                            <td width="10%">:</td>
                            <td width="45%"><?php echo e($data->days); ?> <?php echo app('translator')->get('Days'); ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    <form id="subscription-form" action="<?php echo e(route('subscription.free.submit')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <?php if($data->amount != 0): ?>
                            <div class="form-group">
                                <label class="form-label required"><?php echo e(__('Payment Method')); ?></label>
                                <select name="method" id="subscriptionMethod" class="form-select" required>
                                    <option value=""><?php echo e(__('Select Payment Method')); ?></option>
                                    <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($gateway->keyword,$availableGatways)): ?>
                                            <?php if($gateway->type == 'manual'): ?>
                                                <option value="Manual" data-details="<?php echo e($gateway->details); ?>"><?php echo e($gateway->title); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($gateway->keyword); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div id="card-view" class="col-lg-12 pt-3 d-none">
                            <div class="row">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="lc" value="UK">
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

                                <div class="col-lg-6 mb-3">
                                    <input type="text" class="form-control card-elements" name="cardNumber" placeholder="<?php echo e(__('Card Number')); ?>" autocomplete="off" autofocus oninput="validateCard(this.value);"/>
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

                        <input type="hidden" name="price" value="<?php echo e(convertedPrice($data->amount,$currency)); ?>">
                        <input type="hidden" name="days" value="<?php echo e($data->days); ?>">
                        <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                        <input type="hidden" name="bank_plan_id" value="<?php echo e($data->id); ?>">
                        <input type="hidden" name="currency_sign" value="<?php echo e($currency->sign); ?>">
                        <input type="hidden" id="currencyCode" name="currency_code" value="<?php echo e($currency->name); ?>">
                        <input type="hidden" name="currency_id" value="<?php echo e($currency->id); ?>">

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script type="text/javascript">
'use strict';

$(document).on('change','#subscriptionMethod',function(){
	var val = $(this).val();

	if(val == 'stripe')
	{
		$('#subscription-form').prop('action','<?php echo e(route('subscription.stripe.submit')); ?>');
		$('#card-view').removeClass('d-none');
		$('.card-elements').prop('required',true);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
	}

    if(val == 'paypal') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.paypal.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'paytm') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.paytm.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);

        $('.manual-payment').addClass('d-none');
    }

    if(val == 'instamojo') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.instamojo.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'razorpay') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.razorpay.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'mollie') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.molly.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'flutterwave') {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.flutter.submit')); ?>');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'authorize.net')
    {
        $('#subscription-form').prop('action','<?php echo e(route('subscription.authorize.submit')); ?>');
        $('#card-view').removeClass('d-none');
        $('.card-elements').prop('required',true);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

});

$(document).on('submit','.step1-form',function(){
    var val = $('#sub').val();
    var total = $('#amount').val();
    var paystackInfo = $('#paystackInfo').val();
    var curr = $('#currencyCode').val();
    total = Math.round(total);
        if(val == 0)
        {
        var handler = PaystackPop.setup({
          key: paystackInfo,
          email: $('input[name=email]').val(),
          amount: total * 100,
          currency: curr,
          ref: ''+Math.floor((Math.random() * 1000000000) + 1),
          callback: function(response){
            $('#ref_id').val(response.reference);
            $('#sub').val('1');
            $('#final-btn').click();
          },
          onClose: function(){
            window.location.reload();
          }
        });
        handler.openIframe();
            return false;
        }
        else {
          $('#preloader').show();
            return true;
        }
});

</script>

  <script src="//voguepay.com/js/voguepay.js"></script>

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
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/user/package/details.blade.php ENDPATH**/ ?>
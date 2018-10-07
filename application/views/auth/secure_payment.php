<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Secure Payment</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
			<div class="alertmsgs"></div>
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?php echo validation_errors();?>
                  <?php echo isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
            <div class="stripe-form">
            <?php echo form_open(base_url('auth/secure_payment'), array('class' => 'form-horizontal', 'id' => 'stripe-payment-form'));  ?> 
			  <input type="hidden" name="action" value="secure_payment">
			  <div class="form-group">
                <label for="address" class="col-sm-3 control-label">Address:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="address" name="address">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>
			  <div class="form-group">
                <label for="city" class="col-sm-3 control-label">City:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>
			  <div class="form-group">
                <label for="state" class="col-sm-3 control-label">State:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="state" name="state">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>
			  <div class="form-group">
                <label for="zipcode" class="col-sm-3 control-label">Zipcode:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="zipcode" name="zipcode">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>
			  <div class="form-group">
                <label for="zipcode" class="col-sm-3 control-label">Plan:</label>
                <div class="col-sm-5">
                  <select name="plan" id="plan" class="form-control">
					<option value="">Choose Plan</option>
					<option value="1">Pay-as-you-go</option>
					<option value="2">Monthly</option>
					<option value="3">Yearly</option>
				  </select>
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>
              <div class="form-group">
                <label for="cc_number" class="col-sm-3 control-label">Credit Card Number:</label>
                <div class="col-sm-5">
                  <input type="text" maxlength="16" class="form-control" id="cc_number" name="cc_number">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>

              <div class="form-group">
                <label for="cc_name" class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-5">
                   <input type="text" class="form-control" id="cc_name" name="cc_name">
                </div>
				<div class="col-sm-4">&nbsp;</div>
              </div>

              <div class="form-group">
				<label class="control-label col-sm-3" for="cc_expire_month">Expire Date:</label>
				<div class="col-sm-2">
				   <input type="text" class="form-control" id="cc_expire_month" name="cc_expire_month" placeholder="MM" maxlength="2">
				</div>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="cc_expire_year" name="cc_expire_year" placeholder="YYYY" maxlength="4">
				</div>
				<div class="col-sm-4">&nbsp;</div>
			  </div>
              <div class="form-group fieldbg">
				<label class="control-label col-sm-3" for="cc_cvv">CVV:</label>
				<div class="col-sm-2">
				  <input type="password" maxlength="4" class="form-control" id="cc_cvv" name="cc_cvv">
				</div>
				<div class="col-sm-7">&nbsp;</div>
			  </div>
              <div class="form-group">
				<label class="control-label col-sm-3"></label>
                <div class="col-md-9">
                  <button type="submit" class="btn btn-info pull-left stripe-submit-btn">Pay</button>
				  <img src="<?php echo base_url('public/dist/img/ajax-loader.gif'); ?>" id="aloader">
                </div>
              </div>
            <?php echo form_close( ); ?>
			</div>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
	Stripe.setPublishableKey('pk_test_cUecwRXqyX487ptVT4M5k3L4');
  
	jQuery(function() {
	  var $form = jQuery('#stripe-payment-form');
	  $form.submit(function(event) {
		  jQuery('#aloader').show();
		  if(jQuery('#plan').val() == ''){
			jQuery('.alertmsgs').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failed!</strong> Choose the plan</div>');
			jQuery('#aloader').hide();
			jQuery('html, body').animate({scrollTop: 0}, 300);
			return false;
		  }
		// Disable the submit button to prevent repeated clicks:
		$form.find('.stripe-submit-btn').prop('disabled', true);
	
		// Request a token from Stripe:
		Stripe.card.createToken({
		  number: jQuery('#cc_number').val(),
		  cvc: jQuery('#cc_cvv').val(),
		  exp_month: jQuery('#cc_expire_month').val(),
		  exp_year: $('#cc_expire_year').val(),
		  name: jQuery('#cc_name').val(),
		  address_line1: jQuery('#address').val(),
		  address_city: jQuery('#city').val(),
		  address_state: jQuery('#state').val(),
		  address_zip: jQuery('#zipcode').val() 
		}, stripeResponseHandler);
	
		// Prevent the form from being submitted:
		return false;
	  });
	});

	function stripeResponseHandler(status, response) {
	  // Grab the form:
	  var $form = jQuery('#stripe-payment-form');
	
	  if (response.error) { // Problem!
	
		// Show the errors on the form:
		jQuery('.alertmsgs').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failed!</strong> '+response.error.message+'</div>');
		$form.find('.stripe-submit-btn').prop('disabled', false); // Re-enable submission
		jQuery('#aloader').hide();
		jQuery('html, body').animate({scrollTop: 0}, 300);
	  } else { // Token was created!
	
		// Get the token ID:
		var token = response.id;

		// Insert the token ID into the form so it gets submitted to the server:
		$form.append(jQuery('<input type="hidden" name="stripeToken">').val(token));
	
		// Submit the form:
		$form.get(0).submit();
		//jQuery('#stripe-payment-form').submit();
		return true;
	  }
	};
</script>

<script type="text/javascript">
$("#my_therapist").addClass('active');
$("#add_therapist").addClass('active');
</script>    
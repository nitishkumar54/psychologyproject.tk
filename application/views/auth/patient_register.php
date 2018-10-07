<!DOCTYPE html>
<html lang="en">
    <head>
          <title><?php echo isset($title)?$title:'E-psychology' ?></title>
          <!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <!-- Bootstrap 3.3.6 -->
          <link rel="stylesheet" href="<?php echo base_url() ?>public/bootstrap/css/bootstrap.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="<?php echo base_url() ?>public/dist/css/AdminLTE.min.css">
           <!-- Custom CSS -->
          <link rel="stylesheet" href="<?php echo base_url() ?>public/dist/css/style.css">
		  
          <link rel="stylesheet" href="<?php echo base_url() ?>public/dist/css/validationEngine.jquery.css">
           <!-- jQuery 2.2.3 -->
          <script src="<?php echo base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
       
    </head>
<body style="background: #e8e8ea; ">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4 text-center">
                <div class="register-title">
                    <h3><span>E-PSYCHOTHERAPY</span></h3>
                </div>
				<?php if(isset($errormsg) || validation_errors() !== ''): ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    <?php echo validation_errors();?>
                    <?php echo isset($errormsg)? $errormsg: ''; ?>
                </div>
                <?php endif; ?>
				<?php if(isset($successmsg)): ?>
                <div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
                    <?php echo isset($successmsg)? $successmsg: ''; ?>
                </div>
                <?php endif; ?>
				<div class="form-box">
                    <div class="caption">
                        <h4>Register As Patient</h4>
                    </div>
                    <?php echo form_open(base_url('auth/patient_register'), 'class="register-form" '); ?>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control validate[required]" placeholder="Name" >
                            <input type="text" name="surname" id="surname" class="form-control validate[required]" placeholder="Surname" >
                            <input type="email" name="email" id="email" class="form-control validate[required,custom[email]]" placeholder="Email" >
							<div class="form-group text-left">
								<div class="radio">
									<label>
										<input type="radio" name="gender" id="male" value="male" class="validate[required]">Male
									</label>
									<label>
										<input type="radio" name="gender" id="female" value="female" class="validate[required]">Female
									</label>
								</div>
							</div>
                            <input type="password" name="password" id="password" class="form-control validate[required]" placeholder="Password" >
                            <input type="password" name="cpassword" id="cpassword" class="form-control validate[required,equals[password]]" placeholder="Confirm Password" >
							<input type="text" name="cor" id="cor" class="form-control validate[required]" placeholder="Country of residence" >
							<select name="timezone" id="timezone" class="form-control validate[required]">
								<option value="">Choose Timing</option>
								<?php foreach($timezone_list as $key => $value) { ?>
								<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
                            <input type="submit" name="submit" id="submit" class="form-control" value="Submit">
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
		<div class="row" style="height:50px;"></div>
    </div>
</body>

    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>public/dist/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>public/dist/js/jquery.validationEngine-en.js"></script>
    <script src="<?php echo base_url() ?>public/dist/js/jquery.validationEngine.js"></script>
	
	<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery(".register-form").validationEngine();
		jQuery.ajax({
			url: '<?php echo base_url() ?>auth/timezone_detect',
			data: getTimeZoneData(),
			method: 'POST',
			dataType: 'JSON'
		}).done(function(data) {
			 jQuery('#timezone > option').each(function(){
				if($(this).text()==data) jQuery(this).parent('select').val(jQuery(this).val())
			 })
		});
	});
	
	function getTimeZoneData() {
		var today = new Date();
		var jan = new Date(today.getFullYear(), 0, 1);
		var jul = new Date(today.getFullYear(), 6, 1);
		var dst = today.getTimezoneOffset() < Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
	  
		return {
			offset: -today.getTimezoneOffset() / 60,
			dst: +dst
		};
	}
	</script>

</html>
<!-- Section: inner-header -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1080">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="font-28 text-white">My Account</h3>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="index-mp-layout1.html">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-theme-colored">Page Title</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

<!-- Section: About -->
<section>
  <div class="container">
	<div class="row">
	  <div class="col-md-6 col-md-push-3">  
		<?php if(isset($msg) || validation_errors() !== ''): ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-warning"></i> Alert!</h4>
			<?php echo validation_errors();?>
			<?php echo isset($msg)? $msg: ''; ?>
		</div>
		<?php endif; ?>
		<h4 class="text-gray mt-0 pt-5"> Login</h4>
		<hr>
		<?php echo form_open(base_url('auth/login'), 'class="login-form" '); ?>
		  <div class="row">
			<div class="form-group col-md-12">
			  <label for="email">Email</label>
			  <input id="email" name="email" class="form-control" type="email">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-12">
			  <label for="password">Password</label>
			  <input id="password" name="password" class="form-control" type="password">
			</div>
		  </div>
		  <div class="checkbox pull-left mt-15"> 
			<label for="form_checkbox">
			  <input id="form_checkbox" name="form_checkbox" type="checkbox">
			  Remember me </label>
		  </div>
		  <div class="clear text-right pt-10">
			<a class="text-theme-colored font-weight-600 font-12" href="#">Forgot Your Password?</a>
		  </div>
		  <div class="clear text-center pt-10">
			<input type="submit" name="submit" id="submit" class="btn btn-dark btn-lg btn-block" value="Login">
		  </div>
		  <div class="clear text-center pt-10">
			<a class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" href="<?php echo base_url('auth/register'); ?>" data-bg-color="#3b5998">Register</a>
		  </div>
		<?php echo form_close(); ?>
	  </div>
	</div>
  </div>
</section>
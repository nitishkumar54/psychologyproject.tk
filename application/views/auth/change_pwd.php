<link rel="stylesheet" href="<?php echo base_url() ?>public/dist/css/validationEngine.jquery.css">
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?php echo validation_errors();?>
              </div>
            <?php endif; ?>
           
            <?php echo form_open(base_url('auth/change_pwd'), 'class="form-horizontal chg_pwd_form"');  ?> 
              <div class="form-group">
                <label for="password" class="col-sm-3 control-label">New Password</label>

                <div class="col-sm-8">
                  <input type="password" name="password" class="form-control validate[required]" id="password" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="confirm_pwd" class="col-sm-3 control-label">Confirm Password</label>

                <div class="col-sm-8">
                  <input type="password" name="confirm_pwd" class="form-control validate[required,equals[password]]" id="confirm_pwd" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Change Password" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script src="<?php echo base_url() ?>public/dist/js/jquery.validationEngine-en.js"></script>
<script src="<?php echo base_url() ?>public/dist/js/jquery.validationEngine.js"></script>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery(".chg_pwd_form").validationEngine();
});
</script>
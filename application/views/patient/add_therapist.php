<link rel="stylesheet" href="<?php echo base_url() ?>public/dist/css/validationEngine.jquery.css">
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Therapist</h3>
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
           
            <?php echo form_open(base_url('my_therapist/add_therapist'), 'class="form-horizontal chg_pwd_form"');  ?> 
			  <?php foreach($therapists as $therapist) { ?>
              <div class="form-group">
                <div class="col-sm-1"><input type="checkbox" name="therapist[]" class="validate[required]" value="<?php echo $therapist->id; ?>"></div>
                <div class="col-sm-8"><?php echo $therapist->uname.' '.$therapist->surname; ?> - <b>(<?php echo $therapist->name; ?>)</b></div>
              </div>
			  <?php } ?>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add" class="btn btn-info pull-left">
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
$("#my_therapist").addClass('active');
$("#add_therapist").addClass('active');
</script> 
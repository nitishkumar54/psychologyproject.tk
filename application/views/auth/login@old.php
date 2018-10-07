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
           <!-- jQuery 2.2.3 -->
          <script src="<?php echo base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
       
    </head>
<body style="background: #e8e8ea; ">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4 text-center">
                <div class="login-title">
                    <h3><span>E-PSYCHOTHERAPY</span></h3>
                </div>
                <?php if(isset($msg) || validation_errors() !== ''): ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <?php echo validation_errors();?>
                    <?php echo isset($msg)? $msg: ''; ?>
                </div>
                <?php endif; ?>
                <div class="form-box">
                    <div class="caption">
                        <h4>Sign In</h4>
                    </div>
                    <?php echo form_open(base_url('auth/login'), 'class="login-form" '); ?>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" >
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                            <input type="submit" name="submit" id="submit" class="form-control" value="Submit">
							<a href="<?php echo base_url('auth/register'); ?>" class="register_link form-control">Register</a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>public/dist/js/app.min.js"></script>

</html>
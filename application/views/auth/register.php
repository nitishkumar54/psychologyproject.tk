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
                <div class="form-box">
                    <div class="row">
						<p><a href="<?php echo base_url() ?>auth/psychologist_register" class="btn bg-purple btn-flat margin">Register As Psychologist</a></p>
						<p><hr>Or<hr></p>
						<p><a href="<?php echo base_url() ?>auth/patient_register" class="btn bg-maroon btn-flat margin">Register As Patient</a></p>
					</div>
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
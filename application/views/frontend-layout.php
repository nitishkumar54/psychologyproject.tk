<!DOCTYPE html>
<html dir="ltr" lang="en">
	<head>
		  <title><?php echo isset($title)?$title:'E-psychology' ?></title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <!-- Favicon and Touch Icons -->
		  <link href="<?php echo base_url() ?>public/dist/img/favicon.png" rel="shortcut icon" type="image/png">
		  <link href="<?php echo base_url() ?>public/dist/img/apple-touch-icon.png" rel="apple-touch-icon">
		  <link href="<?php echo base_url() ?>public/dist/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
		  <link href="<?php echo base_url() ?>public/dist/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
		  <link href="<?php echo base_url() ?>public/dist/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
		  <!-- Stylesheet -->
		  <link href="<?php echo base_url() ?>public/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		  <link href="<?php echo base_url() ?>public/dist/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
		  <link href="<?php echo base_url() ?>public/dist/css/animate.css" rel="stylesheet" type="text/css">
		  <link href="<?php echo base_url() ?>public/dist/css/css-plugin-collections.css" rel="stylesheet"/>
		  <!-- CSS | menuzord megamenu skins -->
		  <link id="menuzord-menu-skins" href="<?php echo base_url() ?>public/dist/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
		  <!-- CSS | Main style file -->
		  <link href="<?php echo base_url() ?>public/dist/css/style-main.css" rel="stylesheet" type="text/css">
		  <!-- CSS | Preloader Styles -->
		  <link href="<?php echo base_url() ?>public/dist/css/preloader.css" rel="stylesheet" type="text/css">
		  <!-- CSS | Custom Margin Padding Collection -->
		  <link href="<?php echo base_url() ?>public/dist/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
		  <!-- CSS | Responsive media queries -->
		  <link href="<?php echo base_url() ?>public/dist/css/responsive.css" rel="stylesheet" type="text/css">
		  <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
		  <!-- <link href="<?php //echo base_url() ?>public/dist/css/style.css" rel="stylesheet" type="text/css"> -->

		  <!-- CSS | Theme Color -->
		  <link href="<?php echo base_url() ?>public/dist/css/colors/theme-skin-green.css" rel="stylesheet" type="text/css">

		  <!-- external javascripts -->
		  <script src="<?php echo base_url() ?>public/dist/js/jquery-2.2.4.min.js"></script>
		  <script src="<?php echo base_url() ?>public/dist/js/jquery-ui.min.js"></script>
		  <script src="<?php echo base_url() ?>public/dist/js/bootstrap.min.js"></script>
		  <!-- JS | jquery plugin collection for this theme -->
		  <script src="<?php echo base_url() ?>public/dist/js/jquery-plugin-collection.js"></script>

		  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <![endif]-->
	</head>
	<body class="has-side-panel side-panel-right fullwidth-page side-push-panel">
		<div class="body-overlay"></div>
		<?php if($this->session->flashdata('successmsg') != ''): ?>
			<div class="alert alert-success flash-msg alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <h4> Success!</h4>
			  <?php echo $this->session->flashdata('successmsg'); ?> 
			</div>
		  <?php endif; ?>
		  <?php if($this->session->flashdata('errormsg') != ''): ?>
			<div class="alert alert-warning flash-msg alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <h4> Error!</h4>
			  <?php echo $this->session->flashdata('errormsg'); ?> 
			</div>
		  <?php endif; ?>
		<div id="wrapper" class="clearfix">
		  <!-- preloader -->
			<div id="preloader">
				<div id="spinner">
				  <img class="floating ml-5" src="<?php echo base_url() ?>public/dist/img/preloaders/13.png" alt="">
				  <h5 class="line-height-50 font-18">Loading...</h5>
				</div>
				<div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
			</div>
			<!--header start-->
			<header id="header" class="header">
				<?php include('include/frontend-header.php'); ?>
			</header>
			<!--header end-->
			<!--main content start-->
			<div class="main-content">
				<!-- page start-->
				<?php $this->load->view($view);?>
				<!-- page end-->
			</div>
			<!--main content end-->
			<!--footer start-->
			<footer id="footer" class="footer" data-bg-img="<?php echo base_url() ?>public/dist/img/footer-bg.png" data-bg-color="#001018">
				<?php include('include/frontend-footer.php'); ?>
			</footer>
			<!--footer end-->
			<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
		</div>
	  <script src="<?php echo base_url() ?>public/dist/js/custom.js"></script>
	</body>
</html>
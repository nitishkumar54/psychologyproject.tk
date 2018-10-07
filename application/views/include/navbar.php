<?php 
if($this->session->userdata('user_type') == 2) {
	$home_url = base_url('tdashboard');
} else {
	$home_url = base_url('pdashboard');
}
?><header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $home_url; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E-psychology</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-psychology</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
             <!-- Messages: style can be found in dropdown.less-->
		  <?php if(!empty($notifications)) { ?>
          <li class="dropdown messages-menu frontend">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $notifications['total_msgs']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
				  <?php foreach($notifications['notify'] as $notice) { ?>
                  <li><!-- start message -->
                    <a href="<?php echo base_url('my_therapist/send_message').'/'.$notice->pid.'/'.$notice->tid; ?>">
                      <p>You got a new message from <b><?php echo $notice->uname.' '.$notice->surname; ?></b></p>
                    </a>
                  </li><!-- end message -->
				  <?php } ?>
                </ul>
              </li>
            </ul>
          </li>
		  <?php } ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url() ?>public/dist/img/patient-icon.png" class="user-image" alt="<?php echo ucwords($this->session->userdata('name')).' '.ucwords($this->session->userdata('surname')); ?>">
              <span class="hidden-xs"><?php echo ucwords($this->session->userdata('name')); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url() ?>public/dist/img/patient-icon.png" class="img-circle" alt="<?php echo ucwords($this->session->userdata('name')).' '.ucwords($this->session->userdata('surname')); ?>">
                <p>
                  <?php echo ucwords($this->session->userdata('name')).' '.ucwords($this->session->userdata('surname')); ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
                <div class="pull-left">
                  <a href="<?php echo site_url('auth/change_pwd'); ?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
 
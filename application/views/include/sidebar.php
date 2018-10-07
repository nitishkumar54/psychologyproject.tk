<?php 
if($this->session->userdata('user_type') == 2) {
	$cur_tab = $this->uri->segment(2)==''?'tdashboard': $this->uri->segment(2); 
?><!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>public/dist/img/patient-icon.png" class="img-circle" alt="<?php echo ucwords($this->session->userdata('name')).' '.ucwords($this->session->userdata('surname')); ?>">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($this->session->userdata('name')); ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="tdashboard">
          <a href="<?php echo base_url('tdashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
      </ul>
	  <ul class="sidebar-menu">
        <li id="view_patients">
          <a href="<?php echo base_url('my_patients/view_patients'); ?>"><i class="fa fa-users"></i> <span>My Patients</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<script>
  $("#<?php echo $cur_tab; ?>").addClass('active');
</script><?php
} else {
	$cur_tab = $this->uri->segment(1)==''?'pdashboard': $this->uri->segment(1); 
?><!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $icon_url; ?>" class="img-circle" alt="<?php echo ucwords($this->session->userdata('name')).' '.ucwords($this->session->userdata('surname')); ?>">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($this->session->userdata('name')); ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="pdashboard">
          <a href="<?php echo base_url('pdashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
      </ul>
	  <ul class="sidebar-menu">
        <li id="my_therapist" class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>My Therapist</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="add_therapist"><a href="<?php echo base_url('my_therapist/add_therapist'); ?>"><i class="fa fa-circle-o"></i> Add Therapist</a></li>
              <li id="view_therapists" class=""><a href="<?php echo base_url('my_therapist/view_therapists'); ?>"><i class="fa fa-circle-o"></i> View Therapists</a></li>
            </ul>
          </li>
	   </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<script>
  $("#<?php echo $cur_tab; ?>").addClass('active');
</script><?php
}	
?>
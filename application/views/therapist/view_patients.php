 <!-- Datatable style -->
<link rel="stylesheet" href="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">My Patients</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="therapist_list" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>Name</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($patients as $patient) { ?>
		  <tr>
			<td><?php echo $patient->uname.' '.$patient->surname; ?></td>
			<td>
				<a href="<?php echo base_url('my_patients/send_message').'/'.base64_encode($patient->patient_id).'/'.base64_encode($therapist_id); ?>" class="btn bg-navy btn-flat margin">Send Message</a> 
				<form action="" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="rid" value="<?php echo $patient->rid; ?>">
					<input type="submit" name="submit" value="Remove" class="btn btn-danger btn-flat margin">
				</form>
			</td>
		  </tr>
		  <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?php echo base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$("#view_patients").addClass('active');
</script>        

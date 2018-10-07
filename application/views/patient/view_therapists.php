 <!-- Datatable style -->
<link rel="stylesheet" href="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">My Therapists</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="therapist_list" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>Name</th>
          <th>Speciality</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($therapists as $therapist) { ?>
		  <tr>
			<td><?php echo $therapist->uname.' '.$therapist->surname; ?></td>
			<td><?php echo $therapist->name; ?></td>
			<td>
				<a href="<?php echo base_url('my_therapist/send_message').'/'.base64_encode($patient_id).'/'.base64_encode($therapist->therapist_id); ?>" class="btn bg-navy btn-flat margin">Send Message</a> 
				<form action="" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="rid" value="<?php echo $therapist->rid; ?>">
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
  $(function () {
    $("#therapist_list").DataTable();
  });
</script> 
<script>
$("#view_therapists").addClass('active');
</script>        

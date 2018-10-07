<section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Send Message</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
		<div class="send_message_outer">
			<div class="all_threads_box">
				<?php foreach($patients as $patient) { ?>
				<div class="thread_box <?php if($patient_id == $patient->patient_id) { ?>active_thread<?php } ?>">
					<a href="<?php echo base_url('my_patients/send_message').'/'.base64_encode($patient->patient_id).'/'.base64_encode($therapist_id); ?>">
						<div class="thread_title"><?php echo $patient->uname.' '.$patient->surname; ?></div>
						<!--<div class="thread_prof_details"><span class="thread_prof_title">Speciality: </span><span class="thread_prof_name"><?php //echo $therapist->name; ?></span></div>-->
					</a>
				</div>
				<?php } ?>
			</div>
			<div class="prof_conf_msgs_box">
				<div id="student_messages">
					<?php 
					if(!empty($messages)) {
						foreach($messages as $msg) {
							if($msg->sender_type == 2) { // Therapist Message
					?>
					<div id="rptService_pnlBubble_1" class="triangle-isosceles top" style="float:left;width:50%;">
					<?php echo $msg->message; ?><br>
					<?php if($msg->attach_file != '' && $msg->attach_file_name != '') { ?>
					<a style="text-decoration:underline;" href="<?php echo base_url('upload/').$msg->attach_file; ?>" target="_blank"><?php echo $msg->attach_file_name; ?></a>
					<?php } ?>
					<div id="rptService_pnlAuthor_1" style="text-align:right;font-size:12px;"><?php echo date('d/m/Y h:i:s A', strtotime($msg->message_date)); ?>&nbsp;-&nbsp;From: <?php echo $user_info->uname.' '.$user_info->surname; ?></div>
					</div>
					<?php } else { // Patient Message ?>
					<div id="rptService_pnlBubble_0" class="triangle-isosceles" style="float:right;width:50%;"><?php echo $msg->message; ?><br>
					<?php if($msg->attach_file != '' && $msg->attach_file_name != '') { ?>
					<a style="text-decoration:underline;" href="<?php echo base_url('upload/').$msg->attach_file; ?>" target="_blank"><?php echo $msg->attach_file_name; ?></a>
					<?php } ?>
					<div id="rptService_pnlAuthor_0" style="text-align:right;font-size:12px;"><?php echo date('d/m/Y h:i:s A', strtotime($msg->message_date)); ?>&nbsp;-&nbsp;To: <?php echo $user_info->uname.' '.$user_info->surname; ?></div>
					</div>
					<?php } } } else { ?>
					<h4 style="text-align:center;">No message found!</h4>
					<?php } ?>
				</div>
				<div class="conf_msg_box" style="width: 100%; padding-left: 20px;margin-bottom:10px;padding-right: 20px;">
					<?php echo form_open(base_url('my_patients/send_message').'/'.base64_encode($patient_id).'/'.base64_encode($therapist_id), 'enctype="multipart/form-data" '); ?>
						<input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
						<input type="hidden" name="therapist_id" value="<?php echo $therapist_id; ?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top" style="padding-top: 5px;">Patient:&nbsp;<strong><?php echo $user_info->uname.' '.$user_info->surname; ?></strong></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" style="padding-top: 5px;">Message:</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" style="padding-top: 0px;">
									<textarea name="txtMessage" rows="2" cols="20" id="txtMessage" style="width:100%;height:100px;"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" style="padding-top: 5px;">
									Add Attachment (optional):
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" style="padding-top: 0px;">
									<input type="file" name="attachment">
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" name="submit" value="Send Message" id="conf_send_msg" class="btn btn-success">
								</td>
							</tr>
						</table>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  
<script type="text/javascript">
$("#view_patients").addClass('active');
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('html, body').animate({scrollTop:jQuery(document).height()}, 'slow');
	setInterval(function(){ 
		jQuery.ajax({
		  method: "POST",
		  url: "<?php echo base_url('my_patients/get_therapist_message'); ?>",
		  data: { pid: <?php echo $patient_id; ?>, tid: <?php echo $therapist_id; ?> }
		})
		  .done(function( response ) {
			if(response != '') {
				jQuery( "#student_messages" ).append( response );
			}
		  });
	}, 3000);
});
</script>
<?php 
if(!empty($messages)) {
	foreach($messages as $msg) {
		if($msg->sender_type == 2) { // Therapist Message
?><div id="rptService_pnlBubble_0" class="triangle-isosceles" style="float:left;width:50%;">
<?php echo $msg->message; ?><br>
<?php if($msg->attach_file != '' && $msg->attach_file_name != '') { ?>
<a style="text-decoration:underline;" href="<?php echo base_url('upload/').$msg->attach_file; ?>" target="_blank"><?php echo $msg->attach_file_name; ?></a>
<?php } ?>
<div id="rptService_pnlAuthor_0" style="text-align:right;font-size:12px;"><?php echo date('d/m/Y h:i:s A', strtotime($msg->message_date)); ?>&nbsp;-&nbsp;From: <?php echo $user_info->uname.' '.$user_info->surname; ?></div>
</div>
<?php } else { // Patient Message ?>
<div id="rptService_pnlBubble_1" class="triangle-isosceles top" style="float:right;width:50%;"><?php echo $msg->message; ?><br>
<?php if($msg->attach_file != '' && $msg->attach_file_name != '') { ?>
<a style="text-decoration:underline;" href="<?php echo base_url('upload/').$msg->attach_file; ?>" target="_blank"><?php echo $msg->attach_file_name; ?></a>
<?php } ?>
<div id="rptService_pnlAuthor_1" style="text-align:right;font-size:12px;"><?php echo date('d/m/Y h:i:s A', strtotime($msg->message_date)); ?>&nbsp;-&nbsp;To: <?php echo $user_info->uname.' '.$user_info->surname; ?></div>
</div><?php } }
} else { echo ''; } ?>
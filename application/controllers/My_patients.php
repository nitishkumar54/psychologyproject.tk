<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_patients extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->has_userdata('is_user_login')) {
			redirect('auth/login');
		}
		$this->load->model('Auth_model', 'am');
		$this->load->model('Common_model', 'cm');
		$this->load->model('Patient_model', 'pm');
	}

	public function view_patients(){
		if($this->input->post('submit')){
			$remove = $this->pm->remove_patient($this->input->post('rid'));
			if($remove) {
				$this->session->set_flashdata('successmsg', 'Record has been removed successfully!');
				redirect(base_url('my_patients/view_patients'));
			} else {
				$data['errormsg'] = 'Something went wrong. Try again!';
			}
		}
		$data['therapist_id'] = $this->session->userdata('user_id');
		$data['patients'] = $this->pm->all_my_patients($this->session->userdata('user_id'));
		$data['notifications'] = $this->cm->get_therapist_notify_messages($this->session->userdata('user_id'));
		$data['title'] = 'My Patients :: E-psychology';
		$data['view'] = 'therapist/view_patients';
		$this->load->view('layout', $data);
	}
	
	public function send_message($pid, $tid){
		if($pid == '' || $tid == '') {
			redirect(base_url('my_patients/view_patients'));
		}
		if($this->input->post('submit')){
			$error = $attach_file_name = $attach_file_id = $success = '';
			if(isset($_FILES["attachment"]["name"]) && !empty($_FILES["attachment"]["name"])) {
				$dir = FCPATH.'upload/';
				$temp = explode(".", $_FILES["attachment"]["name"]);
				$extension = end($temp);
				$attach_file_id = $temp[0].'-'.md5(date('Y-m-d H:i:s')).'.'.$extension;
				if ($_FILES["attachment"]["error"] > 0) {
					$error = $_FILES["attachment"]["error"];
				} else {
					move_uploaded_file($_FILES["attachment"]["tmp_name"],  $dir.'/'. $attach_file_id);
					$attach_file_name = $_FILES["attachment"]["name"];
				}
			}
			
			if($error == '') {
				$postmsg = nl2br($this->input->post('txtMessage'));
				$postmsg = $this->cm->makeLinks($postmsg);
				
				$mdata = array(
					'patient_id' => $this->input->post('patient_id'),
					'therapist_id' => $this->input->post('therapist_id'),
					'attach_file' => $attach_file_id,
					'attach_file_name' => $attach_file_name,
					'message' => $postmsg,
					'message_date' => date('Y-m-d H:i:s'),
					'sender_type' => 2 // Therapist
				);
				$this->cm->save_message($mdata);
			} else {
				$this->session->set_flashdata('errormsg', $error);
				redirect(base_url('my_patients/send_message').'/'.$pid.'/'.$tid);
			}
		}
		$patient_id = base64_decode($pid);
		$therapist_id = base64_decode($tid);
		$data['patient_id'] = $patient_id;
		$data['therapist_id'] = $therapist_id;
		$data['user_info'] = $this->am->get_user_info($patient_id);
		$data['patients'] = $this->pm->all_my_patients($this->session->userdata('user_id'));
		$data['messages'] = $this->cm->get_all_messages($patient_id, $therapist_id);
		$this->cm->change_therapist_message_read_status($patient_id, $therapist_id);
		$data['notifications'] = $this->cm->get_therapist_notify_messages($this->session->userdata('user_id'));
		$data['title'] = 'My Messages :: E-psychology';
		$data['view'] = 'therapist/send_messages';
		$this->load->view('layout', $data);
	}
	
	public function get_therapist_message(){
		$data['messages'] = $this->cm->get_unread_therapist_messages($this->input->post('pid'), $this->input->post('tid'));
		$this->cm->change_therapist_message_read_status($this->input->post('pid'), $this->input->post('tid'));
		$this->load->view('therapist/unread_therapist_messages', $data);
	}
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_therapist extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->has_userdata('is_user_login')) {
			redirect('auth/login');
		}
		$this->load->model('Auth_model', 'am');
		$this->load->model('Common_model', 'cm');
		$this->load->model('Therapist_model', 'tm');
	}
	
	public function add_therapist(){
		$check_user_plan = $this->cm->check_user_plan($this->session->userdata('user_id'));
		if($check_user_plan == FALSE) {
			redirect('auth/secure_payment');
		}
		if($this->input->post('submit')){
			$add_therapists = $this->tm->add_therapists($this->session->userdata('user_id'), $this->input->post());
			if($add_therapists) {
				$this->session->set_flashdata('successmsg', 'Record has been added successfully!');
				redirect(base_url('my_therapist/view_therapists'));
			} else {
				$data['errormsg'] = 'Something went wrong. Try again!';
			}
		}
		$data['title'] = 'Add Therapist :: E-psychology';
		$data['therapists'] = $this->tm->all_therapists($this->session->userdata('user_id'));
		$data['notifications'] = $this->cm->get_patient_notify_messages($this->session->userdata('user_id'));
		$data['view'] = 'patient/add_therapist';
		$this->load->view('layout', $data);
	}

	public function view_therapists(){
		if($this->input->post('submit')){
			$remove = $this->tm->remove_therapist($this->input->post('rid'));
			if($remove) {
				$this->session->set_flashdata('successmsg', 'Record has been removed successfully!');
				redirect(base_url('my_therapist/view_therapists'));
			} else {
				$data['errormsg'] = 'Something went wrong. Try again!';
			}
		}
		$data['patient_id'] = $this->session->userdata('user_id');
		$data['therapists'] = $this->tm->all_my_therapists($this->session->userdata('user_id'));
		$data['notifications'] = $this->cm->get_patient_notify_messages($this->session->userdata('user_id'));
		$data['title'] = 'My Therapists :: E-psychology';
		$data['view'] = 'patient/view_therapists';
		$this->load->view('layout', $data);
	}
	
	public function send_message($pid, $tid){
		if($pid == '' || $tid == '') {
			redirect(base_url('my_therapist/view_therapists'));
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
					'sender_type' => 1 // Patient
				);
				$this->cm->save_message($mdata);
			} else {
				$this->session->set_flashdata('errormsg', $error);
				redirect(base_url('my_therapist/send_message').'/'.$pid.'/'.$tid);
			}
		}
		$patient_id = base64_decode($pid);
		$therapist_id = base64_decode($tid);
		$data['patient_id'] = $patient_id;
		$data['therapist_id'] = $therapist_id;
		$data['user_info'] = $this->am->get_user_info($therapist_id);
		$data['therapists'] = $this->tm->all_my_therapists($this->session->userdata('user_id'));
		$data['messages'] = $this->cm->get_all_messages($patient_id, $therapist_id);
		$this->cm->change_message_read_status($patient_id, $therapist_id);
		$data['notifications'] = $this->cm->get_patient_notify_messages($this->session->userdata('user_id'));
		$data['title'] = 'My Messages :: E-psychology';
		$data['view'] = 'patient/send_messages';
		$this->load->view('layout', $data);
	}
	
	public function get_patient_message(){
		$data['messages'] = $this->cm->get_unread_patient_messages($this->input->post('pid'), $this->input->post('tid'));
		$this->cm->change_message_read_status($this->input->post('pid'), $this->input->post('tid'));
		$this->load->view('patient/unread_patient_messages', $data);
	}
}


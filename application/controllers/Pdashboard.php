<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->has_userdata('is_user_login')) {
			redirect('auth/login');
		}
		$this->load->model('Common_model', 'cm');
	}

	public function index(){
		$data['notifications'] = $this->cm->get_patient_notify_messages($this->session->userdata('user_id'));
		$data['view'] = 'patient/dashboard';
		$this->load->view('layout', $data);
	}
}


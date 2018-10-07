<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		if($this->session->has_userdata('is_user_login'))
		{
			redirect('dashboard');
		}
		else{
			redirect('auth/login');
		}
}
}

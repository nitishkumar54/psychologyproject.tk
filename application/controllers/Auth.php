<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	protected $stipe_secret_key = 'sk_test_jET5ogjK1uyNv19OoPhTO2gq';
	protected $pay_as_you_go_plan_id = 'pay-as-you-go';
	protected $monthly_plan_id = 'montly_plan';
	protected $yearly_plan_id = 'yearly_plan';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model', 'auth_model');
		$this->load->model('Common_model', 'cm');
	}

	public function index(){
		if($this->session->has_userdata('is_user_login')) {
			if($result['user_type'] == 2) {
				redirect(base_url('tdashboard'), 'refresh');
			} else {
				redirect(base_url('pdashboard'), 'refresh');
			}
		} else {
			redirect('auth/login');
		}
	}

	public function login(){
		$data['title'] = 'Login :: E-psychology';
		if($this->input->post('submit')){
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'auth/login';
				$this->load->view('frontend-layout', $data);
				//$this->load->view('auth/login');
			}
			else {
				$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);
				$result = $this->auth_model->login($data);
				if ($result == TRUE) {
					$udata = array(
						'user_id' => $result['id'],
						'name' => $result['uname'],
						'surname' => $result['surname'],
						'user_type' => $result['user_type'],
						'is_user_login' => TRUE
					);
					$this->session->set_userdata($udata);
					if($result['user_type'] == 2) {
						redirect(base_url('tdashboard'), 'refresh');
					} else {
						redirect(base_url('pdashboard'), 'refresh');
					}
				}
				else{
					$data['msg'] = 'Invalid Email or Password!';
					$data['view'] = 'auth/login';
					$this->load->view('frontend-layout', $data);
					//$this->load->view('auth/login', $data);
				}
			}
		} else{
			//$this->load->view('auth/login', $data);
			$data['view'] = 'auth/login';
			$this->load->view('frontend-layout', $data);
		}
	}

	public function register(){		
		$data['title'] = 'Register :: E-psychology';
		$this->load->view('auth/register', $data);		
	}		
	
	public function psychologist_register(){
		require_once APPPATH."libraries/timezones/php/timezone.php";
		$data['specialities'] = $this->cm->specialities($data);
		$data['timezone_list'] = Timezone::get_timezone_list();
		$data['title'] = 'Psychologist Register :: E-psychology';
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('degree', 'Degree', 'trim|required');
			$this->form_validation->set_rules('cor', 'Country of residence', 'trim|required');
			$this->form_validation->set_rules('timezone', 'Timezone', 'trim|required');
			$this->form_validation->set_rules('specialities', 'speciality', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('auth/psychologist_register', $data);
			} else {
				$udata = array(
					'uname' => $this->input->post('name'),
					'surname' => $this->input->post('surname'),
					'email' => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'degree' => $this->input->post('degree'),
					'cor' => $this->input->post('cor'),
					'timezone' => $this->input->post('timezone'),
					'specialities' => $this->input->post('specialities'),
					'user_type' => 2,
					'created_at' => date('Y-m-d H:i:s')
				);
				$check = $this->auth_model->check_existing_user($udata['email'], $udata['user_type']);
				if ($check == FALSE) {
					$result = $this->auth_model->user_register($udata);
					if ($result == TRUE) {
						$data['successmsg'] = 'Register Successfully! <a href="'.base_url().'auth/login">Click Here</a> To Login';
						$this->load->view('auth/psychologist_register', $data);
					} else {
						$data['errormsg'] = 'Something went wrong. Please try again!';
						$this->load->view('auth/psychologist_register', $data);
					}
				} else {
					$data['errormsg'] = 'Email is already exist!';
					$this->load->view('auth/psychologist_register', $data);
				}
			}
		} else {
			$this->load->view('auth/psychologist_register', $data);	
		}				
	}
	
	public function patient_register(){
		require_once APPPATH."libraries/timezones/php/timezone.php";
		$data['timezone_list'] = Timezone::get_timezone_list();
		$data['title'] = 'Patient Register :: E-psychology';
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cor', 'Country of residence', 'trim|required');
			$this->form_validation->set_rules('timezone', 'Timezone', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('auth/patient_register', $data);
			} else {
				$udata = array(
					'uname' => $this->input->post('name'),
					'surname' => $this->input->post('surname'),
					'email' => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'cor' => $this->input->post('cor'),
					'timezone' => $this->input->post('timezone'),
					'user_type' => 3,
					'created_at' => date('Y-m-d H:i:s')
				);
				$check = $this->auth_model->check_existing_user($udata['email'], $udata['user_type']);
				if ($check == FALSE) {
					$result = $this->auth_model->user_register($udata);
					if ($result == TRUE) {
						$data['successmsg'] = 'Register Successfully! <a href="'.base_url().'auth/login">Click Here</a> To Login';
						$this->load->view('auth/patient_register', $data);
					} else {
						$data['errormsg'] = 'Something went wrong. Please try again!';
						$this->load->view('auth/patient_register', $data);
					}
				} else {
					$data['errormsg'] = 'Email is already exist!';
					$this->load->view('auth/patient_register', $data);
				}
			}
		} else {
			$this->load->view('auth/patient_register', $data);	
		}				
	}
	
	public function change_pwd(){
		$data['title'] = 'Change Password :: E-psychology';
		$id = $this->session->userdata('user_id');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'auth/change_pwd';
				$this->load->view('layout', $data);
			}
			else{
				$data = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$result = $this->auth_model->change_pwd($data, $id);
				if($result){
					$this->session->set_flashdata('successmsg', 'Password has been changed successfully!');
					redirect(base_url('auth/change_pwd'));
				}
			}
		} else{
			$data['view'] = 'auth/change_pwd';
			$this->load->view('layout', $data);
		}
	}
	
	public function secure_payment(){
		$data['user_id'] = $this->session->userdata('id');
		$data['title'] = 'Secure Payment :: E-psychology';
		if($this->input->post('action')){
			$resp = $this->stripe_integration($this->input->post(), $this->stipe_secret_key);
			if($resp['error'] == 0){
				$this->auth_model->save_stripe_response($resp);
				$this->auth_model->set_user_plan($resp);
				redirect(base_url('auth/thank_you'));
			} else {
				$data['msg'] = $resp['msg'];
			}
		}
		$data['view'] = 'auth/secure_payment';
		$this->load->view('layout', $data);	
	}
	
	public function stripe_integration($data, $stripe_secret_key){
		$user_data = $this->auth_model->get_user_info($this->session->userdata('user_id'));
		require_once APPPATH."libraries/Stripe/init.php";
		\Stripe\Stripe::setApiKey($stripe_secret_key);
		try {
			$response = $item = array();
			
			//create customer
			$customer = \Stripe\Customer::create(array(
			  "email" => $user_data->email,
			  "source" => $data['stripeToken']
			));
			$customer_resp = $customer->__toArray(true);
			//create subscription
			if($data['plan'] == 1){
				$plan_code = $this->pay_as_you_go_plan_id; // Pay-as-you-go plan
				$qty_amount = 30;
				$item = array(
					array(
					  "plan" => $plan_code,
					  "quantity" => $qty_amount
					)
				);
				$subscription = \Stripe\Subscription::create(array(
				  "customer" => $customer_resp['id'],
				  "items" => $item
				));
			} else if($data['plan'] == 2){
				$plan_code = $this->monthly_plan_id; // Monthly plan
				$qty_amount = 20;
				$item = array(
					array(
					  "plan" => $plan_code,
					  "quantity" => $qty_amount
					)
				);
				$subscription = \Stripe\Subscription::create(array(
				  "customer" => $customer_resp['id'],
				  "items" => $item
				));
			} else {
				$plan_code = $this->yearly_plan_id; // Yearly plan
				$qty_amount = 10;
				$item = array(
					array(
					  "plan" => $plan_code,
					  "quantity" => $qty_amount
					)
				);
				$subscription = \Stripe\Subscription::create(array(
				  "customer" => $customer_resp['id'],
				  "items" => $item
				));
			}
			
			$subscription_resp = $subscription->__toArray(true);
			
			$response['token'] = $data['stripeToken'];
			$response['user_id'] = $user_data->id;
			$response['plan'] = $data['plan'];
			$response['customer_id'] = $customer_resp['id'];
			$response['subscription_id'] = $subscription_resp['id'];
			$response['status'] = 1;
			$response['error'] = 0;
			return $response;
		} catch(\Stripe\Error\Card $e) {
			
			// Since it's a decline, \Stripe\Error\Card will be caught
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (\Stripe\Error\RateLimit $e) {
			
			// Too many requests made to the API too quickly
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (\Stripe\Error\InvalidRequest $e) {
			
			// Invalid parameters were supplied to Stripe's API
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (\Stripe\Error\Authentication $e) {
			
			// Authentication with Stripe's API failed
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (\Stripe\Error\ApiConnection $e) {
			
			// Network communication with Stripe failed
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (\Stripe\Error\Base $e) {
			
			// Display a very generic error to the user, and maybe send
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		} catch (Exception $e) {
			
			// Something else happened, completely unrelated to Stripe
			$status['error'] = 1;
			$status['msg'] = $e->getJsonBody()['error']['message'];
			return $status;
			
		}
	}
	
	public function thank_you(){
		$data['title'] = 'Payment Successfull :: E-psychology';
		$data['view'] = 'auth/thank_you';
		$this->load->view('layout', $data);	
	}
	
	public function timezone_detect(){
		require_once APPPATH."libraries/timezones/php/timezone.php";
		$offset = $this->input->post('offset');
		$dst = $this->input->post('dst');

		echo json_encode(Timezone::detect_timezone_id($offset, $dst));
	}
			
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth/login'), 'refresh');
	}
		
}  // end class

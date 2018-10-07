<?php
class Auth_model extends CI_Model{

	public function login($data){
		$tbl_users = $this->db->dbprefix('users');
		$query = $this->db->get_where($tbl_users , array('email' => $data['email']));
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
			$validPassword = password_verify($data['password'], $result['password']);
			if($validPassword){
				return $result = $query->row_array();
			}
			
		}
	}
	
	public function user_register($data){
		$tbl_users = $this->db->dbprefix('users');
		$result = $this->db->insert($tbl_users,$data);
		if($result) {
			return true;
		} else {
			return false;
		}
	}
	
	public function check_existing_user($email, $user_type){
		$tbl_users = $this->db->dbprefix('users');
		$result = $this->db->select('*')->from($tbl_users)->where(array('email' => $email, 'user_type' => $user_type))->get()->row();
		if(!empty($result)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_user_info($id){
		$tbl_users = $this->db->dbprefix('users');
		$result = $this->db->select('*')->from($tbl_users)->where('id', $id)->get()->row();
		return $result;
	}
	
	public function save_stripe_response($data){
		$sdata['user_id'] = $data['user_id'];
		$sdata['token'] = $data['token'];
		$sdata['customer_id'] = $data['customer_id'];
		$sdata['subscription_id'] = $data['subscription_id'];
		$tbl_stripe_response = $this->db->dbprefix('stripe_response');
		$this->db->insert($tbl_stripe_response, $sdata);
	}
	
	public function set_user_plan($data){
		$updata['user_id'] = $data['user_id'];
		$updata['plan_id'] = $data['plan'];
		$updata['status'] = $data['status'];
		$tbl_users_plans = $this->db->dbprefix('users_plans');
		$this->db->insert($tbl_users_plans, $updata);
	}

	public function change_pwd($data, $id){
		$tbl_users = $this->db->dbprefix('users');
		$this->db->where('id', $id);
		$this->db->update($tbl_users, $data);
		return true;
	}

}

?>
<?php
class Therapist_model extends CI_Model{

	public function all_therapists($id){
		$tbl_users = $this->db->dbprefix('users');
		$tbl_patient_therapists = $this->db->dbprefix('patient_therapists');
		$tbl_specialities = $this->db->dbprefix('specialities');
		$query = $this->db->query('SELECT '.$tbl_users.'.id, '.$tbl_users.'.uname, '.$tbl_users.'.surname, '.$tbl_specialities.'.name FROM '.$tbl_users.' Inner join '.$tbl_specialities.' on '.$tbl_specialities.'.id = '.$tbl_users.'.specialities where '.$tbl_users.'.`user_type` = '.$id.' and '.$tbl_users.'.`id` not in (SELECT `therapist_id` FROM '.$tbl_patient_therapists.' where '.$tbl_patient_therapists.'.`patient_id` = '.$id.')');
		$result = $query->result();
		return $result;
	}
	
	public function add_therapists($id, $data){
		$tbl_patient_therapists = $this->db->dbprefix('patient_therapists');
		foreach($data['therapist'] as $dh) {
			$tdata = array();
			$tdata['patient_id'] = $id;
			$tdata['therapist_id'] = $dh;
			$result = $this->db->insert($tbl_patient_therapists, $tdata);
		}
		if($result) {
			return true;
		} else {
			return false;
		}
	}
	
	public function all_my_therapists($id){
		$tbl_users = $this->db->dbprefix('users');
		$tbl_patient_therapists = $this->db->dbprefix('patient_therapists');
		$tbl_specialities = $this->db->dbprefix('specialities');
		
		$this->db->select($tbl_users.'.id as therapist_id, '.$tbl_patient_therapists.'.id as rid, '.$tbl_users.'.uname, '.$tbl_users.'.surname, '.$tbl_specialities.'.name');
		$this->db->from($tbl_users);
		$this->db->join($tbl_patient_therapists, $tbl_patient_therapists.'.therapist_id = '.$tbl_users.'.id');
		$this->db->join($tbl_specialities, $tbl_specialities.'.id = '.$tbl_users.'.specialities');
		$this->db->where($tbl_patient_therapists.'.patient_id', $id);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function remove_therapist($rid){
		$tbl_patient_therapists = $this->db->dbprefix('patient_therapists');
		$tdata = array();
		$tdata['id'] = $rid;
		$result = $this->db->delete($tbl_patient_therapists, $tdata);
		if($result) {
			return true;
		} else {
			return false;
		}
	}

}

?>
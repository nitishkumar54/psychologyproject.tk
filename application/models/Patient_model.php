<?php
class Patient_model extends CI_Model{
	
	public function all_my_patients($id){
		$tbl_users = $this->db->dbprefix('users');
		$tbl_patient_therapists = $this->db->dbprefix('patient_therapists');
		
		$this->db->select($tbl_users.'.id as patient_id, '.$tbl_patient_therapists.'.id as rid, '.$tbl_users.'.uname, '.$tbl_users.'.surname');
		$this->db->from($tbl_users);
		$this->db->join($tbl_patient_therapists, $tbl_patient_therapists.'.patient_id = '.$tbl_users.'.id');
		$this->db->where($tbl_patient_therapists.'.therapist_id', $id);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function remove_patient($rid){
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
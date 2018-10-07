<?php
class Common_model extends CI_Model{

	public function specialities(){
		$tbl_specialities = $this->db->dbprefix('specialities');
		$this->db->select('*');
		$this->db->from($tbl_specialities);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function check_user_plan($id){
		$tbl_users_plans = $this->db->dbprefix('users_plans');
		$this->db->select('*');
		$this->db->from($tbl_users_plans);
		$this->db->where('user_id', $id);
		$result = $this->db->get()->row();
		if(!empty($result)) {
			if($result->status == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function get_all_messages($pid, $tid){
		$tbl_messages = $this->db->dbprefix('messages');
		$this->db->select('*');
		$this->db->from($tbl_messages);
		$this->db->where(array('patient_id' => $pid, 'therapist_id' => $tid));
		$this->db->order_by("message_date", "asc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function save_message($data){
		$tbl_messages = $this->db->dbprefix('messages');
		$this->db->insert($tbl_messages, $data);
	}
	
	public function change_message_read_status($pid, $tid){
		$tbl_messages = $this->db->dbprefix('messages');
		$data = array(  
			'status' => 1 //Read
		);  
		$this->db->where(array('patient_id' => $pid, 'therapist_id' => $tid, 'sender_type' => 2));  
		$this->db->update($tbl_messages, $data); 
	}
	
	public function change_therapist_message_read_status($pid, $tid){
		$tbl_messages = $this->db->dbprefix('messages');
		$data = array(  
			'status' => 1 //Read
		);  
		$this->db->where(array('patient_id' => $pid, 'therapist_id' => $tid, 'sender_type' => 1));  
		$this->db->update($tbl_messages, $data); 
	}
	
	public function get_patient_notify_messages($pid){
		$tbl_users = $this->db->dbprefix('users');
		$tbl_messages = $this->db->dbprefix('messages');

		$query = $this->db->query('Select DISTINCT '.$tbl_users.'.id as tid, '.$tbl_users.'.uname, '.$tbl_users.'.surname, (select count(*) from '.$tbl_messages.' where therapist_id = tid and sender_type=2 and status = 0) as msgs from '.$tbl_users.' Inner join '.$tbl_messages.' on '.$tbl_messages.'.therapist_id = '.$tbl_users.'.id where '.$tbl_messages.'.patient_id = '.$pid.' and '.$tbl_messages.'.sender_type = 2 and '.$tbl_messages.'.status = 0');
		$result = $query->result();
		
		$fresult = $response = array();
		$total_msgs = 0;
		if(!empty($result)) {
			foreach($result as $row) {
				$row->pid = base64_encode($pid);
				$row->tid = base64_encode($row->tid);
				$total_msgs = $total_msgs + $row->msgs;
				$fresult[] = $row;
			}
			$response['notify'] = $fresult;
			$response['total_msgs'] = $total_msgs;
		}
		return $response;
	}
	
	public function get_therapist_notify_messages($tid){
		$tbl_users = $this->db->dbprefix('users');
		$tbl_messages = $this->db->dbprefix('messages');
		$query = $this->db->query('Select DISTINCT '.$tbl_users.'.id as pid, '.$tbl_users.'.uname, '.$tbl_users.'.surname, (select count(*) from '.$tbl_messages.' where patient_id = pid and sender_type=1 and status = 0) as msgs from '.$tbl_users.' Inner join '.$tbl_messages.' on '.$tbl_messages.'.patient_id = '.$tbl_users.'.id where '.$tbl_messages.'.therapist_id = '.$tid.' and '.$tbl_messages.'.sender_type = 1 and '.$tbl_messages.'.status = 0');
		$result = $query->result();
		$fresult = $response = array();
		$total_msgs = 0;
		if(!empty($result)) {
			foreach($result as $row) {
				$row->tid = base64_encode($tid);
				$row->pid = base64_encode($row->pid);
				$total_msgs = $total_msgs + $row->msgs;
				$fresult[] = $row;
			}
			$response['notify'] = $fresult;
			$response['total_msgs'] = $total_msgs;
		}
		return $response;
	}
	
	public function get_unread_patient_messages($pid, $tid){
		$tbl_messages = $this->db->dbprefix('messages');
		$this->db->select('*');
		$this->db->from($tbl_messages);
		$this->db->where(array('patient_id' => $pid, 'therapist_id' => $tid, 'sender_type' => 2, 'status' => 0));
		$this->db->order_by("message_date", "asc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function get_unread_therapist_messages($pid, $tid){
		$tbl_messages = $this->db->dbprefix('messages');
		$this->db->select('*');
		$this->db->from($tbl_messages);
		$this->db->where(array('patient_id' => $pid, 'therapist_id' => $tid, 'sender_type' => 1, 'status' => 0));
		$this->db->order_by("message_date", "asc");
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function makeLinks($str) {
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$urls = array();
		$urlsToReplace = array();
		if(preg_match_all($reg_exUrl, $str, $urls)) {
			$numOfMatches = count($urls[0]);
			$numOfUrlsToReplace = 0;
			for($i=0; $i<$numOfMatches; $i++) {
				$alreadyAdded = false;
				$numOfUrlsToReplace = count($urlsToReplace);
				for($j=0; $j<$numOfUrlsToReplace; $j++) {
					if($urlsToReplace[$j] == $urls[0][$i]) {
						$alreadyAdded = true;
					}
				}
				if(!$alreadyAdded) {
					array_push($urlsToReplace, $urls[0][$i]);
				}
			}
			$numOfUrlsToReplace = count($urlsToReplace);
			for($i=0; $i<$numOfUrlsToReplace; $i++) {
				$str = str_replace($urlsToReplace[$i], "<a target=\"_blank\" href=\"".$urlsToReplace[$i]."\">".$urlsToReplace[$i]."</a> ", $str);
			}
			return $str;
		} else {
			return $str;
		}
	}

}

?>
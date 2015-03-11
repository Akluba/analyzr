<?php
Class Home_model extends CI_Model {
	
	/*
	** CREATE survey
	***************************************** */
	public function new_survey_insert($data) {
		$this->db->insert('survey', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}// end new_survey_insert()
	
	
	/*
	** READ user data
	***************************************** */
	public function get_data($email) {
		$condition = "email =" . "'" . $email['email'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// return user data
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}// end get_data()
	
	
	/*
	** READ survey data
	***************************************** */
	public function get_survey_data($userId){
		$condition = "userId =" . "'" . $userId . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$query = $this->db->get();
		// return survey data
		return $query->result();
	}// end get_survey_data()
	
	
}// end Home_model Class
?>
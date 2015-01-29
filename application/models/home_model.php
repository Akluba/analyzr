<?php

Class Home_model extends CI_Model {

	// Read data using email
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
	
	// Read data using userId
	public function get_survey_data($userId){
		$condition = "userId =" . "'" . $userId . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$query = $this->db->get();
		// return survey data
		return $query->result();
	}// end get_survey_data()
	
	// Insert new survey data
	// Return inserted information
	public function new_survey_insert($data) {
		$this->db->trans_start();
		$this->db->insert('survey', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		//return surveyId when data is inserted
		return  $insert_id;
	}// end new_survey_insert()
	
}// end Home_model Class
?>
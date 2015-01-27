<?php

Class Survey_Info extends CI_Model {

	// Read data using username and password
	public function get_data($email) {
		
		$condition = "email =" . "'" . $email['email'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
		return $query->result();
		} else {
		return false;
		}
	}
	
	public function get_survey_data($userId){
		$condition = "userId =" . "'" . $userId . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$query = $this->db->get();
		
		return $query->result();

	}
	
}
?>
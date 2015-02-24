<?php

Class Auth_model extends CI_Model {

	// Read data using username and password
	public function login($log_data) {
		$condition = "email =" . "'" . $log_data['email'] . "' AND " . "password =" . "'" . $log_data['password'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// Read data to insure member does not exist
	// Insert new data
	public function registration_insert($reg_data) {
		// Query to check whether username already exist or not
		$condition = "email =" . "'" . $reg_data['email'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 0) {
			// Query to insert data in database
			$this->db->insert('user', $reg_data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		}else{
			return false;
		}
	}// end registration_insert()
	
}// end Login_Database Class
?>
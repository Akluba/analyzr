<?php
Class Auth_model extends CI_Model {

	/*
	** LOGIN
	***************************************** */
	public function login($log_data) {
		// email and password match user's inputs
		$condition = "email =" . "'" . $log_data['email'] . "' AND " . "password =" . "'" . $log_data['password'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// if found in DB 
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}// end of login()
	
	
	/*
	** REGISTER
	***************************************** */
	public function registration_insert($reg_data) {
		// query to check whether email already exist or not
		$condition = "email =" . "'" . $reg_data['email'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// email does not exist
		if ($query->num_rows() == 0) {
			// insert data in database
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
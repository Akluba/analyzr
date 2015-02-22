<?php
Class Send_model extends CI_Model {
	
	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	public function insert_send_data($send_data){
		$this->db->insert('sent', $send_data);
	}// end of insert_send_data()
	
	
	/* ##################################################################
	########### READ ####################################################
	*/ ##################################################################
	public function get_survey_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}// end of get_survey_data()
	
	public function get_sent_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}// end of get_sent_data()
	
	
}// end of Send_model Class
?>
<?php

Class Settings_model extends CI_Model {

	// Read data for selected survey
	public function get_survey_settings($Id){
		$condition = "surveyId =" . "'" . $Id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}// end get_survey_settings()
	
	public function update_title($survey_id,$updated_title){
		$this->db->where('surveyId', $survey_id);
		$this->db->update('survey', array('title' => $updated_title));
	}
	
	public function update_status($survey_id,$updated_status){
		$this->db->where('surveyId', $survey_id);
		$this->db->update('survey', array('status' => $updated_status));
	}
	
}// end Settings_model Class
?>
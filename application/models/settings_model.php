<?php

Class Settings_model extends CI_Model {

	// Read data for selected survey
	public function get_survey_settings($Id){
		$condition = "surveyId =" . "'" . $Id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}// end get_survey_settings()
	
}// end Settings_model Class
?>
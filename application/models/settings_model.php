<?php

Class Settings_model extends CI_Model {

	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	
	
	/* ##################################################################
	########### READ ####################################################
	*/ ##################################################################
	
	// Read data for selected survey
	public function get_survey_settings($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}// end get_survey_settings()
	
	/* ##################################################################
	########### UPDATE ##################################################
	*/ ##################################################################
	
	// Update Title 
	public function update_title($survey_id,$updated_title){
		$this->db->where('surveyId', $survey_id);
		$this->db->update('survey', array('title' => $updated_title));
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}// end update_title()
	
	// Update Status
	public function update_status($survey_id,$updated_status){
		$this->db->where('surveyId', $survey_id);
		$this->db->update('survey', array('status' => $updated_status));
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}// end update_status()
	
	/* ##################################################################
	########### DELETE ##################################################
	*/ ##################################################################
	
	// Remove Survey
	public function remove_survey($survey_id){

		$sql = "DELETE t1, t2, t3, t4, t5
		FROM survey t1
		LEFT JOIN question t2 ON t2.surveyId = t1.surveyId
		LEFT JOIN answer t3 ON t3.questionId = t2.questionId
		LEFT JOIN sent t4 ON t4.surveyId = t1.surveyId 
		LEFT JOIN response t5 ON  t5.recipientId = t4.recipientId
		WHERE t1.surveyId = " . $survey_id;
		
		$this->db->query($sql);
		
	}// end remove_survey()
	
	
}// end Settings_model Class
?>
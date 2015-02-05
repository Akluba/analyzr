<?php
Class Builder_model extends CI_Model {

	public function get_survey_data($survey_id){
		$condition = "survey.surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$this->db->join('question', 'question.surveyId = survey.surveyId');
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}
	
}// end Builder_model Class
?>
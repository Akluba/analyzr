<?php
Class Builder_model extends CI_Model {

	public function get_survey_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$query = $this->db->get();
		// return survey settings
		return $query->result();
	}
	
	public function get_question_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_answer_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function insert_question($question_data){
		$this->db->trans_start();
		$this->db->insert('question', $question_data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		//return surveyId when data is inserted
		return  $insert_id;
	}
	
	public function insert_answer($answer_data){
		$this->db->insert_batch('answer', $answer_data); 
	}
	
}// end Builder_model Class
?>
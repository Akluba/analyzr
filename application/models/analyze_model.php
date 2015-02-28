<?php
Class Analyze_model extends CI_Model {
	
	
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
	}// end get_survey_data()
	
	public function get_question_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}// end get_question_data()
	
	public function get_answer_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}// end get_answer_data()
	
	public function get_response_data($survey_id){
		$this->db->select('question.questionId,response.answerId, response.responseText');
		$this->db->from('survey');
		$this->db->join('question', 'question.surveyId = survey.surveyId');
		$this->db->join('answer', 'answer.questionId = question.questionId');
		$this->db->join('response', 'response.answerId = answer.answerId');
		$this->db->where('survey.surveyId',$survey_id);
		
		$query = $this->db->get();
		return $query->result();
	}// end get_response_data()
	
	
	public function get_individual_data($survey_id){
		$this->db->select('sent.recipientId, sent.email, sent.respondDate');
		$this->db->from('survey');
		$this->db->join('sent', 'sent.surveyId = survey.surveyId');
		$this->db->where('survey.surveyId',$survey_id);
		$this->db->where('sent.respondDate IS NOT NULL');
		
		$query = $this->db->get();
		return $query->result();
	}// end get_response_data()
	
	
	
	public function get_recipient_data($recipient_id){
		$this->db->select('response.answerId, response.responseText, answer.surveyId, answer.answerText, question.questionId');
		$this->db->from('response');
		$this->db->join('answer', 'answer.answerId = response.answerId');
		$this->db->join('question', 'question.questionId = answer.questionId');
		$this->db->where('response.recipientId',$recipient_id);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	
}
?>
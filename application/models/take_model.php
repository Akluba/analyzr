<?php
Class Take_model extends CI_Model {

	public function get_recipient_data($recipient_id){
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where('recipientId', $recipient_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_survey_data($survey_id){
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where('surveyId', $survey_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_question_data($survey_id){
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where('surveyId', $survey_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_answer_data($survey_id){
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('surveyId', $survey_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function get_required($survey_id){
		$this->db->select('questionId');
		$this->db->from('question');
		$this->db->where('surveyId', $survey_id);
		$this->db->where('questionRequire', 1);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function insert_response_data($response_data){
		$this->db->insert_batch('response', $response_data);
	}
	
	public function insert_respond_data($respond_data){
		$this->db->where('recipientId', $respond_data['recipientId']);
		$this->db->update('sent', array('respondDate' => $respond_data['respondDate']));
	}
	
}// end Take_model Class
?>
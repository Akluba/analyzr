<?php
Class Send_model extends CI_Model {
	
	/*
	** CREATE sent survey
	***************************************** */
	public function insert_send_data($send_data){
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where('surveyId',$send_data['surveyId']);
		$this->db->where('email',$send_data['email']);
		$this->db->limit(1);
		$query = $this->db->get();
		// if not
		if ($query->num_rows() == 0) {
			$this->db->trans_start();
			// insert send_data into db
			$this->db->insert('sent', $send_data);
			// get id to newly added object in db
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			// return that id to be sent in link
			return  $insert_id;
		}else{
			return false;
		}
	}// end of insert_send_data()
	
	
	/*
	** READ survey data
	***************************************** */
	public function get_survey_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('survey');
		$this->db->where($condition);
		$this->db->join('user', 'user.userId = survey.userId');
		$query = $this->db->get();
		// return survey data
		return $query->result();
	}// end of get_survey_data()
	
	
	/*
	** READ sent data
	***************************************** */
	public function get_sent_data($survey_id){
		$condition = "surveyId =" . "'" . $survey_id . "'";
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where($condition);
		$query = $this->db->get();
		// return sent data
		return $query->result();
	}// end of get_sent_data()
	
	
	/*
	** DELETE sent
	***************************************** */
	public function remove_sent($recipient_id){
		// in the case message is not sent out due to Mandrill error
		$this->db->where('recipientId', $recipient_id);
		$this->db->delete('sent');
	}// end of remove_sent()
	
		
}// end of Send_model Class
?>
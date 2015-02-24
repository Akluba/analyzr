<?php
Class Send_model extends CI_Model {
	
	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	public function insert_send_data($send_data){
		$condition = "email =" . "'" . $send_data['email'] . "'";
		$this->db->select('*');
		$this->db->from('sent');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 0) {
			$this->db->trans_start();
			$this->db->insert('sent', $send_data);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return  $insert_id;
		}else{
			return false;
		}
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
	
	
	/* ##################################################################
	########### DELETE ##################################################
	*/ ##################################################################
	public function remove_sent($recipient_id){
		$this->db->where('recipientId', $recipient_id);
		$this->db->delete('sent');
	}
	
	
	
	
	
	
}// end of Send_model Class
?>
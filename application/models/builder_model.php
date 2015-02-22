<?php
Class Builder_model extends CI_Model {
	
	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	
	public function insert_question($question_data){
		$this->db->trans_start();
		$this->db->insert('question', $question_data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		//return surveyId when data is inserted
		return  $insert_id;
	}// end insert_question()
	
	public function insert_answer($answer_data){
		$this->db->insert_batch('answer', $answer_data); 
	}// end insert_answer()
	
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
	
	/* ##################################################################
	########### UPDATE ##################################################
	*/ ##################################################################
	
	public function edit_question_data($question_id){
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where('questionId', $question_id);
		$query = $this->db->get();
		return $query->result();
	}// end edit_question_data()
	
	public function edit_answer_data($question_id){
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('questionId', $question_id);
		$query = $this->db->get();
		return $query->result();
	}// end edit_answer_data()
	
	public function update_question($question_data){
		$this->db->where('questionId', $question_data['questionId']);
		$this->db->update('question', $question_data);
	}// end update_question()
	
	public function update_answer($answer_data,$question_id){
		
		// get count of existing choices
		$this->db->where('questionId',$question_id);
		$existing = $this->db->get('answer');
		$num_existing = $existing->num_rows();
		
		// get count of new
		$num_new = count($answer_data);
		
		if($num_new === 1){
			var_dump($answer_data);
		}
		// new choice amount = existing choice amount
		else if($num_new === $num_existing){
			
			$new_data = array();
			$i = 0;
			
			// append answerId to new choice array 
			foreach($answer_data as $choice){
				// answerId from existing choice
				$id = $existing->result()[$i]->answerId;
				// setting array value to answerId key
				$choice['answerId'] = $id;
				// adding choice to new_data array
				$new_data[] = $choice;
				// increase i to find next answerId
				$i++;
			}
			
			// update_batch 
			$this->db->update_batch('answer', $new_data, 'answerId');
		}// end equal choice amount if/else
		
		
		
		 
	}// end update_answer()
	
	/* ##################################################################
	########### DELETE ##################################################
	*/ ##################################################################
	
	public function remove_question($question_id){
		$tables = array('question','answer');
		$this->db->where('questionId', $question_id);
		$this->db->delete($tables);
	}// end remove_question()
	
		
}// end Builder_model Class
?>
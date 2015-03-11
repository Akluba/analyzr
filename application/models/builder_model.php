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
			$new_data = array();
			for($i=1;$i<$num_existing;$i++){
				$new_data[] = $existing->result()[$i]->answerId;
			}
			$this->db->where_in('answerId', $new_data);
			$this->db->delete('answer');
			
			$answer_data[0]['answerId'] = $existing->result()[0]->answerId;
			$this->db->update('answer', $answer_data[0]);
		}
		
		
		
		// even and new
		else if($num_new >= $num_existing){
			
			$new_data = array();
			
			// append answerId to new choice array 
			foreach($existing->result() as $i=>$existing_data){
				// answerId from existing choice
				$id = $existing_data->answerId;
				$choice = $answer_data[$i];
				// setting array value to answerId key
				$choice['answerId'] = $id;
				// adding choice to new_data array
				$new_data[] = $choice;
			}
			// update_batch 
			$this->db->update_batch('answer', $new_data, 'answerId');
			
			// new greater existing
			if($num_new > $num_existing){
				$new_data = array();
				for($i=$i+1; $i<$num_new;$i++){
					$new_data[] = $answer_data[$i];
				}
				$this->db->insert_batch('answer', $new_data); 
			}
		}else{
			$new_data = array();
			foreach($answer_data as $i=>$choice){
				$id = $existing->result()[$i]->answerId;
				$choice['answerId'] = $id;
				$new_data[] = $choice;
			}
			// update_batch 
			$this->db->update_batch('answer', $new_data, 'answerId');
			
			$new_data = array();
			for($i=$i+1;$i<$num_existing;$i++){
				$new_data[] = $existing->result()[$i]->answerId;
			}
			$this->db->where_in('answerId', $new_data);
			$this->db->delete('answer');
			
		}// end equal choice amount if/else
		
		
		
		 
	}// end update_answer()
	
	/* ##################################################################
	########### DELETE ##################################################
	*/ ##################################################################
	
	public function remove_question($question_id){

		$sql = "DELETE t1, t2, t3
		FROM question t1
		LEFT JOIN answer t2 ON t2.questionId = t1.questionId
		LEFT JOIN response t3 ON t3.answerId = t2.answerId
		WHERE t1.questionId = " . $question_id;
		
		$this->db->query($sql);
		
	}// end remove_question()
	
		
}// end Builder_model Class
?>
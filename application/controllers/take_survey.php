<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Take_Survey extends CI_Controller {
	
public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');
		
		// Load form validation library
		$this->load->library('form_validation');
		
		// Load session library
		$this->load->library('session');
		
		// Load database
		$this->load->model('take_model');
		
		// Load password security
		$this->load->helper('security');
} // end of __construct()
	
	/* ##################################################################
	########### READ ####################################################
	*/ ##################################################################
	public function render_survey($recipient_id){
		
		$recipient_data = $this->take_model->get_recipient_data($recipient_id);
		$survey_id = $recipient_data[0]->surveyId;
		
		$survey_data = $this->take_model->get_survey_data($survey_id);
		$question_data = $this->take_model->get_question_data($survey_id);
		$answer_data = $this->take_model->get_answer_data($survey_id);
		
		$body_data = array(
			'recipient' => $recipient_data,
			'questions' => $question_data,
			'answers' => $answer_data
		);
		
		$page_data = array(
			'pageTitle' => 'Take Survey',
			'headerContent' => $this->load->view('survey/survey_head'),
			'surveyTitle' => $this->load->view('survey/survey_title',array('survey' => $survey_data), TRUE),
			'surveyBody' => $this->load->view('survey/survey_body',$body_data, TRUE),
		);
		
		$this->load->view('templates/survey', $page_data);
	}
	
	public function get_response(){
		$recipient_id = $this->input->post('recipient_id');
		$survey_id = $this->input->post('survey_id');
		
		//get required data
		$required_data = $this->take_model->get_required($survey_id);
		foreach($required_data as $question){
			$questionId = $question->questionId;
			$this->form_validation->set_rules($questionId, 'Question', 'required|xss_clean');
		}
		
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			echo "required"; 
		}else{
			unset($_POST['survey_id'],$_POST['recipient_id']);
			$response_data = array();
			foreach($_POST as $key=>$value){
				if(isset($_POST[$key.'hidden'])){
					$response_data[] = array(
						'recipientId' => $recipient_id,
						'answerId' => $_POST[$key.'hidden'],
						'answerText' => $value
					);	
				}else if(strpos($key, 'hidden')){
					continue;
				}else{
					$response_data[] = array(
						'recipientId' => $recipient_id,
						'answerId' => $value,
						'answerText' => Null
					);	
				}
			}
			$response_result = $this->take_model->insert_response_data($response_data);
			
			
		}// end of form_validation if/else
	}// end of get_response()
	
	
}// end Take_Survey Class
/* End of file take_survey.php */
/* Location: ./application/controllers/take_survey.php */
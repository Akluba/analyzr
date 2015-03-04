<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Take_Survey extends CI_Controller {
	
public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');
		$this->load->helper('date');
		
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
			'surveyTitle' => $survey_data[0]->title,
			'recipient' => $recipient_data,
			'questions' => $question_data,
			'answers' => $answer_data
		);
		
		$page_data = array(
			'pageTitle' => 'Take Survey',
			'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
			'analyzrContent' => $this->load->view('survey/survey_body',$body_data, TRUE),
		);
		
		$this->load->view('templates/survey', $page_data);
	}
	
	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	public function get_response(){
		// get survey id
		$survey_id = $this->input->post('survey_id');
		//determine which questions are required 
		$required_data = $this->take_model->get_required($survey_id);
		// set form_validation rules for required question
		foreach($required_data as $question){
			$questionId = $question->questionId;
			$this->form_validation->set_rules($questionId, 'Question', 'required|xss_clean');
		}
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			echo "required"; 
		}else{
			// get recipient id
			$recipient_id = $this->input->post('recipient_id');
			// remove unneeded POST items from array
			unset($_POST['survey_id'],$_POST['recipient_id']);
			// array to contain response data
			$response_data = array();
			// loop through POST 
			foreach($_POST as $key=>$value){
				// question id w/ 'hidden' represents text value is present
				if(isset($_POST[$key.'hidden'])){
					$response_data[] = array(
						'recipientId' => $recipient_id,
						'answerId' => $_POST[$key.'hidden'],
						'responseText' => $value
					);	
				}else if(strpos($key, 'hidden')){
					// don't insert hidden input values into response_data[]
					continue;
				}else{
					// insert response data containing only answer id
					$response_data[] = array(
						'recipientId' => $recipient_id,
						'answerId' => $value,
						'responseText' => Null
					);	
				}
			}// end foreach Post data
			// insert response data into database
			$response_insert = $this->take_model->insert_response_data($response_data);
			// insert response date
			$datestring = "%Y%m%d";
			$respond_date = mdate($datestring);
			$respond_data = array(
				'recipientId' => $recipient_id,
				'respondDate' => $respond_date
			);
			$respond_insert = $this->take_model->insert_respond_data($respond_data);
			
		}// end of form_validation if/else
	}// end of get_response()
	
	
}// end Take_Survey Class
/* End of file take_survey.php */
/* Location: ./application/controllers/take_survey.php */
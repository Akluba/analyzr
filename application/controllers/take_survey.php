<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Take_Survey extends CI_Controller {
	// constructor function w/ all dependencies 
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
	
	
	/* 
	** CREATE survey response
	************************************* */
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
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'required' => 'All questions marked <strong>*answer required</strong> must be answered before submitting the survey.'
			);
			// echo array so it's accessable
			echo json_encode($response); 
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
				}else if(is_array($_POST[$key])){
					foreach($_POST[$key] as $check_value){
						$response_data[] = array(
							'recipientId' => $recipient_id,
							'answerId' => $check_value,
							'responseText' => Null	
						);
					}
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
			
			// ajax response returning validation errors
			$response = array(
				'error' => FALSE,
			);
			// echo array so it's accessable
			echo json_encode($response); 
			
		}// end of form_validation if/else
	}// end of get_response()
	
	
	/* 
	** READ survey
	************************************* */
	public function render_survey($recipient_id){
		
		$recipient_data = $this->take_model->get_recipient_data($recipient_id);
		
		// survey exists
		if($recipient_data != null){
			$survey_id = $recipient_data[0]->surveyId;
			$survey_data = $this->take_model->get_survey_data($survey_id);
			$question_data = $this->take_model->get_question_data($survey_id);
			$answer_data = $this->take_model->get_answer_data($survey_id);
			
			$restrict_response = $recipient_data[0]->respondDate;
			$restrict_status = (int)$survey_data[0]->status;
			
			// recipient has already submitted the survey
			if($restrict_response != null){
				$message = 'It appears you have already participated in this survey';
				
				$page_data = array(
					'pageTitle' => 'Survey Restricted',
					'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
					'analyzrContent' => $this->load->view('survey/survey_message',array('message' =>$message), TRUE),
				);
				
				$this->load->view('templates/survey', $page_data);
			}
			// recipient has visited a closed survey
			else if($restrict_status === 0){
				$message = 'It appears this survey has been closed by the user. This means they are no longer accepting responses.';
				
				$page_data = array(
					'pageTitle' => 'Survey Restricted',
					'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
					'analyzrContent' => $this->load->view('survey/survey_message',array('message' =>$message), TRUE),
				);
				
				$this->load->view('templates/survey', $page_data);
			}
			// recipient can continue to survey
			else{
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
			}// end of if/else restrict
		// survey no longer exist
		}else{
			$message = 'It appears this survey no longer exist.';
				
				$page_data = array(
					'pageTitle' => 'Survey Error',
					'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
					'analyzrContent' => $this->load->view('survey/survey_message',array('message' =>$message), TRUE),
				);
				
				$this->load->view('templates/survey', $page_data);
		}// end of if/else existing survey
	}// end of render_survey()
	
	
	/* 
	** READ completed survey message
	************************************* */
	public function thank_you(){
		$message = 'Thank you for participating in this survey!';
			
		$page_data = array(
			'pageTitle' => 'Survey Completed',
			'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
			'analyzrContent' => $this->load->view('survey/survey_message',array('message' =>$message), TRUE),
		);
		
		$this->load->view('templates/survey', $page_data);
	}
		
}// end Take_Survey Class
/* End of file take_survey.php */
/* Location: ./application/controllers/take_survey.php */
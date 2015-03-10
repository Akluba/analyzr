<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Builder extends Auth_Controller {
	// constructor function w/ all dependencies 	
	public function __construct() {
		parent::__construct();
			// Load form helper library
			$this->load->helper('form');
			$this->load->helper('url');
			
			// Load form validation library
			$this->load->library('form_validation');
			
			// Load session library
			$this->load->library('session');
			
			// Load database
			$this->load->model('builder_model');
	} // end of __construct()
	
	
	/* 
	** CREATE question
	************************************* */
	public function create_question(){
		// determine selected type of question by user
		$question_type = $this->input->post('question_type');
		// set rules for form validation based on question type
		if($question_type == 4 || $question_type == 5){
			$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
			$this->form_validation->set_rules('question_text', 'Question Text', 'required|xss_clean');
		}else{
			$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
			$this->form_validation->set_rules('question_text', 'Question Text', 'required|xss_clean');
			$this->form_validation->set_rules('choices[]', 'Question Choices', 'required|xss_clean');
		}
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'text' => form_error('question_text'),
				'choice' => form_error('choices[]')
			);
			// echo array so it's accessable
			echo json_encode($response);	 
		}else{
			// get question data from user inputs
			$question_data = array(
				'surveyId' => $this->input->post("survey_id"),
				'questionType' => $this->input->post("question_type"),
				'questionText' => $this->input->post("question_text"),
				'questionRequire' => $this->input->post('question_require')
			);
			// pass data to model to insert question to database
			$question_result = $this->builder_model->insert_question($question_data);
			// get answer data from user inputs
			$question_id = $question_result;
			$choices = $this->input->post('choices');
			$answer_data = array();
			// if text based answer -- limit answer to ONE null 
			if($question_type == 4 || $question_type == 5){
				$answer_data[] = array(
					'surveyId' => $this->input->post("survey_id"),
					'questionId' => $question_id,
					'answerText' => NULL
				);
			}else{
				// loop through choices array and create answer for each
				foreach($choices as $choice){
					$answer_data[] = array(
						'surveyId' => $this->input->post("survey_id"),
						'questionId' => $question_id,
						'answerText' => $choice
					);
				};// end foreach
			}// end if/else
			// pass data to model to insert answers to database
			$answer_result = $this->builder_model->insert_answer($answer_data);
			// return a successful response via ajax
			$response = array(
				'error' => FALSE
			);
			// echo array so it's accessable
			echo json_encode($response);	
		}// end of form_validation if/else
	}// end of add_question()
	

	/* 
	** READ questions
	************************************* */
	public function builder($survey_id){
		// passing survey_id to models to get data
		$survey_result = $this->builder_model->get_survey_data($survey_id);
		$question_data = $this->builder_model->get_question_data($survey_id);
		$answer_data = $this->builder_model->get_answer_data($survey_id);
		// data available to template
		$data = array(
			'userName' => $survey_result[0]->username,
			'survey_id' => $survey_result[0]->surveyId,
			'title' => $survey_result[0]->title,
		);
		// views to be loaded to builder section
		$page_data = array(
			'pageTitle' => 'Builder',
			'headerContent' => $this->load->view('headers/survey_header',$data, TRUE),
			'navContent' => $this->load->view('nav/side_nav',$data, TRUE),
			'mainContent' => $this->load->view('main_content/builder',array('questions'=>$question_data, 'answers'=>$answer_data), TRUE),
			'sideContent' => $this->load->view('side_content/builder_side',$data, TRUE)	
		);
		// loading view
		$this->load->view('templates/default', $page_data);
	}// end of builder()

	
	/* 
	** UPDATE question
	************************************* */
	public function edit_question($question_id){
		// question + answer data from database
		$question_data = $this->builder_model->edit_question_data($question_id);
		$answer_data = $this->builder_model->edit_answer_data($question_id);
		// 
		$data = array(
			'survey_id' => $question_data[0]->surveyId,
			'question_id' => $question_data[0]->questionId,
			'question_type' => $question_data[0]->questionType,
			'question_text' => $question_data[0]->questionText,
			'choices' => $answer_data,
			'question_require' => $question_data[0]->questionRequire
		);
		// load view of question edit state
		$this->load->view('side_content/builder_edit', $data);	
	}// end of edit_question()
	
	public function update_question(){
		// determine selected type of question by user
		$question_type = $this->input->post('question_type');
		// set rules for form validation based on question type
		if($question_type == 4 || $question_type == 5){
			$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
			$this->form_validation->set_rules('question_text', 'Question Text', 'required|xss_clean');
		}else{
			$this->form_validation->set_rules('question_type', 'Question Type', 'required|xss_clean');
			$this->form_validation->set_rules('question_text', 'Question Text', 'required|xss_clean');
			$this->form_validation->set_rules('choices[]', 'Question Choices', 'required|xss_clean');
		}
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'text' => form_error('question_text'),
				'choice' => form_error('choices[]')
			);
			// echo array so it's accessable
			echo json_encode($response);	 
		}else{
			// get question data from user inputs
			$question_data = array(
				'questionId' => $this->input->post("question_id"),
				'questionType' => $this->input->post("question_type"),
				'questionText' => $this->input->post("question_text"),
				'questionRequire' => $this->input->post('question_require')
			);
			// pass data to model to update question in database
			$question_result = $this->builder_model->update_question($question_data);
			
			$question_id = $this->input->post("question_id");
			$choices = $this->input->post('choices');
			$answer_data = array();
			// if text based answer -- limit answer to ONE null 
			if($question_type == 4 || $question_type == 5){
				$answer_data[] = array(
					'surveyId' => $this->input->post("survey_id"),
					'questionId' => $this->input->post("question_id"),
					'answerText' => NULL
				);
			}else{
				// loop through choices array and create answer for each
				foreach($choices as $choice){
					$answer_data[] = array(
						'surveyId' => $this->input->post("survey_id"),
						'questionId' => $this->input->post("question_id"),
						'answerText' => $choice
					);
				};// end foreach
			}// end question_type if/else
			
			// pass data to model to update answers in database
			$answer_result = $this->builder_model->update_answer($answer_data, $question_id);
			
			// return a successful response via ajax
			$response = array(
				'error' => FALSE
			);
			// echo array so it's accessable
			echo json_encode($response);
			
		}// end of form_validation if/else
	}// end of update_question()
	
	
	/* 
	** DELETE question
	************************************* */
	public function remove_question(){
		$question_id = $this->input->post("question_id");
		$question_result = $this->builder_model->remove_question($question_id);
		echo "true";
	}// end of remove_question()
	
	
	
}// end of Survey_Builder Class
/* End of file survey_builder.php */
/* Location: ./application/controllers/survey_builder.php */
<?php 

session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends Auth_Controller {
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
			$this->load->model('settings_model');
			$this->load->model('builder_model');
	} // end of __construct()

	/* #########################################################################
	################ functionality of survey settings ##########################
	######################################################################### */
	// displaying content to settings section
	public function settings($survey_id){
		// gathering survey information from survey_id	
		$survey_result = $this->settings_model->get_survey_settings($survey_id);
		// data available to template
		$data = array(
			'userName' => $survey_result[0]->username,
			'survey_id' => $survey_result[0]->surveyId,
			'title' => $survey_result[0]->title,
			'created' => $survey_result[0]->createdDate,
			'status' => $survey_result[0]->status
		);
		// views to be loaded to settings section
		$page_data = array(
			'pageTitle' => 'Settings',
			'headerContent' => $this->load->view('headers/survey_header',$data, TRUE),
			'mainContent' => $this->load->view('main_content/settings',$data, TRUE),
			'navContent' => $this->load->view('nav/side_nav',$data, TRUE),
			'sideContent' => $this->load->view('side_content/settings_side',$data, TRUE)
			
		);
		// loading view
		$this->load->view('templates/default', $page_data);
	}// end of settings()
	
	// updating the survey TITLE
	public function update_title($survey_id){
		// get updated title from user input
		$updated_title = $this->input->post('updated_title');
		// pass input and survey_id to model for updating 
		$survey_result = $this->settings_model->update_title($survey_id,$updated_title);
		// reload settings view with new updated title
		redirect('survey/settings/'.$survey_id,'refresh');
	}// end of update_title()
	
	// updating the survey STATUS
	public function update_status($survey_id){
		// get updated status from user selection
		$updated_status = $this->input->post('status_update');
		// pass selection and survey_id to model for updating
		$survey_result = $this->settings_model->update_status($survey_id,$updated_status);
		// reload settings view with new updated status
		redirect('survey/settings/'.$survey_id,'refresh');
	}// end of update_status()
	
	// removing the survey
	public function remove_survey($survey_id){
		// pass survey_id to model to remove survey from database
		$survey_result = $this->settings_model->remove_survey($survey_id);
		// direct back to survey home w/ survey removed
		redirect('home','refresh');
	}// end of remove_survey()
	
	/* #########################################################################
	################ functionality of survey builder ###########################
	######################################################################### */
	
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
	
	
	public function add_question($survey_id){
		// get question data from user inputs
		$question_data = array(
			'surveyId' => $survey_id,
			'questionType' => $this->input->post('question_type'),
			'questionText' => $this->input->post('question_text'),
			'questionRequire' => $this->input->post('question_require')
		);
		// pass data to model to insert question to database
		$question_result = $this->builder_model->insert_question($question_data);
		
		// get answer data from user inputs
		$question_id = $question_result;
		$answer_data = array(
			array(
				'surveyId' => $survey_id,
				'questionId' => $question_id,
				'answerText' => $this->input->post('choice_1')
			),
			array(
				'surveyId' => $survey_id,
				'questionId' => $question_id,
				'answerText' => $this->input->post('choice_2')
			)
		);
		// pass data to model to insert answers to database
		$answer_result = $this->builder_model->insert_answer($answer_data);
		
		// reload builder view w/ new question and answers
		redirect('survey/builder/'.$survey_id,'refresh');
	}
	
	
}// end of Survey Class

/* End of file survey.php */
/* Location: ./application/controllers/survey.php */
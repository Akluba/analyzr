<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Analyze extends Auth_Controller {
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
			$this->load->model('analyze_model');
	} // end of __construct()
	
	
	/* ##################################################################
	########### READ ####################################################
	*/ ##################################################################
	public function analyze($survey_id){
		// passing survey_id to models to get data
		
		$survey_data = $this->analyze_model->get_survey_data($survey_id);
		$question_data = $this->analyze_model->get_question_data($survey_id);
		$answer_data = $this->analyze_model->get_answer_data($survey_id);
		
		$response_data = $this->analyze_model->get_response_data($survey_id);
		$individual_data = $this->analyze_model->get_individual_data($survey_id);
		
		// data available to template
		$survey_data = array(
			'userName' => $survey_data[0]->username,
			'survey_id' => $survey_data[0]->surveyId,
			'title' => $survey_data[0]->title,
		);
		
		$content_data = array(
			'questions'=>$question_data,
			'answers'=>$answer_data,
			'responses' => $response_data,
			'recipients' => $individual_data
		);
		
		$page_data = array(
			'pageTitle' => 'Analyze',
			'headerContent' => $this->load->view('headers/survey_header',$survey_data, TRUE),
			'navContent' => $this->load->view('nav/side_nav',$survey_data, TRUE),
			'mainContent' => $this->load->view('main_content/analyze',$content_data, TRUE),
			'sideContent' => $this->load->view('side_content/analyze_side',$content_data, TRUE)	
		);
		// loading view
		$this->load->view('templates/default', $page_data);
	}
	
	
	public function individual($recipient_id){
		
		$recipient_data = $this->analyze_model->get_recipient_data($recipient_id);
		$survey_id = $recipient_data[0]->surveyId;
		
		$survey_data = $this->analyze_model->get_survey_data($survey_id);
		$question_data = $this->analyze_model->get_question_data($survey_id);
		$answer_data = $this->analyze_model->get_answer_data($survey_id);
		
		
		
		$content_data = array(
			'title' => $survey_data[0]->title,
			'questions'=> $question_data,
			'answers'=> $answer_data,
			'responses' => $recipient_data,
		);
		
		
		$this->load->view('main_content/analyze_individual', $content_data);
	}
	
	
	
	
	
	
	
	
	
	
}// end of Survey_Analyze Class
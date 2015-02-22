<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Send extends Auth_Controller {
	// constructor function w/ all dependencies 	
	public function __construct() {
		parent::__construct();
			// Load form helper library
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->helper('date');
			
			// Load form validation library
			$this->load->library('form_validation');
			
			// Load session library
			$this->load->library('session');
			
			// Load database
			$this->load->model('send_model');
	} // end of __construct()
	
	/* ##################################################################
	########### CREATE ##################################################
	*/ ##################################################################
	public function send_survey(){
		$this->form_validation->set_rules('send_email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('send_subject', 'Subject Field', 'required|xss_clean');
		$this->form_validation->set_rules('send_message', 'Message', 'required|xss_clean');
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'email' => form_error('send_email'),
				'subject' => form_error('send_subject'),
				'message' => form_error('send_message')
			);
			// echo array so it's accessable
			echo json_encode($response);	 
		}else{
			// get current date for survey createdDate
			$datestring = "%Y%m%d";
			$sent_date = mdate($datestring);
			// get data from ajax post
			$send_data = array(
				'surveyId' => $this->input->post("survey_id"),
				'email' => $this->input->post("send_email"),
				'subject' => $this->input->post("send_subject"),
				'message' => $this->input->post("send_message"),
				'sentDate' => $sent_date
			);
			// pass data to model to insert question to database
			$send_result = $this->send_model->insert_send_data($send_data);
			// return a successful response via ajax
			$response = array(
				'error' => FALSE
			);
			// echo array so it's accessable
			echo json_encode($response);
		}// end of form_validation if/else
	}// end of send_survey()
	
	
	/* ##################################################################
	########### READ ####################################################
	*/ ##################################################################
	public function send($survey_id){
		// passing survey_id to models to get data
		$survey_result = $this->send_model->get_survey_data($survey_id);
		$sent_result = $this->send_model->get_sent_data($survey_id);
		// data available to template
		$survey_data = array(
			'userName' => $survey_result[0]->username,
			'survey_id' => $survey_result[0]->surveyId,
			'title' => $survey_result[0]->title,
		);
		// views to be loaded to builder section
		$page_data = array(
			'pageTitle' => 'Send Survey',
			'headerContent' => $this->load->view('headers/survey_header',$survey_data, TRUE),
			'navContent' => $this->load->view('nav/side_nav',$survey_data, TRUE),
			'mainContent' => $this->load->view('main_content/send',array('sent'=>$sent_result), TRUE),
			'sideContent' => $this->load->view('side_content/send_side',$survey_data, TRUE)	
		);
		// loading view
		$this->load->view('templates/default', $page_data);
	}// end send()

}// end of Survey_Builder Class
/* End of file survey_send.php */
/* Location: ./application/controllers/survey_send.php */
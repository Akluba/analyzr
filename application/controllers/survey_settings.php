<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Settings extends Auth_Controller {
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
	} // end of __construct()

	/* #########################################################################
	################ READ -- survey settings ###################################
	######################################################################### */
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
	
	/* #########################################################################
	################ UPDATE -- survey title ####################################
	######################################################################### */
	public function update_title(){
		$this->form_validation->set_rules('updated_title', 'Survey Name', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'message' => form_error('updated_title')
			);
			// echo array so it's accessable
			echo json_encode($response);
		}else{
			// get updated title from user input
			$updated_title = $this->input->post('updated_title');
			$survey_id = $this->input->post('survey_id');
			// pass input and survey_id to model for updating 
			$survey_result = $this->settings_model->update_title($survey_id,$updated_title);
			if($survey_result == TRUE){
				// return a successful response via ajax
				$response = array(
					'error' => FALSE
				);
				// echo array so it's accessable
				echo json_encode($response);
			}else{
				// database error
			}
		}// end form_validation if/else
	}// end of update_title()
	
	/* #########################################################################
	################ UPDATE -- survey status ###################################
	######################################################################### */
	public function update_status(){
		// set rules for form validation
		$this->form_validation->set_rules('status_update', 'Survey Status', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$response = array(
				'error' => TRUE,
				'message' => form_error('status_update')
			);
			// echo array so it's accessable
			echo json_encode($response);
		}else{
			// get updated status from user selection
			$updated_status = $this->input->post('status_update');
			$survey_id = $this->input->post('survey_id');
			// pass selection and survey_id to model for updating
			$survey_result = $this->settings_model->update_status($survey_id,$updated_status);
			if($survey_result == TRUE){
				// return a successful response via ajax
				$response = array(
					'error' => FALSE
				);
				// echo array so it's accessable
				echo json_encode($response);
			}else{
				// database error
			}
		}// end form_validation if/else
	}// end of update_status()
	
	/* #########################################################################
	################ DELETE -- survey content ##################################
	######################################################################### */
	public function remove_survey(){
		$survey_id = $this->input->post('survey_id');
		// pass survey_id to model to remove survey from database
		$survey_result = $this->settings_model->remove_survey($survey_id);
		echo "true";
	}// end of remove_survey()
	
		
}// end of Survey_Settings Class

/* End of file survey_settings.php */
/* Location: ./application/controllers/survey_settings.php */
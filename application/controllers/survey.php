<?php 

session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends Auth_Controller {
	

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

	
	public function settings($survey_id){
				
		$survey_result = $this->settings_model->get_survey_settings($survey_id);
		$data = array(
			'userName' => $survey_result[0]->username,
			'survey_id' => $survey_result[0]->surveyId,
			'title' => $survey_result[0]->title,
			'created' => $survey_result[0]->createdDate,
			'status' => $survey_result[0]->status
		);
		
		$page_data = array(
			'pageTitle' => 'Settings',
			'headerContent' => $this->load->view('survey_header',$data, TRUE),
			'navContent' => $this->load->view('side_nav',$data, TRUE),
			'mainContent' => $this->load->view('settings',$data, TRUE)
		);
		
		$this->load->view('templates/default', $page_data);
	}
	
	public function update_title($survey_id){
		$updated_title = $this->input->post('updated_title');
		$survey_result = $this->settings_model->update_title($survey_id,$updated_title);
		redirect('survey/settings/'.$survey_id,'refresh');
	}
	
	public function update_status($survey_id){
		$updated_status = $this->input->post('status_update');
		$survey_result = $this->settings_model->update_status($survey_id,$updated_status);
		redirect('survey/settings/'.$survey_id,'refresh');
	}
	
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
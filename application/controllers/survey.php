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
			'title' => $survey_result[0]->title,
			'created' => $survey_result[0]->createdDate,
			'status' => $survey_result[0]->status
		);
		
		$this->load->view('side_nav');
		$this->load->view('settings', $data);
	}
	
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
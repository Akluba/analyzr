<?php 

session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Auth_Controller {
	

public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');
		
		// Load form validation library
		$this->load->library('form_validation');
		
		// Load session library
		$this->load->library('session');
		
		// Load database
		$this->load->model('survey_info');
} // end of __construct()

	
	public function index(){
		
		$email = $this->session->userdata('logged_in');
		
		$user_result = $this->survey_info->get_data($email);
		if($user_result == TRUE){
			$user_data = array(
				'userId' =>$user_result[0]->userId,
				'email' =>$user_result[0]->email,
				'username' =>$user_result[0]->username
			);
			
			$userId = $user_data['userId'];
			$survey_result = $this->survey_info->get_survey_data($userId);
			
			$this->load->view('survey_list', array('user'=>$user_data , 'survey'=>$survey_result));
		}
	
	}// end index()
	
	
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
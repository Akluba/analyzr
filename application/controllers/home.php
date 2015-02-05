<?php 

session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Auth_Controller {
	
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
			$this->load->model('home_model');
	} // end of __construct()

	// Determine user , Gather user surveys
	public function index(){
		// determining logged in user from session
		$email = $this->session->userdata('logged_in');
		// passing data to model to get all data pertaining to user
		$user_result = $this->home_model->get_data($email);
		if($user_result == TRUE){
			$user_data = array(
				'userId' =>$user_result[0]->userId,
				'email' =>$user_result[0]->email,
				'username' =>$user_result[0]->username
			);
			// gathering all surveys belonging to user
			$userId = $user_data['userId'];
			$userName = $user_data['username'];
			$survey_result = $this->home_model->get_survey_data($userId);
			
			$page_data = array(
				'pageTitle' => 'Surveys',
				'headerContent' => $this->load->view('home_header',array('user'=>$user_data), TRUE),
				'mainContent' => $this->load->view('survey_list',array('survey'=>$survey_result), TRUE)
			);
			// load view and send data to display surveys
			$this->load->view('templates/default',$page_data);
			// saving userId to be used in add_survey function
			$this->session->set_flashdata('userId', $userId);
		}// end if
	}// end index()
	
	public function add_survey(){
		// receive userId from index function
		$user_id = $this->session->flashdata('userId');
		// get current date for survey createdDate
		$datestring = "%Y%m%d";
		$created_date = mdate($datestring);
		// data to be stored in database
		$data = array(
			'userId' => $user_id,
			'title' => $this->input->post('survey_name'),
			'createdDate' => $created_date,
			'status' => 1
		);
		// Transfering Data To Model
		$result = $this->home_model->new_survey_insert($data);
		// newly added surveyId
		$survey_id = $result;
		// direct user to new survey settings
		redirect('home','refresh');
	}// end add_survey()
	
	
}// end Home Class

/* End of file home.php */
/* Location: ./application/controllers/home.php */
<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Auth_Controller {
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
			$this->load->model('home_model');
	} // end of __construct()
	
	
	/* 
	** CREATE survey
	************************************* */
	public function add_survey(){
		// set rules for from validation
		$this->form_validation->set_rules('survey_name', 'Survey Name', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		// run form validation
		if ($this->form_validation->run() == FALSE) {
			// respond back with error
			$response = array(
				'error' => TRUE,
				'message' => form_error('survey_name')
			);
			// echo array so it's accessable
			echo json_encode($response);
		}else{
			// get current date for survey createdDate
			$datestring = "%Y%m%d";
			$created_date = mdate($datestring);
			// data to be stored in database
			$data = array(
				'userId' => $this->input->post('user_id'),
				'title' => $this->input->post('survey_name'),
				'createdDate' => $created_date,
				'status' => 1
			);
			// Transfering Data To Model - insert survey
			$result = $this->home_model->new_survey_insert($data);
			if($result == TRUE){
				$response = array(
					'error' => FALSE,
					'message' => 'Survey successfully created!'
				);
				// echo array so it's accessable
				echo json_encode($response);	
			}else{
				// respond back with error
				$response = array(
					'error' => TRUE,
					'message' => 'Survey was not added, please try again.'
				);
				// echo array so it's accessable
				echo json_encode($response);
			}
		}// end form validation
	}// end add_survey()

	
	/* 
	** READ surveys
	************************************* */
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
			// data available to view
			$page_data = array(
				'pageTitle' => 'Surveys',
				'headerContent' => $this->load->view('headers/home_header',array('user'=>$user_data), TRUE),
				'mainContent' => $this->load->view('main_content/home',array('survey'=>$survey_result, 'user'=>$user_data), TRUE),
				'sideContent' => $this->load->view('side_content/home_side',array(), TRUE)	
			);
			// load view and send data to display surveys
			$this->load->view('templates/home',$page_data);
		}// end if
	}// end index()
	

}// end Home Class
/* End of file home.php */
/* Location: ./application/controllers/home.php */
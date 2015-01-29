<?php 

session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');
		
		// Load form validation library
		$this->load->library('form_validation');
		
		// Load session library
		$this->load->library('session');
		
		// Load database
		$this->load->model('auth_model');
		
		// Load password security
		$this->load->helper('security');
} // end of __construct()
	
	//load login form
	public function login_form(){
		$this->load->view('login_form');
	}// end login_form()
	
	//load registration form
	public function registration_form() {
		$this->load->view('registration_form');
	}// end registration_form()
	
	
	// LOGIN 
	public function login_process() {
		// setting form_val preferences
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		// watching for form_val lib to be ran
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login_form');
		}else{
			// setting data to user's input posts
			$log_data = array(
			'email' => $this->input->post('email'),
			'password' => do_hash($this->input->post('password')) //hasing password
			);
			// passing data to model to access database
			$result = $this->auth_model->login($log_data);
			// on success save user data to session
			if($result == TRUE){
				$sess_array = array(
					'email' => $this->input->post('email')
				);
				// Add user data in session
				$this->session->set_userdata('logged_in', $sess_array);
				// Redirect user into logged in area
				redirect('home', 'refresh');
			}else{
				$log_data = array(
				'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('login_form', $log_data);
			}// end else/if
		}// end else/if
	}// end login_process
	
	// REGISTRATION
	public function registration_process() {
		// Check validation for user input in registration form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registration_form');
		}else{
			$reg_data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email_value'),
			'password' => do_hash($this->input->post('password')) //hasing password
			);
			// passing data to model to be inserted in database
			$result = $this->auth_model->registration_insert($reg_data) ;
			// on successful registration log user in
			if ($result == TRUE){
				$log_data = array(
					'email' => $this->input->post('email_value'),
					'password' => do_hash($this->input->post('password')) //hasing password
				);
				$log_result = $this->auth_model->login($log_data);
				if($log_result == TRUE){
					$sess_array = array(
						'email' => $this->input->post('email_value')
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $sess_array);
					// Redirect user into logged in area
					redirect('home', 'refresh');
				}
			}else{
				$data['message_display'] = 'email address already exist!';
				$this->load->view('registration_form', $data);
			}// 
		}// end if/else
	}// end registration_process()
	
	// LOG OUT
	public function logout() {
		// Removing session data
		$sess_array = array(
		'email' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}
	
}// end Auth Class

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
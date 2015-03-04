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
		$page_data = array(
			'pageTitle' => 'Login',
			'analyzrContent' => $this->load->view('auth/login_form',array(), TRUE),
		);
		$this->load->view('templates/auth', $page_data);
	}// end login_form()
	
	//load registration form
	public function registration_form() {
		$page_data = array(
			'pageTitle' => 'Register',
			'analyzrContent' => $this->load->view('auth/registration_form',array(), TRUE),
		);
		$this->load->view('templates/auth', $page_data);
	}// end registration_form()
	
	
	// LOGIN 
	public function login_process() {
		// setting form_val preferences
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		// watching for form_val lib to be ran
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'email_error' => form_error('email'),
				'pass_error' => form_error('password')
			);
			// echo array so it's accessable
			echo json_encode($response);
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
				// response to allow redirect to home
				$response = array(
					'error' => FALSE
				);
				// echo array so it's accessable
				echo json_encode($response);
			}else{
				$response = array(
					'error' => TRUE,
					'invalid_error' => 'Invalid email or password'
				);
				// echo array so it's accessable
				echo json_encode($response);
			}// end else/if
		}// end else/if
	}// end login_process
	
	// REGISTRATION
	public function register_process() {
		// Check validation for user input in registration form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			// ajax response returning validation errors
			$response = array(
				'error' => TRUE,
				'user_error' => form_error('username'),
				'email_error' => form_error('email'),
				'pass_error' => form_error('password')
			);
			// echo array so it's accessable
			echo json_encode($response);
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
					// response to allow redirect to home
					$response = array(
						'error' => FALSE
					);
					// echo array so it's accessable
					echo json_encode($response);
				}
			}else{
				$response = array(
					'error' => TRUE,
					'invalid_error' => 'email address already exist!'
				);
				// echo array so it's accessable
				echo json_encode($response);
			}
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
		redirect('login', 'refresh');
	}
	
}// end Auth Class

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
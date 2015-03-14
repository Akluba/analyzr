<?php 
session_start();
	
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {
	
	public function index(){
		$page_data = array(
			'pageTitle' => 'Welcome!',
			'headerContent' => $this->load->view('survey/survey_head',array(),TRUE),
			'analyzrContent' => $this->load->view('survey/landing',array(), TRUE),
		);
		
		$this->load->view('templates/survey', $page_data);
	}
	
	
}// end Landing Class
/* End of file landing.php */
/* Location: ./application/controllers/landing.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('auth','auth');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _loginValidate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('e', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('p', 'Password', 'trim|required');
	}
	
	public function index(){
		$this->_loginValidate();
		$response = array();
		if($this->form_validation->run() === TRUE){
			if($this->auth->authenticate($this->input->post('e'), $this->input->post('p'))){
			} else {
				$response['error'] = 'Invalid Username and Password';
			}
		}
		echo json_encode($response);
		exit;
	}
}
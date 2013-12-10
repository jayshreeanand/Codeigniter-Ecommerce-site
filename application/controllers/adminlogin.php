<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminlogin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		get_loggedin_role_redirect();
		$this->load->model('auth','auth');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _loginValidate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_id', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
	}
	
	public function index(){
		$this->_loginValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			if( $this->auth->authenticate($this->input->post('email_id'), $this->input->post('password')) ){
				redirect('admindashboard');
			} else {
				$this->outputData['error'] = 'Invalid Username and Password';
			}
		}
		$this->load->view('admin/login',$this->outputData);
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class changepassword extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!isLoggedIn()){
			redirect('/','refresh');
		}

		$this->_flushOutputArray();
		$this->load->model('auth','auth');
		$this->load->model('users','user');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _changepasswordValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cp', 'Current Password', 'trim|required|callback_validcp');
		$this->form_validation->set_rules('np', 'New Password', 'trim|required');
		$this->form_validation->set_rules('cnp', 'Confirm New Password', 'trim|required|callback_validcnp');
	}
	
	function validcp($str){
		if($this->auth->authenticate($this->session->userdata('e'),$str)){
			return TRUE;
		} else {
			$this->form_validation->set_message('validcp', 'Your Current Password is invalid');
			return FALSE;
		}
			
		
	} 

	function validcnp($ncp){
		$np = $this->input->post('np');
		if($np != $ncp){
			$this->form_validation->set_message('validcnp', 'New Password and Confirm New Password do not match');
			return FALSE;
		}
		return TRUE;
		
	} 

	public function index(){
		$this->_changepasswordValidate();
		$response = array();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			$this->user->updatePassword($this->session->userdata('uid'), md5($this->input->post('np')));
			$this->outputData['success'] = 'Password has been updated';
		}else {
			$this->outputData['error'] = validation_errors();
		}
		$this->load->view('changepassword', $this->outputData);
	}
}
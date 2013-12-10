<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forgot extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('auth','auth');
		$this->load->model('users','user');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _forgotValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('e', 'Email Id', 'trim|required|valid_email');
	}
	
	public function index(){
		$this->_forgotValidate();
		$response = array();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			if($this->auth->canWeSendForgotPasswordMail()){
				$data = array();
				$data['email'] = $this->input->post('e');
				$data['password'] = generatePassword();
				$msg = $this->load->view('email_templates/forgot_password', $data, TRUE); 
				if(sendggmail($data['email'],'','','Forgot Password',$msg)){
					$this->user->updateNewPassword($data['password'],md5($this->input->post('e')));
					$response = 1;
				}else {
					$response = 0;
				}
			}
		}
		echo json_encode($response);
		exit;
	}
}
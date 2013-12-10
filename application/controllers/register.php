<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('users','user');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _registerValidate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('e', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('p', 'Password', 'trim|required');
	}
	
	public function index(){
		$this->_registerValidate();

		$response = array();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			if($this->user->checkIfUserExist(md5($this->input->post('e')))){
				$response['error'] = 'Email id is already taken';
			} else {
				$uid = $this->user->add();
				if(strlen($uid) == 32){
					$data = $this->user->getById($uid);
					$this->session->set_userdata('uid', $data['id']);
					$this->session->set_userdata('e', $data['email_id']);
					$this->session->set_userdata('r', $data['role']);
					$d = array();
					$d['email'] = $data['email_id'];
					$msg = $this->load->view('email_templates/new_user', $d, TRUE); 
					sendggmail($d['email'],'','','Welcome to Global Graynz – The experience begins..!',$msg);
				}
			}
			echo json_encode($response);
			exit;
		}
		echo json_encode($response);
		exit;
	}
}
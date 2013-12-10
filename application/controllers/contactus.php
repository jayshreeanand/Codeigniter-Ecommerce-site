<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contactus extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _contactValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
	}

	public function index(){
		$this->_contactValidate();
		$this->outputData['error'] = '';
		$this->outputData['success'] = false;
		if($this->form_validation->run() === TRUE){
			$data = array();
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['phone'] = $this->input->post('phone');
			$data['subject'] = $this->input->post('subject');
			$data['message'] = $this->input->post('message');
			$msg = $this->load->view('email_templates/contactus', $data, TRUE); 
			sendggmail($this->config->item('web_admin_email_id'),'','','Contact Us Mail from '.$data['name'],$msg);

			$msg = $this->load->view('email_templates/email_received', array(), TRUE); 
			sendggmail($data['email'],'','','Acknowledging your Request  - Global Graynz',$msg);


			$this->outputData['success'] = true;
		}
		$this->outputData['error'] = validation_errors(); 
		$this->load->view('contactus',$this->outputData);
	}
}
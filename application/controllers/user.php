<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isLoggedIn()){
			redirect('/','refresh');
		}
		$this->_flushOutputArray();
		$this->load->model('orders','o');
		$this->load->model('shippings','s');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _orderidValidate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('orderid', 'Order Id', 'trim|required|callback_check_order');
		
	}

	public function check_order($str){
		if (!$this->o->isMyOrder($str)){
			$this->form_validation->set_message('check_order', 'Invalid Order Id');
			return FALSE;
		} 	
		return TRUE;
	}

	public function myorder(){
		$this->_orderidValidate();
		if($this->form_validation->run() === TRUE){
			$order = $this->o->getById($this->input->post('orderid'));
			$this->outputData['data']  = $order;
			$this->outputData['line_items'] =  $this->o->getLineItems($this->input->post('orderid'));
			//$this->outputData['shipping'] = $this->s->getByUserId($this->session->userdata('uid'));
			$this->outputData['shipping'] = $this->s->getByOrderId($this->session->userdata('uid'),$this->input->post('orderid'));
			$this->load->view('orderdetails', $this->outputData);	
		} else {
			$this->outputData['error'] = validation_errors();
			$this->load->view('myorder', $this->outputData);
		}
	}
	
}
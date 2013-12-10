<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shipping extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();

		$this->load->model('shippings','s');
		$this->load->model('billings','b');
		$this->load->model('orders','o');
		$this->load->model('users','u');
		$this->load->model('auth','auth');
		
		$this->load->library('cart');

		if(!$this->cart->total_items()){
			redirect('shopaway','refresh');
		}
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _shippingValidate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first', 'Shipping First Name', 'trim|required');
		$this->form_validation->set_rules('last', 'Shipping Last Name', 'trim|required');
		$this->form_validation->set_rules('address1', 'Shipping Address1', 'trim|required');
		$this->form_validation->set_rules('address2', 'Shipping Address2', 'trim');
		$this->form_validation->set_rules('city', 'Shipping City', 'trim|required');
		$this->form_validation->set_rules('state', 'Shipping State', 'trim|required');
		$this->form_validation->set_rules('postalcode', 'Shipping Postal Code', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Shipping Mobile', 'trim|required|callback_mobile_check');

		$this->form_validation->set_rules('bfirst', 'Billing First Name', 'trim|required');
		$this->form_validation->set_rules('blast', 'Billing Last Name', 'trim|required');
		$this->form_validation->set_rules('baddress1', 'Billing Address1', 'trim|required');
		$this->form_validation->set_rules('baddress2', 'Billing Address2', 'trim');
		$this->form_validation->set_rules('bcity', 'Billing City', 'trim|required');
		$this->form_validation->set_rules('bcountry', 'Billing Country', 'trim|required');
		$this->form_validation->set_rules('bstate', 'Billing State', 'trim|required');
		$this->form_validation->set_rules('bpostalcode', 'Billing Postal Code', 'trim|required');
		$this->form_validation->set_rules('bmobile', 'Billing Mobile', 'trim|required|callback_bmobile_check');

		if(!isLoggedIn())
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|callback_check_has_account');

		$this->form_validation->set_error_delimiters('<li class="error">', '</li>');
	}

	function check_has_account($email){

		$userExists = $this->u->checkByEmail($email);
		if($userExists){
			$this->form_validation->set_message('check_has_account', 'You already have an account, please click on login');
			return FALSE;
		}
		return TRUE;
	}
	
	function bmobile_check($bmnumber){

		if(!ctype_digit($bmnumber)){
			$this->form_validation->set_message('bmobile_check', 'Enter only numeric values for billing details mobile phone');
			return FALSE;
		}
		return TRUE;
	}

	function mobile_check($smnumber){

		if(!ctype_digit($smnumber)){
			$this->form_validation->set_message('mobile_check', 'Enter only numeric values for shipping details mobile phone');
			return FALSE;
		}
		return TRUE;
	}
		
	private function _add_edit_shipping_address($user_id){
		$data = $this->s->getByUserId($user_id);
		$bdata = $this->b->getByUserId($user_id);
		if(count($data)){
			$this->s->edit($data['id']);
			$this->b->edit($bdata['id']);
		} else {
			$this->s->add($user_id);
			$this->b->add($user_id);
		}
	}


	public function index(){
		$this->_shippingValidate();
		$this->outputData['data'] = $this->s->getByUserId($this->session->userdata('uid'));
		$this->outputData['bdata'] = $this->b->getByUserId($this->session->userdata('uid'));

		if($this->form_validation->run() === TRUE){
			if(isLoggedIn()){
				$this->_add_edit_shipping_address($this->session->userdata('uid'));
			} else {
				$udata = $this->u->getByEmail($this->input->post('email'));
				if(isset($udata[0]) && count($udata[0])){
					$this->_add_edit_shipping_address($udata[0]['id']);
				} else {
					$newPassword = generatePassword();
					$user_id = $this->u->add(md5($newPassword));
					$this->_add_edit_shipping_address($user_id);
					$udata = $this->u->getByEmail($this->input->post('email'));

					$data = array();
					$data['email'] = $udata['email_id'];
					$data['password'] = $newPassword;
					$this->session->set_userdata('fm','Thank you  for registering on Global Graynz.An email with your temporary password has been sent.');
					$msg = $this->load->view('email_templates/auto_register', $data, TRUE); 
					sendggmail($data['email'],'','','Welcome to Global Graynz – The experience begins..!',$msg);
				}
				$this->auth->setSession($udata);
			}
			$shipcostval = calculateShippingCost($this->input->post('city'), $this->input->post('state') );
			//$_POST['shipping'] = calculateShippingCost($this->input->post('city'), $this->input->post('state') );
			$_POST['shipping'] = $shipcostval;
			$this->session->set_userdata('shipcost', $shipcostval);
			// below 2 lines commented
			//$order_id = $this->o->add();
			//$this->session->set_userdata('oid', $order_id);
			redirect('payment','refresh');
		}
		$this->outputData['errors'] = validation_errors();
		$this->load->view('shipping', $this->outputData);
	}	
}
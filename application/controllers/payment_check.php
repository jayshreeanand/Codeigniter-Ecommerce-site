<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_check extends CI_Controller {

	public function __construct(){
		parent::__construct();


		if(!isLoggedIn()){
			redirect('shopaway','refresh');
		}

		$this->_flushOutputArray();

		$this->load->model('orders','o');
		$this->load->model('users','u');
		$this->load->model('shippings','s');
		$this->load->model('billings','b');
		
		$this->load->library('cart');

		if(!$this->cart->total_items()){
			redirect('shopaway','refresh');
		}
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		//newly added below if condition
		$order_id = $this->o->add();
		$this->session->set_userdata('oid', $order_id);
		$this->o->updatePaymentMode($this->session->userdata('oid'),'Credit Card');
		$this->outputData['delivery_cust'] = $this->s->getByUserId($this->session->userdata('uid'));
		$this->outputData['billing_cust'] = $this->b->getByUserId($this->session->userdata('uid'));
		$this->load->view('payment_check', $this->outputData);
	}

	private function _pcValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
	}

	public function validate_order(){		
		
		$ordersuccess=false;
		foreach ($_POST as $_Var=>$_Val){	
			$$_Var = $_Val;
		}
		$Checksum =verifychecksum($Merchant_Id, $Order_Id , $Amount,$AuthDesc,$Checksum,$WorkingKey);	
		
		if($Checksum=="true" && $AuthDesc=="Y")
		{
			//$Message = CCAVENUE_TXT_1;
			
			//Here you need to put in the routines for a successful 
			//transaction such as sending an email to customer,
			//setting database status, informing logistics etc etc
			$this->outputData['message'] = 1;
			$this->o->updateStatus($this->session->userdata('oid'),0);
			//$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
			$this->_mail_order_details($this->session->userdata('oid'),1);
			$this->cart->destroy();
			$this->load->view('payment_complete', $this->outputData);
			
		}
		else if($Checksum=="true" && $AuthDesc=="B")
		{
			//$Message = CCAVENUE_TXT_2;
			
			//Here you need to put in the routines/e-mail for a  "Batch Processing" order
			//This is only if payment for this transaction has been made by an American Express Card
			//since American Express authorisation status is available only after 5-6 hours by mail from ccavenue and at the "View Pending Orders"
			$this->outputData['message'] = 2;
			$this->o->updateStatus($this->session->userdata('oid'),2);
			//$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
			$this->_mail_order_details($this->session->userdata('oid'),1);
			$this->cart->destroy();
			$this->load->view('payment_complete', $this->outputData);
		}
		else if($Checksum=="true" && $AuthDesc=="N")
		{
			//$Message = CCAVENUE_TXT_3;
			
			//Here you need to put in the routines for a failed
			//transaction such as sending an email to customer
			//setting database status etc etc
			$this->outputData['message'] = 3;
			$this->o->updateStatus($this->session->userdata('oid'),3);
			//$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
			$this->_mail_order_details($this->session->userdata('oid'),1);
			$this->cart->destroy();
			$this->load->view('payment_complete', $this->outputData);
			
		}
		else
		{
			//$Message = CCAVENUE_TXT_4;
			
			//Here you need to simply ignore this and dont need
			//to perform any operation in this condition
		}
					
	}
	
	public function complete(){
		$this->_pcValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			if($_POST['payment_mode']=='COD')
			{
				$this->o->updateStatus($this->session->userdata('oid'),0);
				//$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
				$this->_mail_order_details($this->session->userdata('oid'));
				$this->cart->destroy();
				$this->load->view('payment_complete', $this->outputData);
			}
			else if($_POST['payment_mode']=='PTP')
			{
				$this->load->view('payment', $this->outputData);
			}
			else
			{
				$this->outputData['error'] = validation_errors();
				$this->outputData['delivery_cust'] = $this->s->getByUserId($this->session->userdata('uid'));
				$this->outputData['billing_cust'] = $this->b->getByUserId($this->session->userdata('uid'));
				$this->load->view('payment', $this->outputData);
			}
		} else {
			$this->outputData['error'] = validation_errors();
			$this->outputData['delivery_cust'] = $this->s->getByUserId($this->session->userdata('uid'));
			$this->outputData['billing_cust'] = $this->b->getByUserId($this->session->userdata('uid'));
			$this->load->view('payment', $this->outputData);
		}
		
	}

	private function _mail_order_details($oid,$emailType){
//	public function mail_order_details(){ $oid = $this->uri->segment(3);
		$order = $this->o->getById($oid);
		$data['email'] =  $this->session->userdata('e');
		$data['order_id'] = $oid;
		$data['toalOrderCost']  = $order['total'];
		$data['creationDate'] = date("d F, Y h:m A",strtotime($order['created_on']));
		$data['line_items'] =  $this->o->getLineItems($oid);
		$data['shipping'] = $this->s->getByUserId($this->session->userdata('uid'));
		if($emailType==1) $msg = $this->load->view('email_templates/order_details', $data, TRUE); 
		if($emailType==1) $adminmsg = $this->load->view('email_templates/admin_order_details', $data, TRUE);
		if($emailType==2) $msg = $this->load->view('email_templates/batch_process_pending_order_details', $data, TRUE); 
		if($emailType==3) $msg = $this->load->view('email_templates/failure_order_details', $data, TRUE); 
		
		sendggmail($this->session->userdata('e'),'','','Your Order from Global Graynz',$msg);
		sendggmail($this->config->item('web_admin_email_id'),'','','New Order from Global Graynz',$adminmsg);
	}

	public function cancel(){
		$this->o->abort($this->session->userdata('oid'));
		redirect('ggcart','refresh');
	}
}
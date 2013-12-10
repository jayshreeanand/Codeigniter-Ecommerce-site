<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends CI_Controller {

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
		$this->outputData['delivery_cust'] = $this->s->getByUserId($this->session->userdata('uid'));
		$this->outputData['billing_cust'] = $this->b->getByUserId($this->session->userdata('uid'));
		$this->load->view('payment', $this->outputData);
	}

	private function _pcValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
	}

	public function complete(){
		$this->_pcValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			if($_POST['payment_mode']=='COD')
			{
				// newly added below 2 lines
				$order_id = $this->o->add();
				$this->session->set_userdata('oid', $order_id);
				
				$this->outputData['message'] = 1;
				$this->o->updateStatus($this->session->userdata('oid'),0);
				$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
				$this->_mail_order_details($this->session->userdata('oid'));
				$this->cart->destroy();
				$this->load->view('payment_complete', $this->outputData);
			}
			else if($_POST['payment_mode']=='PTP')
			{
				//$this->load->view('payment_check', $this->outputData);
				//$this->o->updatePaymentMode($this->session->userdata('oid'),$this->input->post('payment_mode'));
				redirect('payment_check','refresh');
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

	private function _mail_order_details($oid){
//	public function mail_order_details(){ $oid = $this->uri->segment(3);
		$order = $this->o->getById($oid);
		$data['email'] =  $this->session->userdata('e');
		$data['order_id'] = $oid;
		$data['toalOrderCost']  = $order['total'];
		$data['creationDate'] = date("d F, Y h:m A",strtotime($order['created_on']));
		$data['line_items'] =  $this->o->getLineItems($oid);
		$data['shipping'] = $this->s->getByUserId($this->session->userdata('uid'));
		$msg = $this->load->view('email_templates/order_details', $data, TRUE); 
		$adminmsg = $this->load->view('email_templates/admin_order_details', $data, TRUE); 
		sendggmail($this->session->userdata('e'),'','','Your Order from Global Graynz',$msg);
		sendggmail($this->config->item('web_admin_email_id'),'','','New Order from Global Graynz',$adminmsg);
	}

	public function cancel(){
		$this->o->abort($this->session->userdata('oid'));
		redirect('ggcart','refresh');
	}
}
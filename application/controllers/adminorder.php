<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminorder extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!validateAccess($this->session->userdata('uid')))
		{
			$this->session->sess_destroy();
			redirect('/', 'refresh');
		}
		if(!checkForValidAccess(array('0'))){
			$this->session->sess_destroy();
			redirect('/', 'refresh');
		}
		$this->_flushOutputArray();
		$this->load->model('orders','o');
		$this->load->model('shippings','s');
		$this->load->model('billings','b');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->outputData['data'] = $this->o->getAll(0);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function aborted(){
		$this->outputData['data'] = $this->o->getAll(5);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function completed(){
		$this->outputData['data'] = $this->o->getAll(6);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function shipped(){
		$this->outputData['data'] = $this->o->getAll(2);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function delivered(){
		$this->outputData['data'] = $this->o->getAll(3);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function dpr(){
		$this->outputData['data'] = $this->o->getAll(4);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	public function prvp(){
		$this->outputData['data'] = $this->o->getAll(1);
		$this->load->view('admin/orders/list',$this->outputData);
	}

	private function _orderstatusvalidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nstatus', 'Update Order Status', 'trim|required');
	}

	public function details(){
		$this->_orderstatusvalidate();
		$this->outputData['error'] = '';
		$order_id = $this->uri->segment(3);
		if($this->form_validation->run() === TRUE){
			$this->o->updateStatus($order_id,$this->input->post('nstatus'));
			$this->outputData['success'] = 1;
		} 
		$order = $this->o->getById($order_id);
		$userdetails = $this->s->getUserEmailDetails($order['user_id']);
		$this->outputData['data']  = $order;
		$this->outputData['userdetails']  = $userdetails;
		$this->outputData['line_items'] =  $this->o->getLineItems($order_id);
		//$this->outputData['shipping'] = $this->s->getByUserId($order['user_id']);
		//$this->outputData['billing'] = $this->b->getByUserId($order['user_id']);
		$this->outputData['shipping'] = $this->s->getByOrderId($order['user_id'],$order_id);
		$this->outputData['billing'] = $this->b->getByOrderId($order['user_id'],$order_id);
		$this->load->view('admin/orders/details', $this->outputData);	
	}
	

}
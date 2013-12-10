<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admincuisine extends CI_Controller {

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
		$this->load->model('cuisines','c');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->outputData['data'] =$this->c->getAll();
		$this->load->view('admin/cuisines/list',$this->outputData);
	}

	private function _cuisineValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Cuisine Name', 'trim|required|callback_name_exist');	
	}

	public function name_exist($str){
		if ($this->c->checkNameExists($str) && $this->uri->segment(2)  == 'add'){
			$this->form_validation->set_message('name_exist', 'Cuisine Name Already Exist');
			return FALSE;
		} 	
		return TRUE;
	}

	public function add(){
		$this->_cuisineValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			$this->c->add();
			redirect('admincuisine','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/cuisines/add_edit',$this->outputData);
	}


	public function edit(){
		$this->_cuisineValidate();
		$this->outputData['error'] = '';
		$this->outputData['data'] = $this->c->getById($this->uri->segment(3));
		if($this->form_validation->run() === TRUE){
			$this->c->edit($this->uri->segment(3));
			redirect('admincuisine','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/cuisines/add_edit',$this->outputData);
	}

}
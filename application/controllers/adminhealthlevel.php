<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminhealthlevel extends CI_Controller {

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
		$this->load->model('healthlevel','hl');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->outputData['data'] =$this->hl->getAll();
		$this->load->view('admin/healthlevel/list',$this->outputData);
	}

	private function _healthlevelValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Healthlevel Name', 'trim|required|callback_name_exist');	
	}

	public function name_exist($str){
		if ($this->hl->checkNameExists($str) && $this->uri->segment(2)  == 'add' ){
			$this->form_validation->set_message('name_exist', 'Healthlevel Name Already Exist');
			return FALSE;
		} 	
		return TRUE;
	}

	public function add(){
		$this->_healthlevelValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			$this->hl->add();
			redirect('adminhealthlevel','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/healthlevel/add_edit',$this->outputData);
	}


	public function edit(){
		$this->_healthlevelValidate();
		$this->outputData['error'] = '';
		$this->outputData['data'] = $this->hl->getById($this->uri->segment(3));
		if($this->form_validation->run() === TRUE){
			$this->hl->edit($this->uri->segment(3));
			redirect('adminhealthlevel','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/healthlevel/add_edit',$this->outputData);
	}

}
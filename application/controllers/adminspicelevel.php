<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminspicelevel extends CI_Controller {

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
		$this->load->model('spicelevel','sl');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->outputData['data'] =$this->sl->getAll();
		$this->load->view('admin/spicelevel/list',$this->outputData);
	}

	private function _spicelevelValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Spicelevel Name', 'trim|required|callback_name_exist');	
	}

	public function name_exist($str){
		if ($this->sl->checkNameExists($str) && $this->uri->segment(2)  == 'add' ){
			$this->form_validation->set_message('name_exist', 'Spicelevel Name Already Exist');
			return FALSE;
		} 	
		return TRUE;
	}

	public function add(){
		$this->_spicelevelValidate();
		$this->outputData['error'] = '';
		if($this->form_validation->run() === TRUE){
			$this->sl->add();
			redirect('adminspicelevel','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/spicelevel/add_edit',$this->outputData);
	}


	public function edit(){
		$this->_spicelevelValidate();
		$this->outputData['error'] = '';
		$this->outputData['data'] = $this->sl->getById($this->uri->segment(3));
		if($this->form_validation->run() === TRUE){
			$this->sl->edit($this->uri->segment(3));
			redirect('adminspicelevel','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/spicelevel/add_edit',$this->outputData);
	}

}
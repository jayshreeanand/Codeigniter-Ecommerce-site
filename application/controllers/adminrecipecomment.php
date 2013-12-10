<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminrecipecomment extends CI_Controller {

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
		$this->load->model('recipescomments','rc');
		
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->outputData['data'] =$this->rc->getUnapproved();
		$this->load->view('admin/recipescomments/list',$this->outputData);
	}

	public function edit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');	

		$this->outputData['data'] = $this->rc->getById($this->uri->segment(3));
		
		if($this->form_validation->run() === TRUE){
			$this->rc->edit($this->uri->segment(3));
			redirect('adminrecipecomment','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/recipescomments/add_edit',$this->outputData);	
	}

}
?>
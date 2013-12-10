<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class requests extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('model_requests','req');
			}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	function index(){
		
	}
	

	public function addrequests(){
		$reqid = $this->input->post('reqe');
		$reqdesc = $this->input->post('reqd');
		$this->req->add($reqid,$reqdesc);
	}


	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class internationalcuisine extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		
		$this->load->model('recipes','r');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	public function index(){
		
		$data = $this->r->getAllFrontend();
		$filteredData = array();
		foreach($data as $datum){
			$filteredData[$datum['cuisine_id']][] = $datum;
		}
		$this->outputData['data'] = $filteredData;
		
		$this->load->view('internationalcuisine',$this->outputData);
	}
}
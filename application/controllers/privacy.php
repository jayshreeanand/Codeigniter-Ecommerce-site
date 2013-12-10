<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class privacy extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('auth','auth');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$this->load->view('privacy');
	}
}
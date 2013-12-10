<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subscribe extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('model_subscribe','sc');
			}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	function index(){
		
	}
	

	public function addmail(){
		$scid = $this->input->post('sc');
		$msg = $this->load->view('email_templates/subscribe_details','', TRUE); 
		sendggmail($scid,'','','Hello from Global Graynz!',$msg);
		$this->sc->add($scid);

	}


	
}
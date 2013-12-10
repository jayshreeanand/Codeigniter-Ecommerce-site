<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ggcart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();

		$this->load->library('cart');

		$this->load->model('ingredients','i');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	public function index(){

		$this->load->view('cart_details',$this->outputData);
	}

	public function add(){

		$ingredientData = $this->i->getById($this->input->post('id'));
		$qty = $this->input->post('qty');
		if($qty === FALSE)
			$qty = 1;
		$data = array(
               'id'      => $ingredientData['id'],
               'qty'     => $qty,
               'price'   => $ingredientData['sale_price'],
               'name'    => $ingredientData['name'],
               'options' => array('image1'=> $ingredientData['image1'] )
            );

		$this->cart->insert($data);
		echo json_encode(array('success' => 1));
	}
	
	public function update(){
		$data = array(
               'rowid' => $this->input->post('r'),
               'qty'   => $this->input->post('q')
            );

		$this->cart->update($data); 
	}	

	public function remove(){
		$data = array(
               'rowid' => $this->uri->segment(3),
               'qty'   => 0
            );

		$this->cart->update($data); 
		redirect('ggcart/index','refresh');
	}
}
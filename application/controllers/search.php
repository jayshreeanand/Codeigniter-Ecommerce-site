<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		
		$this->load->model('ingredients','i');
		$this->load->model('recipes','r');
		$this->load->model('cuisines','c');
		$this->load->model('categories','ca');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');						
		$this->load->library('cart');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	public function index(){
		$this->load->library('form_validation');

		if(!empty($_POST)){
			$recipes = $this->r->getSearchResults($this->input->post('keywords'));
			$ingredients = $this->i->getSearchResults($this->input->post('keywords'));
		}else {
			$recipes = $this->r->getSearchResults(' ');
			$ingredients = $this->i->getSearchResults(' ');
		}
		$this->outputData['search_keywords'] = $this->input->post('keywords');
		$this->outputData['recipes'] = $recipes;
		$this->outputData['ingredients'] = $ingredients;
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();				
		$this->load->view('search',$this->outputData);
	}
}
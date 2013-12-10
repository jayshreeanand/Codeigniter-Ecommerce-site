<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ingredient extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();

		$this->load->model('ingredients','i');
		$this->load->model('recipes','r');
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
		$this->outputData['data'] = $this->i->getAll();
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();								
		$this->load->view('ingredients_search',$this->outputData);
	}

	public function details(){
		$slug = explode('-',$this->uri->segment(3));
		$iid = $slug[count($slug)-1];
		if(strlen($iid) == 32){
			$this->outputData['data'] = $this->i->getById($iid);
			$this->outputData['categories'] = $this->ca->getAll();
			$this->outputData['healthlevel'] = $this->h->getAll();
			$this->outputData['spicelevel'] = $this->s->getAll();
			$this->outputData['foodtype'] = $this->f->getAll();									
			$this->outputData['usedin'] = $this->r->getRecipesUsedByThisIngredient($iid);   
			$this->load->view('ingredient_details',$this->outputData);
		}
	}

	public function rateit(){
		if(isLoggedIn()){
			$selectedScore = $this->input->post('score');
			$id = $this->input->post('id');
			$newScore = $this->i->rateIt($id,$selectedScore);
			echo '{"success": "'.$newScore.'"}';
			exit;
		} else {
			echo '{"error":"Please login to rate"}';
			exit;
		}
	}




}
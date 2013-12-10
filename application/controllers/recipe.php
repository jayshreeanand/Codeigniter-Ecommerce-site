<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recipe extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		$this->load->model('recipes','r');
		$this->load->model('ingredients','i');
		$this->load->model('cuisines','c');
		$this->load->model('categories','ca');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');				
		$this->load->model('recipescomments','rc');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	public function index(){
		$this->load->library('form_validation');
		$params=0;
		if(empty($_POST))
			$this->outputData['data'] = $this->r->getAllFrontend();
		else {
			$this->outputData['data'] = $this->r->getAllApplyFilters();

			$params=$this->input->post('d')."_".$this->input->post('d2')."_".$this->input->post('d3')."_".$this->input->post('d4')."_".$this->input->post('d5');
			$this->outputData['spice_level'] 	= $this->input->post('d');
			$this->outputData['health_level'] 	= $this->input->post('d2');
			$this->outputData['expert_level'] 	= $this->input->post('d3');
			$this->outputData['cuisine_id'] 	= $this->input->post('d4');
			$this->outputData['food_type'] 		= $this->input->post('d5');
		}
		//$this->outputData['recommendations'] = $this->r->getRecommended($params);
		$this->outputData['recommendations'] = $this->r->getRecommended();
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();		
		$this->load->view('recipes_search',$this->outputData);
	}

	public function details(){
		$slug = explode('-',$this->uri->segment(3));
		$rid = $slug[count($slug)-1];
		if(strlen($rid) == 32){
			$this->outputData['data'] = $this->r->getById($rid);			
			$this->outputData['ingredients'] = $this->i->getIngredientsByIds($this->outputData['data']['ingredients']);
			$this->outputData['related'] = $this->r->getRelated($this->outputData['data']['related']);
			$this->outputData['comments'] = $this->rc->getApproved($rid);
			$this->load->view('recipes_details',$this->outputData);
		}
	}

	public function printpopup(){
		$slug = explode('-',$this->uri->segment(3));
		$rid = $slug[count($slug)-1];
		if(strlen($rid) == 32){
			$this->outputData['data'] = $this->r->getById($rid);			
			$this->outputData['ingredients'] = $this->i->getIngredientsByIds($this->outputData['data']['ingredients']);
			$this->load->view('recipes_print',$this->outputData);
		}
	}

	public function addcomment(){
		$rid = $this->input->post('rid');
		$comment = $this->security->xss_clean(urldecode($this->input->post('c')));
		$this->rc->add($rid,$comment);
	}


	public function rateit(){
		if(isLoggedIn()){
			$selectedScore = $this->input->post('score');
			$id = $this->input->post('id');
			$newScore = $this->r->rateIt($id,$selectedScore);
			echo '{"success": "'.$newScore.'"}';
			exit;
		} else {
			echo '{"error":"Please login to rate"}';
			exit;
		}
	}

}
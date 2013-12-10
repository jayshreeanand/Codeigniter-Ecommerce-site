<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
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
		
	public function index()
	{
		$this->outputData['new_recipedata'] = $this->r->getNewRecipes();
		$this->outputData['new_ingredientdata'] = $this->i->getNewIngredients();
		$this->outputData['offer_newingredientdata'] = $this->i->getNewOfferIngredients();
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();				
		$this->load->view('welcome_message',$this->outputData);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
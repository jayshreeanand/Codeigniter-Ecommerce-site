<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminrecipe extends CI_Controller {

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
		$this->load->model('recipes','r');
		$this->load->model('ingredients','i');
		$this->load->model('cuisines','c');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');		
		$this->load->model('categories','ca');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$sval=$this->input->post('isearch');
		$this->outputData['data'] =$this->r->getAll($sval);
		$this->load->view('admin/recipes/list',$this->outputData);
	}

	private function _recipeValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Recipe Name', 'trim|required|callback_name_exist');	
	}

	public function name_exist($str){
		if ($this->r->checkNameExists($str) && $this->uri->segment(2)  == 'add'){
			$this->form_validation->set_message('name_exist', 'Recipe Name Already Exist');
			return FALSE;
		} 	
		return TRUE;
	}

	public function add(){
		$this->_recipeValidate();
		$this->outputData['error'] = '';
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();

		if($this->form_validation->run() === TRUE){
			$recipe_id  = $this->r->add();
			create_user_directory($recipe_id,RECIPES_UPLOAD_DIR);
			$filepath = RECIPES_UPLOAD_DIR.$recipe_id;
			uploadAttachments('image1',$filepath,$_FILES['image1']['name'],$_FILES['image1']['name']);
			uploadAttachments('image2',$filepath,$_FILES['image2']['name'],$_FILES['image2']['name']);
			uploadAttachments('image3',$filepath,$_FILES['image3']['name'],$_FILES['image3']['name']);
			
			redirect('adminrecipe','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/recipes/add_edit',$this->outputData);	
	}


	public function edit(){
		$this->_recipeValidate();
		$this->outputData['error'] = '';
		$this->outputData['data'] = $this->r->getById($this->uri->segment(3));

		$ingredients = $this->i->getIngredientNames($this->outputData['data']['ingredients']);
		$this->outputData['ingredientNames'] = str_replace(',','","',$ingredients);

		$rrecipenames = $this->r->getRecipeNames($this->outputData['data']['related']);
		$this->outputData['relatedRecipeNames'] = str_replace(',','","',$rrecipenames);
		
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();
		
		if($this->form_validation->run() === TRUE){
			$this->r->edit($this->uri->segment(3));
			create_user_directory($this->uri->segment(3),RECIPES_UPLOAD_DIR);
			$filepath = RECIPES_UPLOAD_DIR.$this->uri->segment(3);
			uploadAttachments('image1',$filepath ,$_FILES['image1']['name'],$_FILES['image1']['name']);
			uploadAttachments('image2',$filepath ,$_FILES['image2']['name'],$_FILES['image2']['name']);
			uploadAttachments('image3',$filepath ,$_FILES['image3']['name'],$_FILES['image3']['name']);
			redirect('adminrecipe','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/recipes/add_edit',$this->outputData);	
	}

	public function view(){
		$this->outputData['data'] = $this->r->getById($this->uri->segment(3));
		$ingredients = $this->i->getIngredientNames($this->outputData['data']['ingredients']);
		$this->outputData['ingredientNames'] = str_replace(',','","',$ingredients);

		$rrecipenames = $this->r->getRecipeNames($this->outputData['data']['related']);
		$this->outputData['relatedRecipeNames'] = str_replace(',','","',$rrecipenames);
		
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();
		
		$this->load->view('admin/recipes/view',$this->outputData);	
	}

	public function getajax(){
		$data = $this->r->getAll();
		$recipes = array();
		foreach ($data as $d) {
			$recipes[] = $d['name'];
		}
		echo json_encode($recipes);
		exit;
	}
}
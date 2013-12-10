<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminingredient extends CI_Controller {

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
		$this->load->model('ingredients','i');
		$this->load->model('cuisines','c');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');
		$this->load->model('categories','ca');
		$this->load->model('recipes','r');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	public function index(){
		$sval=$this->input->post('isearch');
		$this->outputData['data'] = $this->i->getAll($sval);
		$this->load->view('admin/ingredients/list',$this->outputData);
	}

	private function _ingredientValidate(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Ingredient Name', 'trim|required|callback_name_exist');	
	}

	public function name_exist($str){
		if ($this->i->checkNameExists($str) &&  $this->uri->segment(2)  == 'add'){
			$this->form_validation->set_message('name_exist', 'Ingredient Name Already Exist');
			return FALSE;
		} 	
		return TRUE;
	}

	public function add(){
		$this->_ingredientValidate();
		$this->outputData['error'] = '';
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();

		if($this->form_validation->run() === TRUE){
			$ingredient_id  = $this->i->add();
			create_user_directory($ingredient_id,INGREDIENTS_UPLOAD_DIR);
			$filepath = INGREDIENTS_UPLOAD_DIR.$ingredient_id;
			if($_FILES['image1'])
				uploadAttachments('image1',$filepath,$_FILES['image1']['name'],$_FILES['image1']['name']);
			if($_FILES['image2'])
				uploadAttachments('image2',$filepath,$_FILES['image2']['name'],$_FILES['image2']['name']);
			if($_FILES['image3'])
				uploadAttachments('image3',$filepath,$_FILES['image3']['name'],$_FILES['image3']['name']);
			
			redirect('adminingredient','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/ingredients/add_edit',$this->outputData);	
	}


	public function edit(){
		$this->_ingredientValidate();
		$this->outputData['error'] = '';
		$this->outputData['data'] = $this->i->getById($this->uri->segment(3));
		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();

		$recipes = $this->r->getRecipeNames($this->outputData['data']['used_in']);
		$this->outputData['recipeNames'] = str_replace(',','","',$recipes);

		if($this->form_validation->run() === TRUE){
			$this->i->edit($this->uri->segment(3));
			create_user_directory($this->uri->segment(3),INGREDIENTS_UPLOAD_DIR);
			$filepath = INGREDIENTS_UPLOAD_DIR.$this->uri->segment(3);
			if($_FILES['image1'])
				uploadAttachments('image1',$filepath ,$_FILES['image1']['name'],$_FILES['image1']['name']);
			if($_FILES['image2'])
				uploadAttachments('image2',$filepath ,$_FILES['image2']['name'],$_FILES['image2']['name']);
			if($_FILES['image3'])
			uploadAttachments('image3',$filepath ,$_FILES['image3']['name'],$_FILES['image3']['name']);
			redirect('adminingredient','refresh');
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/ingredients/add_edit',$this->outputData);	
	}

	public function view(){
		$this->outputData['data'] = $this->i->getById($this->uri->segment(3));

		$recipes = $this->r->getRecipeNames($this->outputData['data']['used_in']);
		$this->outputData['recipeNames'] = str_replace(',','","',$recipes);

		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();
		
		$this->load->view('admin/ingredients/view',$this->outputData);	
	}

	public function getajax(){
		$data = $this->i->getAll();
		$ingredients = array();
		foreach ($data as $d) {
			$ingredients[] = $d['name'];
		}
		echo json_encode($ingredients);
		exit;
	}


}
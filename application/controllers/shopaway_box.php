<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shopaway_box extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->_flushOutputArray();
		
		$this->load->model('ingredients','i');
		$this->load->model('cuisines','c');
		$this->load->model('categories','ca');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');								
		$this->load->library('cart');
		$this->load->library('pagination');				
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	
	public function index($params="0_67b3c0c5fc7ce7e39537f8610715c7c5_0_0",$page=0){
		$this->load->library('form_validation');
		
		if(empty($_POST) && empty($params)){
			
			$this->outputData['data'] = $this->i->getAllFronted($page,$params);
		}else {
			if(empty($params))
			{
			$d5_1=$this->input->post('d5_1');
			$d5_2=$this->input->post('d5_2');
			$d4=$this->input->post('d4'); if(empty($d4) || $d4==' ') $d4=0;
			$d2=$this->input->post('d2'); if(empty($d2)) $d2=0;
			$d=$this->input->post('d'); if(empty($d)) $d=0;
			$srt=$this->input->post('sortval'); if(empty($srt)) $srt=0;
			$d5val=0;
			if($d5_1 && $d5_2) $d5val=3;
			else if($d5_1) $d5val=2;
			else if($d5_2) $d5val=1;
			$params = $d5val."_".$d4."_".$d2."_".$d."_".$srt;
			}
			else
			{
				$paramsArr=explode("_",$params);
				$d5val=$paramsArr[0]; if(empty($d5val)) $d5val=0;
				$d4=$paramsArr[1]; if(empty($d4) || $d4==' ') $d4=0;
				$d2=$paramsArr[2]; if(empty($d2)) $d2=0;
				$d=$paramsArr[3]; if(empty($d)) $d=0;
				$srt=$paramsArr[4]; if(empty($srt)) $srt=0;
				$params = $d5val."_".$d4."_".$d2."_".$d."_".$srt;
			}
			$this->outputData['data'] = $this->i->getAllApplyFilters($page,$params);
			$this->outputData['food_type'] 	= $d5val;
			$this->outputData['category_id'] 	= $d4;
			$this->outputData['health_level'] 	= $d2;
			$this->outputData['spice_level'] 	= $d;
			$this->outputData['srt_level'] 	= $srt;
			
		}

/*		echo 'd4:'.$this->input->post('d4').'<br>';
		echo 'd2:'.$this->input->post('d2').'<br>';
		echo 'd:'.$this->input->post('d').'<br>';
		break;
*/		$this->outputData['recommendations'] = $this->i->getRecommended();


		$this->outputData['categories'] = $this->ca->getAll();
		$this->outputData['cuisines'] = $this->c->getAll();
		$this->outputData['healthlevel'] = $this->h->getAll();
		$this->outputData['spicelevel'] = $this->s->getAll();
		$this->outputData['foodtype'] = $this->f->getAll();						
		$this->load->view('shopaway',$this->outputData);
	}
}
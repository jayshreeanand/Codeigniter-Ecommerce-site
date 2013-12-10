<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminupload extends CI_Controller {

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
		$this->getimgdata=array();
		$this->load->model('ingredients','i');
		$this->load->model('cuisines','c');
		$this->load->model('categories','ca');
		$this->load->model('healthlevel','h');
		$this->load->model('spicelevel','s');
		$this->load->model('foodtype','f');										
		$this->load->model('recipes','r');
	}
	
	function _flushOutputArray(){
		$this->outputData = array();
	}
	
	private function _validate(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('atype', 'Type', 'trim|callback_checkacttype');
		$this->form_validation->set_rules('type', 'Data', 'trim|callback_checktype');
	}
	
		function checkacttype($str){
	 	if(empty($str)){
	 		$this->form_validation->set_message('checkacttype', 'Please select whether it is adding or updation of data');
			return FALSE;
	 	}
		return TRUE;
		}

	 function checktype($str){
	 	if(empty($str)){
	 		$this->form_validation->set_message('checktype', 'Please select whether it is recipe or ingredient data');
			return FALSE;
	 	}

		if(!$_FILES['file']['size']){
			$this->form_validation->set_message('checktype', 'Please Upload');
			return FALSE;
		} else if(!strpos($_FILES['file']['name'], 'xlxs') && !strpos($_FILES['file']['name'], 'xls') &&  !strpos($_FILES['file']['name'], 'zip')){
			$this->form_validation->set_message('checktype', 'Invalid file');
			return FALSE;
		}
		return TRUE;
	}
	

	private function _ingredientsUpload($rows,$row_count,$type){

		for ($i = 2; $i <= $row_count; $i++) {
            $row = $rows[$i];
            $data = array();
			$imgArr = array();
            if($type=='a')
			{
			$data = array(
        		'name'          => trim($row[2]),
                'used_in'   	=> $this->r->getRecipesIdsByCodes(trim($row[3])),				
                'description'  	=> trim($row[4]),
                'regular_price' => (float)trim($row[5]),
                'sale_price'    => (float)trim($row[6]),             
                'rating'   	    => trim($row[7]),
                'cuisine_id'    => $this->c->getIdByName(trim($row[8])),
                'category_id'   => $this->ca->getIdByName(trim($row[9])),
                //'food_type'   	=> (strtolower($row[8]) == 'veg' || strtolower($row[8]) == 'vegetarian' ) ? 1 : 2,
                //'health_level'  => getHealthLevelId(trim($row[9])),
                //'spice_level'   => getSpiceLevelId(trim($row[10])),
                'food_type'   	=> $this->f->getIdByName(trim($row[10])),
                'health_level'  => $this->h->getIdByName(trim($row[11])),
                'spice_level'   => $this->s->getIdByName(trim($row[12])),
                'recommendation' => (trim($row[13])=='Yes' ? 1 : 0),
                'status'         => (trim($row[14])=='Active' ? 1 : 0),
                'offer_exists'   => trim($row[15]),
                'image1'         => trim($row[16]),
                'image2'         => trim($row[17]),
                'image3'         => trim($row[18])
            );
			}
            else if($type=='u')
			{
			$data = array(
        		'name'          => trim($row[2]),
                'used_in'   	=> $this->r->getRecipesIdsByCodes(trim($row[3])),
                'description'  	=> trim($row[4]),
                'regular_price' => (float)trim($row[5]),
                'sale_price'    => (float)trim($row[6]),             
                'rating'   	    => trim($row[7]),
                'cuisine_id'    => $this->c->getIdByName(trim($row[8])),
                'category_id'   => $this->ca->getIdByName(trim($row[9])),
                //'food_type'   	=> (strtolower($row[8]) == 'veg' || strtolower($row[8]) == 'vegetarian' ) ? 1 : 2,
                //'health_level'  => getHealthLevelId(trim($row[9])),
                //'spice_level'   => getSpiceLevelId(trim($row[10])),
                'food_type'   	=> $this->f->getIdByName(trim($row[10])),
                'health_level'  => $this->h->getIdByName(trim($row[11])),
                'spice_level'   => $this->s->getIdByName(trim($row[12])),
                'recommendation' => (trim($row[13])=='Yes' ? 1 : 0),
                'status'         => (trim($row[14])=='Active' ? 1 : 0),
                'offer_exists'   => trim($row[15]),
                'image1'         => trim($row[16]),
                'image2'         => trim($row[17]),
                'image3'         => trim($row[18]),
                'ingredient_code' => trim($row[19]) 				
            );
			}
			
         	if($type=='a') $resArr=$this->i->bulkupdate($data);
         	else if($type=='u') $resArr=$this->i->bulkupdate_edit($data);
			
			$imgArr[]=$resArr[0];
			$imgArr[]=trim($row[16]);
			$imgArr[]=trim($row[17]);
			$imgArr[]=trim($row[18]);
			$imgNameArr[]=$imgArr;			
	    }
		$this->imgdatavals($imgNameArr);
	}
	

	function ucs2html($str) 
	{
		$str=trim($str); // if you are reading from file
		$len=strlen($str);
		$html='';
		for($i=0;$i<$len;$i+=2)
		$html.='&#'.hexdec(dechex(ord($str[$i+1])).
			  sprintf("%02s",dechex(ord($str[$i])))).';';
		return($html);
	}


	function _recipesUpload($rows,$row_count,$type){
		$imgNameArr = array();
		for ($i = 2; $i <= $row_count; $i++) {
            $row = $rows[$i];
            $imgArr = array();
            $data = array();
            if($type=='a')
			{
			$data = array(
        		'name'          => trim($row[2]),
                'ingredients'   => $this->i->getIngredientsIdsByCodes(trim($row[3])),
                'related'   	=> $this->r->getRecipesIdsByCodes(trim($row[4])),
                //'process'   	=> preg_replace("/([\xC2\xC3])([\x80-\xBF])/e","chr(ord('\\1')<<6&0xC0|ord('\\2')&0x3F)",trim($row[5])),
                //'process'   	=> preg_replace("/([\x80-\xFF])/e","chr(0xC0|ord('\\1')>>6).chr(0x80|ord('\\1')&0x3F)",trim($row[5])),
                'process'   	=> $this->ucs2html(trim($row[5])),
                //'process'   	=> iconv("UTF-8", "ISO-8859-1",trim($row[5])),
                //'process'   	=> utf8_encode(trim($row[5])),
                'history'   	=> trim($row[6]),
                'nutrition'   	=> trim($row[7]),
                'preparation_time'   	=> trim($row[8]),
                'cooking_time'   	=> trim($row[9]),
                'rating'   	    => trim($row[10]),
                'cuisine_id'    => $this->c->getIdByName(trim($row[11])),
                'category_id'   => $this->ca->getIdByName(trim($row[12])),
                //'food_type'   	=> (strtolower($row[8]) == 'veg' || strtolower($row[8]) == 'vegetarian' ) ? 1 : 2,
                //'health_level'  => getHealthLevelId(trim($row[9])),
                //'spice_level'   => getSpiceLevelId(trim($row[10])),
                'food_type'   	=> $this->f->getIdByName(trim($row[13])),
                'health_level'  => $this->h->getIdByName(trim($row[14])),
                'spice_level'   => $this->s->getIdByName(trim($row[15])),				
                'expert_level'   => getExpertLevelId(trim($row[16])),
                'video'         => trim($row[17]),
                'recommendation' => (trim($row[18])=='Yes' ? 1 : 0),
                'status'         => (trim($row[19])=='Active' ? 1 : 0),
                'image1'         => trim($row[20]),
                'image2'         => trim($row[21]),
                'image3'         => trim($row[22]) 
            );
			}
			else if($type=='u')
			{
            $data = array(
        		'name'          => trim($row[2]),
                'ingredients'   => $this->i->getIngredientsIdsByCodes(trim($row[3])),
                'related'   	=> $this->r->getRecipesIdsByCodes(trim($row[4])),
                'process'   	=> $this->ucs2html(trim($row[5])),
                'history'   	=> trim($row[6]),
                'nutrition'   	=> trim($row[7]),
                'preparation_time'   	=> trim($row[8]),
                'cooking_time'   	=> trim($row[9]),
                'rating'   	    => trim($row[10]),
                'cuisine_id'    => $this->c->getIdByName(trim($row[11])),
                'category_id'   => $this->ca->getIdByName(trim($row[12])),
                //'food_type'   	=> (strtolower($row[8]) == 'veg' || strtolower($row[8]) == 'vegetarian' ) ? 1 : 2,
                //'health_level'  => getHealthLevelId(trim($row[9])),
                //'spice_level'   => getSpiceLevelId(trim($row[10])),
                'food_type'   	=> $this->f->getIdByName(trim($row[13])),
                'health_level'  => $this->h->getIdByName(trim($row[14])),
                'spice_level'   => $this->s->getIdByName(trim($row[15])),				
                'expert_level'   => getExpertLevelId(trim($row[16])),
                'video'         => trim($row[17]),
                'recommendation' => (trim($row[18])=='Yes' ? 1 : 0),
                'status'         => (trim($row[19])=='Active' ? 1 : 0),
                'image1'         => trim($row[20]),
                'image2'         => trim($row[21]),
                'image3'         => trim($row[22]),
                'recipe_code'    => trim($row[23])
            );
			}
			
         	if($type=='a') $resArr=$this->r->bulkupdate($data);
         	else if($type=='u') $resArr=$this->r->bulkupdate_edit($data);
			
			$imgArr[]=$resArr[0];
			$imgArr[]=trim($row[20]);
			$imgArr[]=trim($row[21]);
			$imgArr[]=trim($row[22]);
			$imgNameArr[]=$imgArr;
	    }
		$this->imgdatavals($imgNameArr);
	}
	
	function imgdatavals($dataval)
	{
		$this->getimgdata=$dataval;
	}
	
	function getimgdatavals()
	{
		return $this->getimgdata;
	}

	function recursiveRemoveDirectory($dir,$DeleteMe=false)
	{
      if(!$dh = @opendir($dir)) return;
      while (false !== ($obj = readdir($dh)))
      {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) $this->recursiveRemoveDirectory($dir.'/'.$obj, true);
      }

      closedir($dh);
      if ($DeleteMe)
      {
         @rmdir($dir);
      }
	}

	public function index(){
		$this->_validate();
		$this->outputData['error'] = '';
		$this->outputData['success'] = '';
		if($this->form_validation->run() === TRUE){
			if($_FILES['file']){
				$filepath = BULK_UPLOAD_DIR;
				uploadAttachments('file',$filepath,$_FILES['file']['name'],$_FILES['file']['name']);
				$fn = clean_file_name($_FILES['file']['name']);

				chmod(BULK_UPLOAD_DIR.$fn,0777);
				$pathToFile = BULK_UPLOAD_DIR.$fn;
				
				if(strpos($_FILES['file']['name'], 'xlxs') || strpos($_FILES['file']['name'], 'xls'))
				{
					$params =  array('file' => $pathToFile, 'store_extended_info' => true);
					$this->load->library('Spreadsheet_Excel_Reader',$params);
					$this->spreadsheet_excel_reader->setOutputEncoding('CP1251'); // Set output Encoding.
					$this->spreadsheet_excel_reader->read($pathToFile); // relative path to .xls that was uploaded earlier
			   
					$rows = $this->spreadsheet_excel_reader->sheets[0]['cells'];
					$row_count = count($rows);
	
					if($_POST['type'] == 'i')
						$this->_ingredientsUpload($rows,$row_count,$_POST['atype']);
					else if($_POST['type'] == 'r')
						$this->_recipesUpload($rows,$row_count,$_POST['atype']);
					
					$this->outputData['success'] = 1;
					unlink(BULK_UPLOAD_DIR.$fn);
				}
				else if(strpos($_FILES['file']['name'], 'zip'))
				{
					$act_newZipName=$pathToFile;
					$extract_to_dir=$filepath.'temp_'.date("Ymd_His");
			        $pathinfo = pathinfo($_FILES['file']['name']);
			        $cust_given_filename = $pathinfo['filename'];
					mkdir($extract_to_dir,0700);
					chmod($extract_to_dir,0777);					
					$zip = new ZipArchive;
					$res = $zip->open($act_newZipName);
					if ($res === TRUE) {
						$zip->extractTo($extract_to_dir);
						$zip->close();
					}
					
					$csvFileName='';
					$dh = opendir($extract_to_dir.'/'.$cust_given_filename);
					while (($inside_filename = readdir($dh)) !== false) {
					if(stripos($inside_filename,'.xlxs')) $csvFileName=$inside_filename;
					else if(stripos($inside_filename,'.xls')) $csvFileName=$inside_filename;
					}
					closedir($dh);
										
					$pathToFile=$extract_to_dir.'/'.$cust_given_filename.'/'.$csvFileName;
					$imageFilepath=$extract_to_dir.'/'.$cust_given_filename;
					$params =  array('file' => $pathToFile, 'store_extended_info' => true);
					$this->load->library('Spreadsheet_Excel_Reader',$params);
					$this->spreadsheet_excel_reader->setOutputEncoding('CP1251'); // Set output Encoding.
					$this->spreadsheet_excel_reader->read($pathToFile); // relative path to .xls that was uploaded earlier
			   
					$rows = $this->spreadsheet_excel_reader->sheets[0]['cells'];
					$row_count = count($rows);
	
					if($_POST['type'] == 'i')
					{
						$this->_ingredientsUpload($rows,$row_count,$_POST['atype']);
						$imgNamesArrData=$this->getimgdatavals();
						foreach($imgNamesArrData as $imgNamesData)
						{
							foreach($imgNamesData as $keval=>$imgNamesval)
							{
								if(empty($keval)){ 
								$idval=$imgNamesval;
								$targetfilepath = INGREDIENTS_UPLOAD_DIR.$idval;
								if(!file_exists($targetfilepath))
								{
									mkdir($targetfilepath,0700);
									chmod($targetfilepath,0777);								
								}
								}
								else if(!empty($keval) && !empty($imgNamesval)) 
								{
									if(file_exists($imageFilepath.'/'.$imgNamesval))
									copy($imageFilepath.'/'.$imgNamesval,$targetfilepath.'/'.$imgNamesval);
								}
							}
						}						
					}
					else if($_POST['type'] == 'r')
					{
						$this->_recipesUpload($rows,$row_count,$_POST['atype']);
						$imgNamesArrData=$this->getimgdatavals();
						foreach($imgNamesArrData as $imgNamesData)
						{
							foreach($imgNamesData as $keval=>$imgNamesval)
							{
								if(empty($keval)){ 
								$idval=$imgNamesval;
								$targetfilepath = RECIPES_UPLOAD_DIR.$idval;
								if(!file_exists($targetfilepath))
								{
									mkdir($targetfilepath,0700);
									chmod($targetfilepath,0777);								
								}
								}
								else if(!empty($keval) && !empty($imgNamesval)) 
								{
									if(file_exists($imageFilepath.'/'.$imgNamesval))									
									copy($imageFilepath.'/'.$imgNamesval,$targetfilepath.'/'.$imgNamesval);
								}
							}
						}
					}
					
					$this->outputData['success'] = 1;
					unlink($act_newZipName);
					$this->recursiveRemoveDirectory($extract_to_dir,true);									
				}
			}
		}
		$this->outputData['error'] = validation_errors();
		$this->load->view('admin/upload',$this->outputData);
	}
}
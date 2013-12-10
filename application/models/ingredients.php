<?php
class Ingredients extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'ingredients';
        
       	$this->selectQuery = '	ingredients.id as id,
                     			ingredients.name as name,
                     			ingredients.ingredient_code as ingredient_code,
                                ingredients.regular_price as regular_price,
                                ingredients.sale_price as sale_price,
                                ingredients.used_in as used_in,
                                ingredients.description as description,
                                ingredients.rating as rating,
                                ingredients.category_id as category_id,
                                ingredients.cuisine_id as cuisine_id,
                                ingredients.health_level as health_level,
                                ingredients.spice_level as spice_level,
                                ingredients.food_type as food_type,
                                ingredients.recommendation as recommendation,
                                ingredients.image1 as image1,
                                ingredients.image2 as image2.
                                ingredients.image3 as image3.
                   				ingredients.status as status,
								ingredients.offer_exists as offer_exists,
                                ingredients.created_on as created_on';
    }
    
	function setvalues(){	
    	$this->data = array(
                            'name'          => $this->input->post('name'),
                            'regular_price' => (float)$this->input->post('regular_price'),
                            'sale_price'    => (float)$this->input->post('sale_price'),
                            'used_in'       => $this->getRecipes($this->input->post('used_in')),
                            'description'   => $this->input->post('description'),
                            'rating'        => (float)$this->input->post('rating'),
                            'category_id'   => $this->input->post('category_id'),
                            'cuisine_id'    => $this->input->post('cuisine_id'),
                            'health_level'   => $this->input->post('health_level'),
                            'spice_level'   => $this->input->post('spice_level'),
                            'food_type'   => $this->input->post('food_type'),
                            'recommendation' => $this->input->post('recommendation'),
							'offer_exists' => $this->input->post('offer_exists')
                        );
        if(!empty($_FILES['image1']['name'])){
            $this->data['image1'] = clean_file_name($_FILES['image1']['name']);
        }
        if(!empty($_FILES['image2']['name'])){
            $this->data['image2'] = clean_file_name($_FILES['image2']['name']);
        }
        if(!empty($_FILES['image3']['name'])){
            $this->data['image3'] = clean_file_name($_FILES['image3']['name']);
        }
    }
    
	function getRandomString($length = 5) {
    	$characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
	    $string = '';

    	for ($i = 0; $i < $length; $i++) {
        	$string .= $characters[mt_rand(0, strlen($characters) - 1)];
    	}

    	return $string;
	}
	
	function ingredient_code_value()
	{
		$cnt=0;
		$new_ingredient_code='';
		do
		{
		$str="IN_".$this->getRandomString(5);
		$chk_sql = "select * from ingredients where ingredient_code='".$str."'";	
		$chk_query = $this->db->query($chk_sql);	
			if ($chk_query->num_rows() == 0) 
			{
				$new_ingredient_code=$str;
				$cnt++;
			}
		}while ($cnt<=0);
		return $new_ingredient_code; 				
	}
		
	function add(){
    	$this->setvalues();
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
		$ingredient_code_val=$this->ingredient_code_value();
    	$this->data['id'] = $id;
		$this->data['ingredient_code'] = $ingredient_code_val;
    	$this->data['status'] = 1;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Ingredients::add'.$e->getMessage());
  			return 0;
  		}
    }
   
    function edit($id){
        $this->setvalues();
        $this->data['status'] = $this->input->post('status');
        $this->db->where('id', $id);
        try{
			$this->db->update($this->tableName,$this->data);
            //echo $this->db->last_query(); exit;
            return 1;
        } catch(Exception $e){
            log_message('error', 'Ingredients::edit'.$e->getMessage());
            return 0;
        }
    }

    function bulkupdate($data){
        $id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
        $ingredient_code_val=$this->ingredient_code_value();
		$data['id'] = $id;
		$data['ingredient_code'] = $ingredient_code_val;
        //$data['status'] = 0;
        $data['created_on'] = date('Y-m-d H:i:s');
		$code_idArr=array();
        try{
            $this->db->insert($this->tableName,$data);
			$code_idArr[]=$id;
			$code_idArr[]=$ingredient_code_val;
			return $code_idArr;			
        } catch(Exception $e){
            log_message('error', 'Ingredients::bulkupdate'.$e->getMessage());
            return 0;
        }
    }

    function bulkupdate_edit($data){
		$code_idArr=array();
		$this->db->where('ingredient_code', $data['ingredient_code']);
        try{
            $this->db->update($this->tableName,$data);
			$exData=$this->getIdFromCode($data['ingredient_code']);
			$code_idArr[]=$exData[0]['id'];
			return $code_idArr;			
        } catch(Exception $e){
            log_message('error', 'Ingredients::edit'.$e->getMessage());
            return 0;
        }
	}

    function getIdFromCode($code){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('ingredient_code' => $code));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }
	
	function getById($id){
    	$data = array();
    	$query = $this->db->get_where($this->tableName, array('id' => $id));
    	//echo $this->db->last_query();
		$data =  $query->row_array();
		return $data;
    }  
    

    function getAll($sval=''){
        $data = array();
        $this->db->order_by('created_on', 'DESC');
		if(empty($sval)) $query = $this->db->get_where($this->tableName,array());
		else if(!empty($sval))
		{
		$this->db->like('name',$sval,'both');
		$query = $this->db->get_where($this->tableName,array());
		//$query = $this->db->query("select * from ".$this->tableName." where name like '%".$sval."%'");
		}
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getAllFronted($page=0,$params=0){
        $data = array();				
		$this->db->order_by('created_on', 'DESC');
        $query = $this->db->get_where($this->tableName,array('status' => 1));
		$config['base_url'] = base_url().'/index.php/shopaway/index/'.$params;
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = 15;
		$config['num_links'] = 11;
		$config['uri_segment'] = 4;
		$config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['prev_link'] = '<img src="'. base_url().'images/prev.png" alt="Prev">';
        $config['next_link'] = '<img src="'. base_url().'images/next.png" alt="Next">';
		$config['cur_tag_open'] = '<a class="paginselet">';
		$config['cur_tag_close'] = '</a>';
						
		$this->pagination->initialize($config);		
		$page = $this->uri->segment(4);

        if($page=="") { $page = 0; }
        $this->db->limit(15,$page);
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get_where($this->tableName,array('status' => 1));		
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getNewIngredients(){
        $data = array();
		$this->db->order_by('created_on', 'DESC');
		$this->db->limit(4,0);
        $query = $this->db->get_where($this->tableName,array('status' => 1, 'offer_exists' => "No"));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }
	
    function getNewOfferIngredients(){
        $data = array();
		$this->db->order_by('created_on', 'DESC');
		$this->db->limit(4,0);
        $query = $this->db->get_where($this->tableName,array('status' => 1, 'offer_exists' => "Yes"));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }	

    function getOfferIngredients($page=0,$params=0){
        $data = array();
		$where = array();
       if(empty($params))
		{
		$sl = trim($this->input->post('d'));
        $hl = trim($this->input->post('d2'));
        $ft = trim($this->input->post('d5'));
        $cid = trim($this->input->post('d4'));
		$srt = trim($this->input->post('sortval'));
		$d5_1=$this->input->post('d5_1');
		$d5_2=$this->input->post('d5_2');
		$d5val=''; $d5val_1='';
		if($d5_1 && $d5_2) { $d5val=''; $d5val_1=3; }
		else if($d5_1) { $d5val=2; $d5val_1=2; }
		else if($d5_2) { $d5val=1; $d5val_1=1; }
		}
		else
		{
			$paramsArr=explode("_",$params);
			$d5val=$paramsArr[0]; if(empty($d5val)) $d5val=0;
			$cid=$paramsArr[1]; if(empty($cid) || $cid==' ') $cid=0;
			$h1=$paramsArr[2]; if(empty($h1)) $h1=0;
			$s1=$paramsArr[3]; if(empty($s1)) $s1=0;
			$srt=$paramsArr[4]; if(empty($srt)) $srt=0;			
			$d5val_1=$d5val;
			if($d5val_1==3) $d5val=''; 
		}
		
		$this->outputData['food_type'] 	= $d5val_1;
		$ft=$d5val;
		
        if(!empty($sl)){
            $where['spice_level'] = $sl;
        }

        if(!empty($hl)){
            $where['health_level'] = $hl;
        }

        if(!empty($ft)){
            $where['food_type'] = $ft;
        }

        if(!empty($cid)){
            $where['category_id'] = $cid;
        }

        $where['status'] = 1;
		$where['offer_exists'] = "Yes";
        
		if(empty($srt)) $this->db->order_by('created_on', 'DESC');
		else if($srt=='rsa') $this->db->order_by('rating', 'DESC');
		else if($srt=='rsd') $this->db->order_by('rating', 'ASC');
		else if($srt=='psa') $this->db->order_by('sale_price', 'DESC');
		else if($srt=='psd') $this->db->order_by('sale_price', 'ASC');
		else if($srt=='nsa') $this->db->order_by('name', 'DESC');
		else if($srt=='nsd') $this->db->order_by('name', 'ASC');
		
        $query = $this->db->get_where($this->tableName,$where);
		
		$config['base_url'] = base_url().'/index.php/offer_shopaway/index/'.$params;
		//$config['total_rows'] = ceil($query->num_rows()/15);
		$config['total_rows'] = $query->num_rows();
		//$config['page_query_string'] = TRUE;
		$config['per_page'] = 15;
		$config['num_links'] = 11;
		$config['uri_segment'] = 4;
		$config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['prev_link'] = '<img src="'. base_url().'images/prev.png" alt="Prev">';
        $config['next_link'] = '<img src="'. base_url().'images/next.png" alt="Next">';
		$config['cur_tag_open'] = '<a class="paginselet">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config);		
		$page = $this->uri->segment(4);

        if($page=="") { $page = 0; }
        $this->db->limit(15,$page);
		if(empty($srt)) $this->db->order_by('created_on', 'DESC');
		else if($srt=='rsa') $this->db->order_by('rating', 'DESC');
		else if($srt=='rsd') $this->db->order_by('rating', 'ASC');
		else if($srt=='psa') $this->db->order_by('sale_price', 'DESC');
		else if($srt=='psd') $this->db->order_by('sale_price', 'ASC');
		else if($srt=='nsa') $this->db->order_by('name', 'DESC');
		else if($srt=='nsd') $this->db->order_by('name', 'ASC');
		$query = $this->db->get_where($this->tableName,$where);
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 		 
        return $data;
    }	

    function checkNameExists($name){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('name' => $name));
        if ($query->num_rows() > 0){
            return TRUE;
        } 
        return FALSE;
    }

    function getIngredientNames($iids){
        $this->db->select('name');
		$this->db->order_by('created_on', 'DESC');
        $this->db->where_in('id', explode(',',$iids));
        $query = $this->db->get($this->tableName);
        $data = array();
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        $names = array();
        foreach ($data as $d) {
            $names[] = $d['name'];    
        }
        return  '"'.implode(",",$names).'"';
    }

    function getIngredientsByIds($ids){
        $data = array();
		$this->db->order_by('created_on', 'DESC');
        $this->db->where_in('id', explode(',',$ids));

        $query = $this->db->get($this->tableName);
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        }
        return $data;
    }

    function getIngredientsIdsByCodes($ingredientsCodes){
        $ids = array();$data = array();
        //$i = str_replace(array("[","]"),'',$ingredientsCodes);
        $i = str_replace(' ','',$ingredientsCodes);
        $i = str_replace(",","','",$i);
        if(!empty($i)){
            $sql = "select id from ingredients where ingredient_code IN ('".$i."')";
       		$this->db->order_by('created_on', 'DESC');
			$query = $this->db->query($sql); 
            
            if ($query->num_rows() > 0){
                $data =  $query->result_array();
            }
           
            foreach ($data as $d) {
                $ids[] = $d['id'];    
            }
        }
        return  implode(',',$ids);
    }
	
    function getAllApplyFilters($page=0,$params=0){
        $data = array();
        $where = array();

        if(empty($params))
		{
		$sl = trim($this->input->post('d'));
        $hl = trim($this->input->post('d2'));
        $ft = trim($this->input->post('d5'));
        $cid = trim($this->input->post('d4'));
		$srt = trim($this->input->post('sortval'));
		$d5_1=$this->input->post('d5_1');
		$d5_2=$this->input->post('d5_2');
		$d5val=''; $d5val_1='';
		if($d5_1 && $d5_2) { $d5val=''; $d5val_1=3; }
		else if($d5_1) { $d5val=2; $d5val_1=2; }
		else if($d5_2) { $d5val=1; $d5val_1=1; }
		}
		else
		{
			$paramsArr=explode("_",$params);
			$d5val=$paramsArr[0]; if(empty($d5val)) $d5val=0;
			$cid=$paramsArr[1]; if(empty($cid) || $cid==' ') $cid=0;
			$h1=$paramsArr[2]; if(empty($h1)) $h1=0;
			$s1=$paramsArr[3]; if(empty($s1)) $s1=0;
			$srt=$paramsArr[4]; if(empty($srt)) $srt=0;			
			$d5val_1=$d5val;
			if($d5val_1==3) $d5val=''; 
		}
		
		$this->outputData['food_type'] 	= $d5val_1;
		$ft=$d5val;
		
        if(!empty($sl)){
            $where['spice_level'] = $sl;
        }

        if(!empty($hl)){
            $where['health_level'] = $hl;
        }

        if(!empty($ft)){
            $where['food_type'] = $ft;
        }

        if(!empty($cid)){
            $where['category_id'] = $cid;
        }

        $where['status'] = 1;
        
		if(empty($srt)) $this->db->order_by('created_on', 'DESC');
		else if($srt=='rsa') $this->db->order_by('rating', 'DESC');
		else if($srt=='rsd') $this->db->order_by('rating', 'ASC');
		else if($srt=='psa') $this->db->order_by('sale_price', 'DESC');
		else if($srt=='psd') $this->db->order_by('sale_price', 'ASC');
		else if($srt=='nsa') $this->db->order_by('name', 'DESC');
		else if($srt=='nsd') $this->db->order_by('name', 'ASC');
		
        $query = $this->db->get_where($this->tableName,$where);
		
		$config['base_url'] = base_url().'/index.php/shopaway/index/'.$params;
		//$config['total_rows'] = ceil($query->num_rows()/15);
		$config['total_rows'] = $query->num_rows();
		//$config['page_query_string'] = TRUE;
		$config['per_page'] = 15;
		$config['num_links'] = 11;
		$config['uri_segment'] = 4;
		$config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['prev_link'] = '<img src="'. base_url().'images/prev.png" alt="Prev">';
        $config['next_link'] = '<img src="'. base_url().'images/next.png" alt="Next">';
		$config['cur_tag_open'] = '<a class="paginselet">';
		$config['cur_tag_close'] = '</a>';
		
		//$config['full_tag_open'] = '<ul>';
		//$config['full_tag_close'] = '</ul>';
		//$config['first_tag_open'] = '<li>';
		//$config['first_tag_close'] = '</li>';
		//$config['prev_tag_open'] = '<a href="#" class="prev"><img src="images/prev.png" alt="Prev">';
		//$config['prev_tag_close'] = '</a>';
		//$config['cur_tag_open'] = '<span class="slct">';
		//$config['cur_tag_close'] = '</span>';
		//$config['next_tag_close'] = '</ul>';
		//$config['last_tag_open'] = '<li>';
		//$config['last_tag_close'] = '</li>';		
		//$config['num_tag_open'] = '<li>';
		//$config['num_tag_close'] = '</li>';		
		$this->pagination->initialize($config);		
		$page = $this->uri->segment(4);

        if($page=="") { $page = 0; }
        $this->db->limit(15,$page);
		if(empty($srt)) $this->db->order_by('created_on', 'DESC');
		else if($srt=='rsa') $this->db->order_by('rating', 'DESC');
		else if($srt=='rsd') $this->db->order_by('rating', 'ASC');
		else if($srt=='psa') $this->db->order_by('sale_price', 'DESC');
		else if($srt=='psd') $this->db->order_by('sale_price', 'ASC');
		else if($srt=='nsa') $this->db->order_by('name', 'DESC');
		else if($srt=='nsd') $this->db->order_by('name', 'ASC');
		$query = $this->db->get_where($this->tableName,$where);
		
      //  echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

     function getRecommended(){
        $data = array();
        $sql = "select * from ingredients where status = 1 and recommendation = 1 order by rand() limit 5";
		$this->db->order_by('created_on', 'DESC');
        $query =  $this->db->query($sql); 
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getRecipes($recipesName){
        $ids = array();

        $r = str_replace(array("[","]"),'',$recipesName);
        if(!empty($r)){
            $sql = "select id from recipes where name IN (".$r.")";
            $this->db->order_by('created_on', 'DESC');
			$query = $this->db->query($sql); 
            if ($query->num_rows() > 0){
                $data =  $query->result_array();
            }
            
            foreach ($data as $d) {
                $ids[] = $d['id'];    
            }
        }
        return  implode(',',$ids);
    }

    function getSearchResults($keyword){
        $data = array();
        $keyword = trim(strtolower($keyword));
        $sql = "select * from ingredients where status = 1 and (name like '%$keyword%' OR description like '%$keyword%')";
        $this->db->order_by('created_on', 'DESC');
		$query = $this->db->query($sql); 
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        }
        return $data;
    }


    function rateIt($id, $score){
        $sql = "update ingredients set rating=(rating+".$score.")/2 where id = '".$id."'";
        $query = $this->db->query($sql); 

        $sql = "select rating from ingredients where id = '".$id."'";
        $query = $this->db->query($sql); 
       
        $data =  $query->row_array();
       
        return $data['rating'];
    }
}
?>
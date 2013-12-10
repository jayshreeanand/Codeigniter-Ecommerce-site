<?php
class Recipes extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'recipes';
        
       	$this->selectQuery = '	recipes.id as id,
                     			recipes.name as name,
                     			recipes.recipe_code as recipe_code,
                                recipes.process as process,
                                recipes.history as history,
                                recipes.nutrition as nutrition,
                                recipes.health_level as health_level,
                                recipes.spice_level as spice_level,
                                recipes.expert_level as expert_level,
                                recipes.food_type as food_type,
                                recipes.preparation_time as preparation_time,
                                recipes.cooking_time as cooking_time,
                                recipes.rating as rating,
                                recipes.ingredients as ingredients,
                                recipes.category_id as category_id,
                                recipes.cuisine_id as cuisine_id,
                                recipes.recommendation as recommendation,
                                recipes.related as related,
                                recipes.image1 as image1,
                                recipes.image2 as image2.
                                recipes.image3 as image3.
                                recipes.video as video,
                   				recipes.status as status,
                                recipes.created_on as created_on';
    }
    
	function setvalues(){	
       
    	$this->data = array(   
                            'name'          => $this->input->post('name'),
                            'process'       => $this->input->post('process'),
                            'history'       => $this->input->post('history'),
                            'nutrition'     => $this->input->post('nutrition'),
                            'health_level'  => $this->input->post('health_level'),
                            'spice_level'   => $this->input->post('spice_level'),
                            'expert_level'  => $this->input->post('expert_level'),
                            'food_type'     => $this->input->post('food_type'),
                            'preparation_time' => $this->input->post('preparation_time'),
                            'cooking_time'  => $this->input->post('cooking_time'),
                            'rating'        => (float)$this->input->post('rating'),
                            'ingredients'   => $this->getIngredients($this->input->post('ingredients')),
                            'category_id'   => $this->input->post('category_id'),
                            'cuisine_id'    => $this->input->post('cuisine_id'),
                            'recommendation' => $this->input->post('recommendation'),
                            'related'       => $this->getRecipesIdsByNames($this->input->post('related')),
                            'video'         => $this->input->post('video')
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
	
	function recipe_code_value()
	{
		$cnt=0;
		$new_recipe_code='';
		do
		{
		$str="RE_".$this->getRandomString(5);
		$chk_sql = "select * from recipes where recipe_code='".$str."'";	
		$chk_query = $this->db->query($chk_sql);	
			if ($chk_query->num_rows() == 0) 
			{
				$new_recipe_code=$str;
				$cnt++;
			}
		}while ($cnt<=0);
		return $new_recipe_code; 				
	}
	
	function add(){
    	$this->setvalues();
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
		$recipe_code_val=$this->recipe_code_value();
    	$this->data['id'] = $id;
    	$this->data['recipe_code'] = $recipe_code_val;
    	$this->data['status'] = 1;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Recipes::add'.$e->getMessage());
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
            log_message('error', 'Recipes::edit'.$e->getMessage());
            return 0;
        }
    }

    function bulkupdate($data){
        $id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
		$recipe_code_val=$this->recipe_code_value();
        $data['id'] = $id;
		$data['recipe_code'] = $recipe_code_val;
        //$data['status'] = 0;
        $data['created_on'] = date('Y-m-d H:i:s');
		$code_idArr=array();
        try{
            $this->db->insert($this->tableName,$data);
			$code_idArr[]=$id;
			$code_idArr[]=$recipe_code_val;
			return $code_idArr;
        } catch(Exception $e){
            log_message('error', 'Recipes::bulkupdate'.$e->getMessage());
            return 0;
        }
    }

    function bulkupdate_edit($data){
		$code_idArr=array();
		$this->db->where('recipe_code', $data['recipe_code']);
        try{
            $this->db->update($this->tableName,$data);
			$exData=$this->getIdFromCode($data['recipe_code']);
			$code_idArr[]=$exData[0]['id'];
			return $code_idArr;			
        } catch(Exception $e){
            log_message('error', 'Recipes::bulkedit'.$e->getMessage());
            return 0;
        }
	}

    function getIdFromCode($code){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('recipe_code' => $code));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getIngredients($ingredientsName){
         $ids = array();
       $ings =  str_replace(array("[","]"),'',$ingredientsName);
        if(!empty($ings)){
        $sql = "select id from ingredients where name IN (".$ings.")";
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

     function getAllFrontend(){
        $data = array();
		$this->db->order_by('created_on', 'DESC');
        $query = $this->db->get_where($this->tableName,array('status' => 1));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

     function getNewRecipes(){
        $data = array();
		$this->db->order_by('created_on', 'DESC');
		$this->db->limit(4,0);
        $query = $this->db->get_where($this->tableName,array('status' => 1));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        }
        return $data;
    }
	
    function getAllApplyFilters(){
        $data = array();
        $where = array();

        $sl = trim($this->input->post('d'));
        $hl = trim($this->input->post('d2'));
        $el = trim($this->input->post('d3'));
        $c  = trim($this->input->post('d4'));
        $ft = trim($this->input->post('d5'));
        

        if($sl && !empty($sl)){
            $where['spice_level'] = $sl;
        }
        if($hl && !empty($hl)){
            $where['health_level'] = $hl;
        }
        if($el && !empty($el)){
            $where['expert_level'] = $el;
        }
        if($c && !empty($c)){
            $where['cuisine_id'] = $c;
        }
        if($ft && !empty($ft)){
            $where['food_type'] = $ft;
        }
        $this->db->order_by('created_on', 'DESC');
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

    function getRecommended($params=0){
        
		$sp_lel=0;
		$h_lel=0;
		$ex_lel=0;
		$cui_id=0;
		$f_type=0;
		
		if(!empty($params))
		{
		$paramsArr=explode("_",$params);
		$sp_lel=$paramsArr[0]; if(empty($sp_lel)) $sp_lel=0;
		$h_lel=$paramsArr[1]; if(empty($h_lel)) $h_lel=0;
		$ex_lel=$paramsArr[2]; if(empty($ex_lel)) $ex_lel=0;
		$cui_id=$paramsArr[3]; if(empty($cui_id)) $cui_id=0;
		$f_type=$paramsArr[4]; if(empty($f_type)) $f_type=0;			
		}
		
		$data = array();
        $sql = "select * from recipes where status = 1 and recommendation = 1 ";
		if(!empty($sp_lel)) $sql .=" and spice_level='".$sp_lel."'";
		if(!empty($h_lel)) $sql .=" and health_level='".$h_lel."'";
		if(!empty($ex_lel)) $sql .=" and expert_level='".$ex_lel."'";
		if(!empty($cui_id)) $sql .=" and cuisine_id='".$cui_id."'";
		if(!empty($f_type)) $sql .=" and food_type='".$f_type."'";
		$sql .=" order by rand() limit 2";
        $this->db->order_by('created_on', 'DESC');
		$query =  $this->db->query($sql); 
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
		else
		{
			$sql = "select * from recipes where status = 1 and recommendation = 1 order by rand() limit 2";
			$this->db->order_by('created_on', 'DESC');
			$query =  $this->db->query($sql); 
			if ($query->num_rows() > 0){
				$data =  $query->result_array();
			} 			
		}
        return $data;
    }

    function getRecipeNames($iids){
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

    function getRecipesUsedByThisIngredient($iid){
        $data = array();
		$this->db->order_by('created_on', 'DESC');		
        $this->db->like('ingredients', $iid); 
        $query = $this->db->get($this->tableName);
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getRecipesIdsByNames($recipesName){
        $ids = array();$data = array();
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

    function getRecipesIdsByCodes($recipesCodes){
        $ids = array();$data = array();
        //$r = str_replace(array("[","]"),'',$recipesCodes);
        $r = str_replace(' ','',$recipesCodes);
		$r = str_replace(",","','",$r);
        //$r = $recipesCodes;
        if(!empty($r)){
            $sql = "select id from recipes where recipe_code IN ('".$r."')";
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
	
    function getRelated($related){
        $data = array();
        $sql = "select * from recipes where id IN ('".$related."') order by rand() limit 1";
   		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->query($sql); 
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        }
        return $data;
    }


    function getSearchResults($keyword){
        $data = array();
        $keyword = trim(strtolower($keyword));
        $sql = "select * from recipes where status = 1 and (name like '%$keyword%' OR process like '%$keyword%' OR history like '%$keyword%' OR  nutrition like '%$keyword%')";
   		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->query($sql); 
      //  echo $this->db->last_query();
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        }
        return $data;
    }

    function rateIt($id, $score){
        $sql = "update recipes set rating=(rating+".$score.")/2 where id = '".$id."'";
        $query = $this->db->query($sql); 
        $sql = "select rating from recipes where id = '".$id."'";
        $query = $this->db->query($sql); 
        $data =  $query->row_array();
        return $data['rating'];
    }

}
?>
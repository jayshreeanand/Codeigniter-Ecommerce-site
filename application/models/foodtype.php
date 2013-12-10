<?php
class Foodtype extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'foodtypes';
        
       	$this->selectQuery = '	foodtypes.id as id,
                     			foodtypes.name as name,
                   				foodtypes.status as status,
                                foodtypes.created_on as created_on';
    }
    
	function setvalues(){	
    	$this->data = array('name' => $this->input->post('name'));
    }
    
	function add(){
    	$this->setvalues();
    	//$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
    	//$this->data['id'] = $id;
    	$this->data['status'] = 1;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
			return $this->db->insert_id();
  			//return $id;
  		} catch(Exception $e){
  			log_message('error', 'Foodtype::add'.$e->getMessage());
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
            log_message('error', 'Foodtype::edit'.$e->getMessage());
            return 0;
        }
    }

	function getById($id){
    	$data = array();
    	$query = $this->db->get_where($this->tableName, array('id' => $id));
    	//echo $this->db->last_query();
		$data =  $query->row_array();
		return $data;
    }  
    

    function getAll(){
        $data = array();
        $query = $this->db->get_where($this->tableName,array());
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function checkNameExists($name){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('LOWER(name)' => strtolower($name)));
        if ($query->num_rows() > 0){
            return TRUE;
        } 
        return FALSE;
    }

    function getIdByName($name){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('LOWER(name)' => strtolower($name)));
        if ($query->num_rows() > 0){
            $data =  $query->row_array();
        } 
        if(count($data))
            return  $data['id'];
        return 0;

    }

}
?>
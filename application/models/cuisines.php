<?php
class Cuisines extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'cuisines';
        
       	$this->selectQuery = '	cuisines.id as id,
                     			cuisines.name as name,
                   				cuisines.status as status,
                                cuisines.created_on as created_on';
    }
    
	function setvalues(){	
    	$this->data = array('name' => $this->input->post('name'));
    }
    
	function add(){
    	$this->setvalues();
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
    	$this->data['id'] = $id;
    	$this->data['status'] = 1;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Cuisines::add'.$e->getMessage());
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
            log_message('error', 'Cuisines::edit'.$e->getMessage());
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
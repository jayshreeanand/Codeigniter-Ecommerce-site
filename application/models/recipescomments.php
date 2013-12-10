<?php
class RecipesComments extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'recipes_comments';
        $this->data = array();
       	$this->selectQuery = '	recipes_comments.id as id,
                     			recipes_comments.recipe_id as recipe_id,
                                recipes_comments.comment as comment,
                   				recipes_comments.status as status,
                                recipes_comments.created_on as created_on';
    }
    
    
	function add($rid,$comment){
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
    	$this->data['id'] = $id;
        $this->data['recipe_id'] = $rid;
        $this->data['comment'] = $comment;
    	$this->data['status'] = 0;
    	$this->data['created_on'] = date('Y-m-d H:i:s');

  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Recipes_comments::add'.$e->getMessage());
  			return 0;
  		}
    }
   
    function edit($id){
        $this->data['status'] = $this->input->post('status');
        $this->db->where('id', $id);
        try{
            $this->db->update($this->tableName,$this->data);
            //echo $this->db->last_query(); exit;
            return 1;
        } catch(Exception $e){
            log_message('error', 'Recipes_comments::edit'.$e->getMessage());
            return 0;
        }
    }

    function getUnapproved(){
        $data = array();
        $query = $this->db->get_where($this->tableName,array('status' => 0));
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
        return $data;
    }

    function getApproved($rid){
         $data = array();
        $query = $this->db->get_where($this->tableName,array( 'recipe_id' => $rid,  'status' => 1));
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

}
?>
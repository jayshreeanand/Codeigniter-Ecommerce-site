<?php
class Users extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
        
       	$this->selectQuery = '	users.id as id,
                                users.email_id as email_id,
                                users.role as role,
                   							users.status as status,
                                users.created_on as created_on';
    }
    
	function setvalues(){	
    	$this->data = array(
          'email_id' => $this->input->post('e'),
          'password' => md5($this->input->post('p'))
    	);
  }
    
  function setvaluesViaShipping($shipping){ 
      $this->data = array(
          'email_id' => $this->input->post('email'),
          'password' => $shipping
      );
  }

	function add($shipping=FALSE){

      if($shipping){
        $this->setvaluesViaShipping($shipping);
      } else {
        $this->setvalues();
      }
    	
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
    	$this->data['id'] = $id;
      $this->data['role'] = 1;
    	$this->data['status'] = 1;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Users::add'.$e->getMessage());
  			return 0;
  		}
    }
    
    
    function edit($id){
  		$this->setvalues();
  		$this->db->where('id', $id);
  		try{
  			$this->db->update($this->tableName,$this->data);
  			//echo $this->db->last_query(); exit;
  			return 1;
  		} catch(Exception $e){
  			log_message('error', 'Users::edit'.$e->getMessage());
  			return 0;
  		}
    }

    function checkIfEmailIsChanged($uid){
    	$data = $this->getById($id);
    	if($data['email_id'] == $this->input->post('email_id')){
    		return false;
    	} else {
    		return true;
    	}
    }
    
    function checkIfUserExist($md5EmailId){
    	$data = array();
    	$query = $this->db->get_where($this->tableName, array('md5(email_id)' => $md5EmailId));
    	$data =  $query->row_array();
    	if(count($data))
    		return TRUE;
    	return FALSE;
    }
    
    
    function updateNewPassword($np,$md5EmailId){
    	$data = array();
    	$data['password'] = md5($np);
    	$this->db->where('md5(email_id)', $md5EmailId);
  		try{
  			$this->db->update($this->tableName,$data);
  			//echo $this->db->last_query(); exit;
  			return 1;
  		} catch(Exception $e){
  			log_message('error', 'Users::edit'.$e->getMessage());
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
      $query = $this->db->get_where($this->tableName,array('status'=>1,'role' => 1));
      if ($query->num_rows() > 0){
        $data =  $query->result_array();
      } 
      return $data;
  }

	function get(){
    	$rows = array();
		  $this->db->select($this->selectQuery);
		  $this->db->from($this->tableName);
		  $query = $this->db->get();
		  //echo $this->db->last_query();
		  if ($query->num_rows() > 0){
   			$rows = $query->result_array();
		  } 
		  return $rows;
  } 

    function getByEmail($email){
    	$data = array();
    	$query = $this->db->get_where($this->tableName, array('email_id' => $email));
    	if ($query->num_rows() > 0){
   			$data = $query->row_array();
		} 
    	return $data;
    }
    
    function checkByEmail($email){
    	$query = $this->db->get_where($this->tableName, array('email_id' => $email));
    	if ($query->num_rows() > 0){
			return true;
		} 
    	return false;
    }
		
    function getName($id){
    	$data = $this->getById($id);
    	if(isset($data) && isset($data['name'])) return $data['name'];
    }
    
    function updatePassword($id, $password){
    	$this->db->where('id', $id);
  		try{
  			$this->db->update($this->tableName, array('password'=> $password));
  			//echo $this->db->last_query(); exit;
  			return 1;
  		} catch(Exception $e){
  			log_message('error', 'Users::edit'.$e->getMessage());
  			return 0;
  		}
    }
 
}
?>
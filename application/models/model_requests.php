<?php
class model_requests extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'requests';
        $this->data = array();
       	$this->selectQuery = 'requests.email_id as email_id,
       	                       requests.description as description,
                               requests.created_on as created_on';
    }

	function add($reqid,$reqdesc){
		
      	$this->data['email_id'] = $reqid;
      	$this->data['description'] = $reqdesc;
        $this->data['created_on'] = date('Y-m-d H:i:s');
   
  
  		try{
  			$this->db->insert($this->tableName,$this->data);
     return 1;
  		} catch(Exception $e){
  			log_message('error', 'requests::add'.$e->getMessage());
  			return 0;
  		}
    }
   

}
?>
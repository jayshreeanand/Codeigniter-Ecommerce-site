<?php
class model_subscribe extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'subscribe';
        $this->data = array();
       	$this->selectQuery = 'subscribe.email_id as email_id,
                               subscribe.created_on as created_on';
    }

	function add($scid){
      	$this->data['email_id'] = $scid;
        $this->data['created_on'] = date('Y-m-d H:i:s');
   
  
  		try{
  			$this->db->insert($this->tableName,$this->data);
      $this->session->set_userdata('sub', '1');
    
          		return 1;
  		} catch(Exception $e){
  			log_message('error', 'subscribe::add'.$e->getMessage());
  			return 0;
  		}
    }
   

}
?>
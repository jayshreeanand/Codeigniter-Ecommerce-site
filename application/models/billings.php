<?php
class Billings extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'billing_details';
        
       	$this->selectQuery = '	billing_details.id as id,
                                billing_details.user_id as user_id,
                     			billing_details.first_name as first_name,
                                billing_details.last_name as last_name,
                                billing_details.address1 as address1,
                                billing_details.address2 as address2,
                                billing_details.city as city,
                                billing_details.state as state,
                                billing_details.postal_code as postal_code,
                                billing_details.country as country,
                                billing_details.mobile as mobile,
                                billing_details.created_on as created_on';
    }
    
	function setvalues(){	
    	$this->data = array(   
                                'first_name' => $this->input->post('bfirst'),
                                'last_name' => $this->input->post('blast'),
                                'address1' => $this->input->post('baddress1'),
                                'address2' => $this->input->post('baddress2'),
                                'city' => $this->input->post('bcity'),
                                'state' => $this->input->post('bstate'),
                                'postal_code' => $this->input->post('bpostalcode'),
                                'country' => $this->input->post('bcountry'),
                                'mobile' => $this->input->post('bmobile')
                            );

    }
    
	function add($user_id){
    	$this->setvalues();
    	$id = md5(getmypid().uniqid(rand(), true).$this->session->userdata('session_id'));
    	$this->data['id'] = $id;
    	$this->data['user_id'] = $user_id;
    	$this->data['created_on'] = date('Y-m-d H:i:s');
  		try{
  			$this->db->insert($this->tableName,$this->data);
  			return $id;
  		} catch(Exception $e){
  			log_message('error', 'Billing_details::add'.$e->getMessage());
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
            log_message('error', 'Billing_details::edit'.$e->getMessage());
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
    
    function getByUserId($uid){
        $data = array();
        if($uid !== FALSE){
            $query = $this->db->get_where($this->tableName, array('user_id' => $uid));
        //  echo $this->db->last_query();
            $data =  $query->row_array();
        }
        return $data;
    }
	
    function getByOrderId($uid,$oid){
        $data = array();
		
        if($uid !== FALSE && $oid !== FALSE){
            
			$ship_sql = "select osb.b_first_name as first_name,osb.b_last_name as last_name,osb.b_address1 as address1,osb.b_address2 as address2,osb.b_city as city,osb.b_state as state,osb.b_country as country,osb.b_postal_code as postal_code,osb.b_mobile as mobile from order_shipping_billing_details osb,orders o where o.id=$oid and o.user_id='$uid' and o.id=osb.order_id";
			$query = $this->db->query($ship_sql);
        	if ($query->num_rows() > 0){
            	$data =  $query->result_array();
        	}
			$data=$data[0];
        }
		if(empty($data)) $this->getByUserId($uid);
        return $data;
    }	  
    
    function getUserEmailDetails($uid){
        $data = array();
		
        if($uid !== FALSE ){
            
			$ud_sql = "select email_id from users where id='$uid'";
			$query = $this->db->query($ud_sql);
        	if ($query->num_rows() > 0){
            	$data =  $query->result_array();
        	}
			$data=$data[0];
        }
        return $data;
    }	
}
?>
<?php
class Auth extends CI_Model {

	private $tableName;
	private $secret; 
	
    function __construct(){
        parent::__construct();
        $this->tableName = 'users';
    }
	
	function setSession($data){
		
		$this->session->set_userdata('uid', $data['id']);
		$this->session->set_userdata('e', $data['email_id']);
		$this->session->set_userdata('r', $data['role']);
	}

	function getRandomString($length = 5) {
    	$characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
	    $string = '';

    	for ($i = 0; $i < $length; $i++) {
        	$string .= $characters[mt_rand(0, strlen($characters) - 1)];
    	}

    	return $string;
	}
	
	function authenticate($email,$password){

		
		/*$sql = "select * from orders";		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $data)
			{
			$order_id=$data->id;
			$useridval=$data->user_id;
			if($order_id>97) break;
			$bill_sql = "select * from billing_details where user_id='$useridval'";
			$query = $this->db->query($bill_sql);
        	if ($query->num_rows() > 0){
            	$bill_data =  $query->result_array();
        	}
			$bill_data =$bill_data[0];

			$ship_sql = "select * from shipping_details where user_id='$useridval'";
			$query = $this->db->query($ship_sql);
        	if ($query->num_rows() > 0){
            	$ship_data =  $query->result_array();
        	}			
			$ship_data =$ship_data[0];
		
			$s_first_name=$ship_data['first_name'];
			$s_last_name=$ship_data['last_name'];
			$s_address1=$ship_data['address1'];
			$s_address2=$ship_data['address2'];
			$s_city=$ship_data['city'];
			$s_state=$ship_data['state'];
			$s_postal_code=$ship_data['postal_code'];
			$s_country=$ship_data['country'];
			$s_mobile=$ship_data['mobile'];
			$b_first_name=$bill_data['first_name'];
			$b_last_name=$bill_data['last_name'];
			$b_address1=$bill_data['address1'];
			$b_address2=$bill_data['address2'];
			$b_city=$bill_data['city'];
			$b_state=$bill_data['state'];
			$b_postal_code=$bill_data['postal_code'];
			$b_country=$bill_data['country'];
			$b_mobile=$bill_data['mobile'];
			
			$sql = "insert into  order_shipping_billing_details(order_id,s_first_name,s_last_name,s_address1,s_address2,s_city,s_state,s_postal_code,s_country,s_mobile,b_first_name,b_last_name,b_address1,b_address2,b_city,b_state,b_postal_code,b_country,b_mobile)
					VALUES ($order_id,'$s_first_name','$s_last_name','$s_address1','$s_address2','$s_city','$s_state','$s_postal_code','$s_country','$s_mobile','$b_first_name','$b_last_name','$b_address1','$b_address2','$b_city','$b_state','$b_postal_code','$b_country','$b_mobile')";
			$this->db->query($sql);
			error_log($this->db->last_query());
			}
		}
		*/
		/*
		$sql = "select * from recipes where recipe_code=''";		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $data)
			{
				$cnt=0;
				do
				{
				$str="RE_".$this->getRandomString(5);
				$chk_sql = "select * from recipes where recipe_code='".$str."'";	
				$chk_query = $this->db->query($chk_sql);	
					if ($chk_query->num_rows() == 0) 
					{
						$upd_query="update recipes set recipe_code='".$str."' where id='".$data->id."'";
						$this->db->query($upd_query);
						$cnt++;
					}
				}while ($cnt<=0);				
			}
		}		

		$sql = "select * from ingredients where ingredient_code=''";		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $data)
			{
				$cnt=0;
				do
				{
				$str="IN_".$this->getRandomString(5);
				$chk_sql = "select * from ingredients where ingredient_code='".$str."'";	
				$chk_query = $this->db->query($chk_sql);	
					if ($chk_query->num_rows() == 0) 
					{
						$upd_query="update ingredients set ingredient_code='".$str."' where id='".$data->id."'";
						$this->db->query($upd_query);
						$cnt=1;
					}
				}while ($cnt<=0);			
			}
		}
		*/

		$sql = "select * from ".$this->tableName." where ";
		$sql .= " email_id = '".$email."' and password='".md5($password)."'";
		$sql .= " and status=1";
		
		$query = $this->db->query($sql);

		$data = array();
		if ($query->num_rows() > 0) {
			$data = $query->row_array();
			$this->setSession($data);
			return TRUE;
		}
		return FALSE;
	}


	function canWeSendForgotPasswordMail(){
		$sql = "select * from users where email_id = '".$this->input->post('e')."'";
		$query = $this->db->query($sql);
	
		$data = array();
		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
}
?>
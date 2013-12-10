<?php
class Orders extends CI_Model {
	
	function __construct(){
        parent::__construct();
        $this->tableName = 'orders';
        
       	$this->selectQuery = '	orders.id as id,
                     			orders.user_id as user_id,
                                orders.total as total,
                                orders.shipping as shipping,
                   				orders.status as status,
                                orders.payment_mode as payment_mode,
                                orders.created_on as created_on';
    }
    
    
	function add(){

        $this->db->select_max('id');
        $query = $this->db->get($this->tableName);
        $data =  $query->result_array();
        $order_id = (int)$data[0]['id'];
		$ordered_date = $data[0]['created_on'];
        $order_id += 1;
		$useridval= $this->session->userdata('uid');
		$shipcostval=$this->input->post('shipping');
		if(empty($shipcostval)) $shipcostval=$this->session->userdata('shipcost');
        //$total = (float)$this->input->post('shipping') + (float)$this->cart->total();
        $total = (float)$shipcostval + (float)$this->cart->total();
        /* if($total < $this->config->item('max_amount_to_avoid_shipping') ){
             $total += $this->config->item('shipping_charges');
        } */

        $this->data = array();
        $this->data['id'] = $order_id;
        $this->data['user_id'] = $this->session->userdata('uid');
    	$this->data['status'] = 0;
        $this->data['total'] = $total;
        //$this->data['shipping'] = $this->input->post('shipping');
        $this->data['shipping'] = $shipcostval;
    	//$this->data['created_on'] = date('Y-m-d H:i:s');
    	$this->data['created_on'] = $ordered_date;
		
		$this->session->set_userdata('shipcost', 0);
		
  		try{
  			$this->db->insert($this->tableName,$this->data);
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
		
			$s_first_name=mysql_real_escape_string($ship_data['first_name']);
			$s_last_name=mysql_real_escape_string($ship_data['last_name']);
			$s_address1=mysql_real_escape_string($ship_data['address1']);
			$s_address2=mysql_real_escape_string($ship_data['address2']);
			$s_city=mysql_real_escape_string($ship_data['city']);
			$s_state=mysql_real_escape_string($ship_data['state']);
			$s_postal_code=mysql_real_escape_string($ship_data['postal_code']);
			$s_country=mysql_real_escape_string($ship_data['country']);
			$s_mobile=mysql_real_escape_string($ship_data['mobile']);
			$b_first_name=mysql_real_escape_string($bill_data['first_name']);
			$b_last_name=mysql_real_escape_string($bill_data['last_name']);
			$b_address1=mysql_real_escape_string($bill_data['address1']);
			$b_address2=mysql_real_escape_string($bill_data['address2']);
			$b_city=mysql_real_escape_string($bill_data['city']);
			$b_state=mysql_real_escape_string($bill_data['state']);
			$b_postal_code=mysql_real_escape_string($bill_data['postal_code']);
			$b_country=mysql_real_escape_string($bill_data['country']);
			$b_mobile=mysql_real_escape_string($bill_data['mobile']);
			
			$sql = "insert into  order_shipping_billing_details(order_id,s_first_name,s_last_name,s_address1,s_address2,s_city,s_state,s_postal_code,s_country,s_mobile,b_first_name,b_last_name,b_address1,b_address2,b_city,b_state,b_postal_code,b_country,b_mobile)
					VALUES ($order_id,'$s_first_name','$s_last_name','$s_address1','$s_address2','$s_city','$s_state','$s_postal_code','$s_country','$s_mobile','$b_first_name','$b_last_name','$b_address1','$b_address2','$b_city','$b_state','$b_postal_code','$b_country','$b_mobile')";
			$this->db->query($sql);
			error_log($this->db->last_query());
			
            foreach ($this->cart->contents() as $items){
                $iid = $items['id'];
                $price = $items['price'];
                $qty = $items['qty'];
                $time = date('Y-m-d H:i:s');
                $sql = "insert into order_line_items(order_id,ingredient_id,cost,quantity,created_on)
                        VALUES ($order_id,'$iid',$price,$qty,'$time')";
                $this->db->query($sql);
                error_log($this->db->last_query());
            }
            return $order_id;
  		} catch(Exception $e){
  			log_message('error', 'Orders::add'.$e->getMessage());
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
            log_message('error', 'Orders::edit'.$e->getMessage());
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
    

    function getAll($status){
        $data = array();

/*        $sql  = "   SELECT o.id as orid,o.user_id as user_id,o.total as total,o.shipping as shipping,o.status as status,o.payment_mode as payment_mode,o.created_on as created_on,s.* 
                    FROM orders as o 
                    INNER JOIN users as u ON o.user_id = u.id
                    INNER JOIN shipping_details as s ON s.user_id = u.id";
*/        $sql  = "   SELECT o.id as orid,o.user_id as user_id,o.total as total,o.shipping as shipping,o.status as status,o.payment_mode as payment_mode,o.created_on as created_on,osb.s_first_name as first_name,osb.s_last_name as last_name,osb.s_address1 as address1,osb.s_address2 as address2,osb.s_city as city,osb.s_state as state,osb.s_country as country,osb.s_postal_code as postal_code,osb.s_mobile as mobile 
                    FROM orders as o 
                    INNER JOIN users as u ON o.user_id = u.id
                    INNER JOIN order_shipping_billing_details as osb ON osb.order_id = o.id";
        if(is_int($status)){
             $sql .= "  WHERE o.status = ".$status;
        }
         $sql .= "  ORDER BY o.id DESC";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
       // print_r($data); exit;
        return $data;
    }


    function abort($orderid){
        $this->data = array();
        $this->data['status'] = 5;
        $this->db->where('id', $orderid);
        try{
            $this->db->update($this->tableName,$this->data);
            //echo $this->db->last_query(); exit;
            return 1;
        } catch(Exception $e){
            log_message('error', 'Orders::edit'.$e->getMessage());
            return 0;
        }
    }

    function updateStatus($orderid,$status){
		 $ordDataArr=$this->getById($orderid);
		 $this->data = array();
    	 $this->data['status'] = $status;
		 $this->data['created_on'] = $ordDataArr['created_on'];
         $this->db->where('id', $orderid);
        try{
            $this->db->update($this->tableName,$this->data);
            //echo $this->db->last_query(); exit;
            return 1;
        } catch(Exception $e){
            log_message('error', 'Orders::edit'.$e->getMessage());
            return 0;
        }
    }

    function updatePaymentMode($oid,$pm=''){
        $data = array();
		$pmval=$this->input->post('payment_mode');
		if(!empty($pm)) $pmval=$pm;
        $data['payment_mode'] = $pmval;
        $this->db->where('id', $oid);
        try{
            $this->db->update($this->tableName,$data);
          //  echo $this->db->last_query(); exit;
        } catch(Exception $e){
            log_message('error', 'Orders::updatePaymentMode'.$e->getMessage());
            return 0;
        }
	}

    function isMyOrder($orderid){
        $query = $this->db->get_where($this->tableName,array('id' => $orderid,'user_id' => $this->session->userdata('uid')));
        if ($query->num_rows() > 0){
            return TRUE;
        } 
        return FALSE;
    }

    function getLineItems($orderid){
        $data = array();

        $sql  = " SELECT oli.*,i.name 
                  FROM order_line_items as oli INNER JOIN ingredients as i  ON oli.ingredient_id = i.id 
                  where oli.order_id = $orderid";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $data =  $query->result_array();
        } 
       // print_r($data); exit;
        return $data;
    }

}
?>
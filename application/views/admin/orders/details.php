<?php 
$staticContentUrl = base_url(); 
$this->load->view('admin/header', array('pageTitle' => 'Cuisine Management','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
$os = $this->config->item('order_status');
?>
<?php $this->load->view('admin/orders/menu');?>

<!--main contents area starts here -->
<style>
p span{
	font-weight: bold;
}
.orders_right {
	float:left;
	width:300px;
}
</style>
<div class="table-wrapper">
	<?php if($success){?>
	<div class="well alert alert-success">Order Status Updated</div>
	<?php }?>
	<div class="orders_right">
	    <div class="orders_left_top1">
		    <h2>Order Summary</h2> 
		</div> 
	    <div class="orders_left_top2">
			 <p>Order ID: <span><?php echo $data['id'];?></span></p>
		</div>  
	    <div class="orders_left_top3">
		     <p>Ordered Date: <span><?php echo date("d F, Y h:m A",strtotime($data['created_on'])); ?><br/><?php date("F j, Y, g:i a",$createdontime);?></span></p>
		</div>  
		<div class="orders_left_top4">   
			<p>Payment Mode: <span><?php echo $data['payment_mode'];?></span></p>
		</div> 
	    <div class="orders_left_top4">
		    <p>Total: <span class="WebRupee">&#x20B9;</span> <span><?php echo $data['total'];?></span></p>
			<p>Current Status: <span><?php echo $os[$data['status']];?></span></p>
		</div>  
		 <div class="orders_left_top4">
		   <br/>
			<p>Update Status To: 
					<form name="statusupdate" id="statusupdate" method="post" action="<?php echo site_url('adminorder/details/'.$this->uri->segment(3));?>">
							<select name="nstatus" id="nstatus">
								<option value="">Change Status</option>
								<?php foreach($this->config->item('order_status') as $k=>$v){?>
								<option value="<?php echo $k;?>"><?php echo $v;?></option>
								<?php }?>
							</select>
							<input type="submit" name="submit" class="btn-primary" value="update" />
					</form>
			</p>
		</div>  
		<br/><br/>	
	</div>									

	<div class="orders_right">
	    <div class="orders_right_top1">
		    <h2>Shipping Address</h2> 
		</div> 
	    <div class="orders_right_top2">
		    <span><?php echo $shipping['first_name'].' '.$shipping['last_name'];?></span>
			<p><?php echo $shipping['address1'];?></p>
			<p><?php echo $shipping['address2'];?></p>
			<p><?php echo $shipping['city'];?>, <?php echo getStateName($shipping['state'],$shipping['country']);?></p>
			<p><?php echo $shipping['postal_code'];?></p>
			<p><?php echo getCountry($shipping['country']);?></p>
			<p><?php echo $shipping['mobile'];?></p>
            <p><?php echo $userdetails['email_id'];?></p>
		</div>  
	</div> 		
	<div class="orders_right">
	    <div class="orders_right_top1">
		    <h2>Billing Address</h2> 
		</div> 
	    <div class="orders_right_top2">
		    <span><?php echo $billing['first_name'].' '.$billing['last_name'];?></span>
			<p><?php echo $billing['address1'];?></p>
			<p><?php echo $billing['address2'];?></p>
			<p><?php echo $billing['city'];?>, <?php echo getStateName($billing['state'],$billing['country']);?></p>
			<p><?php echo $billing['postal_code'];?></p>
			<p><?php echo getCountry($billing['country']);?></p>
			<p><?php echo $billing['mobile'];?></p>
		</div> 
	</div> 									
	<table class="table">
		<tr>
			<th>Item Description</th>
			<th>Price</th>
			<th>Qty</th>
			<th>Subtotal</th>
		</tr>
		<?php foreach($line_items as $lt){?>
		<tr>
			<td><?php echo $lt['name'];?></td>
			<td><span class="WebRupee">&#x20B9;</span> <?php echo $lt['cost'];?> </td>
			<td><?php echo $lt['quantity'];?></td>
			<td><span class="WebRupee">&#x20B9;</span> <?php echo $lt['quantity']*$lt['cost'];?></td>
		</tr>
		<?php }?>	
		<tr>
			<td colspan="3">Shipping</td>
			<td><?php echo ($data['shipping'] == 0) ? 'FREE' : $data['shipping']; ?></td>
		</tr>	
		<tr>
			<td colspan="3">Total</td>
			<td><span class="WebRupee">&#x20B9;</span> <?php echo $data['total'];?></td>
		</tr>						
	</table>								
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>

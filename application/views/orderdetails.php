<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'My Order Details','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
$os = $this->config->item('order_status');
?>

<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>

	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>My Orders</h4>					
				</div>
					<form name="order" method="post" action="<?php echo site_url('shopaway');?>">
				<div class="orders terms container">
	                <div class="orders_top">
					    <div class="orders_left span8">
						    <div class="orders_left_top1">
							    <h2>Order Summary</h2> 
							</div> 
						    <div class="orders_left_top2">
							     <span><?php echo count($line_items);?> Item</span>
								 <p>Order ID: <span><?php echo $data['id'];?></span></p>
							</div>  
						    <div class="orders_left_top3">
							     <p>Date: <span><?php echo date("d F, Y h:m A",strtotime($data['created_on'])); ?><br/><?php date("F j, Y, g:i a",$createdontime);?></span></p>
							</div>  
						    <div class="orders_left_top4">
							    <p>Total: <span style="left:0px;top:0px;" class="WebRupee">&#x20B9;</span> </p><h5> <?php echo $data['total'];?></h5>
								<div class="squaredFour2">
									<input type="checkbox" value="None" id="squaredFour2" name="check" checked disabled="true" />
									<label for="squaredFour2"></label>
								</div>
								<span><?php echo $os[$data['status']];?></span>
							</div>  										
						</div> 
					    <div class="orders_right span4">
						    <div class="orders_right_top1">
							    <h2>Shipping Address</h2> 
							</div> 
						    <div class="orders_right_top2">
							    <span><?php echo $shipping['first_name'].' '.$shipping['last_name'];?></span>
								<p>	<?php echo $shipping['address1'];?></p>
								<p>	<?php echo $shipping['address2'];?></p>
								<p>	<?php echo $shipping['city'];?>, <?php echo getStateName($shipping['state'],$shipping['country']);?></p>
								<p>	<?php echo $shipping['postal_code'];?></p>
							</div>  
						    <div class="orders_right_top3">
								<p><?php echo $shipping['mobile'];?></p>
                                <p><?php echo $this->session->userdata('e');?></p>
							</div> 									
						</div> 									
					</div> 
					<div class="orders_top2">
					    <p>Item Description</p>
						<ul>
							<li>Price</li>
							<li>Qty.</li>
							<li>Subtotal</li>
						</ul>
					</div>
					<div class="orders_top3">
						<?php 
						foreach($line_items as $lt){?>
						<ul>
						    <li><p><?php echo $lt['name'];?></p></li>
							<li><span class="WebRupee">&#x20B9;</span> <?php echo $lt['cost'];?> </li>
							<li><?php echo $lt['quantity'];?></li>
							<li><span class="WebRupee">&#x20B9;</span> <?php echo $lt['quantity']*$lt['cost'];?></li>
						</ul>
						<?php }?>								
					</div>
					<div class="orders_top4">
						<ul>
							<li>Shipping</li>
							<li><span class="WebRupee">&#x20B9;</span> <?php echo ($data['shipping'] == 0) ? 'FREE' : $data['shipping']; ?></li>
						</ul>								
					</div>
					<div class="orders_top5">
						<ul>
							<li>Total</li>
							<li><span class="WebRupee">&#x20B9;</span> <?php echo $data['total'];?></li>
						</ul>								
					</div>								
	                <input type="submit" class="oredr_submit" /> 
                    </from>  								
			    </div>			
			</div>   	
        </div>
    </div>	
</div>

<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array()));?>

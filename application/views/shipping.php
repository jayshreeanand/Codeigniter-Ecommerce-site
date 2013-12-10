<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Shipping','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();


if($data){
	$first = $data['first_name'];
	$last = $data['last_name'];
	$address1 = $data['address1'];
	$address2 = $data['address2'];
	$city = $data['city'];
	$state = $data['state'];
	$postalcode = $data['postal_code'];
	$mobile = $data['mobile'];

	$bfirst = $bdata['first_name'];
	$blast = $bdata['last_name'];
	$baddress1 = $bdata['address1'];
	$baddress2 = $bdata['address2'];
	$bcity = $bdata['city'];
	$bstate = $bdata['state'];
	$bcountry = $bdata['country'];
	$bpostalcode = $bdata['postal_code'];
	$bmobile = $bdata['mobile'];

	$email = $this->session->userdata('e') ? $this->session->userdata('e') : set_value('email');
} else {
	$first = set_value('first');
	$last = set_value('last');
	$address1 = set_value('address1');
	$address2 = set_value('address2');
	$city = set_value('city');
	$state = set_value('state');
	$postalcode = set_value('postalcode');
	$mobile = set_value('mobile');

	$bfirst = set_value('bfirst');
	$blast = set_value('blast');
	$baddress1 = set_value('baddress1');
	$baddress2 = set_value('baddress2');
	$bcity = set_value('bcity');
	$bstate = set_value('bstate');
	$bpostalcode = set_value('bpostalcode');
	$bmobile = set_value('bmobile');

	$email = set_value('email');
}

$itemCount = $this->cart->total_items();
?>

<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>

<form method="post" name="shipping-form" id="shipping-form" action="<?php echo site_url('shipping');?>" >
	
	<?php if(!$isLoggedIn){?> 
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main" style="height:200px;">
			    <div class="gredient_main_top container">
				    <h4>Checkout</h4>		
				</div>
				
                <div class="shipping_main container">
	                <div class="shipping_main_left">	      
					    <span>Provide your email address to send order details</span> 
					    <p>Indicates required field</p> 
					  
						    <ul>
						    	<?php if($errors){?>
									<?php echo $errors;?>
								<?php } ?>
						    	<li>
								    <label>Email Address</label>
								    <input type="text" name="email" name="email" id="email" value="<?php echo $email;?>" />
								</li>								
						    </ul>
						  
					</div>				
				</div> 				
			</div>   
        </div>
    </div>	
    <?php } else if($isLoggedIn){?> 
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main" style="height:80px;">
                <div class="shipping_main container">
	                <div class="shipping_main_left">	      
						    <ul>
						    	<?php if($errors){?>
									<?php echo $errors;?>
								<?php } ?>
						    </ul>
						  
					</div>				
				</div> 				
			</div>   
        </div>
    </div>	
    <?php } ?>			
	
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Shipping Details</h4>		
				</div>
				
                <div class="shipping_main container">
	                <div class="shipping_main_left">    
					    <span>Enter a Shipping Address</span> 
					    <p>Indicates required field</p> 
					   		<ul>
						    	<li>
								    <label>First Name</label>
								    <input type="text" name="first" id="first" value="<?php echo $first;?>" />
								</li>
						    	<li>
								    <label>Last Name</label>
								    <input type="text" name="last" id="last" value="<?php echo $last;?>"/ />
								</li>
						    	<li>
								    <label>Address 1</label>
								    <input type="text" name="address1" id="address1" value="<?php echo $address1;?>"//>
								</li>	
						    	<li>
								    <label>Address 2</label>
								    <input type="text" name="address2" id="address2" value="<?php echo $address2;?>"/ />
								</li>
						    	<li>
								    <label>City</label>
								    <input type="text" name="city" id="city" value="<?php echo $city;?>"//>
								</li>
								<li>
								    <label>Country</label>
								    <h6>India</h6>
								</li>
						    	<li>
								    <label>State/Province</label>
								   	<select class="styled1" name="state" id="state" style="width:176px;margin-left:-8px;margin-bottom:7px;">
										<option class="">--Select State--</option>
										<?php foreach($this->config->item('356states') as $statekey=>$statename){?> 
										<option value="<?php echo $statekey;?>" <?php if($state == $statekey){ echo 'selected';}?> ><?php echo $statename;?></option>
										<?php }?>
									</select>
								</li>
						    	<li>
								    <label>Postal Code</label>
								    <input type="text" name="postalcode" id="postalcode" value="<?php echo $postalcode;?>" />
								</li>
						    	
						    	<li>
								    <label>Mobile Phone</label>
								    <input type="text" name="mobile" id="mobile" value="<?php echo $mobile;?>" />
								</li>							
						    </ul> 
						    
					</div>
					<?php if($itemCount){?> 
	                <div class="payment_main_right">
					    <div class="payment_main_right_inner">
						    <div class="order_summery1">
							    <p>Order Summary</p>
								<span>Items:<?php echo $itemCount;?></span>
								<a href="<?php echo site_url('ggcart');?>">Edit Cart</a>
							</div> 
						     <?php foreach ($this->cart->contents() as $items){?>
						    <div class="order_summery2">
							   
							    <div class="or_right">
							    	<p><?php echo $items['name'];?></p>
								    <ul>
								    	<li><?php echo $items['qty'].' X  <span class="WebRupee">&#x20B9;</span> '.$this->cart->format_number($items['price']).'  = ';?></li>
										<li style="padding-left:3px;"> <span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($items['qty']*$items['price']);?></li> 
									</ul>
								</div>   
							</div> 
							 <?php } ?>
						    <div class="order_summery3">
							    <ul class="os_l">
							    	<li>Subtotal</li>
							    	<li>Discount</li>
							    	<li>Order Total</li>
							    </ul>
							    <ul class="os_r">
							    	<li><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()); ?></li>
							    	<li>-<span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()-$this->cart->total_discount()); ?></li>
							    	<li><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total_discount()); ?></li>
							    </ul>								
							</div> 							
						</div>   
					</div> 
					<?php }?>                  				
				</div> 				
			</div>   	
        </div>
    </div>	


    <div class="container" style="clear:both;">
	    <div class="row-fluid">
			<div class="gredient_main billing_detail1">
			    <div class="gredient_main_top container">
				    <h4>Billing Details</h4>		
				</div>
				
                <div class="shipping_main container">
	                <div class="shipping_main_left">
								<div class="squaredFour">
									<input type="checkbox" value="1" id="squaredFour" onclick="copystoa()" name="check" />
									<label for="squaredFour"></label>
								</div>
						<h3 class="checkboxH3">Same as Shipping Address</h3>      
					    <span>Enter a Billing Address</span> 
					    <p>Indicates required field</p> 
				
						    <ul>
						    	<li>
								    <label>First Name</label>
								    <input type="text" name="bfirst" id="bfirst" value="<?php echo $bfirst;?>" />
								</li>
						    	<li>
								    <label>Last Name</label>
								    <input type="text" name="blast" id="blast" value="<?php echo $blast;?>"/ />
								</li>
						    	<li>
								    <label>Address 1</label>
								    <input type="text" name="baddress1" id="baddress1" value="<?php echo $baddress1;?>"//>
								</li>	
						    	<li>
								    <label>Address 2</label>
								    <input type="text" name="baddress2" id="baddress2" value="<?php echo $baddress2;?>"/ />
								</li>
						    	<li>
								    <label>City</label>
								    <input type="text" name="bcity" id="bcity" value="<?php echo $bcity;?>"//>
								</li>
								<li>
								    <label>Country</label>
								    <select class="styled1" name="bcountry" id="bcountry" style="width:176px;margin-left:43px;margin-bottom:7px;">
										<option selected >--Select Country--</option>
										<?php foreach($this->config->item('country') as $countrykey=>$countryname){?> 
										<option value="<?php echo $countrykey;?>" <?php if($bcountry == $countrykey){ echo 'selected';}?> ><?php echo $countryname;?></option>
										<?php }?>
									</select>
								</li>
						    	<li>
								    <label>State/Province</label>
								   		<select class="styled1" name="bstate" id="bstate" style="width:176px;margin-left:-8px;margin-bottom:7px;" >
											<option selected >--Select State--</option>
											<?php foreach($this->config->item($bcountry.'states') as $statekey=>$statename){?> 
											<option value="<?php echo $statekey;?>" <?php if($bstate == $statekey){ echo 'selected';}?> ><?php echo $statename;?></option>
										<?php }?>
										</select>
								</li>
						    	<li>
								    <label>Postal Code</label>
								    <input type="text" name="bpostalcode" id="bpostalcode" value="<?php echo $bpostalcode;?>" />
								</li>
						    	
						    	<li>
								    <label>Mobile Phone</label>
								    <input type="text" name="bmobile" id="bmobile" value="<?php echo $bmobile;?>" />
								</li>								
						    </ul>

                            <input type="submit" class="cancel" value="submit" />	
                             <?php if($data){ ?> 						
							<input type="submit" class="checkout" name="update"  value="submit" />
							<?php } else { ?>
							<input type="submit" class="checkout" name="add"  value="submit" />
							<?php } ?>
				
					</div>				
				</div> 				
			</div>   
        </div>
    </div>		
</form>
<?php $this->load->view('footer', array('jsFiles' => array('js/shipping/shipping.js'))); ?>


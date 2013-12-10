<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Cart','cssFiles' =>array())); 
$itemCount = (int)$this->cart->total_items();

?>
<style>
.c_left_right{
	width: 485px;
}
.c_left_right p{
	width:366px;
}

</style>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>My Cart</h4>
				    <?php if($itemCount){?>
                    <h6>(<span><?php echo (int)$itemCount;?></span> items)</h6> 
                    <?php }?>					
				</div>
				<?php if($itemCount) { ?> 
                <div class="gredient_main_bottom container">
	                <div class="cartpage_one">
					    <ul class="cartpage_one_left">
					    	<li>Item</li>
					    	<li>Description</li>
					    </ul>  
					    <ul class="cartpage_one_right">
					    	<li>Price</li>
					    	<li>Quantity</li>
					        <li>Total</li>
						</ul>  						
					</div><!--end cartpage one--> 
                   
				    <?php foreach ($this->cart->contents() as $items){?>
				     <div class="cartpage_two">
                        <div class="cartpage_two_left">
						    <img style="width:73px;height:73px;" src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $items['id'];?>/<?php echo $items['options']['image1'];?>" alt="product" />    
						    <div class="c_left_right">
							    <p><?php echo $items['name'];?><br />  <a href="<?php echo site_url('ggcart/remove/'.$items['rowid']);?>">Remove</a></p> 
							   	<!-- span>In Stock</span><br / -->  
							    <!--ul>
							    	<li><a href="<?php //echo site_url('ggcart/remove/'.$items['rowid']);?>">Remove</a></li>
							    	<!--li><a href="#">Save For Later</a></li>
							    </ul-->
							</div>
						</div> 
                        <div class="cartpage_two_right">
						    <ul>
						    	<li style="width: 144px;"><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($items['price']);?></li>
						    	<li><input type="text" name="qty" maxlength="4"  placeholder="1" style="width:50px" value="<?php echo $items['qty'];?>" /><br /><a href="#" data-row-id="<?php echo $items['rowid'];?>" class="update">Update</a></li>
						    	<li style="text-align:right;"><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($items['subtotal']);?></li>

						    </ul> 
						</div>  						
				    </div><!--end cartpage two-->
				     <?php } ?>
                    <div class="cartpage_three">
					    <div class="cartpage_three_inner">
							<ul class="cartpage_three_left">
															
								<li>Subtotal</li>
								<li>Discount</li>
								<li style="margin-top:5px;">Order Total</li>
							</ul>
							<ul class="cartpage_three_right">
							<li><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()); ?></li>
								<li>-<span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total()-$this->cart->total_discount()); ?> </li>
								<li><span class="WebRupee">&#x20B9;</span> <?php echo $this->cart->format_number($this->cart->total_discount()); ?>
								</li>
							</ul>							
						</div>	
				    </div><!--end cartpage three-->	
				     
           
                    <div class="cartpage_four">
                  
                   
                        <div class="cartpage_four_inner"> 
                        <div class ="cartpage_four_inner_coupon">

                        <input type="text" name="qty" maxlength="15"  placeholder="" style="width:100px"  value="" /><br /><a href="#"  class="update_options"><?php echo ($this->cart->total()-$this->cart->total_discount()) > 0? 'Remove Coupon':'Apply Coupon';?> <br/> </a>
                          </div> 
							<a href="<?php echo site_url('shopaway');?>"><img type="image" src="<?php echo $staticContentUrl;?>images/cartpage2.png" alt="shopaway" /></a>
							<a href="<?php echo site_url('shipping');?>"><img src="<?php echo $staticContentUrl;?>images/cartpage3.png" alt="shipping" /> </a>
						</div>	
				    </div><!--end cartpage four-->						
				</div> 	
				<?php } else {?>
					 <div class="gredient_main_bottom container">
		                <div class="cartpage_one">
						    <ul class="cartpage_one_left">
						    	<li>Cart is Empty</li>
						   	</ul>  
						    <ul class="cartpage_one_right">
						    	<li><a href="<?php echo site_url('shopaway');?>"><img type="image" src="<?php echo $staticContentUrl;?>images/cartpage2.png" alt=" " /></a></li>
							</ul>  						
						</div><!--end cartpage one--> 
					</div>
				<?php }?>			
			</div>   	
        </div>
    </div>	
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.raty.js','js/cart/cart.js' ))); ?>

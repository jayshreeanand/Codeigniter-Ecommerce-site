<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'My Order','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
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
                <div class="box-part container">
	                <div class="box contact">
					    <div class="box-area">
						   <h3 class="border">Order Status</h3>
						   <h4>Check Order Status</h4>
							<p>Now you can track the progress of your order right here!</p>
							<p>Enter your Order ID below and click “GO” to view details of your order.</p>
							<form name="order" method="post" action="<?php echo site_url('user/myorder');?>">
								<?php if($error){ ?>
									<span style="color:red"><?php echo $error;?></span>
								<?php } ?>
								<div class="order-area">
									<input type="text" name="orderid" id="orderid" /><input type="submit" />
								</div>
							</form>
						</div>
					</div>                 				
				</div> 				
			</div>   	
        </div>
    </div>	
</div>


<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array()));?>

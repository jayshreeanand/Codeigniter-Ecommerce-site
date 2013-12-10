<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Payment Completed','cssFiles' =>array())); 
$itemCount = $this->cart->total_items();
?>

<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Payment Information</h4>					
				</div>
				
                <div class="payment_complete_main container" style="height:330px;">
	                <div class="payment_main_left">
					    <div class="payment_main_left_top">
						    <img src="<?php echo $staticContentUrl;?>images/payment1.png" alt="DONE" /> 
							<p>Payment Complete</p>
						</div>
						<div style="padding:0px 40px; margin-top:84px;" >
							<?php 
								$Order_Id = $this->session->userdata('oid');
								if($message==1) { ?>
							<p>Thank you for your order! Your order will be delivered in 3-6 days.</p>
                            <p>Your Order number: <strong><?php echo $Order_Id;?></strong>.</p>
							<p>If you chose to pay by Credit/Debit Card, You will receive an email in a few days with the
payment link. Please do note that your order processing will begin immediately!</p>
							<p>We hope that you enjoyed your experience with Global Graynz and look forward to having you
back soon. If you have any feedback on our website/experience please feel free to <a href="mailto:email@globalgraynz.com">email</a> or <a href="<?php site_url('contactus');?>">call
us</a></p>
							<?php } else if($message==2) { ?>
							<p>Thank you for your order! We will keep you posted regarding the status of your order through e-mail.</p>
                            <p>Your Order number: <strong><?php echo $Order_Id;?></strong>.</p>
							<p>If you chose to pay by Credit/Debit Card, You will receive an email in a few days with the
payment link. Please do note that your order processing will begin immediately!</p>
							<p>We hope that you enjoyed your experience with Global Graynz and look forward to having you
back soon. If you have any feedback on our website/experience please feel free to <a href="mailto:email@globalgraynz.com">email</a> or <a href="<?php site_url('contactus');?>">call
us</a></p>							
							<?php } else if($message==3) { ?>
							<p>Thank you for your order! However,the transaction has been declined.</p>
							<p>If you chose to pay by Credit/Debit Card, You will receive an email in a few days with the
payment link. Please do note that your order processing will begin immediately!</p>
							<p>We hope that you enjoyed your experience with Global Graynz and look forward to having you
back soon. If you have any feedback on our website/experience please feel free to <a href="mailto:email@globalgraynz.com">email</a> or <a href="<?php site_url('contactus');?>">call
us</a></p>							
							<?php } ?>
							</div>
					  		
						<a href="<?php echo site_url('/');?>" class="homee"><img class="continue" src="<?php echo $staticContentUrl;?>images/payment_complete1.png" alt="cartpage continue" /></a>
											
					</div>                 				
				</div> 				
			</div>   	
        </div>
    </div>	
</div>
<?php $this->load->view('footer', array('jsFiles' => array())); ?>


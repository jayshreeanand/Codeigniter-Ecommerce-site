<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Contact Us','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
?>
<style>
.bulleted-list{
	margin-left: 9px;
	list-style-type: disc;
}
.bulleted-list li{
	list-style-type: disc;
	margin:5px;
}

</style>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Contact Us</h4>					
				</div>
				
                <div class="box-part container">
	                <div class="box contact">
					    <div class="box-area">	<br/>
						   	<p>Want a certain product? – Do drop us a note and we'll make it happen. 
						   	</p>
						   	<p>We love feedback - good or bad, do let us know how we are doing.  
						   		We strive to put a smile on your face!
						   	</p>
							<h3>Drop Us A Note</h3>
						<form name="contact-form" id="contact-form" method="post" action="<?php echo site_url('contactus');?>">
							<ul class="contact-form">
								<?php if($success){ ?><li>Thank you! for your message, we will get back to you soon.</li><?php } ?>
								<li><div id="contact-error-maessage" 
						    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
						     	<?php if(isset($error) && (strlen($error) > 3)){ 
						     		echo '<button class="close" data-dismiss="alert">x</button>';
						     		echo  $error;
						     	} else { 
						     		echo '&nbsp;';
						     	}?>
						     </div></li>
								<li><label>Name</label><input type="text" name="name"  id="name" /></li>
								<li><label>Email</label><input type="text" name="email"  id="email" ></li>
								<li><label>Phone</label><input type="text" name="phone"  id="phone" /></li>
								<li><label>Subject</label><input type="text" name="subject"  id="subject" /></li>
								<li><label>Message</label><textarea rows="10" cols="10" name="message"  id="message" ></textarea></li>
								<li><input type="submit" class="sub-btn" /></li>
							</ul>	
						</form>	
                     		<p>
						   		If you ever think we can help you with something: 
						   	</p>

						   	<ul class="bulleted-list">
						   		<li> Do you want to know how to use an ingredient?</li>
						   		<li>Would you like to see a certain recipe/product on the site?</li>
								<li>Would you like your products packed a certain way?</li>
								<li> Or pretty much anything else...</li>
						   	</ul>
						   	<br/>	
						   	<p>Feel free to give us a call or send us an email and we'll make it happen.  
						   		That is just one way we show you how important you are to us and is where the Global Graynz experience begins!!</p>

						   <p>
							India <br/>
							Office: A-4, 38, 18th Avenue, Ashok Nagar, Chennai 600083<br/>
							Phone: 91-9884457540, 044-4216-8588<br/><br/>

							USA<br/>
							Phone:  1-425-591-9846<br/><br/>

							E-mail: <a href="mailto:email@globalgraynz.com">email@globalgraynz.com</a><br/>
							</p>
						</div>

					</div>                 				
				</div> 				
			</div>   	
        </div>
    </div>	
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/contactus/contactus.js')));?>

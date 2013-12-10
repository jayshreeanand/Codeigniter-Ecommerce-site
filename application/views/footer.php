<?php 
$staticContentUrl = base_url();
$isLoggedIn = isLoggedIn();
$jsFile =''; 
if(isset($jsFiles))
{
	foreach($jsFiles as $jsF)
	{
		$jsFile .= '<script type="text/javascript" src="'.$staticContentUrl.$jsF.'"></script> ';
	}
}
?>


<?php if(!$isLoggedIn){?> 
<div class="requests_wrap" style="display:none;">
    <div class="requests_main">
	    <div class="requests_inner">
		    <div class="requests_inner_top">
			    <h6 style="font-size:19px;line-height:0px;" >Tell us what you want!</h6>
                <a href="#" id="requests-close"><img src="<?php echo $staticContentUrl;?>images/login-registration1.png" alt="requests a product"/></a>  				
			</div>  
		    <div class="requests_inner_middle">
			    <form name="requests-requests" id="requests-form" action="<?php site_url('requests/addrequests')?>" method="post">
				    <div class="requests_input_div2">
						<input type="text" name="reqemail_id" id="reqemail_id" class="first2" placeholder="Email Address" maxlength="100" autocomplete="off"/>
					</div>
					<div class="requests_input_div2">
						<input type="reqdescription" name="reqdescription" id="reqdescription" class="first2" placeholder="Details" maxlength="20" autocomplete="off"/>
						<input type="hidden" name="req-url" id="req-url" value="<?php echo current_url();?>"/>
					</div>
					
                    <input type="button" name="requests" class="requests-btn"/>
				</form>  				
			</div> 
					
		</div> 
	</div>
</div>
<?php }?>


<?php if(!$isLoggedIn){?> 
<div class="login_wrap" style="display:none;">
    <div class="login_main">
	    <div class="login_inner">
		    <div class="login_inner_top">
			    <h6 style="font-size:19px;line-height:0px;" >Login</h6>
                <a href="#" id="login-close"><img src="<?php echo $staticContentUrl;?>images/login-registration1.png" alt="login registration1"/></a>  				
			</div>  
		    <div class="login_inner_middle">
			    <form name="login-form" id="login-form" action="<?php site_url('login')?>" method="post">
				    <div class="login_input_div2">
						<input type="text" name="email_id" id="email_id" class="first2" placeholder="Email Address" maxlength="100" autocomplete="off"/>
					</div>
					<div class="login_input_div2">
						<input type="password" ame="password" id="password" class="first2" placeholder="Password" maxlength="20" autocomplete="off"/>
						<input type="hidden" name="lc-url" id="lc-url" value="<?php echo current_url();?>"/>
					</div>
					<a class="forgot-btn" href="#">Forgot your password?</a>
                    <input type="button" nam="login" class="login-btn"/>
				</form>  				
			</div> 
				<div class="login_inner_top2">
					<h6 style="font-size:19px;line-height:0px;" >Create an account to expedite checkout, and track your orders</h6>           				
				</div>
		    <div class="login_inner_middle2">
			    <form name="registration-form" id="registration-form" action="<?php site_url('register')?>" method="post">
				    <div class="login_input_div4">
						<input type="text" name="remail_id" id="remail_id" class="first4" placeholder="Email Address" maxlength="100" autocomplete="off" />
					</div>
					<div class="login_input_div4">
						<input type="password" name="rpassword" id="rpassword" class="first4" placeholder="Password" maxlength="20" autocomplete="off"/>
					</div>
					<div class="login_input_div4">
						<input type="password" name="rrpassword" id="rrpassword" class="first4" placeholder="Retype Password" maxlength="20" autocomplete="off"/>
						<input type="hidden" name="sc-url"  id="sc-url" value="<?php echo current_url();?>"/>
					</div>					
                    <input type="button" name="register" class="register-btn" />
				</form>  				
			</div> 				
		</div> 
	</div>
</div>
<?php }?>







<?php if(!$isLoggedIn){?> 
<div class="subscribe_wrap" style="display:none;">
    <div class="subscribe_main">
	    <div class="subscribe_inner">
		    <div class="subscribe_inner_top">
			    
                <a href="#" id="subscribe-close"><img src="<?php echo $staticContentUrl;?>images/login-registration1.png" alt="login registration1"/></a> <h6 style="font-size:19px;line-height:0px;" >Enjoy multi-cuisine food?</h6> 				
			</div>  
		     <div class="subscribe_inner_middle2">
		     <p>Signup here to receive our weekly newsletter with <br/>Great recipes, information and deals </p>
			    <form name="registration-form" id="registration-form" action="<?php site_url('subscribe/addmail')?>" method="post">
				    <div class="subscribe_input_div4">
						<input type="text" name="subscribe_email_id" id="subscribe_email_id" class="first4" placeholder="Email Address" maxlength="100" autocomplete="off" />
						<input type="hidden" name="sce-url"  id="sce-url" value="<?php echo current_url();?>"/>

					</div>
					   <p style="font-size:15px;line-height:20px;	padding:15px 5px 0px 5px;"  ><strong>Receive 10% off your first order just for signing up!</strong></p>
                    <input type="button" name="subscribe" class="subscribe-btn" />
                 	
				</form>  
							
			</div> 				
		</div> 
	</div>
</div>
<?php }?>


			<!--footer area starts here -->
			<div class="footer-wrap">
			    <div class="container" style="background:#eef4d2;">
			        <footer class="footer">
			            <div class="row-fluid">
			            	<div class="span3 left offset1">
			                    <nav>
			                    	<ul>
			                    		<li><a href="<?php echo site_url('aboutus');?>">About Us</a>|</li>
										<li><a href="<?php echo site_url('contactus');?>">Contact Us</a></li>
										<?php if($isLoggedIn){?>
										<li>|<a href="<?php echo site_url('user/myorder');?>" <?php if($c == 'user'){?> class="active" <?php }?>>My Orders</a></li>
										<?php } ?>
			                    	</ul>
			                    </nav>	
			                </div>
			                <div class="span3 offset1" style="margin-left:73px;">
							    <ul class="social-icons right">
							    	<li><a target="_blank" href="http://www.globalgraynz.blogspot.com"><img src="<?php echo $staticContentUrl;?>images/blogger.png" alt="blogger"/></a></li>
							    	<li><a target="_blank" href="http://www.facebook.com/GlobalGraynz"><img src="<?php echo $staticContentUrl;?>images/facebook.png" alt="facebook"/></a></li>
							    	<li><a target="_blank" href="http://www.twitter.com/GlobalGraynz"><img src="<?php echo $staticContentUrl;?>images/twitter.png" alt="twitter"/></a></li>
							    	<li><a target="_blank" href="http://www.pinterest.com/GlobalGraynz"><img src="<?php echo $staticContentUrl;?>images/pinterest.png" alt="pinterest"/></a></li>
							    
							    	<li><a target="_blank" href="http://www.youtube.com/GlobalGraynz"><img src="<?php echo $staticContentUrl;?>images/youtube.png" alt="youtube"/></a></li>
							    	
							    </ul>
			                </div>
			                <div class="span4">
			                	  	<div style="margin-top:10px;font-size: 11px;margin-left:100px;">Featured on <a target="_blank" href="http://www.nextbigwhat.com/looking-for-rare-ingredients-for-your-master-kitchen-try-globalgraynz-297/"> <br/> <img src="<?php echo $staticContentUrl;?>images/nextbigwhat.png" alt="NextBigWhat"/></a> </div>
			                </div>
			            </div>
			        </footer>
			    </div>
			</div>	
			<div class="container bottom">
				<ul class="bottom-nav">
					<li><a style="margin-left:-50px; " href="<?php echo site_url('terms');?>">Terms and Conditions</a>|</li>
					<li><a href="<?php echo site_url('privacy');?>">Privacy Policy</a></li>
					<li style="margin-left:175px; margin-right:-100px;">Cant find what you're looking for?</li>
                 </ul>
                 	<div class="requests-section" style="float:right;margin-right:75px">
		                        <?php if(!$isLoggedIn){?> 
		                        <a href="javascript:void(0);" class="requests" >Tell us!</a>
		                        <?php } else {?>
		                         <a class="requests" href="javascript:void(0);">Tell us!</a>
		                    	<?php } ?>
		           </div>
		          
				</div>
				        	
			<!--footer ends-->

		</div><!--/.fluid-container-->
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<script  type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/modernizr.custom.17475.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/jquerypp.custom.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/jquery.elastislide.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/vendor/jquery.validate.min.js"></script>
		<script>
				$( '#carousel' ).elastislide();

				$(document).ready(function(){
					$("#search-frm").validate({
							
						submitHandler: function(form) {
							if($('#search-frm input[name=keywords]').val())
								form.submit();
							else{
								alert('Please enter your search keyword');
								return false;
							}
						}
					 });
				});
		</script>
		<?php if(!$isLoggedIn){?> 
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/welcome/welcome.js"></script>
		<script type="text/javascript" src="<?php echo $staticContentUrl;?>js/requests/requests.js"></script>
		<?php } ?>
		<?php echo $jsFile;?>
		


		

    
	</body>
</html>
<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Change Password','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
?>

<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Change Password</h4>					
				</div>
				
                <div class="box-part container">
	                <div class="box contact">
					    <div class="box-area">	<br/>
						<form name="changepassword-form" id="changepassword-form" method="post" action="<?php echo site_url('changepassword');?>">
							<ul class="changepassword-form">
								<?php if($success){ ?><li><div class="well alert alert-success">New Password has been updated.</div></li><?php } ?>
								<li><div id="contact-error-maessage" 
						    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
						     	<?php if(isset($error) && (strlen($error) > 3)){ 
						     		echo '<button class="close" data-dismiss="alert">x</button>';
						     		echo  $error;
						     	} else { 
						     		echo '&nbsp;';
						     	}?>
						     </div></li>
								<li><label>Current Password</label><input type="password" name="cp"  id="cp" /></li>
								<li><label>New Password</label><input type="password" name="np"  id="np" /></li>
								<li><label>Confirm New Password</label><input type="password" name="cnp"  id="cnp" /></li>
								<li><input type="submit" class="sub-btn" /></li>
							</ul>	
						</form>	
						</div>

					</div>                 				
				</div> 				
			</div>   	
        </div>
    </div>	
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/changepassword/changepassword.js')));?>

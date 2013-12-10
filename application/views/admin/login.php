<?php $this->load->view('admin/header', array('pageTitle' => 'Home','cssFiles' =>array())); ?>

<div class="row">
	<div id="signin" class="span6 offset3">
		<form method="POST" id="signin-form" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Sign In</legend>
			    <div id="invitation-message" 
			    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
			     	<?php if(isset($error) && (strlen($error) > 3)){ 
			     		echo '<button class="close" data-dismiss="alert">x</button>';
			     		echo  $error;
			     	} else { 
			     		echo '&nbsp;';
			     	}?>
			     </div>
			    
			    <div class="control-group">
			      <label class="control-label" for="email_id">Email</label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required email" name="email_id" id="email_id" placeholder="user@domain.com" />
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="password">Password</label>
			      <div class="controls">
			      	
			      	<input type="password" class="input-xlarge required" name="password" id="password" />
			       
			      </div>
			    </div>
			    
			    <div class="form-actions" >
			    	<input type="hidden" id="crf" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
				    <button class="btn btn-primary signin" >Sign In</button>
			    </div>
		  	</fieldset>
		</form>
	</div>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>


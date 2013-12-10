<?php $this->load->view('admin/header', array('pageTitle' => 'Healthlevel Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/healthlevel/menu');?>

<?php 

if($data){
	$name = $data['name'];
	$status = (int)$data['status'];
} else {
	$name = set_value('name');
	$status = set_value('status');
}

?>
<div class="row">
	<div id="healthlevel" class="span6 offset1">
		<form method="POST" id="healthlevel-form"  class="form-horizontal" >
	 		<fieldset>
		    	<legend>Healthlevel Details</legend>
			    <div id="healthlevel-message" 
			    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
			     	<?php if(isset($error) && (strlen($error) > 3)){ 
			     		echo '<button class="close" data-dismiss="alert">x</button>';
			     		echo  $error;
			     	} else { 
			     		echo '&nbsp;';
			     	}?>
			     </div>

			     <div class="control-group">
			      <label class="control-label" for="name">Name <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="name" id="name" value="<?php echo $name;?>"/>
			        </div>
			      </div>
			    </div>
			    <?php if($data){ ?>
			    <div class="control-group">
			      <label class="control-label" for="status">Status </label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="status">
			      			<option value=" " selected > Please Select </option>
			      			<option value="1" <?php if($status == 1){ echo 'selected';}?>> Active</option>
			      			<option value="0" <?php if($status == 0){ echo 'selected';}?> > Inactive</option>
			      		</select>
			        </div>
			      </div>
			    </div>
				<?php }?>
			    
			    <div class="form-actions" >
			    	<?php if($data){?>
			    	<button class="btn btn-primary edit" >Update</button> 
			    	<?php } else { ?>
			    	<button class="btn btn-primary add" >Add</button> 
			    	<?php }?>
			    	<button class="btn cancel" >Cancel</button> 
			    </div>
		  	</fieldset>
		</form>
	</div>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/healthlevel/add-edit.js'))); ?>

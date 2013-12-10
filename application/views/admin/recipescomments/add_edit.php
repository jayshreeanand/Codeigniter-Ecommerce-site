<?php $this->load->view('admin/header', array('pageTitle' => 'Recipes Comments Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/recipescomments/menu');?>

<?php 

if($data){
	$id 			= $data['id'];
	$comment 		= $data['comment'];
	$status 		= (int)$data['status'];
}

?>

<div class="row">
	<div id="recipe-comment" class="span6">
		<form method="POST" id="recipe-comment-form" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Recipe Comment</legend>
			    <div id="recipe-comment-message" 
			    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
			     	<?php if(isset($error) && (strlen($error) > 3)){ 
			     		echo '<button class="close" data-dismiss="alert">x</button>';
			     		echo  $error;
			     	} else { 
			     		echo '&nbsp;';
			     	}?>
			     </div>

			     <div class="control-group">
			      <label class="control-label" for="comment">Comment <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend"><?php echo $comment;?></div>
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
			      			<option value="0" <?php if($status == 0){ echo 'selected';}?>> Inactive</option>
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
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/recipescomments/add-edit.js'))); ?>

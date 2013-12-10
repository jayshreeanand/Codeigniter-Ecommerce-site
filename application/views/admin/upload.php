<?php $this->load->view('admin/header', array('pageTitle' => 'Admin','cssFiles' =>array())); ?>

<div class="row">
	<div id="bulk" class="span6 offset1">
		<form method="POST" action="<?php echo site_url('adminupload'); ?>" id="bulk-form"  enctype="multipart/form-data" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Bulk Upload</legend>
		    	<div id="bulk-message" 
			    	<?php if(isset($error) && (strlen($error) > 3)){ echo 'class="well alert alert-error"';} ?> >
			     	<?php if(isset($error) && (strlen($error) > 3)){ 
			     		echo '<button class="close" data-dismiss="alert">x</button>';
			     		echo  $error;
			     	} else { 
			     		echo '&nbsp;';
			     	}?>
			     </div>
			    <?php if($success){ echo '<div class="well alert alert-success"><button class="close" data-dismiss="alert">x</button>Uploaded Successfully</div>'; } ?>

			     <div class="control-group">
			      <label class="control-label" for="category_id">Type <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="atype" id="atype" class="required" >
			      			<option value=" " selected > Please Select</option>
			      			<option value="a" >Adding</option>
			      			<option value="u" >Updating</option>
			      		</select>
			        </div>
			      </div>
			    </div>
			     <div class="control-group">
			      <label class="control-label" for="category_id">Data <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="type" id="type" class="required" >
			      			<option value=" " selected > Please Select</option>
			      			<option value="r" >Recipe</option>
			      			<option value="i" >Ingredient</option>
			      		</select>
			        </div>
			      </div>
			    </div>

			     <div class="control-group">
			      <label class="control-label" for="image2">Excel File (.xls) or Zip File (.zip)</label>
			      <div class="controls">
			      	<div class="input-prepend">
			       		<input type="file" class="input-xlarge" name="file" id="file" />
			        </div>
			      </div>
			    </div>

			     <div class="form-actions" >
			    	<input type="submit" class="btn btn-primary" value="Upload" /> 
			    </div>

		    </fieldset>
		</form>
	</div>
</div>

<?php $this->load->view('admin/footer', array('jsFiles' => array(''))); ?>

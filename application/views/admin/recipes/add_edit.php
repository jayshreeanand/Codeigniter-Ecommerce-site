<?php $this->load->view('admin/header', array('pageTitle' => 'Recipes Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/recipes/menu');?>

<?php 

if($data){
	$id 			= $data['id'];
	$name 			= $data['name'];
	$process 		= $data['process'];
	$history 		= $data['history'];
	$nutrition 		= $data['nutrition'];

	$preparation_time 	= $data['preparation_time'];
	$cooking_time 		= $data['cooking_time'];
	$rating 		= $data['rating'];
	$category_id	= $data['category_id'];
	$cuisine_id		= $data['cuisine_id'];

	$health_level	= $data['health_level'];
	$spice_level	= $data['spice_level'];
	$expert_level	= $data['expert_level'];
	$food_type 		= $data['food_type'];
	$recommendation = $data['recommendation'];

	
	$image1			= $data['image1'];
	$image2			= $data['image2'];
	$image3			= $data['image3'];

	$video 			= $data['video'];
	$status 		= (int)$data['status'];
} else {
	$name 			= set_value('name');
	$process 		= set_value('process');
	$history 		= set_value('history');
	$nutrition 		= set_value('nutrition');

	$preparation_time 	= set_value('preparation_time');
	$cooking_time	= set_value('cooking_time');

	$rating 		= set_value('rating');
	$category_id 	= set_value('category_id');
	$cuisine_id 	= set_value('cuisine_id');

	$health_level	= set_value('health_level');
	$spice_level	= set_value('spice_level');
	$expert_level	= set_value('expert_level');
	$food_type 		= set_value('food_type');
	$recommendation = set_value('recommendation');

	$image1			= set_value('image1');
	$image2			= set_value('image2');
	$image3			= set_value('image3');
	$video 			= set_value('video');


	$status 		= set_value('status');
}

?>
<script>
<?php if($data){?>
	var editIngredients =[<?php echo $ingredientNames;?>];
	var related = [<?php echo $relatedRecipeNames;?>] 
<?php } else { ?>
var editIngredients = [];
var related = [];
<?php } ?>
</script>

<div class="row">
	<div id="recipe" class="span6">
		<form method="POST" id="recipe-form"  enctype="multipart/form-data" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Recipe Details</legend>
			    <div id="recipe-message" 
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

			    <div class="control-group">
			    	 <label class="control-label" for="ingredients">Ingredients <span>*</span></label>
			    	<div class="controls">
			      	<div class="input-prepend">
			      		<textarea id="textarea" name="ingredients"  rows="1"></textarea>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			    	 <label class="control-label" for="related">Related Recipe <span>*</span></label>
			    	<div class="controls">
			      	<div class="input-prepend">
			      		<textarea id="related" name="related" rows="1"></textarea>
			        </div>
			      </div>
			    </div>
			    	
			    <div class="control-group">
			      <label class="control-label" for="process">Process <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<textarea  class="required address" style="height:100px;" name="process" id="process"><?php echo $process;?></textarea>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="history">History <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<textarea  class="required address" style="height:100px;" name="history" id="history"><?php echo $history;?></textarea>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="nutrition">Nutrition <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<textarea  class="required address" style="height:100px;" name="nutrition" id="nutrition" ><?php echo $nutrition;?></textarea>
			        </div>
			      </div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="preparation_time">Preparation Time <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="preparation_time" id="preparation_time" value="<?php echo $preparation_time;?>"/>
			        </div>
			      </div>
			    </div>


			     <div class="control-group">
			      <label class="control-label" for="cooking_time">Cooking Time <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="cooking_time" id="cooking_time" value="<?php echo $cooking_time;?>"/>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="rating">Rating <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="rating" id="rating" value="<?php echo $rating;?>"/>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="health_level">Health Level <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="health_level" id="health_level" class="required">
			      			<option value=" " selected > Please Select Health Level</option>
			      			<?php foreach($healthlevel as $hl){?>
			      			<option value="<?php echo $hl['id'];?>" <?php if($health_level == $hl['id']){ echo 'selected';}?>> <?php echo $hl['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="spice_level">Spice Level <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="spice_level" id="spice_level" class="required">
			      			<option value=" " selected > Please Select Spice Level</option>
			      			<?php foreach($spicelevel as $sl){?>
			      			<option value="<?php echo $sl['id'];?>" <?php if($spice_level == $sl['id']){ echo 'selected';}?>> <?php echo $sl['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>


			     <div class="control-group">
			      <label class="control-label" for="expert_level">Expert Level <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="expert_level" id="expert_level" class="required">
			      			<option value=" " selected > Please Select Expert Level</option>
			      			<?php foreach($this->config->item('expert_level') as $el){?>
			      			<option value="<?php echo $el['id'];?>" <?php if($expert_level == $el['id']){ echo 'selected';}?>> <?php echo $el['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>


			    <div class="control-group">
			      <label class="control-label" for="food_type">Food Type <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="food_type" id="food_type" class="required">
			      			<option value=" " selected > Please Select Food Type</option>
			      			<?php foreach($foodtype as $ft){?>
			      			<option value="<?php echo $ft['id'];?>" <?php if($food_type == $ft['id']){ echo 'selected';}?>> <?php echo $ft['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>



			    <div class="control-group">
			      <label class="control-label" for="category_id">Category <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="category_id" id="category_id" class="required">
			      			<option value=" " selected > Please Select Category</option>
			      			<?php foreach($categories as $category){?>
			      			<option value="<?php echo $category['id'];?>" <?php if($category_id == $category['id']){ echo 'selected';}?>> <?php echo $category['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>

			     <div class="control-group">
			      <label class="control-label" for="cuisine_id">Cuisine <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="cuisine_id" id="cuisine_id" class="required">
			      			<option value=" " selected > Please Select Cuisine</option>
			      			<?php foreach($cuisines as $cuisine){?>
			      			<option value="<?php echo $cuisine['id'];?>" <?php if($cuisine_id == $cuisine['id']){ echo 'selected';}?>> <?php echo $cuisine['name'];?></option>
			      			<?php }?>
			      		</select>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="recommendation" class="required">Recommendation <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="recommendation" id="recommendation">
			      			<option value="0" <?php if($recommendation == 0){ echo 'selected';}?> >No</option>
			      			<option value="1" <?php if($recommendation == 1){ echo 'selected';}?> >Yes</option>
			      		</select>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image1">Image</label>
			      <div class="controls">
			      	 <?php if($data && !empty($image1)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image1;?>" /><br/>
			      	 <?php } ?>
			      	<div class="input-prepend">
			       		<input type="file" class="input-xlarge" name="image1" id="image1" value="" />
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image2">Image</label>
			      <div class="controls">
			      	 <?php if($data && !empty($image2)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image2;?>" /><br/>
			      	 <?php } ?>
			      	<div class="input-prepend">
			       		<input type="file" class="input-xlarge" name="image2" id="image2" value="" />
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image3">Image</label>
			      <div class="controls">
			      	 <?php if($data && !empty($image3)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image3;?>" /><br/>
			      	 <?php } ?>
			      	<div class="input-prepend">
			       		<input type="file" class="input-xlarge" name="image3" id="image3" value="" />
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="video">Video YouTube Url</label>
			      <div class="controls">
			      	<?php if($video && !empty($video)){ ?>
			      		<iframe width="360" height="315" src="<?php echo $video;?>" frameborder="0"></iframe>
			      	<?php } ?>
			      
			      	<div class="input-prepend">
			       		<input type="text" class="input-xlarge required" name="video" id="video" value="<?php echo $video;?>"/>
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
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/vendor/textext.js','js/recipes/add-edit.js'))); ?>

<?php $this->load->view('admin/header', array('pageTitle' => 'Cuisine Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/ingredients/menu');?>

<?php 

if($data){
	$id 			= $data['id'];
	$name 			= $data['name'];
	$regular_price 	= $data['regular_price'];
	$sale_price 	= $data['sale_price'];
	$used_in 		= $data['used_in'];
	$description 	= $data['description'];
	$history 		= $data['history'];
	$rating 		= $data['rating'];
	$category_id	= $data['category_id'];
	$cuisine_id		= $data['cuisine_id'];
	$health_level	= $data['health_level'];
	$spice_level	= $data['spice_level'];
	$food_type		= $data['food_type'];
	$image1			= $data['image1'];
	$image2			= $data['image2'];
	$image3			= $data['image3'];
	$recommendation = $data['recommendation'];
	$offer_exists          = $data['offer_exists'];
	$status 		= (int)$data['status'];
} else {
	$name 			= set_value('name');
	$regular_price 	= set_value('regular_price');
	$sale_price 	= set_value('sale_price');
	$used_in 		= set_value('used_in');
	$history 		= set_value('history');
	$rating 		= set_value('rating');
	$category_id 	= set_value('category_id');
	$cuisine_id 	= set_value('cuisine_id');
	$health_level	= set_value('health_level');
	$spice_level	= set_value('spice_level');
	$food_type		= set_value('food_type');
	$recommendation = set_value('recommendation');
	$status 		= set_value('status');
	$offer_exists          = set_value('offer_exists');	
}

?>
<script>
<?php if($data){?>
	var editRecipes =[<?php echo $recipeNames;?>];
<?php } else { ?>
var editRecipes = [];
<?php } ?>
</script>
<div class="row">
	<div id="ingredient" class="span6 offset1">
		<form method="POST" id="ingredient-form"  enctype="multipart/form-data" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Ingredient Details</legend>
			    <div id="ingredient-message" 
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
			      <label class="control-label" for="regular_price">Regular Price <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="regular_price" id="regular_price" value="<?php echo $regular_price;?>"/>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="sale_price">Sale Price <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<input type="text" class="input-xlarge required" name="sale_price" id="sale_price" value="<?php echo $sale_price;?>"/>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="used_in">Used In <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<textarea id="textarea" name="used_in" rows="1"></textarea>
			        </div>
			      </div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="description">Description<span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<textarea  class="required required" style="height:100px;" name="description" id="description" ><?php echo $description;?></textarea>
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
			      <label class="control-label" for="category_id">Category <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="category_id" id="category_id" class="required" >
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
			      <label class="control-label" for="recommendation">Recommendation <span>*</span></label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="recommendation" id="recommendation" class="required">
			      			<option value="0" <?php if($recommendation == 0){ echo 'selected';}?> >No</option>
			      			<option value="1" <?php if($recommendation == 1){ echo 'selected';}?> >Yes</option>
			      		</select>
			        </div>
			      </div>
			    </div>

			     <div class="control-group">
			      <label class="control-label" for="offer_exists">Offer Exists</label>
			      <div class="controls">
			      	<div class="input-prepend">
			      		<select name="offer_exists" id="offer_exists" class="required">
			      			<option value="No" <?php if($offer_exists == "No"){ echo 'selected';}?> >No</option>
			      			<option value="Yes" <?php if($offer_exists == "Yes"){ echo 'selected';}?> >Yes</option>
			      		</select>
			        </div>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image1">Image</label>
			      <div class="controls">
			      	 <?php if($data && !empty($image1)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image1;?>" /><br/>
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
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image2;?>" /><br/>
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
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image3;?>" /><br/>
			      	 <?php } ?>
			      	<div class="input-prepend">
			       		<input type="file" class="input-xlarge" name="image3" id="image3" value="" />
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
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/vendor/textext.js','js/ingredients/add-edit.js'))); ?>

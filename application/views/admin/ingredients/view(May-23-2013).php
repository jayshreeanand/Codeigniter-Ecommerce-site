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
	$food_type 		= $data['food_type'];
	$recommendation = $data['recommendation'];
	$image1			= $data['image1'];
	$image2			= $data['image2'];
	$image3			= $data['image3'];
	$status 		= (int)$data['status'];
} 

?>
<style>
.control-group div {
	text-align: left;
	margin-top: 4px;
	padding-left: 180px;
}
</style>
<div class="row">
	<div id="ingredient" class="span6 offset1">
		<form method="POST" id="ingredient-form"  enctype="multipart/form-data" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Ingredient Details</legend>
			   

			    <div class="control-group">
			    	<label class="control-label" for="name">Name <span>*</span></label>
					<div><?php echo $name;?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="regular_price">Regular Price <span>*</span></label>
			      <div><?php echo $regular_price;?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="sale_price">Sale Price <span>*</span></label>
			      <div><?php echo $sale_price;?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="used_in">Used In <span>*</span></label>
			      <div><?php echo str_replace('"', '', $recipeNames);?></div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="description">Description<span>*</span></label>
			      <div><?php echo $description;?></div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="rating">Rating <span>*</span></label>
			      <div><?php echo $rating;?></div>
			    </div>


			    <div class="control-group">
			      <label class="control-label" for="category_id">Category <span>*</span></label>
			      <?php foreach($categories as $category) {
			      			if($category_id == $category['id']){ ?>
			      			<div> <?php echo $category['name'];?></div>
			      			 <?php } ?>
			      <?php } ?>
			    </div>

			     <div class="control-group">
			      <label class="control-label" for="cuisine_id">Cuisine <span>*</span></label>
			      <?php foreach($cuisines as $cuisine){
			      			if($cuisine_id == $cuisine['id']){?>
			      			<div> <?php echo $cuisine['name'];?></div>
			      			 <?php } ?>
			     
			      <?php } ?>
			    </div>




			    <div class="control-group">
			      <label class="control-label" for="health_level">Health Level <span>*</span></label>
	      			<?php foreach($this->config->item('health_level') as $hl){?>
	      				<?php if($health_level == $hl['id']){ echo '<div>'.$hl['name'].'</div>'; }?>
	      			<?php }?>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="spice_level">Spice Level <span>*</span></label>			      
	      			<?php foreach($this->config->item('spice_level') as $sl){?>
	      			<?php if($spice_level == $sl['id']){ echo '<div>'.$sl['name'].'</div>';}?>
	      			<?php }?>			      		
			    </div>



			    <div class="control-group">
			      <label class="control-label" for="food_type">Food Type <span>*</span></label>
			     
	      			<?php foreach($this->config->item('food_type') as $ft){?>
	      			<?php if($food_type == $ft['id']){ echo '<div>'.$ft['name'].'</div>';}?>
	      			<?php }?>
			      		
			    </div>






			     <div class="control-group">
			      <label class="control-label" for="recommendation">Recommended <span>*</span></label>
			      <div><?php echo ($recommendation == 1 ) ? 'Yes' : 'No'; ?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image1">Image</label>
			      <div>
			      	 <?php if($data && !empty($image1)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image1;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image2">Image</label>
			      <div>
			      	 <?php if($data && !empty($image2)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image2;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image3">Image</label>
			      <div>
			      	 <?php if($data && !empty($image3)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/ingredients/'.$id.'/'.$image3;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="status">Status </label>
			     
			      	<div><?php echo ($status === 1) ? 'Active' : 'InActive';?></div>
			    </div>
			    
		  	</fieldset>
		</form>
	</div>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array(''))); ?>

<?php $this->load->view('admin/header', array('pageTitle' => 'Recipe View','cssFiles' =>array())); ?>
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
	<div id="recipe" class="span6 offset1">
		<form method="POST" id="recipe-form"  enctype="multipart/form-data" class="form-horizontal" >
	 		<fieldset>
		    	<legend>Recipe Details</legend>
			   

			    <div class="control-group">
			    	<label class="control-label" for="name">Name <span>*</span></label>
					<div><?php echo $name;?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="ingredients">Ingredients<span>*</span></label>
			      <div><?php echo str_replace('"', '', $ingredientNames);?></div>
			    </div>

			   	<div class="control-group">
			      <label class="control-label" for="related">Related<span>*</span></label>
			      <div><?php echo str_replace('"', '', $relatedRecipeNames);?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="sale_price">Process <span>*</span></label>
			      <div><?php echo $process;?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="used_in">History <span>*</span></label>
			      <div><?php echo $history;?></div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="description">Nutrition<span>*</span></label>
			      <div><?php echo $nutrition;?></div>
			    </div> 

			     <div class="control-group">
			     <label class="control-label" for="preparation_time">Preparation Time <span>*</span></label>
			      <div><?php echo $preparation_time;?></div>
			    </div> 

			     <div class="control-group">
			      <label class="control-label" for="cooking_time">Cooking Time <span>*</span></label>
			      <div><?php echo $cooking_time;?></div>
			    </div> 

			    <div class="control-group">
			      <label class="control-label" for="rating">Rating <span>*</span></label>
			      <div><?php echo $rating;?></div>
			    </div>


			    <div class="control-group">
			      <label class="control-label" for="health_level">Health Level <span>*</span></label>
			      <?php foreach($healthlevel  as $hl) {
			      			if($health_level  == $hl['id']){ ?>
			      			<div> <?php echo $hl['name'];?></div>
			      			 <?php } ?>
			      <?php } ?>
			    </div>

			     <div class="control-group">
			      <label class="control-label" for="spice_level">Spice Level <span>*</span></label>
			      <?php foreach($spicelevel  as $sl) {
			      			if($spice_level  == $sl['id']){ ?>
			      			<div> <?php echo $sl['name'];?></div>
			      			 <?php } ?>
			      <?php } ?>
			    </div>

			    <div class="control-group">
 					<label class="control-label" for="expert_level">Expert Level <span>*</span></label>
			      <?php foreach($this->config->item('expert_level')  as $el) {
			      			if($expert_level  == $el['id']){ ?>
			      			<div> <?php echo $el['name'];?></div>
			      			 <?php } ?>
			      <?php } ?>
			    </div>

			    <div class="control-group">
 					<label class="control-label" for="food_type">Food Type<span>*</span></label>
			      <?php foreach($foodtype  as $ft) {
			      			if($food_type  == $ft['id']){ ?>
			      			<div> <?php echo $ft['name'];?></div>
			      			 <?php } ?>
			      <?php } ?>
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
			      <label class="control-label" for="recommendation">Recommended <span>*</span></label>
			     <div> <?php echo ($recommendation == 1) ? 'Yes' : 'No'; ?></div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image1">Image</label>
			      <div>
			      	 <?php if($data && !empty($image1)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image1;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image2">Image</label>
			      <div>
			      	 <?php if($data && !empty($image2)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image2;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="image3">Image</label>
			      <div>
			      	 <?php if($data && !empty($image3)){ ?>
			      	 	<img src="<?php echo base_url().'uploads/recipes/'.$id.'/'.$image3;?>" /><br/>
			      	 <?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="video">Video YouTube Url</label>
			      <div>
			      	<?php if($video && !empty($video)){ ?>
			      		<iframe width="360" height="315" src="<?php echo $video;?>" frameborder="0"></iframe>
			      	<?php } ?>
			      </div>
			    </div>

			    <div class="control-group">
			      <label class="control-label" for="status">Status </label>
			     
			      	<div><?php echo ($status == 1) ? 'Active' : 'InActive';?></div>
			    </div>
			    
		  	</fieldset>
		</form>
	</div>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array(''))); ?>

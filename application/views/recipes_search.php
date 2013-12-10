<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Recipes','cssFiles' =>array())); 

if(count($_POST)){
	$spice_level 	= $spice_level;
	$health_level 	= $health_level;
	$expert_level 	= $expert_level;
	$cuisine_id		= $cuisine_id;
	$food_type 		= $food_type;

} else {
	$spice_level 	= set_value('spice_level');
	$health_level 	= set_value('health_level');
	$expert_level 	= set_value('expert_level');
	$food_type 		= set_value('food_type');
	$cuisine_id		= set_value('cuisine_id');
}
?>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
	<div class="container">
	    <div class="row-fluid">
		    <div class="span8" style="margin-right:26px;">
			    <div class="recepie_main_left">
				    <div class="recepie_main_left_top">
					    <div class="recepie_main_left_top_top">
						    <h2>Recipes</h2>  
						</div>
 						<div class="recepie_main_left_top_bottom">
 							<form method="post" id="recipe-search" action="<?php echo site_url('recipe');?>">
								<ul>
									<li>
										<select name="d" class="styled">
											<option value=" ">Spice</option>
											<?php echo $spice_level; foreach($spicelevel as $sl){?>
							      			<option value="<?php echo $sl['id'];?>" <?php if($spice_level == $sl['id']){ echo 'selected';}?>> <?php echo $sl['name'];?></option>
							      			<?php }?>
										</select>
									</li>
									<li>
										<select name="d2" class="styled">
										<option value=" ">Health</option>
										<?php foreach($healthlevel as $hl){?>
		      								<option value="<?php echo $hl['id'];?>" <?php if($health_level == $hl['id']){ echo 'selected';}?>> <?php echo $hl['name'];?></option>
		      							<?php }?>
									</select>
									</li>
									<li>
										<select name="d3" class="styled">
											<option value=" ">Expertise</option>
											<?php foreach($this->config->item('expert_level') as $el){?>
							      			<option value="<?php echo $el['id'];?>" <?php if($expert_level == $el['id']){ echo 'selected';}?>> <?php echo $el['name'];?></option>
							      			<?php }?>
										</select> 
									</li>
									<li>
										<select name="d4" class="styled">
											<option value=" ">Cuisine</option>
											<?php foreach($cuisines as $cuisine){?>
							      			<option value="<?php echo $cuisine['id'];?>" <?php if($cuisine_id == $cuisine['id']){ echo 'selected';}?>> <?php echo $cuisine['name'];?></option>
							      			<?php }?>
										</select>
									</li>		

									<li>
											<select name="d5" class="styled">
											<option value=" ">Food Type</option>
											<?php foreach($foodtype as $ft){?>
									      	<option value="<?php echo $ft['id'];?>" <?php if($food_type == $ft['id']){ echo 'selected';}?>> <?php echo $ft['name'];?></option>
									      	<?php }?>
										</select>
									</li>	
									<li class="last" style="margin-top:12px;" >
										<a style="margin-left:15px;" href="<?php echo site_url('recipe');?>"><img src="<?php echo $staticContentUrl."images/refresh-icon.png";?>" /></a>
									</li>										
								</ul>
						      </form>
						</div> 
					</div>
				    <div class="recepie_main_left_bottom row-fluid">
					    <div class="recepie_main_left_bottom_inner">
							<ul>
								<?php foreach($data as $datum){?>
								<li>
									<div class="recepie_main_left_bottom_one">
									    <div class="recepie_main_left_bottom_one_top">
									    	<div class="star" id="<?php echo $datum['id'];?>" data-number="5" data-score="<?php echo $datum['rating'];?>"></div>
										    <a href="<?php echo site_url('recipe/details/'.getSeoUrl($datum['name'], $datum['id']));?>">
										    	<img style="height:200px;width:200px;" src="<?php echo $staticContentUrl.'uploads/recipes/'.$datum['id'].'/'.$datum['image1'];?>" alt="receipe-page_img1" />
										    </a>   
										</div>

									    <div class="recepie_main_left_bottom_one_bottom">
										    <p><strong><a href="<?php echo site_url('recipe/details/'.getSeoUrl($datum['name'], $datum['id']));?>"><?php echo smarttruncate($datum['name'],41,TRUE,TRUE);?></a></strong></p>
                                            <span><?php echo getCuisineName($cuisines,$datum['cuisine_id']);?></span>
                                           
										</div> 										
									</div>
								</li>
								<?php } 

								if(!count($data)){ ?>
										<li><h6>No recipes found</h6></li>
								<?php } ?>
								
							</ul>
						</div>
					</div> 					
				</div>   
			</div>

			<div class="span4" style="width:23.915%;">
			    <div class="recepie_main_right" style="margin-left:45px;">
				    <div class="recepie_main_right_top">
					    <h4>Top Picks</h4>   
					</div>
				    <div class="recepie_main_right_bottom">
					    <ul>
					    	<?php foreach($recommendations as $r){?>
					    	<li>
									<div class="recepie_main_right_bottom_one">
									    <div class="recepie_main_left_bottom_one_top">
									    	<a href="<?php echo site_url('recipe/details/'.getSeoUrl($r['name'], $r['id']));?>">
										    	<img style="width:200px;height:200px;" src="<?php echo $staticContentUrl.'uploads/recipes/'.$r['id'].'/'.$r['image1'];?>" alt="receipe-page_img1" />   
											</a>
										</div>
									    <div class="recepie_main_left_bottom_one_bottom">
                                            <p><a href="<?php echo site_url('recipe/details/'.getSeoUrl($r['name'], $r['id']));?>"><?php echo smarttruncate($r['name'],41,TRUE,TRUE);?></a></p>
                                            <span><?php echo getCuisineName($cuisines,$r['cuisine_id']);?></span>
										</div> 										
									</div>							
							</li>
							<?php }?>
					    </ul>  
					</div> 					
				</div> 
			</div> 
        </div>
    </div>
</div>

<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.raty.js','js/recipes/recipes-search.js' ))); ?>




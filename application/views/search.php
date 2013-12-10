<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Search Results','cssFiles' =>array(''))); 

function  getCategory($categories,$cat_id){
	foreach($categories as $category){
		if($cat_id == $category['id'])
			return $category['name'];
	}
}

function getCuisine($cuisines,$cu_id){
	foreach($cuisines as $cuisine){
		if($cu_id == $cuisine['id'])
			return $cuisine['name'];
	}
}


?>

<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
	<div class="container">
	    <div class="row-fluid">
			    <div class="gredient_main">
				    <div class="recepie_main_left_top">
						<div class="gredient_main_top container">
							<h4>Search Results</h4>		
						</div>
						<div class="search_top_bottom">
                        	<p>Ingredients Listing</p> 
						</div> 
					</div>

				    <div class="shipping_main container">
						<div id="main">
							<div class="nano">
								<div class="overthrow content description">					
									<div class="recepie_main_left_bottom_inner scroll2">
										<ul>
											<?php foreach ($ingredients as $ingredient) { ?>
											<li>
												<div class="recepie_main_left_bottom_one">
													<div class="recepie_main_left_bottom_one_top">
														<a href="<?php echo site_url('ingredient/details/'.getSeoUrl($ingredient['name'],$ingredient['id'])); ?>">
															<div class="istar" id="<?php echo $ingredient['id'];?>" data-number="5" data-score="<?php echo $ingredient['rating'];?>"></div>
                                                            <span class="green">
                                            	<?php if($ingredient['food_type'] == 1) { ?><img src="<?php echo $staticContentUrl;?>images/vegitable.png" alt="Vegitable">
												<?php } else if($ingredient['food_type'] == 2){ ?>
                                                <img src="<?php echo $staticContentUrl;?>images/non_veg.png" alt="Non Veg">
                                                <?php } ?>
                                            </span>
										    				<img style="height:200px;width:200px;" src="<?php echo $staticContentUrl.'uploads/ingredients/'.$ingredient['id'].'/'.$ingredient['image1'];?>" alt="<?php echo $ingredient['name'];?>" /> 
										    			</a>  
													</div>
                                                    

													<div class="recepie_main_left_bottom_one_bottom">
														<p><strong><a href="<?php echo site_url('ingredient/details/'.getSeoUrl($ingredient['name'],$ingredient['id'])); ?>"><?php echo $ingredient['name'];?></a></strong></p>
														<!--<span><?php echo ($ingredient['food_type'] == 1) ? 'Veg' : 'Non Veg';?></span>-->
														
													</div>
												</div>
											</li>
											<?php }
											if(!count($ingredients)){
											 ?>		
											 <li>
												
														<p>Your search did not match any results. <br/> <br/><p><strong>Suggestions:</strong></p><br/>
			
				                                          Make sure all words are spelled correctly.<br/>
				                                          Try different keywords.<br/>
				                                          Try more general keywords.<br/>
			
														</p>

														<p><strong>Not finding what you want?  </strong> </p>

														<div class="requests-section" style="float:left;margin-right:75px">
		                        <?php if(!$isLoggedIn){?> 
		                        <a href="javascript:void(0);" class="requests" >Tell us!</a>
		                        <?php } else {?>
		                         <a class="requests" href="javascript:void(0);">Tell us!</a>
		                    	<?php } ?>
		           </div>
		          
		          


												
											</li>			
											 <?php } ?>		
										</ul>
									</div>
								</div>	
							</div>		
						</div>	

						<div class="search_top_bottom2">
                            <p>Recipes Listing</p> 
						</div> 
						<div id="area">
							<div class="nano">
								<div class="overthrow content description">					
									<div class="recepie_main_left_bottom_inner scroll2">
										<ul>
											<?php foreach ($recipes as $recipe) { ?>
											<li>
												<div class="recepie_main_left_bottom_one">
													<div class="recepie_main_left_bottom_one_top">
														<a href="<?php echo site_url('recipe/details/'.getSeoUrl($recipe['name'], $recipe['id']));?>">
															<div class="rstar" id="<?php echo $recipe['id'];?>" data-number="5" data-score="<?php echo $recipe['rating'];?>"></div>
										    				<img style="height:200px;width:200px;" src="<?php echo $staticContentUrl.'uploads/recipes/'.$recipe['id'].'/'.$recipe['image1'];?>" alt="<?php echo $recipe['name'];?>" />
										    			</a>  
													</div>

													<div class="recepie_main_left_bottom_one_bottom">
														<p><a href="<?php echo site_url('recipe/details/'.getSeoUrl($recipe['name'], $recipe['id']));?>"><?php echo $recipe['name'];?></a></p>
														<span>Cuisine Type: <?php echo getCuisine($cuisines,$recipe['cuisine_id']);?></span>
														
													</div> 										
												</div>
											</li>
											<?php }
											if(!count($recipes)){
											 ?>		
											  <li>
												
														<p>Your search did not match any results. <br/> 
														</p>
												
											</li>	
											 <?php } ?>								
										</ul>
									</div>
								</div>	
							</div>		
						</div>		
		           </div> 					
	            </div> 	
        </div>
    </div>
</div>
<script type="text/javascript">
	_gaq.push(['_trackEvent', 'Search', 'Search', '<?php echo $search_keywords;?>'],true);
</script>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.raty.js','js/search/search.js'))); ?>

<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => $data['name'],'cssFiles' =>array())); 
?>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">	
		<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4>Recipe: <?php echo $data['name'];?></h4>       			
				</div>
				
                <div class="recepie_main container">
					<div class="recepie_main_top row-fluid span12">
					    <ul>
					    	<li>
					    		<div class="main1">
								    <div class="main1_inner">
									    <div class="main1_inner_top">
							                <img style="width:200px;height:200px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $data['id'];?>/<?php echo $data['image1'];?>" alt="<?php echo $data['name'];?>" /> 
										</div>
										<p><?php echo $data['name'];?></p>
										
									</div>   
								</div>
					    	</li>
					    </ul>  
					</div> 
					
					<div class="recepie_main_bottom row-fluid span12">
					    <div class="recepie_main_bottom-inner">
							
							
							<div class="tab-content">
								<h2> Process</h2>
								<div style="margin-left:0px;" id="recipe" class="tab-pane active recepie_main_bottom_bottom container span12">
							    	<div class="recepie_main_bottom_bottom_main row-fluid" style=" margin:0px 0px 0px 3px;">
										<div class="recepie-recipie">
											<?php echo $data['process'];?>
										</div> 
									</div>    
								</div> 	
								<h2 style="margin-top:25px;"> Ingredients List</h2>
								<div id="ingredients" class="tab-pane active recepie_main_bottom_bottom container span12 ">
								    <div class="recepie_main_bottom_bottom_main row-fluid">
								    	<?php 
								    		$i = 1;
								    		foreach($ingredients as $in){
								    			if(	($i % 2) == 0){
								    				if($i > 2)
								    					$more_class = 'more-right';
								    				else
								    					$more_class = 'rightt';
								    			} else {
								    				if($i > 2)
								    					$more_class = 'more_left';
								    				else
								    					$more_class = 'left';
								    			}
								    				

								    		?> 
										    <div class="recepie_main_bottom_bottom_main_one span6 botttom <?php echo $more_class;?>">
											    <div class="recepie_main_bottom_bottom_main_one_left">
												    <a href="<?php echo site_url('ingredient/details/'.getSeoUrl($in['name'], $in['id']));?>">
												    	<img style="width:200px;height:200px;" src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $in['id'];?>/<?php echo $in['image1'];?>" alt="receipe-details-page_img4" />    
													</a>
												</div> 
											    <div class="recepie_main_bottom_bottom_main_one_right">
												    <h6><?php echo $in['name'];?></h6> 
													<ul class="price">
														<li>Price <?php echo $in['sale_price'];?></li>
													</ul>
													<ul class="rating">
														<li>Rating</li>
														<li>
															<div class="star" data-number="5" data-score="<?php echo $in['rating'];?>"></div>
														</li>
													</ul>
												</div> 										
											</div> 

										<?php $i++; } ?>					
									</div>   
								</div> 
								<h2 style="margin-top:25px;"> History</h2>
								<div  id="history" class="tab-pane active recepie_main_bottom_bottom container span12">
							    	<div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-history">
											<?php echo $data['history'];?>
										</div> 
									</div>    
								</div> 

								<h2 style="margin-top:25px;"> Nutrition</h2>
								<div  id="nutrition" class="tab-pane active recepie_main_bottom_bottom container span12">
							    	<div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-history">
											<?php echo $data['nutrition'];?>
										</div> 
									</div>    
								</div>

							</div> 	
						</div>	
					</div> 					
				</div> 				
			</div>   	
        </div>
    </div>

<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.raty.js','js/recipes/recipes-details.js' ))); ?>




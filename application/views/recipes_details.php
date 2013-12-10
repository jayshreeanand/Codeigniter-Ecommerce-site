<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => $data['name'],'cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();
?>
<script>
	var isLoggedIn =  <?php echo ($isLoggedIn) ? 1:  0; ?>; 
</script>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
		<div class="container">
	    <div class="row-fluid">
			<div class="gredient_main">
			    <div class="gredient_main_top container">
				    <h4><?php echo $data['name'];?></h4>
				    <!-- div id="<?php //echo $data['id'];?>" class="main-star" data-number="5" data-score="<?php //echo $data['rating'];?>"></div -->
                   			
				</div>
				
                <div class="recepie_main container">
					<div class="recepie_main_top row-fluid span12">
					    <ul>
					    	<li>
					    		<div class="main1">
								    <div class="main1_inner">
									    <div class="main1_inner_top">
							                <img style="width:200px;height:200px;"  src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $data['id'];?>/<?php echo $data['image1'];?>" alt="<?php echo $data['name'];?>" /> 
										</div>
										<div class="bottom_d" style="padding:0px 15px;">
											<?php if(!empty($data['image1'])){ ?> 
										    	<div class="b_i"><img style="width:50px;height:50px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $data['id'];?>/<?php echo $data['image1'];?>" /></div> 
											<?php } ?>
											<?php if(!empty($data['image2'])){ ?> 
												<div class="b_i"><img style="width:50px;height:50px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $data['id'];?>/<?php echo $data['image2'];?>" /></div>
										    <?php } ?>
										    <?php if(!empty($data['image3'])){ ?> 
										    	<div class="b_i"><img style="width:50px;height:50px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $data['id'];?>/<?php echo $data['image3'];?>" /></div>
											<?php } ?>
										</div>
									</div>   
								</div>
					    	</li>
					    	
					    	<li>
					    		<div class="main2">
									    <div class="main2_inner_top">
									    	<?php if($data['video'] != 'No Video' ){?> 
									    	<iframe width="325" height="248" src="<?php echo $data['video'];?>" frameborder="0"></iframe>
											<?php } else { ?>
											<img src="<?php echo $staticContentUrl.'images/tempvideo.png';?>" />
											<?php } ?>
										</div>
								</div>
					    	</li>
					    	
					    		
					    	<?php if(count($related)){?>
					    	<li>
					    		<div class="main3">
					    			<p style="padding-left:17px;text-align:left;">You can also look at</p>
								    <div class="main3_inner_top">
								    	<?php foreach ($related as $rel) {?>
											<a href="<?php echo site_url('recipe/details/'.getSeoUrl($rel['name'], $rel['id']));?>">
											  	<img style="width:200px;height:200px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $rel['id'];?>/<?php echo $rel['image1'];?>" alt="receipe-details-page_img2" /><br/>
											  	<span><?php echo $rel['name'];?></span>
											</a>
										<?php } ?>
									</div>
									
								</div>
					    	</li>
					    	 <?php } ?>
					    </ul>  
					</div> 
					
					<div class="recepie_main_bottom row-fluid span12">
					    <div class="recepie_main_bottom-inner">
							
							<div class="recepie_main_bottom_top container">
							    <div class="span7">
								    <ul class="inner-list nav nav-tab" id="myTab" >
									    <li><a href="#recipe">Recipes</a></li>
									    <li><a href="#ingredients">Ingredients</a></li>
									    <li><a href="#history">History</a></li>
									     <li><a href="#nutrition">Nutrition</a></li> 
									    <li><a href="#comments">Comments</a></li>    
									</ul> 
								</div>
                                <div class="span5">
								    <ul class="inner-list2">
									    <li>
									    	<a href="<?php echo site_url('recipe/printpopup/'.getSeoUrl($data['name'],$data['id']));?>" 
									    		class="print" data-link="<?php echo getSeoUrl($data['name'],$data['id']);?>"  
									    		onclick="window.open('<?php echo site_url('recipe/printpopup/'.getSeoUrl($data['name'],$data['id']));?>','Print','width=1024,height=300,toolbar=1,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Print</a></li>    
									</ul> 
								</div> 								
							</div>

							<div class="tab-content">

								<div id="recipe" class="tab-pane active recepie_main_bottom_bottom container span12">
							    	<div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-recipie">
											<?php echo $data['process'];?>
										</div> 
									</div>    
								</div> 	


								<div id="history" class="tab-pane recepie_main_bottom_bottom container span12">
							    	<div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-history">
											<?php echo $data['history'];?>
										</div> 
									</div> 
								</div> 

								<div id="nutrition" class="tab-pane recepie_main_bottom_bottom container span12">
									<div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-history">
											<?php echo $data['nutrition'];?>
										</div> 
									</div>  
								</div> 
								
								<div id="comments" class="tab-pane recepie_main_bottom_bottom container span12">
								    <div class="recepie_main_bottom_bottom_main row-fluid">
										<div class="recepie-comments">
										    <div class="recepie-comments-top">
											   		<h5> <?php if(!$isLoggedIn){?>Login to <?php } ?> Share your thoughts</h5>
													<textarea name="ctext" id="ctext"></textarea>
													<input type="hidden" id="rid" name="rid" value="<?php echo $data['id'];?>" />
													<input type="button" class="comment" />
											</div>
											
	                                        <div class="recepie-comments-bottom">
											    <?php foreach ($comments as $comment) { ?>
											    	<p> --> <?php echo $comment['comment'];?></p>
											    <?php }?>								
											</div> 										
										</div> 
									</div>    
								</div> 		

								<div id="ingredients" class="tab-pane recepie_main_bottom_bottom container span12 ">
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
														<li>Price : <span class="WebRupee">&#x20B9;</span> <?php echo $in['sale_price'];?></li>
													</ul>
													<ul class="rating">
														<li>Rating</li>
														<li>
															<div class="star" id="<?php echo $in['id'];?>" data-number="5" data-score="<?php echo $in['rating'];?>"></div>
														</li>
													</ul>
													<a style="left:0px;" href="#" class="add" data-product-id="<?php echo $in['id'];?>" ><?php echo isProductInCart($in['id']) ? 'In Cart' :'Add to Cart';?></a>
													<select name="qty-<?php echo $in['id'];?>" id="qty-<?php echo $in['id'];?>" style="float:right;margin-right:24px;margin-top:9px;width: 53px;">
														<?php foreach(range(1,10) as $q){?>
														<option value="<?php echo $q;?>"><?php echo $q;?></option>
														<?php }?>
													</select>
												</div> 										
											</div> 

										<?php $i++; } ?>					
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




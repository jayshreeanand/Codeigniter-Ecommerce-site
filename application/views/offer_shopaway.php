<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Shopaway','cssFiles' =>array())); 


if($data){

	$food_type = $food_type;
	$spice_level = $spice_level;
	$health_level = $health_level;
	$category_id =  $category_id;

} else {
	$food_type = set_value('food_type');
	$health_level = set_value('health_level');
	$spice_level = set_value('spice_level');
	$category_id =  set_value('category');
}


function getCategory($categories,$cat_id){
	foreach($categories as $category){
		if($cat_id == $category['id'])
			return $category['name'];
	}
}

function getFoodtype($foodtype,$f_id){
	foreach($foodtype as $ftval){
		if($f_id == $ftval['id'])
			return $ftval['name'];
	}
}

?>
<!--main contents area starts here -->
<div class="gradient_page_main-wrap">
	<?php echo showBanner();?>
	
	
    
    
	<div class="container">
	    <div class="row-fluid">
		    <div class="span8">
			    <div class="recepie_main_left">
				    <div class="recepie_main_left_top">
					    <div class="recepie_main_left_top_top heading">
							<h2><strong>Global Graynz Offers</strong></h2>
							<div class="right_cart">
								<h6>Items added in Cart (<?php echo $this->cart->total_items();?>)</h6>
								<a href="<?php echo site_url('ggcart');?>" style="float:right"><img src="<?php echo $staticContentUrl;?>images/shopping_cart2.png" alt="shopping_cart2" /></a>
							</div> 							
						</div>
 						<div class="threeselect">
                        <form method="post" id="shopaway" action="<?php echo site_url('offer_shopaway');?>">
							<div class="veg">
								<input name="d5_1" id="d5_1" type="checkbox" value="<?php echo ($food_type==2 || $food_type==3) ? 1 : 0; ?>" <?php echo ($food_type==2 || $food_type==3) ? "checked" : ""; ?>  /><a href="#"><img src="<?php echo $staticContentUrl;?>images/red.gif" width="24" height="23" alt="Red"></a><input name="d5_2" id="d5_2" type="checkbox" value="<?php echo ($food_type==1 || $food_type==3) ? 1 : 0; ?>" <?php echo ($food_type==1 || $food_type==3) ? "checked" : ""; ?> /><a href="#"><img src="<?php echo $staticContentUrl;?>images/green.gif" width="24" height="23" alt="Green"></a>
							</div>
							<ul>
								<li>
										<select name="d4" class="styled">

											<option value=" ">Category</option>
											<?php foreach($categories as $category){?>
							      			<option value="<?php echo $category['id'];?>" <?php if(($category_id == $category['id']) && !empty($category_id)){ echo 'selected';}?>> <?php echo $category['name'];?></option>
							      			<?php }?>
										</select>
																		
								</li>
								<li>
													<select name="d2" class="styled">
										<option value=''>Health</option>
										<?php foreach($healthlevel as $hl){?>
		      								<option value="<?php echo $hl['id'];?>" <?php if($health_level == $hl['id']){ echo 'selected';}?>> <?php echo $hl['name'];?></option>
		      							<?php }?>
													</select>
								</li>
								<li>
													<select name="d" class="styled">
											<option value=''>Spice</option>
											<?php foreach($spicelevel as $sl){?>
							      			<option value="<?php echo $sl['id'];?>" <?php if($spice_level == $sl['id']){ echo 'selected';}?>> <?php echo $sl['name'];?></option>
							      			<?php }?>
													</select>
								</li>											
							</ul>
                             <?php
							 	$rimg="images/rating.png";
								$pimg="images/price.png";
								$nimg="images/name.png";
								if($srt_level=="rsa") $rimg="images/rating-down.png";
								else if($srt_level=="rsd") $rimg="images/rating-up.png";
								if($srt_level=="psa") $pimg="images/price-down.png";
								else if($srt_level=="psd") $pimg="images/price-up.png";
								if($srt_level=="nsa") $nimg="images/name-down.png";
								else if($srt_level=="nsd") $nimg="images/name-up.png";								
							 ?>
						     <div class="info">
							 	<a href="#"><img  id="rs" src="<?php echo $staticContentUrl.$rimg;?>" alt="Rating"></a>
								<a href="#"><img  id="ps" src="<?php echo $staticContentUrl.$pimg;?>" alt="Price"></a>
								<a href="#"><img  id="ns" src="<?php echo $staticContentUrl.$nimg;?>" alt="Name"></a>
							 </div> 
						</div> 
                        <input type="hidden" name="sortval" id="sortval" value="<?php echo $srt_level;?>" />
                        </form>                         
					</div>
				    <div class="recepie_main_left_bottom row-fluid">
					    <div class="recepie_main_left_bottom_inner infoPart">
							<ul>
							<?php 
							$cnt=0;
							foreach($data as $datum){
							if($cnt==15) break;
							?>
								<li>
									<div class="recepie_main_left_bottom_one">
										<div class="recepie_main_left_bottom_one_top">
										    <div class="star" id="<?php echo $datum['id'];?>" data-number="5" data-score="<?php echo $datum['rating'];?>"></div>
											<span class="green">
                                            	<?php if((int)$datum['food_type'] == 1) { ?><img src="<?php echo $staticContentUrl;?>images/vegitable.png" alt="Vegitable">
												<?php } else if((int)$datum['food_type'] == 2){ ?>
                                                <img src="<?php echo $staticContentUrl;?>images/non_veg.png" alt="Non Veg">
                                                <?php } ?>
                                            </span>
										    <a href="<?php echo site_url('ingredient/details/'.getSeoUrl($datum['name'],$datum['id'])); ?>">
										    	<img style="width:200px;height:200px;" src="<?php echo $staticContentUrl.'uploads/ingredients/'.$datum['id'].'/'.$datum['image1'];?>" alt="receipe-page_img1" /> 
										    </a>  
										</div>
									    <div class="recepie_main_left_bottom_one_bottom shopway_span">                                           
											<p><strong><a href="<?php echo site_url('ingredient/details/'.getSeoUrl($datum['name'],$datum['id'])); ?>"><?php echo $datum['name'];?></a></strong></p>
											<strong><?php echo getCategory($categories,$datum['category_id']);?></strong>
<?php if($datum['regular_price']!=$datum['sale_price']) { ?><span class="price-out">&#x20B9; <?php echo $datum['regular_price'];?></span><?php } else { echo '<span class="price-out"><br /></span>';}?> 
                                            
                                            <span>&#x20B9; <?php echo $datum['sale_price'];?></span>
											 <ul class="infolist">
												<li>
<a href="#" class="shop_way_rating_a add" data-product-id="<?php echo $datum['id'];?>" ><?php echo isProductInCart($datum['id']) ? 'In Cart' :'Add to Cart';?></a>									
									    <select name="qty-<?php echo $datum['id'];?>" id="qty-<?php echo $datum['id'];?>" class="shop_way_rating_select">
												<?php foreach(range(1,10) as $q){?>
												<option value="<?php echo $q;?>"><?php echo $q;?></option>
												<?php }?>
											</select>
												</li>
											</ul>
										</div> 										
									</div>
								</li>
								<?php 
								$cnt++;
								} 
									if(!count($data)){ ?>
										<li><h6>No ingredients found</h6></li>
								<?php } ?>								
							</ul>
						</div>
						<div class="pagi">
                        <?php echo $this->pagination->create_links(); ?>
							<!--<a href="#" class="prev"><img src="<?php echo $staticContentUrl;?>images/prev.png" alt="Prev"></a>
							<ul>
								<li><a href="#">1</a></li>
								<li><a href="#" class="slct">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">6</a></li>
								<li><a href="#">7</a></li>
								<li><a href="#">8</a></li>
								<li><a href="#">9</a></li>
								<li><a href="#">10</a></li>
								<li><a href="#">..</a></li>
								<li><a href="#">12</a></li>
							</ul>
							<a href="#" class="next"><img src="<?php echo $staticContentUrl;?>images/next.png" alt="Nextt"></a>
                            -->
						</div>
						<div class="pagr">
							<!--<a href="#">25</a>
							<a href="#">50</a>
							<a href="#">100</a>	-->
						</div>
					</div> 					
				</div>   
			</div>

			<div class="span4">
			    <div class="recepie_main_right">
				    <div class="recepie_main_right_top">
					    <h4>Recommendation</h4>   
					</div>
				    <div class="shopway_main_right_bottom infoPart">
					    <ul>
					    	<?php foreach($recommendations as $r){?>
                            <li>
									<div class="shopway_right_bottom_one">
									    <div class="recepie_main_left_bottom_one_top">
									    	<a href="<?php echo site_url('ingredient/details/'.getSeoUrl($r['name'],$r['id'])); ?>">
										    	<img style="width:200px;height:200px;" src="<?php echo $staticContentUrl.'uploads/ingredients/'.$r['id'].'/'.$r['image1'];?>" alt="shopaway-page-new_img1" />   
											</a>
                                               
										</div>
									    <div class="recepie_main_left_bottom_one_bottom">							
											<p><strong><a href="<?php echo site_url('ingredient/details/'.getSeoUrl($r['name'],$r['id'])); ?>"><?php echo $r['name']; ?></a></strong></p>
											<strong><?php echo getCategory($categories,$r['category_id']);?></strong>
											<?php if($r['regular_price']!=$r['sale_price']) { ?><div><span class="price-out">&#x20B9; <?php echo $r['sale_price'];?></span></div><?php } else { echo '<div><span class="price-out"><br /></span></div>';}?>
											<span>&#x20B9; <?php echo $r['sale_price'];?></span>
                                            <ul class="infolist">
												<li>
<a href="#" class="shop_way_rating_a add" data-product-id="<?php echo $r['id'];?>" ><?php echo isProductInCart($r['id']) ? 'In Cart' :'Add to Cart';?></a>									
									    <select name="qty-<?php echo $r['id'];?>" id="qty-<?php echo $r['id'];?>" class="shop_way_rating_select">
												<?php foreach(range(1,10) as $q){?>
												<option value="<?php echo $q;?>"><?php echo $q;?></option>
												<?php }?>
											</select>
                                                
                                               </li>
											</ul>
										</div> 										
									</div>							
							</li>
                            <?php } ?>
					    </ul>  
					</div> 					
				</div> 
			</div> 
        </div>
    </div>
    
    
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/select.js','js/vendor/jquery.raty.js','js/shopway/shopaway.js'))); ?>


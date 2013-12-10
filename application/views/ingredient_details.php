<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => $data['name'],'cssFiles' =>array('css/vendor/rcarousel.css'))); 

$icount = 0;
if($data['image1'])
	$icount++;
if($data['image2'])
	$icount++;
if($data['image3'])
	$icount++;

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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 
<!--main contents area starts here -->

<div class="gradient_page_main-wrap">
<?php echo showBanner();?>
<div class="container">
  <div class="row-fluid">
    <div class="gredient_main">
      <div class="gredient_main_top container">
        <h4><?php echo $data['name'];?></h4>
      </div>
      <div class="gredient_main_bottom container">
        <div class="container">
          <div class="gredient_main_bottom_top row-fluid">
            <div class="sideimg">
              <div class="imgholder"> <img style="width:200px;height:200px;" src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $data['id']; ?>/<?php echo $data['image1']; ?>" alt="food sample" /> </div>
              <?php if($icount > 1){ ?>
              <div class="three_box">
                <?php if($data['image1']){?>
                <div class="box_imgHolder"> <img  src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $data['id']; ?>/<?php echo $data['image1']; ?>" alt="" /> </div>
                <?php } ?>
                <?php if($data['image2']){?>
                <div class="box_imgHolder"> <img src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $data['id']; ?>/<?php echo $data['image2']; ?>" alt="" /> </div>
                <?php } ?>
                <?php if($data['image3']){?>
                <div class="box_imgHolder"> <img src="<?php echo $staticContentUrl;?>uploads/ingredients/<?php echo $data['id']; ?>/<?php echo $data['image3']; ?>" alt="" /> </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
            <div class="food_detail">
              <div class="textholder">
                <p> <?php echo $data['description'];?> </p>
              </div>
              <div class="price_add">
                <ul>
                  <li class="more-margin" style="margin-right:19px;">Food Type:</li>
                  <li><?php echo getFoodtype($foodtype,$data['food_type']);?>

                    <?php 	/*if((int)$data['food_type'] == 1){ 
														echo 'Veg'; 
													} else if((int)$data['food_type'] == 2){ 
														echo 'Non Veg';
													}*/?>

                  </li>
                </ul>
                <ul>
                  <li class="more-margin">Category:</li>
                  <li><?php echo getCategory($categories,$data['category_id']);?></li>
                </ul>
                <ul>
                  <li class="more-margin" style="margin-right:46px;" >Rating:</li>
                  <li>
                    <div class="star" id="<?php echo $data['id'];?>" data-number="5" data-score="<?php echo $data['rating'];?>"></div>
                  </li>
                </ul>
                <ul>
                  <li class="more-margin" style="margin-right:56px;" >Price:</li>
                  <li><span class="WebRupee">&#x20B9;</span> <?php echo $data['sale_price'];?></li>
                </ul>
                <ul>
                  <li style="margin-right:32px;">Quantity:</li>
                  <li>
                    <select name="qty" id="qty" style="margin-top:-5px;width:56px;">
                      <?php foreach(range(1,10) as $q){?>
                      <option value="<?php echo $q;?>"><?php echo $q;?></option>
                      <?php }?>
                    </select>
                    <a href="#" class="add add-to-cart-ingredient" data-product-id="<?php echo $data['id']; ?>" ><?php echo isProductInCart($data['id']) ? 'In Cart' :'Add to Cart';?></a> </li>
                </ul>
                <ul>
                  <li>
                    <div class="fb-like" data-href="<?php echo current_url();?>" data-send="false" data-width="450" data-show-faces="true" data-font="tahoma"></div>
                  </li>
                </ul>
                <!--<ul>
              <li>
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.globalgraynz.com&amp;send=false&amp;layout=standard&amp;width=100&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:35px;" allowTransparency="true"></iframe>              
              </li>
              </ul>--> 
              </div>
            </div>
          </div>
          <?php
						$usedinCount = count($usedin);
						echo '<script> var usedinCount = '.$usedinCount.';</script>';
					 if($usedinCount){?>
          <div class="gredient_main_bottom_bottom">
            <div class="container">
              <div class="row-fluid">
                <div class="gredient_slide span12">
                  <div class="gredient_slide_top span11">
                    <div class="olive_oil_recepies">
                      <p>Looking for something exciting to make with this product? - Check out these awesome recipes</p>
                    </div>
                  </div>
                  <div class="gredient_slide_bottom span12">
                    <div class="gredient_slide_bottom_inner">
                      <?php if($usedinCount > 4){?>
                      <a href="#" id="ui-carousel-prev"><img src="<?php echo $staticContentUrl;?>images/ingredient_arrow1.png" class="ingredient_arrow1" alt="ingredient_arrow1" /> </a>
                      <?php } ?>
                      <div id="carousel" style="padding:20px;margin: 0;">
                        <?php foreach ($usedin as $u) {?>
                        <a class="suges" style="text-decoration:none;" href="<?php echo site_url('recipe/details/'.getSeoUrl($u['name'],$u['id']));?>" > <img style="width:200px;height:200px;" src="<?php echo $staticContentUrl;?>uploads/recipes/<?php echo $u['id'];?>/<?php echo $u['image1'];?>" /> <br/>
                        <?php echo $u['name'];?> </a>
                        <?php } ?>
                      </div>
                      <?php if($usedinCount > 4){?>
                      <a href="#" id="ui-carousel-next"><img src="<?php echo $staticContentUrl;?>images/ingredient_arrow2.png" class="ingredient_arrow2" alt="ingredient_arrow2" style="margin:-155px 15px 0 0" /></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/jquery.raty.js','js/vendor/jquery.ui.core.min.js','js/vendor/jquery.ui.widget.min.js','js/vendor/jquery.ui.rcarousel.min.js','js/ingredients/ingredients-details.js' ))); ?>

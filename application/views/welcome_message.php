<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'Home','cssFiles' =>array())); 
$isLoggedIn = isLoggedIn();

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

<div class="homepage_main-wrap">
  <div class="container">
    <div class="main">
      <div class="slogan-section">
        <h2>India's first exclusively international online grocery store</h2>
      </div>
      <div class="row-fluid">
        <div class="span4">
          <div class="section1-wrap">
            <div class="section1-wrap-inner" title="Explore Recipes"> <a href="<?php echo site_url('recipe');?>"><img src="<?php echo $staticContentUrl;?>images/pin.png" class="pin" alt="pin" /></a>
              <h3 style="margin-top:9x"><a href="<?php echo site_url('recipe');?>">Explore</a></h3>
              <a href="<?php echo site_url('recipe');?>"><img src="<?php echo $staticContentUrl;?>images/recipes.jpg" class="banner3_img2" alt="Explore Recipes" /></a>
              <h3><a href="<?php echo site_url('recipe');?>">Recipes</a></h3>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="section2-wrap">
            <div class="section2-wrap-inner" title="Shop Chef's Boxes"> <a href="<?php echo site_url('shopaway_box');?>"><img src="<?php echo $staticContentUrl;?>images/pin.png" class="pin" alt="pin" /></a>
              <h3 style="margin-top:-17px"><a href="<?php echo site_url('shopaway_box');?>">Chef's Boxes</a></h3>
              <a href="<?php echo site_url('shopaway_box');?>"><img src="<?php echo $staticContentUrl;?>images/chefbox.jpg" class="banner2_img2" alt="Shop Chef's Boxes" /></a>
              <h3><a style="text-decoration:none" href="<?php echo site_url('shopaway_box');?>">Shop Now!</a></h3>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="section3-wrap">
            <div class="section3-wrap-inner" title="Experience our Pantry"> <a href="<?php echo site_url('shopaway');?>"><img src="<?php echo $staticContentUrl;?>images/pin.png" class="pin" alt="pin" /></a>
              <h3 style="margin-top:9x"><a href="<?php echo site_url('shopaway');?>">Shop</a></h3>
              <a href="<?php echo site_url('shopaway');?>"><img src="<?php echo $staticContentUrl;?>images/ingredients.jpg" class="banner1_img2" alt="international cuisines" /></a>
              <h3><a href="<?php echo site_url('shopaway');?>">Products</a></h3>
            </div>
          </div>
        </div>
      </div>
      <div style="padding-top: 30px;font-size: 15px;color: #FFF;">
        <center>
          <p>Free shipping in Chennai &amp; Bangalore  | Flat Rs.100 for rest of India | Chef's Boxes delivered within 48 hrs in Chennai | Cash on Delivery available</p>
        </center>
      </div>
      <div class="row-fluid">
        <div class="bottomBox">
          <div class="span12">
            <h2>Special Offers</h2>
            <a href="<?php echo site_url('offer_shopaway');?>" class="seemore">See more</a> </div>
          <div class="boxArea">
            <dl>
              <?php foreach($offer_newingredientdata as $oni_datum) { ?>
              <dd>
                <div class="star" id="<?php echo $oni_datum['id'];?>" data-number="5" data-score="<?php echo $oni_datum['rating'];?>"></div>
                <span class="green">
                <?php if((int)$oni_datum['food_type'] == 1) { ?>
                <img src="<?php echo $staticContentUrl;?>images/vegitable.png" alt="Vegitable">
                <?php } else if((int)$oni_datum['food_type'] == 2){ ?>
                <img src="<?php echo $staticContentUrl;?>images/non_veg.png" alt="Non Veg">
                <?php } ?>
                </span>
                <div class="homeprodcent"> <a href="<?php echo site_url('ingredient/details/'.getSeoUrl($oni_datum['name'],$oni_datum['id'])); ?>"> <img style="width:200px;height:200px;" src="<?php echo $staticContentUrl.'uploads/ingredients/'.$oni_datum['id'].'/'.$oni_datum['image1'];?>" /> </a> </div>
                <span style="margin-left:10px;">
                <p><strong><a href="<?php echo site_url('ingredient/details/'.getSeoUrl($oni_datum['name'],$oni_datum['id'])); ?>"><?php echo $oni_datum['name'];?></a></strong></p>
                </span><br/>
                <strong><?php echo getCategory($categories,$oni_datum['category_id']);?></strong>
                <?php if($oni_datum['regular_price']!=$oni_datum['sale_price']) { ?>
                <span class="price-out">&#x20B9; <?php echo $oni_datum['regular_price'];?></span>
                <?php } ?>
                <br />
                <span><span class="WebRupee">&#x20B9;</span> <?php echo $oni_datum['sale_price'];?></span>
                <div class="clear"> <a href="#" class="shop_way_rating_a add" data-product-id="<?php echo $oni_datum['id'];?>" ><?php echo isProductInCart($oni_datum['id']) ? 'In Cart' :'Add to Cart';?></a>
                  <select name="qty-<?php echo $oni_datum['id'];?>" id="qty-<?php echo $oni_datum['id'];?>" class="homeselectbx">
                    <?php foreach(range(1,10) as $q){?>
                    <option value="<?php echo $q;?>"><?php echo $q;?></option>
                    <?php }?>
                  </select>
                </div>
              </dd>
              <?php } if(empty($offer_newingredientdata)) { echo '<div style="width:100%;height:200px;bgcolor:white"> <center><strong><br/><br/><br/><br/>There are no Offers.</strong></center></div>';}?>
            </dl>
          </div>
          <div class="span12">
            <h2>New Products</h2>
            <a href="<?php echo site_url('shopaway');?>" class="seemore">See more</a> </div>
          <div class="boxArea">
            <dl>
              <?php foreach($new_ingredientdata as $ni_datum) { ?>
              <dd>
                <div class="star" id="<?php echo $ni_datum['id'];?>" data-number="5" data-score="<?php echo $ni_datum['rating'];?>"></div>
                <span class="green">
                <?php if((int)$ni_datum['food_type'] == 1) { ?>
                <img src="<?php echo $staticContentUrl;?>images/vegitable.png" alt="Vegitable">
                <?php } else if((int)$ni_datum['food_type'] == 2){ ?>
                <img src="<?php echo $staticContentUrl;?>images/non_veg.png" alt="Non Veg">
                <?php } ?>
                </span>
                <div class="homeprodcent"> <a href="<?php echo site_url('ingredient/details/'.getSeoUrl($ni_datum['name'],$ni_datum['id'])); ?>"> <img style="width:200px;height:200px;" src="<?php echo $staticContentUrl.'uploads/ingredients/'.$ni_datum['id'].'/'.$ni_datum['image1'];?>" /> </a> </div>
                <span style="margin-left:10px;">
                <p><strong><a href="<?php echo site_url('ingredient/details/'.getSeoUrl($ni_datum['name'],$ni_datum['id'])); ?>"><?php echo $ni_datum['name'];?></a></strong></p>
                </span><br/>
                <strong><?php echo getCategory($categories,$ni_datum['category_id']);?></strong>
                <?php if($ni_datum['regular_price']!=$ni_datum['sale_price']) { ?>
                <span class="price-out">&#x20B9; <?php echo $ni_datum['regular_price'];?></span>
                <?php } ?>
                <br />
                <span class="WebRupee">&#x20B9;</span> <?php echo $ni_datum['sale_price'];?></span>
                <div class="clear"> <a href="#" class="shop_way_rating_a add" data-product-id="<?php echo $ni_datum['id'];?>" ><?php echo isProductInCart($ni_datum['id']) ? 'In Cart' :'Add to Cart';?></a>
                  <select name="qty-<?php echo $ni_datum['id'];?>" id="qty-<?php echo $ni_datum['id'];?>" class="homeselectbx">
                    <?php foreach(range(1,10) as $q){?>
                    <option value="<?php echo $q;?>"><?php echo $q;?></option>
                    <?php }?>
                  </select>
                </div>
              </dd>
              <?php } ?>
            </dl>
          </div>
          <div class="span12">
            <h2>Recent Recipes</h2>
            <a href="<?php echo site_url('recipe');?>" class="seemore">See more</a> </div>
          <div class="boxArea">
            <dl>
              <?php foreach($new_recipedata as $nr_datum) { ?>
              <dd>
                <div class="feature"> <a href="<?php echo site_url('recipe/details/'.getSeoUrl($nr_datum['name'], $nr_datum['id']));?>"> <img style="height:200px;width:200px;" src="<?php echo $staticContentUrl.'uploads/recipes/'.$nr_datum['id'].'/'.$nr_datum['image1'];?>" /> </a> </div>
                <h3>Cuisine Name : <a href="<?php echo site_url('recipe/details/'.getSeoUrl($nr_datum['name'], $nr_datum['id']));?>"><?php echo smarttruncate($nr_datum['name'],41,TRUE,TRUE);?></a> </h3>
                <div> Cuisine Type : <?php echo getCuisineName($cuisines,$nr_datum['cuisine_id']);?> </div>
                <!--<img src="<?php echo $staticContentUrl;?>images/star.gif" alt="Star">-->
                <div class="star" id="<?php echo $nr_datum['id'];?>" data-number="5" data-score="<?php echo $nr_datum['rating'];?>"></div>
              </dd>
              <?php 
							} 
							?>
            </dl>
          </div>
        </div>
      </div>
      <div style="padding-top: 59px;font-size: 18px;color: #FFF;">
        <center>
          <p> </p>
        </center>
      </div>
    </div>
  </div>
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/vendor/select.js','js/vendor/jquery.raty.js','js/recipes/recipes-search.js','js/shopway/shopaway.js'))); ?>

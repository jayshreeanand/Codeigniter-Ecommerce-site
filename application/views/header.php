<?php
$staticContentUrl = base_url(); 
$isLoggedIn = isLoggedIn();
$cssFile = '';
$seo_keywords = 'International Foods, Global Foods, India, Pasta, Chinese, Thai, Italian, Food, Experience, Gourmet products, multi cuisine, ingredients, recipe packs, sauces';
$seo_description = '';
$submenu = isset($submenu) ? $submenu: '';
if(isset($cssFiles))
{
    foreach($cssFiles as $cssF)
    {
        $cssFile .= '<link rel="stylesheet" type="text/css" href="'.$staticContentUrl.$cssF.'" />';
    }
}
$c = $this->uri->segment(1);
$a = $this->uri->segment(2);

$keywords = $this->input->post('keywords') ? $this->input->post('keywords') : '';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title>Global Graynz – The International Food Experience - <?php echo $pageTitle;?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=0.25, minimum-scale=0.25, maximum-scale=1.0" />
		<meta name="keywords" content="<?php echo $seo_keywords;?>">
		<meta name="description" content="<?php echo $seo_description;?>">
		<meta name="author" content="Global Graynz">
		<link rel="icon" type="image/png" href="<?php echo $staticContentUrl;?>images/favicon.ico" />
	    <!-- Le styles -->
	    <link type="text/css" rel="stylesheet" href="<?php echo $staticContentUrl;?>css/vendor/bootstrap.css" />
	   
	    <link type="text/css" rel="stylesheet" href="<?php echo $staticContentUrl;?>css/style.css" />
	    <?php echo $cssFile;?>
	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="js/html5shiv.js"></script>
	    <![endif]-->
	 	<script>
	    	staticContentUrl = '<?php echo $staticContentUrl;?>';
	    	siteurl = '<?php echo $staticContentUrl.'index.php/';?>';
	    </script>



	    <script type="text/javascript">
var subid  = <?php echo json_encode($this->session->userdata('sub')); ?>; 
</script>


	    <style type='text/css'> 
	    	@-ms-viewport { 
	    		min-zoom: 0.25; // Smallest allowed zoom factor. 
	    		width: device-width; 
	    	}
	    </style>
	</head>
	<body <?php if($c == 'welcome' || empty($c)) {?> class="index_page" <?php } ?> >	

	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 


		<!--header starts here -->
		<div class="header-wrap">
			<div class="container">
		        <header class="header">
		            <div class="row-fluid">
		            	<div class="span6 left">
		            	 <ul>
                  <li>
                   <div class="fb-like" data-href="http://facebook.com/globalgraynz" data-width="450" data-show-faces="false" data-send="false"></div>
                  </li>
                </ul>
		                	<a href="<?php echo site_url();?>"><img style="height:104px;width:333px;" src="<?php echo $staticContentUrl;?>images/main_logo.png" alt=""></a>	
		                </div>

		                <?php if($a != 'printpopup'){?> 
		                <div class="span6 right">

		                	<div class="login-section" style="float:right;">
		                        <?php if(!$isLoggedIn){?> 
		                        <a href="javascript:void(0);" class="login" >Login</a>
		                        <?php } else {?>
		                        Hi, <?php echo $this->session->userdata('e')?> <a class="login" href="<?php echo site_url('logout');?>">Logout</a>
		                    	<?php } ?>
		                        <a href="<?php echo site_url('ggcart');?>" class="shopping_cart"><img src="<?php echo $staticContentUrl;?>images/shopping_cart.png" alt="shopping_cart" /></a>
		                        </ul>
                
		                    </div>
		                    <div class="search-section">
		                        <div class="search-wrap clearfix">
		                        	<form name="search" method="post" id="search-frm" action="<?php echo site_url('search');?>" >
		                            	<input type="text" autocomplete="off" name="keywords" id-"keywords" placeholder="Search.." class="search-field" value="<?php echo $keywords;?>" >
										<button class="search-btn"><img src="<?php echo $staticContentUrl;?>images/search.png" alt="search" /></button>
									</form>
		                        </div>
		                                <ul class="bottom-nav1">
					<li><img src="<?php echo $staticContentUrl;?>images/visa.png" alt="visa" /></li>
					<li><img src="<?php echo $staticContentUrl;?>images/mastercard.png" alt="mastercard" /></li>
					<li><img src="<?php echo $staticContentUrl;?>images/amex.png" alt="amex" /></li>
				</ul>
		                    </div>	
		            				
		                </div>
		                <?php }?>
		            </div>
		            <?php if($c != 'welcome' && !empty($c) && $a != 'printpopup') {?> 
		                <div class="main_nav">
							<nav>
								<ul>
									<li><a href="<?php echo site_url();?>">Home</a></li>
									<li><a href="<?php echo site_url('recipe');?>"  <?php if($c == 'recipe'){?> class="active" <?php }?> >Recipes</a></li>
									<li><a href="<?php echo site_url('shopaway_box');?>" <?php if($c == 'shopaway_box'){?> class="active" <?php }?> >Chef's Boxes</a></li>
									<li><a href="<?php echo site_url('shopaway');?>" <?php if($c == 'shopaway' || $c == 'ingredient'){?> class="active" <?php }?>>Shop</a></li>
									<?php if($isLoggedIn){?>
										<li><a href="<?php echo site_url('user/myorder');?>" <?php if($c == 'user'){?> class="active" <?php }?>>My Orders</a></li>
										<li><a href="<?php echo site_url('changepassword');?>" <?php if($c == 'changepassword'){?> class="active" <?php }?>>Change Password</a></li>
									<?php } ?>
								</ul>
							</nav> 
						</div>
						<?php }?>
		        </header>
		    </div>
		</div>
		<!--header ends -->





















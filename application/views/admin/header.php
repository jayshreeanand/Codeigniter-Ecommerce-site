<?php
$staticContentUrl = base_url(); 
$isLoggedIn = isLoggedIn();
$cssFile = '';
$submenu = isset($submenu) ? $submenu: '';
if(isset($cssFiles))
{
    foreach($cssFiles as $cssF)
    {
        $cssFile .= '<link rel="stylesheet" type="text/css" href="'.$staticContentUrl.$cssF.'" />';
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>globalgraynz | <?php echo $pageTitle;?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo $staticContentUrl;?>css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $staticContentUrl;?>css/vendor/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo $staticContentUrl;?>css/main.css">
         <?php echo $cssFile;?>
        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
         <script>
            staticContentUrl = '<?php echo $staticContentUrl;?>';
            siteurl = '<?php echo $staticContentUrl.'index.php/';?>';
        </script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->


        <div class="navbar">
	    	<div class="navbar-inner">
	    		<div class="container">
	    			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    				<span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			         </a>
	          		<a class="brand" href="<?php echo site_url();?>">globalgraynz</a>
	          		<div class="nav-collapse collapse">
	            		<ul class="nav">
	              			<?php 
	              			$page = array('c' => (string)$this->uri->segment(1), 'a' => (string)$this->uri->segment(2));
	              			if($isLoggedIn  && $this->session->userdata('r') == 0)
								$this->load->view('admin/navbar',$page);
	              			?>
	            		</ul>	
	          		</div><!--/.nav-collapse -->
	        	</div>
	        </div>
	 	</div>
	 	<div class="containder">

	 		
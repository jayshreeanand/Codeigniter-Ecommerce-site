<?php 
$staticContentUrl = base_url(); 
$this->load->view('header', array('pageTitle' => 'International Cuisines','cssFiles' =>array())); 


function getRecipesBasedOnCuisine($data, $cuisine_id){
	$output = '';
	if(isset($data[$cuisine_id])){
		foreach($data[$cuisine_id] as $r){
			$output .= '<li>'.anchor('/recipe/details/'.getSeoUrl($r['name'],$r['id']), $r['name'], 'attributs').'</li>';
		}
	} else {
		$output .= '<li>No Recipes</li>';
	}
	return $output;
}

?>

<!--main contents area starts here -->
<div class="map_page_main-wrap">
	<div class="container">
	    <div class="row-fluid">
			<div class="map_main">
			    <div class="map_main_top container">
				    <h4>Explore International Cuisines</h4>  
				</div>				
                <div class="map_main_bottom container">
				    <img src="<?php echo $staticContentUrl;?>images/map.png" class="map" alt="world_map" /> 

					<a href="javascript://" id="italian"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>

					<a href="javascript://" id="greek"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>

					<a href="javascript://" id="french"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>

					<a href="javascript://" id="chinese"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>
					<a href="javascript://" id="thai"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>

					<a href="javascript://" id="mexican"  rel="popover">
						<img src="<?php echo $staticContentUrl;?>images/map_pointer.png" />
					</a>

				</div> 				
			</div>   	
        </div>
    </div>
</div>

<div id="italian-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, '1e4640b0ef2494859dfbe21654343782');?>
	</ul>
</div>

<div id="greek-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, '689c56b2aceac9ed953d2b211e302dad');?>
	</ul>
</div>

<div id="french-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, '74ba5e390c8185f775f4d6f5fc6f3bcc');?>
	</ul>
</div>

<div id="chinese-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, 'a93a1bb475c53560348619f86ee42419');?>
	</ul>
</div>

<div id="thai-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, 'a5818e90424ffb219ebcdd967868d6c5');?>
	</ul>
</div>

<div id="mexican-content" style="display:none">
	<ul>
		<?php echo getRecipesBasedOnCuisine($data, 'e3f3c37945750e987246e1a71e19b7dc');?>
	</ul>
</div>
<!--main content area (except header,footer) ends -->
<?php $this->load->view('footer', array('jsFiles' => array('js/internationalcuisine/map.js'))); ?>


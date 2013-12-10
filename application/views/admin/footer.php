<?php 
$staticContentUrl = base_url();
$jsFile =''; 
if(isset($jsFiles))
{
	foreach($jsFiles as $jsF)
	{
		$jsFile .= '<script type="text/javascript" src="'.$staticContentUrl.$jsF.'"></script> ';
	}
}
?>
			<hr style="clear:both;" />
	      	<footer>
	        	<p>&copy; globalgraynz 2013</p>
	      	</footer>
		</div><!--/.fluid-container-->
		<script src="<?php echo $staticContentUrl;?>js/vendor/jquery-1.9.0.min.js"></script>
		<script src="<?php echo $staticContentUrl;?>js/vendor/bootstrap.min.js"></script>
		<?php echo $jsFile;?>
		<!--  Page rendered in {elapsed_time} -->
	</body>
</html>
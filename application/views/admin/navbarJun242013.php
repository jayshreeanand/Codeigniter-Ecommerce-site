<li <?php if($c=='' || $c == 'admin'){?> class="active" <?php }?>><a href="<?php echo site_url('admindashboard');?>">Home</a></li>
<li <?php if($c == 'admincuisine' ){?> class="active" <?php }?>><a href="<?php echo site_url('admincuisine');?>">Cuisine</a></li>
<li <?php if($c == 'admincategory' ){?> class="active" <?php }?>><a href="<?php echo site_url('admincategory');?>">Category</a></li>
<li <?php if($c == 'adminingredient' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminingredient');?>">Ingredients</a></li>
<li <?php if($c == 'adminrecipe' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminrecipe');?>">Recipes</a></li>
<li <?php if($c == 'adminrecipecomment' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminrecipecomment');?>">Recipes Comments</a></li>
<li <?php if($c == 'adminuser' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminuser');?>">Users</a></li>
<li <?php if($c == 'adminorder' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminorder');?>">Orders</a></li>
<li <?php if($c == 'adminupload' ){?> class="active" <?php }?>><a href="<?php echo site_url('adminupload');?>">Bulk Upload</a></li>
<li <?php if($c == 'logout' ){?> class="active" <?php }?>><a href="<?php echo site_url('logout');?>">Logout</a></li>
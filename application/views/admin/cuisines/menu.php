<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'admincuisine/' || $c.'/'.$a == 'admincuisine/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('admincuisine/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'admincuisine/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('admincuisine/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'admincuisine/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
 
  </ul>
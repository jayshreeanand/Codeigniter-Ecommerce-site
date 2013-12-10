<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminspicelevel/' || $c.'/'.$a == 'adminspicelevel/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminspicelevel/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'adminspicelevel/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminspicelevel/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'adminspicelevel/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
 
  </ul>
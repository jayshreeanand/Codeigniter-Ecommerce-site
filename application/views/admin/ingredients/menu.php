<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminingredient/' || $c.'/'.$a == 'adminingredient/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminingredient/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'adminingredient/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminingredient/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'adminingredient/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
    <li <?php echo ($c.'/'.$a == 'adminingredient/view') ? $active : $inavtive; ?>><a href="#">View</a></li>
  </ul>
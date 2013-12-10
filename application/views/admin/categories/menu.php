<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'admincategory/' || $c.'/'.$a == 'admincategory/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('admincategory/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'admincategory/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('admincategory/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'admincategory/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
 
  </ul>
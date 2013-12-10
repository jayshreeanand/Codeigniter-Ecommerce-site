<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminfoodtype/' || $c.'/'.$a == 'adminfoodtype/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminfoodtype/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'adminfoodtype/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminfoodtype/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'adminfoodtype/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
 
  </ul>
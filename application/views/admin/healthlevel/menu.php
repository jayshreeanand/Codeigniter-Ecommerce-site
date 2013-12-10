<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminhealthlevel/' || $c.'/'.$a == 'adminhealthlevel/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminhealthlevel/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'adminhealthlevel/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminhealthlevel/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'adminhealthlevel/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
 
  </ul>
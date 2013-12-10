<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminrecipe/' || $c.'/'.$a == 'adminrecipe/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminrecipe/index');?>">List</a></li>
    <li <?php echo ($c.'/'.$a == 'adminrecipe/add') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminrecipe/add');?>">Add</a></li>
    <li <?php echo ($c.'/'.$a == 'adminrecipe/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>
    <li <?php echo ($c.'/'.$a == 'adminrecipe/view') ? $active : $inavtive; ?>><a href="#">View</a></li>
  </ul>
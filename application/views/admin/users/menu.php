<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminuser/' || $c.'/'.$a == 'adminuser/index') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminuser/index');?>">View Users</a>
    </li>
  </ul>

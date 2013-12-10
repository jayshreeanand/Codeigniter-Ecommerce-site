<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminrecipecomment/' || $c.'/'.$a == 'adminrecipecomment/index') ? $active : $inavtive; ?>><a href="<?php echo site_url('adminrecipecomment/index');?>">List Unapproved</a></li>
    <li <?php echo ($c.'/'.$a == 'adminrecipecomment/edit') ? $active : $inavtive; ?>><a href="#">Edit</a></li>

  </ul>
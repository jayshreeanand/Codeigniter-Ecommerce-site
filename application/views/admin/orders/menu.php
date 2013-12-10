<?php
$c = (string)$this->uri->segment(1);
$a = (string)$this->uri->segment(2); 

$active = 'class="active"';
$inactive = '';

?>
  <ul class="nav nav-tabs nav-stacked" style="float:left;">
    <li <?php echo ($c.'/'.$a == 'adminorder/' || $c.'/'.$a == 'adminorder/index') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/index');?>">Pending Orders</a>
    </li>
    <li <?php echo ( $c.'/'.$a == 'adminorder/completed') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/completed');?>">Completed Orders</a>
    </li>
    <li <?php echo ( $c.'/'.$a == 'adminorder/shipped') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/shipped');?>">Shipped Orders</a>
    </li>
     <li <?php echo ($c.'/'.$a == 'adminorder/aborted') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/aborted');?>">Aborted Orders</a>
    </li>


    <li <?php echo ( $c.'/'.$a == 'adminorder/delivered') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/delivered');?>">Delivered Orders</a>
    </li>

    <li <?php echo ( $c.'/'.$a == 'adminorder/dpr') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/dpr');?>">Delivered and Payment Received Orders</a>
    </li>

     <li <?php echo ( $c.'/'.$a == 'adminorder/prvp') ? $active : $inavtive; ?>>
    	<a href="<?php echo site_url('adminorder/prvp');?>">Payment Received via Phone Orders</a>
    </li>
   

 	<li <?php echo ( $c.'/'.$a == 'adminorder/details') ? $active : $inavtive; ?>>
 		<a href="<?php echo site_url('adminorder');?>">Order Details</a>
 	</li>
  </ul>

<?php $this->load->view('email_templates/mail_header'); ?>

<br/>

<p>The following order was placed in Global Graynz</p>
<br/>
<br/>
<p>Order Number: <?php echo $order_id;?></p>
<br/>
<p>Order Summary:</p>
<table style="width:100%;border:1ps solid #000;">
	<tr>
		<th>Sl No</th>
		<th>Description</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
	</tr>
<?php $i=1; foreach($line_items as $line_item){?>
	<tr>
		<td align="center"><?php echo $i;?></td>
		<td align="center"><?php echo $line_item['name'];?></td>
		<td align="center"><?php echo $line_item['cost'];?></td>
		<td align="center"><?php echo $line_item['quantity'];?></td>
		<td align="center"><?php echo $line_item['cost']* $line_item['quantity'];?></td>
	</tr>
<?php $i++;
} ?>
</table>
<br/><br/>
<p>Total Cost: <?php echo $toalOrderCost;?></p>
<br/>
<p>Shipping Address:</p>
<?php echo $shipping['first_name'].' '.$shipping['last_name'];?><br/>
<?php echo $shipping['address1'];?> <br/>
<?php echo $shipping['address2'];?><br/>
<?php echo $shipping['city'].' '.$shipping['postal_code'];?><br/>
<?php echo $shipping['state'].', India';?><br/>
<br/><br/>
<p>Kindly process the order at the earliest.
</p>
<br/><br/>

<br/>

<?php $this->load->view('email_templates/mail_header'); ?>

<p>Dear <?php echo $email;?></p>
<br/>

<p>Thank you for your order! We will keep you posted regarding the status of your order through e-mail. In the meanwhile, to check the status of your order, please
log-in to your Global Graynz account or click on the following link <?php echo site_url('user/orders');?></p>
<br/>
<p>We wish we could be there to see your smile as you open the package!</p>
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
<p>If you chose the pay by Credit/Debit card option, you will receive a separate email to a payment link
within 1-2 weeks. Please pay through that link. Needless to worry, your order has begun processing and
will be within the timeline mentioned above.
</p>
<br/><br/>
<p>As always, if you ever think we can help you with something: want to know how to use an ingredient,
would like to see a certain recipe/product on the site or would like your products packed a certain way,
or pretty much anything else, feel free to give us a call (044-4216-8588 / email@globalgraynz.com)
and we’ll make it happen. That is just one way we show you how important you are to us and is where
the Global Graynz experience begins!!</p>
<br/>
<?php $this->load->view('email_templates/mail_footer'); ?>
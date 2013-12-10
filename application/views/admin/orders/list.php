<?php $this->load->view('admin/header', array('pageTitle' => 'Cuisine Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/orders/menu');?>

<div class="table-wrapper">
	<table class="table cuisine-list">
		<tr>
			<th>Order Id</th>
			<th>Name</th>
			<th>Shipping Address</th>
			<th>Order Total</th>
			<th>Payment Mode</th>
			<th>Status</th>
		</tr>
		<?php foreach($data as $d){ 

				$address =  $d['address1'].'<br/>';
				$address .= $d['address2'].'<br/>';
				$address .= $d['city'].'<br/>';
				$address .= getStateName($d['state'],$d['country']).'<br/>';
				$address .= $d['postal_code'].'<br/>';
				$address .= getCountry($d['country']);

			?> 
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo '<a href="'.site_url('adminorder/details/'.$d['orid']).'">'.$d['orid'].'</a>';?></td>
			<td><?php echo $d['first_name'].' '.$d['last_name'];?></td>
			<td><?php echo $address; ?></td>
			<td><?php echo $d['total'];?></td>
			<td><?php echo $d['payment_mode'];?></td>
			<td><?php 
				switch ($d['status']) {
					case 0:
						echo 'Pending';
						break;
					case 1:
						echo 'Payment Received via Phone';
						break;
					case 2:
						echo 'Shipped';
						break;
					case 3:
						echo 'Delivered';
						break;
					case 4:
						echo 'Delivered and Payment Received';
						break;
					case 5:
						echo 'Abort';
						break;
					case 6:
						echo 'Completed';
						break;
				
			}?></td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>

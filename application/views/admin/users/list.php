<?php $this->load->view('admin/header', array('pageTitle' => 'Users Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/users/menu');?>

<div class="table-wrapper">
	<table class="table cuisine-list">
		<tr>
			<th>Email Id</th>
			<th>Status</th>
		</tr>
		<?php foreach($data as $d){ ?> 
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo $d['email_id'];?></td>
			<td><?php echo $d['status']? 'Active': 'InActive';?></td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>

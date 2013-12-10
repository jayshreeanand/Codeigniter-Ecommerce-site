<?php $this->load->view('admin/header', array('pageTitle' => 'Cuisine Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/categories/menu');?>

<div class="table-wrapper">
	<table class="table cuisine-list">
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
		<?php foreach($data as $d){ ?>
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo $d['name'];?></td>
			<td><?php echo $d['status'] ? 'Active' :'Inactive';?></td>
			<td><a href="<?php echo site_url('admincategory/edit/'.$d['id']);?>">Edit</a> </td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>

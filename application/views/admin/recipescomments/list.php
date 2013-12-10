<?php $this->load->view('admin/header', array('pageTitle' => 'Recipe Comments Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/recipescomments/menu');?>

<div class="table-wrapper">
	<table class="table cuisine-list">
		<tr>
			<th>Comment</th>
			<th>Edit</th>
		</tr>
		<?php foreach($data as $d){ ?>
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo $d['comment'];?></td>
			<td><a href="<?php echo site_url('adminrecipecomment/edit/'.$d['id']);?>">Edit</a> </td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array())); ?>

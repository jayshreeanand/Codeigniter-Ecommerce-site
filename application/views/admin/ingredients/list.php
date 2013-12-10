<?php $this->load->view('admin/header', array('pageTitle' => 'Cuisine Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/ingredients/menu');?>

<div class="table-wrapper">
<form name="search" method="post" id="search-form" class="form-horizontal" action="<?php echo site_url('adminingredient');?>" >
<div style="float:right;width:400px;height:30px;border:solid 0px red;display:inline;">
<input type="text" style="height:15px;margin:0;" name="isearch" id="isearch">&nbsp;
<input type="button" id="ssearch" style="margin:0;height:26px;" name="search" value="Search"/></div>
</form>
	<table class="table cuisine-list">
		<tr>
			<th>Name</th>
			<th>Code</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
		<?php foreach($data as $d){ ?>
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo anchor('adminingredient/view/'.$d['id'],$d['name']);?> <?php if($d['offer_exists']=="Yes") echo "&nbsp;&nbsp;(Offer)";?></td>
			<td><?php echo $d['ingredient_code'];?></td>
			<td><?php echo $d['status'] ? 'Active' :'Inactive';?></td>
			<td><a href="<?php echo site_url('adminingredient/edit/'.$d['id']);?>">Edit</a> </td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/vendor/jquery.validate.min.js','js/ingredients/search.js'))); ?>

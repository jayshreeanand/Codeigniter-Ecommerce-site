<?php $this->load->view('admin/header', array('pageTitle' => 'Recipe Management','cssFiles' =>array())); ?>
<?php $this->load->view('admin/recipes/menu');?>

<div class="table-wrapper">
<form name="search" method="post" id="search-form" class="form-horizontal" action="<?php echo site_url('adminrecipe');?>" >
<div style="float:right;width:400px;height:30px;border:solid 0px red;display:inline;">
<input type="text" style="height:15px;margin:0;" name="isearch" id="isearch">&nbsp;
<input type="button" id="ssearch" style="margin:0;height:26px;" name="search" value="Search"/></div>
</form>
	<!--<table border="0" width="100%">
    <tr><td width="100%" style="text-align:right">
    <input type="button" id="xlsfile" name="xlsfile" onclick="download_receipesfile();" value="Download xls file"/>
    </td></tr>
    </table>-->
    <table class="table cuisine-list">
		<tr>
			<th>Name</th>
			<th>Code</th>
            <th>Status</th>
			<th>Edit</th>
		</tr>
		<?php foreach($data as $d){ ?>
		<tr id="tr_<?php echo $d['id']?>">
			<td><?php echo anchor('adminrecipe/view/'.$d['id'],$d['name']);?></td>
			<td><?php echo $d['recipe_code'];?></td>
			<td><?php echo $d['status'] ? 'Active' :'Inactive';?></td>
			<td><a href="<?php echo site_url('adminrecipe/edit/'.$d['id']);?>">Edit</a> </td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load->view('admin/footer', array('jsFiles' => array('js/recipes/list.js','js/recipes/search.js'))); ?>

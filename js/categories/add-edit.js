var act = null;

$("#category-form").validate({
	rules: {
	    name: {
	      required: true
	    }
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).on('click', 'button.add', function(event){
	act = add;
});

$(document).on('click', 'button.update', function(event){
	act = edit;
});

function add(form){
	$('#category-form').attr('action', siteurl+'admincategory/add');
	form.submit();
}
function edit(form){
	$('#category-form').attr('action', siteurl+'admincategory/edit');
	form.submit();
}
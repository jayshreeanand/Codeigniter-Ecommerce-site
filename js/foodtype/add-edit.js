var act = null;

$("#foodtype-form").validate({
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

$(document).on('click', 'button.cancel', function(event){
	$('#foodtype-form').attr('action', siteurl+'adminfoodtype');
});

function add(form){
	$('#foodtype-form').attr('action', siteurl+'adminfoodtype/add');
	form.submit();
}
function edit(form){
	$('#foodtype-form').attr('action', siteurl+'adminfoodtype/edit');
	form.submit();
}
var act = null;

$("#spicelevel-form").validate({
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
	$('#spicelevel-form').attr('action', siteurl+'adminspicelevel');
});

function add(form){
	$('#spicelevel-form').attr('action', siteurl+'adminspicelevel/add');
	form.submit();
}
function edit(form){
	$('#spicelevel-form').attr('action', siteurl+'adminspicelevel/edit');
	form.submit();
}
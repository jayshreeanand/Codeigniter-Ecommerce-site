var act = null;

$("#cuisine-form").validate({
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
	$('#cuisine-form').attr('action', siteurl+'admincuisine/add');
	form.submit();
}
function edit(form){
	$('#cuisine-form').attr('action', siteurl+'admincuisine/edit');
	form.submit();
}
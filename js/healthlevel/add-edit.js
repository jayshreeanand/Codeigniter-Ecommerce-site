var act = null;

$("#healthlevel-form").validate({
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
	$('#healthlevel-form').attr('action', siteurl+'adminhealthlevel');
});

function add(form){
	$('#healthlevel-form').attr('action', siteurl+'adminhealthlevel/add');
	form.submit();
}
function edit(form){
	$('#healthlevel-form').attr('action', siteurl+'adminhealthlevel/edit');
	form.submit();
}
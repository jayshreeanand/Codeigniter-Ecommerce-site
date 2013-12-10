var act = null;

$("#recipe-comment-form").validate({
	rules: {
	    status: {
          required: true
        }
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });


$(document).on('click', 'button.update', function(event){
	act = edit;
});

function edit(form){
	$('#recipe-comment-form').attr('action', siteurl+'adminrecipecomment/edit');
	form.submit();
}
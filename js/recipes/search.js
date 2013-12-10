var act = null;

$('#ssearch').click(function(){ 
if($('#isearch').val().length==0){
alert('Enter Recipe name to search');
return false;
}
else
{
$('#search-form').submit();
}
});

/*
$("#search-form").validate({
	rules: {
	    isearch: {
	      required: true
	    }
	},
	submitHandler: function(form) {
		act(form);
	}	
 });

$(document).on('click', '#ssearch', function(event){
	act = searchval;
});
 
function searchval(form){
alert('hi')
	//$('#search-form').attr('action', siteurl+'adminingredient');
	//form.submit();
}
*/ 
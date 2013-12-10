var act = null;

$("#contact-form").validate({
	rules: {
	    cp: {
	      required: true
	    },
	    np:{
	    	 required: true
	    },
	    cnp:{
	    	 required: true
	    },
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).on('click', '.sub-btn', function(event){
	act = submitchangepassword;
});



function submitchangepassword(form){
	$('#changepassword-form').attr('action', siteurl+'changepassword');
	form.submit();
}

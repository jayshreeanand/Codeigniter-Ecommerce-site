var act = null;

$("#contact-form").validate({
	rules: {
	    name: {
	      required: true
	    },
	    email:{
	    	 required: true,
	    	 email: true
	    },
	    phone:{
	    	 required: true,
	    	 number: true
	    },
	    subject:{
	    	 required: true
	    },
	    message:{
	    	 required: true
	    },
	},
		
	submitHandler: function(form) {
		act(form);
	}
 });
	
$(document).on('click', '.sub-btn', function(event){
	act = submitcontact;
});



function submitcontact(form){
	$('#contact-form').attr('action', siteurl+'contactus');
	form.submit();
}

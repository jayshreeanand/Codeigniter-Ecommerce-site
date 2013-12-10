$(document).ready(function(){

		var emregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



		$('.requests').click(function() {
			$('.requests_wrap').show();
		});

		$("#requests-close").click(function() {
			$('#reqemail_id').val('');
			$('#reqdescription').val('');
			
			$('.requests_wrap').hide();
		});

		$(document).keyup(function(e) {
		  if (e.keyCode == 27) { $('.reqeusts_wrap').hide(); }   // esc
		});


		

		$(".requests-btn").click(function(){

			var reqe = $('#reqemail_id').val();
			var reqd = $('#reqdescription').val();
		var requrl = $('#req-url').val();

			if(!reqe.length || reqe == 'Email Address'){
				alert('Please enter Email Address for Registration');
				return false;
			}

			if(!emregex.test(reqe)){
				alert('Please enter valid Email Address for Registration');
				return false;
			}

			if(!reqd.length || reqd == 'Details'){
				alert('Please fill in the details');
				return false;
			}
	$('.requests_wrap').hide();
			
	$.post(siteurl+'requests/addrequests',{reqe:reqe, reqd:reqd})
			.done(function(data){
				data = jQuery.parseJSON(data);
						if(data.error){
					alert(data.error);
				} else {
					window.location=requrl;
						
				}
			});
			
		});

		$("#reqmail_id,#reqdescription").keyup(function(ek)
		{
			if(ek.keyCode == 13) {
			var reqe = $('#reqemail_id').val();
			var reqd = $('#reqdescription').val();
			var requrl = $('#req-url').val();

			if(!reqe.length || reqe == 'Email Address'){
				alert('Please enter Email Address for Registration');
				return false;
			}

			if(!emregex.test(reqe)){
				alert('Please enter valid Email Address for Registration');
				return false;
			}

			if(!reqd.length || reqd == 'Details'){
				alert('Please fill in the details');
				return false;
			}

			
	$('.requests_wrap').hide();
			$.post(siteurl+'requests/addrequests',{reqe:reqe, reqd:reqd})
			.done(function(data){
				data = jQuery.parseJSON(data);
				if(data.error){
					alert(data.error);
				} else {
					
					window.location=requrl;
				}
			});
			}
		});















		/* <![CDATA[ */
			$(function() {
				var input = document.createElement("input");
			    if(('placeholder' in input)==false) { 
					$('[placeholder]').focus(function() {
						var i = $(this);
						if(i.val() == i.attr('placeholder')) {
							i.val('').removeClass('placeholder');
							if(i.hasClass('password')) {
								i.removeClass('password');
								this.type='password';
							}			
						}
					}).blur(function() {
						var i = $(this);	
						if(i.val() == '' || i.val() == i.attr('placeholder')) {
							if(this.type=='password') {
								i.addClass('password');
								this.type='text';
							}
							i.addClass('placeholder').val(i.attr('placeholder'));
						}
					}).blur().parents('form').submit(function() {
						$(this).find('[placeholder]').each(function() {
							var i = $(this);
							if(i.val() == i.attr('placeholder'))
								i.val('');
						})
					});
				}
			});
		/* ]]> */
		
});
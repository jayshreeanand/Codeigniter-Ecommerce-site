$(document).ready(function(){

		var emregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.login').click(function() {
			$('.login_wrap').show();
		});

		$("#login-close").click(function() {
			$('.login_wrap').hide();
		});

		$(document).keyup(function(e) {
		  if (e.keyCode == 27) { $('.login_wrap').hide(); }   // esc
		});

		$(".login-btn").click(function(){
			var e = $('#email_id').val();
			var p = $('#password').val();
			var curl = $('#lc-url').val();

			if(!e.length || e == 'Email Address'){
				alert('Please enter Email Address for Login');
				return false;
			}

			if(!emregex.test(e)){
				alert('Please enter valid Email Address for Login');
				return false;
			}

			if(!p.length || p == 'Password' ){
				alert('Please enter password for Login');
				return false;
			}

			$.post(siteurl+'login',{e:e, p:p})
			.done(function(data){
				data  = jQuery.parseJSON(data);
				if(data.error){
					alert('Invalid email address and password');
				} else {
					window.location=curl;
				}
			});
		});

		$(".forgot-btn").click(function(){
			var e = $('#email_id').val();
			if(!e.length || e == 'Email Address'){
				alert('Please enter Email Address');
				return false;
			}

			if(!emregex.test(e)){
				alert('Please enter valid Email Address');
				return false;
			}

			$.post(siteurl+'forgot',{e:e})
			.done(function(data){
				data  = jQuery.parseJSON(data);
				if(data.error){
				} else {
					alert('Please check your mail for password');
				}
			});
		});


		$(".register-btn").click(function(){

			var re = $('#remail_id').val();
			var rp = $('#rpassword').val();
			var rrp = $('#rrpassword').val();
			var curl = $('#sc-url').val();

			if(!re.length || re == 'Email Address'){
				alert('Please enter Email Address for Registration');
				return false;
			}

			if(!emregex.test(re)){
				alert('Please enter valid Email Address for Registration');
				return false;
			}

			if(!rp.length || rp == 'Password'){
				alert('Please fill password for Registration');
				return false;
			}

			if(!rrp.length || rrp == 'Retype Password'){
				alert('Please re type password for Registration');
				return false;
			}

			if(rrp != rp){
				alert('Please make sure password and re type password are same');
				return false;
			}

			$.post(siteurl+'register',{e:re, p:rp})
			.done(function(data){
				data = jQuery.parseJSON(data);
				if(data.error){
					alert(data.error);
				} else {
					window.location=curl;
				}
			});
			
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
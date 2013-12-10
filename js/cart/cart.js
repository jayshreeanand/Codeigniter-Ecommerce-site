$(document).ready(function(){


		$('.update').click(function(){

			var rowid = $(this).attr('data-row-id');
			var qty = $(this).parent().children()[0].value;

		
			$.post(siteurl+'ggcart/update',{r:rowid, q:qty})
			.done(function(data){
				window.location= siteurl+'ggcart';
			});
			return false;
		});



		$('.update_options').click(function(){

			
			var coupon = $(this).parent().children()[0].value;

			$.post(siteurl+'ggcart/update_options',{c:coupon})
			.done(function(data){
				window.location= siteurl+'ggcart';
			});
			return false;
		});
});
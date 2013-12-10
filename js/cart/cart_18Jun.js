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
});
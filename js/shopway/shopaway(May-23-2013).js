$(document).ready(function(){
		$('.star').each(function(){
			$(this).raty({
				  score: function() { return $(this).attr('data-score'); },
				  starOn   : 'images/receipe-details-page_star11.png',
  				  starOff  : 'images/receipe-details-page_star12.png',
  				  starHalf : 'images/receipe-details-page_star11.png',
  				  click: function(score, evt) {
					  	$.post(siteurl+'ingredient/rateit',{id:$(this).attr('id'), score: score})
						  	.done(function(data){
						  		var d = jQuery.parseJSON(data);
							if(d.success){
								$(this).attr('data-score',d.success);
							}
							if(d.error){
								alert(d.error);
							}
					 	});
				  	}
				});
		});

		$('.add').click(function(){
			var itemClicked = $(this);
			var iid = $(this).attr('data-product-id');
			var qty = $('#qty-'+iid).val();
			var clickText = $(this).html();
			if(clickText == 'Add to Cart'){
				$.post(siteurl+'ggcart/add',{id:iid, qty:qty})
				.done(function(data){
					var d = jQuery.parseJSON(data);
					if(d.success){
						itemClicked.html('In Cart');
						var iic =  parseInt($("#items-in-cart").html());
						iic = iic+parseInt(qty);
						$("#items-in-cart").html(iic);
					}
				});
			} 
			return false;
		});

		$('.styled').each(function(){
			$(this).change(function(){
				$('#shopaway').submit();
			});
		});
});
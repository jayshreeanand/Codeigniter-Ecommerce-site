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
/*
		$('.add').click(function(){
			var itemClicked = $(this);
			var iid = $(this).attr('data-product-id');
			var qty = $("#qty").val();
			var clickText = $(this).html();
			if(clickText == 'Add to Cart'){
				$.post(siteurl+'ggcart/add',{id:iid,qty:qty})
				.done(function(data){
					var d = jQuery.parseJSON(data);
					if(d.success){
						itemClicked.html('In Cart');
					}
				});
			} 
			return false;
		});
*/
		
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
		
		$('#d5_1').click(function () {
		if($("#d5_1").is(':checked'))
			$("#d5_1").val(1);
		else
			$("#d5_1").val(0);
		$('#shopaway').submit();
		});	

		$('#d5_2').click(function () {
		if($("#d5_2").is(':checked'))
			$("#d5_2").val(1);
		else
			$("#d5_2").val(0);
		$('#shopaway').submit();
		});	

		$('#d5_2').click(function () {
		if($("#d5_2").is(':checked'))
			$("#d5_2").val(1);
		else
			$("#d5_2").val(0);
		$('#shopaway').submit();
		});	

		$('#rs').click(function () {
			var rsval=$("#sortval").val();
			if(rsval=='rsd' || rsval.length==0) $("#sortval").val("rsa");
			else $("#sortval").val("rsd");
			$('#shopaway').submit();
		});

		$('#ps').click(function () {
			var psval=$("#sortval").val();
			if(psval=='psd' || psval.length==0) $("#sortval").val("psa");
			else $("#sortval").val("psd");
			$('#shopaway').submit();
		});

		$('#ns').click(function () {
			var nsval=$("#sortval").val();
			if(nsval=='nsd' || nsval.length==0) $("#sortval").val("nsa");
			else $("#sortval").val("nsd");
			$('#shopaway').submit();
		});

});
$(document).ready(function(){

	$('.star').each(function(){
		$(this).raty({
			score: function() { return $(this).attr('data-score'); },
			starOn   : 'images/ingredient_star1.png',
			starOff  : 'images/ingredient_star2.png',
			starHalf : 'images/ingredient_star1.png',
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

	$('.box_imgHolder img').mouseover(function(){
		$(this).css('cursor','pointer');
		$('.imgholder img').attr('src', $(this).attr('src'));
	});

	if(usedinCount > 4 && usedinCount != 0){
		$( "#carousel" ).rcarousel({margin:10,visible:4,step:1,height:190,width:151});
	} else {
		$( "#carousel" ).rcarousel({margin:10,visible:usedinCount,step:1,height:190,width:151});
	}
	
});
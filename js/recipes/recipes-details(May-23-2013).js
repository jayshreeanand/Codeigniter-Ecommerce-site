$(document).ready(function(){

	$('#myTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});

	$('.main-star').each(function(){
		$(this).raty({
			score: function() { return $(this).attr('data-score'); },
			starOn   : 'images/receipe-details-page_star1.png',
			starOff  : 'images/receipe-details-page_star12.png',
			starHalf : 'images/receipe-details-page_star1.png',
			click: function(score, evt) {
				  	$.post(siteurl+'recipe/rateit',{id:$(this).attr('id'), score: score})
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
				}
			});
		} 
		return false;
	});

	$("#ctext").focus(function(){
		if(!isLoggedIn)
			alert("Please Login to Share your thought");
	});

	$('.comment').click(function(){
		var comment = $("#ctext").val();
		var rid = $("#rid").val();
		
		if(!comment.length){
			alert("Please write a comment");
			return false;
		} 
		if(!isLoggedIn){
			alert("Please Login to Share your thought");
			return false;
		}
		$.post(siteurl+'recipe/addcomment',{c: encodeURIComponent(comment), rid:rid})
		.done(function(data){
			alert("Your comments will appear in this section on administrator approval, thanks for taking your time");
			$("#ctext").val('');
		});
	});

	$('.b_i img').mouseover(function(){
		$(this).css('cursor','pointer');
		$('.main1_inner_top img').attr('src', $(this).attr('src'));
	});

});
$(document).ready(function(){
		$('.rstar').each(function(){
			$(this).raty({
				  score: function() { return $(this).attr('data-score'); },
				  starOn   : 'images/receipe-details-page_star11.png',
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

		$('.istar').each(function(){
			$(this).raty({
				  score: function() { return $(this).attr('data-score'); },
				  starOn   : 'images/receipe-details-page_star11.png',
  				  starOff  : 'images/receipe-details-page_star12.png',
  				  starHalf : 'images/receipe-details-page_star1.png',
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
});
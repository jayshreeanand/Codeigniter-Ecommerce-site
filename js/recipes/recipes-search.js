$(document).ready(function(){

		$('.star').each(function(){
			var _this = $(this);
			$(this).raty({
				  score: function() { return $(this).attr('data-score'); },
				  starOn   : 'images/receipe-details-page_star11.png',
  				  starOff  : 'images/receipe-details-page_star12.png',
  				  starHalf : 'images/receipe-details-page_star11.png',
  				  click: function(score, evt) {
  				  	$.post(siteurl+'recipe/rateit',{id:$(this).attr('id'), score: score})
  				  	.done(function(data){
  				  		var d = jQuery.parseJSON(data);
						if(d.success){
							$(this).attr('data-score',d.success);

						}
						if(d.error){
							alert('Please login to rate');
							$(this).attr('data-score',_this.attr('data-score'));
						}
  				  	});
				  }
				});
		});

		$('.styled').each(function(){
			$(this).change(function(){
				$('#recipe-search').submit();
			});
		});
});
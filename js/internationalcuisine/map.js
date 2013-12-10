$(document).ready(function(){

	$('#italian').popover({title: 'Italian Cuisine', placement: 'top', html:true,content: $('#italian-content').html()});	

	$('#greek').popover({title: 'Greek Cuisine', placement: 'right', html:true,content: $('#greek-content').html()});	

	$('#french').popover({title: 'French Cuisine', placement: 'left', html:true,content: $('#french-content').html()});	

	$('#chinese').popover({title: 'Chinese Cuisine', html:true,content: $('#chinese-content').html()});	

	$('#thai').popover({title: 'Thai Cuisine', html:true,content: $('#thai-content').html()});	

	$('#mexican').popover({title: 'Mexican Cuisine', html:true,content: $('#mexican-content').html()});	
		
});
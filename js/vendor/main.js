$('#left-sidebar-slider').css('margin-top',$(window).height()/2);
$('#left-sidebar-slider').click(function(){

	if($('.submenu-bar').attr('class').indexOf('invisible') == -1){
		$('.left-sidebar').animate({ width: '20px'}, 1000,function(){
		$('.submenu-bar').removeClass("visible").addClass("invisible");
		  });
	} else {
		$('.submenu-bar').removeClass("invisible").addClass("visible");
		$('.left-sidebar').animate({ width: '190px'}, 1000);
	}
});
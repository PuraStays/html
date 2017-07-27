$(document).ready(function() {
   	var stickyNavTop = $('nav').offset().top;
	var stickyNav = function(){
		var scrollTop = $(window).scrollTop();			  
		if (scrollTop > stickyNavTop) { 
			$('nav').addClass('shrink');
		} else {
			$('nav').removeClass('shrink'); 
		}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	
	//login signup popup
	$('.signup').hide();
	$('#signup').on("click", function(){
		$('.signin').hide();
		$('.signup').show();
	});
	$('#signin').on("click", function(){
		$('.signup').hide();
		$('.signin').show();
	})
});
$(document).ready(function() {

	//validation
	$("#signinForm").validate();
	$("#signupForm").validate();

	//review block
	$(".review-content ul li .rev").addClass("less");
	$(".review-content ul li").each(function(index,element){		
		var _this = this;
		$(this).find(".more").on('click', function(e){
			if($(this).prev().find('.rev').hasClass('less')){
				$(this).prev().find('.rev').removeClass('less');
				$(this).text("less");	
			}else{
				$(this).prev().find('.rev').addClass('less');
				$(this).text("more");
			}		
			
		})
	})

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
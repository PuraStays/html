$(document).ready(function() {

	if ($('#cluster option').length > 2) {
		$('#cluster').on('change', function() {
			// alert('working');
		})
	}

	//floating window djubo integration fake
	// $.getJSON('/data/resort.json', function(data) {
	// 	console.log( "success", data );
	//   })
	// .done(function() {
	// 	console.log( "second success" );
	// })
	// .error(function(jqXHR, textStatus, errorThrown) {
  //       console.log("error " + textStatus);
  //       console.log("incoming Text " + jqXHR.responseText);
  //   })
	// .always(function() {
	// 	console.log( "complete" );
	// });
	function getRandomNumber () {
	  var d1 = new Date();
	  d1.toUTCString();
	  var num = Math.floor(d1.getTime()/1000);
	  return num;
	}
	setTimeout(function() {
		var now = new Date();
		$.getJSON("/data/resort.json?" + getRandomNumber(), function(json) {
			if (window.localStorage.page === 'resort') {
				var pageId = window.localStorage.id;
				var propArr = json.filter(obj => {
					return obj.resort_id == pageId;
				})
				if(propArr.length>0) {
					$('#BEx4IDaY3bPP').prop("selectedIndex", propArr[0].widget_prop_id);
					$('#BEx4IDaY3bQBT').attr('href', propArr[0].resort_booking_link);
				}
			}
		})	
	}, 2000);

	//tooltip init
	$('[data-toggle="tooltip"]').tooltip();

	//validation
	$("#signinForm").validate();
	$("#signupForm").validate();
	$("#generalForm").validate();
	$("#groupForm").validate();
	$("#subscribeForm").validate();
	

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
	$('.dropdown-inner ul li:last-child').remove();
	$(".navbar-toggle").on("click", function () {
		$(this).toggleClass("active");
		$('body').toggleClass('noscroll');
		$('.overlay').toggleClass('forMenu');
		if($(this).parents('nav').hasClass('shrink')){
			$('.res-menu-header').addClass('smaller');
		}else{
			$('.res-menu-header').removeClass('smaller')
		}
	});

	$('[data-toggle="slide-collapse"]').on('click', function() {
		$navMenuCont = $($(this).data('target'));
		$navMenuCont.animate({'width':'toggle'}, 350);
	}); 


	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('.footer-tools').outerHeight();

	$(window).scroll(function(event){
		if(!$('.navbar-toggle').hasClass('active')){
			didScroll = true;
		}
	});

	setInterval(function() {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();
		
		// Make sure they scroll more than delta
		if(Math.abs(lastScrollTop - st) <= delta)
			return;
		
		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		if (st > lastScrollTop && st > navbarHeight){
			// Scroll Down
			$('.footer-tools').removeClass('navdown').addClass('nav-up');
		} else {
			// Scroll Up
			if(st + $(window).height() < $(document).height()) {
				$('.footer-tools').removeClass('nav-up').addClass('navdown');
			}
		}
		
		lastScrollTop = st;
	}

	//book a stay button handler
	var clickedFrom, booking_url;
	booking_url = "http://www.purastays.com/booking/";

	/*$('.book_a_stay').on('click', function(){
		clickedFrom = $(this).attr('data-from');
		if(clickedFrom == 'menu'){
			if($(window).width()<768){
				goToBooking()
			}else{
				goToBooking()
			}			
		}else if(clickedFrom == 'footer'){
			goToBooking()
		}
	})*/
	
	function goToBooking(){
		window.location.href = booking_url;
	}	

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


	//footer subscribe button handler
	$("#subscribe .alert.alert-success").fadeOut(0);  
		//upload event booking
		$("#subscribe_btn").on("click",function(){
			
			var form = $("#subscribeForm");               
			console.log(JSON.stringify(form.serializeArray()));
			$.ajax({
				contentType: "application/json; charset=utf-8",
				type: "POST",
				dataType: 'json',
				data: JSON.stringify(form.serializeArray()),
				crossDomain: true,
				url: 'http://api.purastays.com/contactus/subscribe',
				success: function(msg){
					$("#subscribe .alert.alert-success").fadeIn(300);    
					$("#subscribe .alert.alert-success").text(msg.message);                        
				},error: function(res){
					alert('ajax post failed');  
					console.log(res);
				}
				}); 
		});


		$("#clickCall").on('click', function(){            	
			if($('.call_number_container .num01').hasClass('hidd')){
				$('.call_number_container .num01').removeClass('hidd');
			}else{
				$('.call_number_container .num01').addClass('hidd');
			}
		})
	
});
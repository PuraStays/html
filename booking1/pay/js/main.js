jQuery(document).ready(function() {
	jQuery('.msg, .block.right, .col2.left').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated fadeInLeft', // Class to add to the elements when they are visible
	    offset: 200    
	});  
	jQuery('.block.left, .col2.right').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated fadeInRight', // Class to add to the elements when they are visible
	    offset: 200    
	});
	jQuery('.item1,.item2,.item3,.downld, .col3').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
	    offset: 200    
	}); 
	jQuery('.achieve, .why, form').addClass("hidden").viewportChecker({
	    classToAdd: 'visible animated fadeIn', // Class to add to the elements when they are visible
	    offset: 200    
	}); 
});

var viewport = $(window).width();
if(viewport<=640){
	$('.menu').addClass('menuDrop');	
}

$(window).on("scroll", function(e){
	$('.menu.menuDrop').slideUp(400);	
	$('#res-menu').removeClass('active');
	var distanceY = window.pageYOffset || document.documentElement.scrollTop,
		shrinkOn = 100;

		
		if(distanceY > shrinkOn){
			$('header').addClass('smaller');
		}else{
			if($('header').hasClass('smaller'))	{
				$('header').removeClass('smaller')	
			}
		}
})







	
	
	
$(document).ready(function(e) {	
	
		$("#res-menu").on('click',function(){
			if(($(this)).hasClass('active')){
				$(this).removeClass('active');					
				$('.menu').slideUp(400);	
				
			}else{
				$(this).addClass('active');	
				$('.menu').slideDown(400);	
			}
	})		
	
	
	// video handler
	var factor = 1/2;			
			var screenW = $(document).width();			
			if(screenW<800){factor = 2/3}
			if(screenW<768){factor = 4/5}
			
			var screenw2 = screenW * factor;
			var screenw4 = screenw2 / 2;			
			var screenh2 = screenw2 * (4/7) ;
			var screenh4 = screenh2 / 2;
			
			var screenH = $(document).height();
			$('.vid-pop').width(screenw2).css({'margin-left':-screenw4});
			$('.vid-pop').height(screenh2).css({'margin-top':-screenh4});
			
			$('.vid-pop').find('iframe').attr('width',screenw2).attr('height',screenh2);
						
            $(".col3").hover(function(){				
				$(this).find(".hover").fadeIn(200);
				$(this).find(".desc").animate({bottom:0});	
			}, function(){
				$(this).find(".hover").fadeOut(100);
				$(this).find(".desc").animate({bottom:-100});	
			})
			
			$(".play").on("click", function(){				
				var _this = $(this);
				var imgSrc = _this.parent().siblings('img').attr('src');
				var vidSrc = _this.parent().siblings('img').attr('data-vid');
				$('#vid-pop, .overlay').fadeIn(500);
				$("#vid-pop .vid-pop-inner").append("<img/>");
				$("#vid-pop .vid-pop-inner img").width(screenw2).height(screenh2).attr("src", imgSrc);
				$("#vid-pop .vid-pop-inner").append("<img src='images/youtube-player.png' class='play-now'>");

				var vidFun = function(vidSrc, screenw2, screenh2){					
					var vidURL = '<iframe width="'+ screenw2 +'" height="' + screenh2 + '" src="'+ vidSrc +'" frameborder="0" allowfullscreen></iframe>';					
					return vidURL;					
				}
				
				$(".play-now").on("click", function(){
					$("#vid-pop .vid-pop-inner").find('img').remove();
					$("#vid-pop .vid-pop-inner").append(vidFun(vidSrc, screenw2, screenh2));
				})
				
				console.log(imgSrc+" aur "+vidSrc);
				
				$('.overlay').fadeIn(100); 
				$('#vid-pop').fadeIn(200);
				
			})
			$(".overlay").on("click", function(e){
				  if (e.target.id === "overlay"){
					//$("#vid-pop .vid-pop-inner img, #vid-pop .vid-pop-inner iframe").remove()
					//$('.overlay').fadeOut(200);
					//$('#vid-pop').fadeOut(100);
				  }
			})
			$(".vid-close").on("click", function(e){
				$(".vid-pop .vid-pop-inner img, .vid-pop .vid-pop-inner iframe").remove()
				$('.overlay').fadeOut(200);
				$('.vid-pop,#login-pop').fadeOut(100);
				$('.refer_code input').val("");
				$('.refer_code input').hide();
				$('.refer_code span').show();
			})
			
			$('.loginlink').on('click', function(){
				$('#login-pop, .overlay').fadeIn(500);	
			})
	
});



	
	
	
	
	
	
	
	
	
	
	

/*var fixmeTop = $('.fixme').offset().top+300;
$(window).scroll(function() {	
    var currentScroll = $(window).scrollTop();
	console.log()
    if (currentScroll >= fixmeTop) {
        $('.fixme').addClass('a').css({
          //  position: 'fixed',
            top: '0',
            left: '0'
        });
    } else {
        $('.fixme').removeClass('a').css({
			//position: 'static'
		});			
    }
});*/
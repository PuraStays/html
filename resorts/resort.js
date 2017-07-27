

$(document).ready(function(){
	//stay section scroll start
    function drawStayGallery(){
    	if($(window).width()>768){
	        var stayslider = $('#image-gallery-stay').lightSlider({
	            gallery:true,
	            item:1,
	            thumbItem:7,
	            slideMargin: 0,
	            speed:1500,
	            loop:true,
	            auto: true,
	            pauseOnHover:true,
	            responsive : [],
	            onSliderLoad: function() {
	                $('#image-gallery-stay').removeClass('cS-hidden');
	            }  
	        });
	        stayslider.refresh();
    	}else{
    		$('.list-container').bxSlider({
    			controls: false,
    			adaptiveHeight: true
    		});
    	}
    }

    function resetStayGallery(galleryId){
        $('.overlay').fadeIn(500);
        var listString = "";
        var templateItem = "";
        var templateHTML;  

        $.ajax({
            //url: "http://localhost:3000/images/" + galleryId,
            //url: "images.json",
            url: "http://api.purastays.com/resort-rooms/id/" + galleryId,
            success: function(result){
            	//console.log("http://api.purastays.com/resort-rooms/id/" + galleryId);
            	result = JSON.parse(result);
            	var title = result.grpTitle;
                for(var i=0; i< result.imageList.length; i++){
                    listString += '<li data-thumb="'+result.imageList[i].img+'"><img src="'+result.imageList[i].img+'" /></li>';                    
                }

                templateItem = '<ul id="image-gallery-stay" class="gallery list-unstyled cS-hidden">' + listString + "</ul>";
              	
                templateHTML = $.parseHTML(templateItem);

                var actualImageList = $('#image-gallery-stay');
                var parentImageList = actualImageList.parents('.customWd');            
                parentImageList.children().remove();                    
                parentImageList.append(templateHTML);
                drawStayGallery();
                console.log(title);
                $('.stay-gallery').find('.galleryTitle h4').html(title);
                $('.overlay').fadeOut(500);
            }
        });      
    }

    drawStayGallery();
    //$('.list-item:first-child').addClass("active");

    $("#stay-container .list-item").each(function(index){

    	if($(window).width()>768){
    		$(this).on('click', function(event){
	        	event.preventDefault();
	            var currId = $(this).data('id');
	            console.log(currId);                
	            if(!$(this).hasClass('active')){
	                $(this).parent().children('.list-item').removeClass('active open');
	                $(this).addClass('active'); 
	                resetStayGallery(currId);
	            }            
	        })

	        //handling more / less button
	        $(this).find('a.btn').on('click', function(event){
	            var that = this;
	            event.stopPropagation();                
	            var currId = $(this).parents('.list-item').data('id');
	            console.log(currId);
	            if($(that).parents('.list-item').hasClass('open')){        
	                $(that).parents('.list-item').removeClass('open');         
	            }else{
	                $(that).parents('.list-item').parent().children().removeClass('open active')                  
	                $(that).parents('.list-item').addClass('open active');     
	                resetStayGallery(currId);
	            }            
	        })
    	}else{
    		$(this).find('a.btn').on('click', function(event){
	            var that = this;
	            event.stopPropagation();                
	            var currId = $(this).parents('.list-item').data('id');
	            var currBxViewportHt = $(this).parents('.bx-viewport').outerHeight();	            	            
	            if($(that).parents('.list-item').hasClass('open')){        
	                $(that).parents('.list-item').removeClass('open');         
	            }else{	            	
	                $(that).parents('.list-item').parent().children().removeClass('open active')                  
	                $(that).parents('.list-item').addClass('open active');     	                
	                //$(this).parents('.bx-viewport').outerHeight($(this).parents('.list-item').outerHeight());
	            }            
	        })
    	}        
    })
    //stay section scroll end
})
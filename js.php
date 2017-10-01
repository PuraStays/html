<script src="bower_components/jquery/dist/jquery.min.js"></script>   
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="libs/jquery.validate.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="js/common.js"></script>
<script>
    var vid = document.getElementById("PuraVideo");
    var bannImg = document.getElementById("slideVid");
</script>

<script type="text/javascript">

    function setImageWidth(){
        setTimeout(function(){
            $(".galleryNew li.col-sm-4").each(function(index){
                var conHt = $(this).find('figure').outerHeight();
                var conWd = $(this).find('figure').outerWidth();

                var imgHt =  $(this).find('figure img').outerHeight();
                var imgWd = $(this).find('figure img').outerWidth();
                
                var widDiff = imgWd - conWd; //+ve image large, -ve container large
                var htDiff = imgHt - conHt;
                if(widDiff>2){
                    $(this).find('figure img').css({
                        "left": -widDiff/2
                    })
                }

            })

            $(".galleryNew li.col-sm-8").each(function(index){  
                var conHt = $(this).find('figure').outerHeight();
                var conWd = $(this).find('figure').outerWidth();

                var imgHt =  $(this).find('figure img').outerHeight();
                var imgWd = $(this).find('figure img').outerWidth();
                
                var widDiff = imgWd - conWd; //+ve image large, -ve container large
                var htDiff = imgHt - conHt;              
                if(htDiff < 0) {
                    $(this).find('figure img').css({
                        "height": "100%",
                        "width": "auto"
                    });
                    var nowDiff = $(this).find('figure img').width() - $(this).find('figure').width();
                    $(this).find('figure img').css({
                        "left": -nowDiff/2
                    })
                }
                if(htDiff > 0) {
                    $(this).find('figure img').css({
                        "top": -htDiff/2
                    })
                }
            })
        }, 100)
    }

    $(window).load(function(){
       setImageWidth();
    });
    $(window).resize(function(){
        setImageWidth();
    });
</script>
<script type = 'text/javascript'>
    var tab = new Array();
    function updateResult(){

        var mood = $("#mood").val()
        var cluster = $("#cluster").val()
        

        $('.overlay').fadeIn(300);

        var data1 =  JSON.stringify({"cluster":cluster, "mood":mood});
        $.ajax({
            contentType:"application/json; charset=utf-8",
            type:"GET", 
            dataType :'json',
            url:" http://api.purastays.com/cluster-mood-selection/cluster/"+ cluster +"/mood/"+mood+"?_=" + new Date().getTime(),                
            crossDomain: true,
            cache: false,
            success: function(res){                    
                if(res.gallery_title != null){
                    $('.sec.explore-home h2').text(res.gallery_title);
                    var find_res = "";
                    if(res.mood != null)
                    {
                    	//find_res =  res.mood + " in " + res.gallery_title;
                    	find_res = 'Holiday Stays '+ res.gallery_title +' for travel mood '+ res.mood;
                    }
                    else
                    {
                    	find_res = 'Holiday Stays '+ res.gallery_title;
                    }
                    $("#find_result").text(find_res).fadeIn(300);
                }                      
                renderGallery(res.gallery);
                renderTestimonial(res.testimonials);                          
            },
            error: function (err) {
                console.log(err);
            },
            complete: function(){
                $('.overlay').fadeOut(500); 
        		$('html,body').delay(200).animate({scrollTop: $('.explore-gallery').offset().top}, 1000);
            }
        });
    }
    var renderGallery = function(data){     	
    	console.log(data); 
        $( ".galleryNew ul li" ).each(function( index ) {
            var _this = this;             
            $(this).find('.imgCntnr figure img').attr({'src': data[index].img, 'alt': data[index].heading});
            $(this).find('.hoverImg').attr('href', data[index].link);
            $(this).find('.hoverImg .txtBlk h2').text(data[index].heading);
            $(this).find('.hoverImg .txtBlk p').text(data[index].desc);                    
        });
    }

    var renderTestimonial = function(data){    	     
    	if(data.length>0){
	        $('.exp-block').each(function(index){
	            var _this = this;
	            $(this).find('.img-bg-cont > img').attr('src',data[index].Banner_Image);
	            $(this).find('.exp-container .exp-act-pics .usr1 img').attr('src',data[index].User1Image);
	            $(this).find('.exp-container .exp-act-pics .usr2 img').attr('src',data[index].User2Image);
	            $(this).find('.exp-container .exp-act-pics .usr1 p.name').text(data[index].User1Name);
	            $(this).find('.exp-container .exp-act-pics .usr2 p.name').text(data[index].User2Name);
	            $(this).find('.exp-container .exp-act-title h4').text(data[index].Title);
	            $(this).find('.exp-container .exp-act-block .exp-txt p').text(data[index].Summary); 
	            $(this).find('.exp-container .exp-act-block .btn-blk a').attr('href', data[index].Url);
	            //$(this).find('.exp-container .exp-act-block .btn-blk a').attr('href','story-details.php?stroy=' + data[index].Id);

	        })   
        }     
    }

</script>
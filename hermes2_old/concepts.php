<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<section class="pura-banner-inner" id="home">
        	
            <?php include_once("includes/nav.php");?>
            
            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1>For a traveler in you</h1>
                    <p>Comfortable and standardized accommodation across different living spaces</p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="images/inner-banner-resorts.jpg" alt="pura resort">
            </div>
        </section>
    </header>
    
    <section class="sec-resort concept">
    	<a href="#home" class="closeblk page-scroll"></a>
    	<div class="container">
            <div class="tab-container">
            	<div class="row">
                	<ul class="nav nav-tabs">
                    	<li class="active"><a href="#stay" data-toggle="tab"><img src="images/features-icons/stay-icon.png" alt="icon"><div class="title">Rooms</div></a></li>
                        <li><a href="#cafe" data-toggle="tab"><img src="images/features-icons/cafe-tab-icon.png" alt="cafe"><div class="title">Cafe</div></a></li>
                        <li><a href="#exp" data-toggle="tab"><img src="images/features-icons/exp-icon.png" alt="exp"><div class="title">Experiences</div></a></li>
                        <li><a href="#op" data-toggle="tab"><img src="images/features-icons/operation-icon.png" alt="operation"><div class="title">Operations</div></a></li>
                    </ul>                   
                </div>
                <div class="tab-content">
                	<div class="tab-pane fade in active" id="stay">
                        <div class="btn-sec">
                            <a href="#section1" class="btn btn-pura btn-blk page-scroll">explore rooms</a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	Elegant yet contemporary character, with mesmerizing views of mountains to valleys 
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Comfortable and spacious stays with fresh and crisp bed and bath linen 
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Friendly service and willingness to go that extra mile to make sure you get what you want 
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Room and Bath amenities inspired to pamper you
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="cafe">
                        <div class="btn-sec">
                            <a href="#section2" class="btn btn-pura btn-blk page-scroll">explore cafe</a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	All day cafe, celebrating locally rich cuisines and handpicked popular dishes from the world
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Freshly brewed coffee for a dialogue with the traveler within 
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Transforms to a social joint, for creating a perfect bond with your family and loved ones
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Sure to tantalize your taste buds
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="exp">
                        <div class="btn-sec">
                            <a href="#section3" class="btn btn-pura btn-blk page-scroll">explore experience</a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	Experiences designed to indulge in wilderness and explore the surroundings
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Bouquet of  guided tours, local experiences and activities
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	From healing amenities to adrenaline rushed activities and expeditions
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Select your travel mood and program your experiences for a memorable holiday
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="op">
                        <div class="btn-sec">
                            <a href="#section4" class="btn btn-pura btn-blk page-scroll">explore operation</a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	Standardized in room experience and F&amp;B offerings programmed with local experiences and activities
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Consistent and quality service across all properties
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Fresh approach and robust operating procedures
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	Responsive to your travel moods, enabled for quick discovery and selection  of travel experiences
                        </div>
                    </div>
                </div>
                	</div>
                </div>                
            </div>            
        </div>
    </section>   
    
    <section class="sec package" id="section1">
    	<div class="container">
        	<h2>Explore Rooms</h2>
        </div>    
		<div class="two-block">        	
            <div class="left-sec concept-txt-bg">            	
                <div class="grey-bg half-blk-txt text-left">
                    <p>Our handpicked selection of boutique resorts, holiday homes, lodges and villas represent finesse and tranquility with the breathtaking views of majestic mountains and cascading water as a definite alternate to unpleasant travel occurrences.<p>

<p>Pura offers intimate size and cozy ambiance, delightful lodgings with crisp linens, fluffy duvets and bath essentials  to rejuvenate 
you from the rat race of the cities. Each room is decorated in a smoothly contemporary mélange of sun kissed yellows, natures 
lush greens and wintery night of blues and whites with warm cushions to add our character and warmth.</p>

<p>We enable the perfect individual as well as family environment for holidaymakers, while being committed to the spirit of conservation and restoration. Each property is sensitive to its surroundings – both environment and the local community.</p>

<p>Pura understands your need for comfort and recognizes the appetite for your cravings with a worry free holiday accommodation.</p>

<p>Our<strong> Comfortable Holiday Stays Guarantee</strong> include:</p>
	<table class="table">
                <thead>
                    
                </thead>
                <tbody>
                	<tr>
                        <td>Spotless bath towels</td>
                        <td>Rs. 500/ - OFF on your stay*</td>
                    </tr>
                    <tr>    
                        <td>Fresh &amp; crisp bed linen</td>
                        <td>Rs. 700/ - OFF on your stay*</td>
                    </tr>
                    <tr>
                        <td>Fully functional bathroom with standard toiletries , hot and cold water</td>
                        <td>Rs. 500/ - OFF on your stay*</td>
                    </tr>
                    <tr>
                        <td>In room amenities : 4 water bottles, tea –coffee maker, standard choice of tea, coffee and munchies</td>
                        <td>Voucher of Rs. 500/, can be used during your current stay or next stay at Pura **</td>
                    </tr>
                    <tr>   
                        <td>Complementary buffet breakfast : gourmet breakfast menu on the table from 8 AM to 12 noon. </td>
                        <td>Voucher of Rs. 500/, can be used during your current stay or next stay at Pura **</td>
                    </tr>                    
                </tbody>
            </table>                    

                </div>
            </div>
            <div class="right-sec package-left">
            	<div class="grey-bg">
                	<div class="slider1">
                    	<div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                    </div>
                    <div id="bx-pager1" class="bx-pager">
                      <a data-slide-index="0" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="1" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="2" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>            
        </div>       
    </section>
    
    <section class="sec package" id="section2">
    	<div class="container">
        	<h2>Cafe</h2>
        </div>    
		<div class="two-block">        	            
            <div class="left-sec package-left">
            	<div class="grey-bg">
                	<div class="slider2">
                    	<div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                    </div>
                    <div id="bx-pager2" class="bx-pager">
                      <a data-slide-index="0" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="1" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="2" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="right-sec concept-txt-bg">            	
                <div class="grey-bg half-blk-txt text-left">
                    <p>The Café at Pura symbolizes the "joy of life" offering you a little sumptuous taste, all along the day,
with a friendly and comfortable atmosphere.</p>

<p>A perfect stop to linger over utterly satisfying, simple, yet exquisite meals. All day menu with gourmet burgers, pizzas, sandwiches, salads and rolls – to match some of the popular choices in our daily lives. </p>
<p>Our chefs at Café Pura are constantly evolving our menus and dishes, by reviving traditional global cuisine with a modern twist.</p>

<p>Ideal for book lovers looking for a quite time to catch up on their reading as they can choose from the array of books and tea blends, freshly brewed coffee. </p>

<p>The cafe can transform to a social joint with loud cheers and banter of fun, thanks to the board game marathons or charades your family can indulges in.</p>                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>                
    </section>  
    
    <section class="sec package" id="section3">
    	<div class="container">
        	<h2>Experience</h2>
        </div>    
		<div class="two-block">        	
            <div class="left-sec concept-txt-bg">            	
                <div class="grey-bg half-blk-txt text-left">
                    <p>Experiences at Pura are suited for those who are independent of a forced travel package. With a choice of wilderness
nature walks, picnics, night barbeques and bonfire, design your own stay program and select from curated guided tours, local experiences and activities.</p>
                    <p>our trustworthy team of  Travel Curators carefully select and program the experiences with your stay. The stays are 
programmed, keeping in mind indigenous beauty and as you draw closer to the finish of the Holiday you depart with immersive experiential break leaving your footprints.</p>                                 
                </div>
            </div>
            <div class="right-sec package-left">
            	<div class="grey-bg">
                	<div class="slider3">
                    	<div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                    </div>
                    <div id="bx-pager3" class="bx-pager">
                      <a data-slide-index="0" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="1" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="2" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>                
    </section>
    
    <section class="sec package bottom-gap" id="section4">
    	<div class="container">
        	<h2>Operation</h2>
        </div>    
		<div class="two-block">        	            
            <div class="left-sec package-left">
            	<div class="grey-bg">
                	<div class="slider4">
                    	<div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                        <div><img src="images/gall/room-gall01.jpg" alt=""></div>
                    </div>
                    <div id="bx-pager4" class="bx-pager">
                      <a data-slide-index="0" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="1" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                      <a data-slide-index="2" href=""><img src="images/gall/room-gall01.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="right-sec concept-txt-bg">            	
                <div class="grey-bg half-blk-txt text-left">
                    <p>Pura's mission is born from the out of the box ideas of the hardworking team of hoteliers and passionate travelers. By logically organizing complex service delivery methods, Pura sets up circuit level operations to ensure consistency across all properties, while continuously achieving lower costs for our customers.  While we we not inventing anything new, we are also not following the traditional hotel way. We believe in designing simple and meaningful operations for our team.</p>



                    <p>Our methodology lies on the standardized and even functioning of quality service across all properties. Powered by technology, we bring the discovery and selection of holidays and weekend getaways at the comfort of your homes or even on the go.</p>

                    <p>Our staff are rooted in the local scene and and shall assist in establishing your connect with the surroundings.  
Through a continuous learning and development process, the team at Pura is  committed to offer the best in holidays.</p>                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>                
    </section>     
    
    <section class="social-sec">
    	<div class="container">
        	<ul>
            	<li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-google-plus"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
            </ul>
        </div>
    </section>
    
    <footer class="clearfix">
        <div class="container clearfix">
            <div class="col-sm-3 foot-sep">
                <div class="foot-logo"><img src="images/pura-logo-grey.png" alt="pura"></div>
            </div>
            <div class="col-sm-3 foot-sep">
                <div class="foot-in">        
                    <div class="foot-txt"><i class="fa fa-envelope"></i> <a href="mailto:contact@purastays.com">contact@purastays.com</a></div>
                    <div class="foot-txt"><i class="fa fa-phone"></i> <a href="tel:+9112412356789"><span>+91 124 123 567 89</span></a></div>   
                    <div class="gap30"></div>
                    <h4>Corporate office</h4>  
                    <div class="foot-txt">#<span>9</span>, building no. <span>10</span>,<br>cyber city, gurgaon<br>pin - <span>123456</span><br>India</div>   
                </div>    
            </div>
            <div class="col-sm-3 foot-sep">
                <div class="foot-in">
                    <h4>Quick links</h4>  
                    <ul>
                        <li><a href="about.php">About Pura</a></li>
                        <li><a href="javascript:void(0);">For Pura Membership</a></li>
                        <li><a href="javascript:void(0);">free Newsletter</a></li>
                        <li><a href="javascript:void(0);">Travel tips</a></li>
                        <li><a href="javascript:void(0);">Do's and Dont's</a></li>
                        <li><a href="javascript:void(0);">Terms &amp; conditions</a></li>
                        <li><a href="javascript:void(0);">Comfortable Holiday Stay Guarantee</a></li>
                    </ul>  
                </div>
            </div>
            <div class="col-sm-3">
                <div class="foot-in">
                    <h4>Packages</h4>  
                    <ul>
                        <li><a href="javascript:void(0);">Wildlife Getaway</a></li>
                        <li><a href="javascript:void(0);">Snow Holiday</a></li>
                        <li><a href="javascript:void(0);">Adventure Holiday</a></li>
                        <li><a href="javascript:void(0);">Heritage Tour</a></li>
                        <li><a href="javascript:void(0);">Women Holiday</a></li>
                    </ul>
                 </div>   
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <a href="contact.php">contact us</a> | copyright &copy; pura stays. all right reserved
            </div>
        </div>        
    </footer>
    <div class="floatingLnk">
        <div class="inn">
            <ul>
                <li><a href="javascript:void(0);"><img src="images/features-icons/stay-icon.png" alt="pura"></a></li>
                <li><a href="javascript:void(0);"><img src="images/features-icons/cafe-tab-icon.png" alt="pura"></a></li>
                <li><a href="javascript:void(0);"><img src="images/features-icons/exp-icon.png" alt="pura"></a></li>
                <li><a href="javascript:void(0);"><img src="images/features-icons/operation-icon.png" alt="pura"></a></li>
            </ul>
        </div>   
    </div>
        

    <script src="bower_components/jquery/dist/jquery.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {
        	$('.slider1').bxSlider({
			  pagerCustom: '#bx-pager1', controls: false
			}); 
			$('.slider2').bxSlider({
			  pagerCustom: '#bx-pager2', controls: false
			}); 
			$('.slider3').bxSlider({
			  pagerCustom: '#bx-pager3', controls: false
			}); 
			$('.slider4').bxSlider({
			  pagerCustom: '#bx-pager4', controls: false
			});  
			
			$("a.page-scroll").click(function() {
				var targetDiv = $(this).attr('href');
				$('html, body').animate({
					scrollTop: $(targetDiv).offset().top 
				}, 2500, 'easeOutCubic');
			});  
			
			var stickyScrollBtn = $('.sec-resort .tab-container').offset().top;
			//console.log($('.sec-resort .tab-container').offset().top);
			var stickyNav = function(){
				var scrollTop = $(window).scrollTop();		  
				if (scrollTop > stickyScrollBtn) { 
					//$('.sec-resort').addClass('float-btn');
					//$('.sec.package#section1').css('margin-top',300);
                    
                    $('.floatingLnk').fadeIn(500);
				} else {
					//$('.sec-resort').removeClass('float-btn');
					//$('.sec.package#section1').css('margin-top',0); 
                    $('.floatingLnk').fadeOut(500);
                    
				}
			};			 
			stickyNav();
			 
			$(window).scroll(function() {
				stickyNav();
			});
			
        });    	
    </script>
  </body>
</html>
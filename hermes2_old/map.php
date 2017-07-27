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
    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDryTVfbzTzVoJ-0z8Qo2TNUMHL4pg0Uos&callback=initMap" async defer></script>
    <script>
    	var map;
		var mylatlng = {lat: 29.5486, lng: 78.9353};
		
		function initMap() {
		  map = new google.maps.Map(document.getElementById('map'), {
			center: mylatlng,		
		    mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoom: 11,
			panControl: false,
			mapTypeControl: false,
	        streetViewControl: false
		  });
		  
		  setMarkers(map);
		}
		// Data for the markers consisting of a name, a LatLng and a zIndex for the
		// order in which these markers should display on top of each other.
		var beaches = [
		  ['Bondi Beach', 29.51, 78.965, 4],
		  ['Coogee Beach', 29.52, 78.97, 5],
		  ['Cronulla Beach', 29.5486, 78.94, 3],
		  ['Manly Beach', 29.53, 78.91, 2],
		  ['Maroubra Beach', 29.50, 78.90, 1]
		];
		
		function setMarkers(map) {
		  // Adds markers to the map.
		
		  // Marker sizes are expressed as a Size of X,Y where the origin of the image
		  // (0,0) is located in the top left of the image.
		
		  // Origins, anchor positions and coordinates of the marker increase in the X
		  // direction to the right and in the Y direction down.
		  var image = {
			url: 'images/map-marker.png',
			// This marker is 20 pixels wide by 32 pixels high.
			size: new google.maps.Size(41, 46),
			// The origin for this image is (0, 0).
			origin: new google.maps.Point(0, 0),
			// The anchor for this image is the base of the flagpole at (0, 32).
			anchor: new google.maps.Point(0, 46)
		  };
		  // Shapes define the clickable region of the icon. The type defines an HTML
		  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
		  // The final coordinate closes the poly by connecting to the first coordinate.
		  var shape = {
			//coords: [1, 1, 1, 20, 18, 20, 18, 1],
			type: 'poly'
		  };
		  for (var i = 0; i < beaches.length; i++) {
			var beach = beaches[i];
			var marker = new google.maps.Marker({
			  position: {lat: beach[1], lng: beach[2]},
			  map: map,
			  icon: image,
			  shape: shape,
			  title: beach[0],
			  zIndex: beach[3]
			});
		  }
		}
		  /*var marker = new google.maps.Marker({
			position: mylatlng,
			map: map,
			title: 'Hello World!',
		  });
		  map.addListener('center_changed', function() {
			// 3 seconds after the center of the map has changed, pan back to the
			// marker.
			window.setTimeout(function() {
			  map.panTo(marker.getPosition());
			}, 3000);
		  });
		
		  marker.addListener('click', function() {
			map.setZoom(15);
			map.setCenter(marker.getPosition());
		  });
		}/*/
    </script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<nav role="navigation" class="navbar navbar-pura shrink">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand"><img src="images/logo.png" alt="Pura"></a>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">                    
            <ul class="nav navbar-nav navbar-right">
                    	<li class="active"><a href="#" class="book">Book a room</a></li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Stays | Resorts <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="resort.php"><i class="fa fa-home"></i> Resort 1</a></li>
                                <li class="divider"></li>
                                <li><a href="resort.php"><i class="fa fa-home"></i> Resort 1</a></li>
                                <li class="divider"></li>
                                <li><a href="resort.php"><i class="fa fa-home"></i> Resort 1</a></li>
                                <li class="divider"></li>
                                <li><a href="resort.php"><i class="fa fa-home"></i> Resort 1</a></li>
                            </ul>
                        </li>
                        <li><a href="concepts.php">Concept</a></li>                        
                        <li><a href="http://blog.purastays.com/" target="_blank">Blog</a></li>
                        <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#myModal">Login</a></li>
                    </ul>
        </div>
        </div>
    </nav>
    
    <div class="map-block">    	
        <div class="left-list">
           <!--div class="tab-sec">
           	  <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-primary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Resort
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="options" id="option2" autocomplete="off"> Activity
                  </label>
                </div>
           </div-->
           <div class="res-list">
           	  <div class="res-list-inn">
	              <ul>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                    <li>
                    	<div class="res-blk">
                        	<div class="left">
                            	<div class="pic">
                                	<img src="images/res-pics.jpg" alt="resort">
                                </div>                                
                            </div>
                            <div class="right">
                                	<div class="title">Sample resort 1</div>
                                    <div class="des">safsad fsda fsadf afs dafs df</div>
                                    <ul>
                                    	<li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                        <li><i class="fa fa-check"></i> sdf</li>
                                    </ul>
                                    <div class="btn-sec">
                                    	<a href="javascript:void(0);" class="btn btn-pura btn-blk">view more</a>
                                    </div>
                                </div>
                        </div>
                    </li>
                  </ul>
              </div>
           </div>
        </div>
        <div class="map-container">
            <div class="map-content" id="map"></div>
        </div>
    </div>
    
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
    <!-- Login Modal -->
    <?php include_once("includes/login-modal.php");?>

    
  </body>
</html>
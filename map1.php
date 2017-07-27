<!DOCTYPE html>
<?php
    ini_set('display_errors', 1);
   include_once("includes/db.inc.php");
   $db= new DB();

$id = $_REQUEST['id'];
$db = new DB();


   //url-rewrite function
       $qry_url = "select * from url_redirection where Status = 1"; 
       $result_url = $db->_query($qry_url);
       while($row_url = mysqli_fetch_array($result_url))
            $arr_url[$row_url['Old_Url']] = $row_url['New_Url'];
    //end of url-rewrite function



//$qry1 = "select Id from clusters where find_in_set($id, Activities)";
$qry1 = "select Id from clusters where  Activities like '%".$id.", %'";

$result1 = $db->_query($qry1);
$clusters = [];
$resorts = [];
while($row1 = mysqli_fetch_array($result1))
{
    $clusters[] = $row1['Id'];
}
$cluster_id = implode(', ', $clusters);
 
$qry = 'SELECT Resorts FROM clusters where Id IN ('.$cluster_id.')';
$result = $db->_query($qry);
while($row = mysqli_fetch_array($result))
{
    $resort = explode(', ', $row['Resorts']);
    foreach ($resort as $key => $value) {
        if($value !="")
            $resorts[] = $value;
    }
}
$resort_id = implode(', ', $resorts);
$qry = 'SELECT Id, Lat, Lng, Resort_Summary FROM resorts where Status = 1 && Id IN ('.$resort_id.')';
$result = $db->_query($qry);

$count = mysqli_num_rows($result);

header('Content-type: text/html; charset=utf-8')   
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore less frequented places in the lap of nature - Pura Stays</title>
    <meta name="description" content="India's first travel mood based portal allows its users to book a holiday stay rendering unique experiences for a dream vacation amidst nature.">
    <meta name="keywords" content="">
    
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="css/custom.css" rel="stylesheet">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>    

    <script>
    	function initialize() {
		    var locations = [
		            <?php
		                $i=0;
		                while($row = mysqli_fetch_array($result))
		                {
		                    $i++;
		                    if($i<$count)
		                    {
		                        ?>
		                        ['<?= $row['Id']; ?>', <?= $row['Lat']; ?>, <?= $row['Lng']; ?>, <?= $i; ?>],
		                        <?php
		                    }
		                    else
		                    {
		                        ?>
		                            ['<?= $row['Id']; ?>', <?= $row['Lat']; ?>, <?= $row['Lng']; ?>, <?= $i; ?>]
		                        <?php
		                    }
		                }
		            ?>
			    ];

		    window.map = new google.maps.Map(document.getElementById('map'), {
		        mapTypeId: google.maps.MapTypeId.ROADMAP,
		        zoom: 20,
		        panControl: false,
				mapTypeControl: false,
		        streetViewControl: false,
	            	           
	            mapTypeControlOptions: {
	                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
	            },
	            navigationControl: true,
	            navigationControlOptions: {
	                style: google.maps.NavigationControlStyle.SMALL
	            }
		    });

		    var infowindow = new google.maps.InfoWindow();

		    var bounds = new google.maps.LatLngBounds();

		    for (i = 0; i < locations.length; i++) {
		        marker = new google.maps.Marker({
		            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		            map: map,
		            icon: 'images/map-marker.png'
		        });

		        bounds.extend(marker.position);

		        google.maps.event.addListener(marker, 'click', (function (marker, i) {
		            return function () {
		            	var elems = document.querySelectorAll(".blkn");

						[].forEach.call(elems, function(el) {
						    el.classList.remove("hover");
						});

						var element = document.getElementById(locations[i][0]);
						element.classList.add("hover");				
		            }
		        })(marker, i));
		    }
		   

		    map.fitBounds(bounds);

		    var listener = google.maps.event.addListener(map, "idle", function () {		        
		        google.maps.event.removeListener(listener);
		    });
		}

		function loadScript() {
		    var script = document.createElement('script');
		    script.type = 'text/javascript';
		    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB9OLokmn9nhBuHYjk_v21oFNuF7tYys9Q&callback=initialize';
		    document.body.appendChild(script);
		}

		window.onload = loadScript;
    </script>
    
     
  </head>
  <body>
    
  <div class="overlay"><img src="images/loading.gif" alt="pura" width="120px" height="10px"></div>
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
                <a href="http://www.purastays.com" class="navbar-brand"><img src="images/logo.png" alt="Pura"></a>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">                    
            <ul class="nav navbar-nav navbar-right">
                    	<li class="active"><a href="http://www.purastays.com/booking/" class="book">Book a stay</a></li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Holiday Stays <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                            <?php
                                
                                $qry = "select * from resorts where Status = 1 order by Resort_Name ASC";
                                $result = $db->_query($qry);
                                while($row = mysqli_fetch_array($result))
                                    {
		                                $url = 'http://www.purastays.com/resorts/resort.php?id='.$row['Id'];
			                            $url = $arr_url[$url];
			                            ?>
			                                <li><a href="<?= $url; ?>"><i class="fa custom-home"></i><?= $row['Resort_Name'];?></a></li>
			                                <li class="divider"></li>
			                            <?php        
                                    }
                                ?>
                            </ul>
                        </li>
                        <li><a href="http://www.purastays.com/pura-stays-insight">Insight</a></li>                        
                        <li><a href="http://blog.purastays.com/" target="_blank">Blog</a></li>
                        <?php
                        if($_SESSION['login_status']=='login')
                            {
                                echo '<li><a href="http://www.purastays.com/profile">Profile</a></li>    ';
                    			echo '<li><a href="http://www.purastays.com/index.php?logout">Sign out</a></li>';        
                            }
                            else
                            {
                                echo '<li><a href="javascript:void(0);"  data-toggle="modal" data-target="#myModal">Sign in</a></li>';        
                            }
                        ?>
                    </ul>
        </div>
        </div>
    </nav>
    
    <div class="map-block">    	
        <div class="left-list">           
           <div class="res-list">
           	  <div class="res-list-inn" id="res-list-inn">
	              <ul>
                    <?php
                                                
                        $qry = 'SELECT * FROM resorts where Status = 1 && Id IN ('.$resort_id.')';
                        $result = $db->_query($qry);
                        while($row = mysqli_fetch_array($result))
                        {   
                            ?>
                            <li class="blkn" id="<?= $row['Id']; ?>">
                                <div class="res-blk">
                                    <div class="left">
                                        <div class="pic">
                                            <img src="<?= $row['About_Image']; ?>" alt="resort">
                                        </div>                                
                                    </div>
                                    <div class="right">
                                        <div class="title"><?= $row['Resort_Name']; ?></div>
                                        <div class="des"><?= $row['Resort_Summary']; ?></div>
                                        
                                        <div class="btn-sec">
                                        	<?php
                                        		$url = 'http://www.purastays.com/resorts/resort.php?id='.$row['Id'];
			                            		$url = $arr_url[$url];
                                        	?>
                                            <a href="<?= $url; ?>" class="btn btn-pura btn-blk">view more</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php
                        }
                    ?>
                    
                  </ul>
              </div>
           </div>
        </div>
        <div class="map-container">
            <div class="map-res-menu" id="showResort"><img src="images/map-res.png" alt="res map menu" /></div>
            <div class="map-content" id="map"></div>
        </div>
    </div>
    
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>
    <!-- Login Modal -->
    <?php include_once("includes/login-modal.php");?>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#showResort").on('click', function(){
                if($(this).hasClass('active')){
                    $('.left-list').fadeOut(0);
                    $('.map-container').css('padding-left',0);
                    $(this).css('left', -2);
                    $(this).removeClass('active');
                    $(this).css('-webkit-transform', 'rotateY(0deg)');
                    $(this).css('-moz-transform', 'rotateY(0deg)');
                    $(this).css('transform', 'rotateY(0deg)');
                }else{
                    $('.left-list').fadeIn(500);
                    $('.map-container').css('padding-left',290);
                    $(this).css('left', 290);
                    $(this).addClass('active');
                    $(this).css('-webkit-transform', 'rotateY(-180deg)');
                    $(this).css('-moz-transform', 'rotateY(-180deg)');
                    $(this).css('transform', 'rotateY(-180deg)');
                }    
            })
        })
    </script>
     
  </body>
</html>
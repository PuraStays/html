<?php   header('Content-type: text/html; charset=utf-8'); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        ini_set("display_errors", '1');
        include("../includes/db.inc.php");
        $db = new DB();
        $id = $_REQUEST['id'];
        $qry = "select * from resorts where id= $id && Status = 1";
        $result = $db->_query($qry);
        $row = mysqli_Fetch_array($result);
        $actual_link = 'http://www.purastays.com'.$_SERVER['REQUEST_URI'];
    ?>
    
    <title><?= $row['Meta_Title']; ?></title>
    <meta name="description" content="<?= $row['Meta_Description']; ?>">
    <meta name="keywords" content="<?= $row['Meta_Keyword']; ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="<?= $row['Meta_Title']; ?>">
    <meta name="twitter:description" content="<?= $row['Meta_Description']; ?>">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="<?= $row['Banner_Image']; ?>">
    <meta name="twitter:url" content="<?= $actual_link;?>">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="<?= $row['Meta_Title']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= $actual_link;?>" />
    <meta property="og:image" content="<?= $row['Banner_Image']; ?>" />
    <meta property="og:description" content="<?= $row['Meta_Description']; ?>" />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255" />
    <meta property="fb:app_id" content="1152657561422465" />

    <!-- stylesheets -->
    <?php include_once("../partials/common/stylesheet.php") ?>
    <?php include_once("../partials/resorts/stylesheet.php") ?>
    
    <!-- javascript head section-->
    <?php include_once("../partials/common/javascript-head.php") ?>
    <?php include_once("../partials/resorts/javascript-head.php") ?>
    
    <!-- set page properties -->
    <script type="text/javascript">
        localStorage.clear();
        localStorage.setItem("page", "<?php echo pathinfo(__FILE__, PATHINFO_FILENAME); ?>");
        localStorage.setItem("id", "<?php echo $_REQUEST['id']; ?>");
        var mapLocation = {
            "lat": <?= $row['Lat']; ?>,
            "lng": <?= $row['Lng'] ?>
        };
        localStorage.setItem("location", JSON.stringify(mapLocation));
    </script>

    <script>
        var resource = {
            "page": "<?php echo pathinfo(__FILE__, PATHINFO_FILENAME); ?>",
            "id": "<?php echo $id = $_REQUEST['id']; ?>"
        }        
    </script>

	
    <script>
      var myLatLng = {lat: <?= $row['Lat']; ?>, lng: <?= $row['Lng']; ?>};
      console.log(JSON.parse(localStorage.getItem(location)));
      function initMap() {
          
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          draggable: false,
          scrollwheel: false,
	      disableDoubleClickZoom: true,
	      panControl: false,
	      streetViewControl: false,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Pura',
          icon: '../images/map-marker.png'
        });   
      }  
      $(document).ready(function () {       
        $('.maplink').on('click', function(){    
            $('#mapModal').modal({
                show: 'true'
            });        
            var modalBodyHt = $(window).outerHeight() - 55;
            $('#mapModal .modal-body').height(modalBodyHt);
            
            var map2 = new google.maps.Map(document.getElementById('map2'), {
                zoom: 10,
                center: myLatLng
            });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map2,
                    title: 'Pura',
                    icon: '../images/map-marker.png'
    	        });
            })
        })      
    </script>
    <?php include_once("../includes/taghead.php") ?>
  </head>
  <body onload="loadPackage()">
  <?php include_once("../includes/tagbody.php") ?> 

    <div class="overlay"><img src="../images/loading.gif" alt="Pura Stays" width="60px" height="60px"></div>
    <header>
       
        <?php require_once("../src/Facebook/autoload.php"); ?>
        <?php include_once("../includes/login-modal.php");?>        
        <?php include_once("offers.php");?>
    	
        <div class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("../includes/nav2.php");?>

            
            
            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1><?= $row['Banner_Title']; ?></h1>
                    <p></p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="<?= $row['Banner_Image']; ?>" alt="<?= $row['Banner_Title']; ?>">
            </div>
        </div>
    </header>
    
    <section class="sec-resort">
    	<div class="container">
            <div class="icon-container">    
            	<div class="row">
                	<ul>
                        <?php
                            $features =  explode(", ", $row['feature_id']);
                            $qry_f = "select f.* from resorts as r INNER JOIN features as f ON (r.feature_id REGEXP CONCAT(' ?', f.Id)) where r.Id = $id && f.Status = 1";
                            $result_f = $db->_query($qry_f);
                            $i=0;
                            while ($row_f = mysqli_fetch_array($result_f)) {
                                $i++;
                                if(!$db->is_mobile())
                                {
                                    echo '<li><img src="'.$row_f["Image"].'" alt="'.$row_f["Title"].'"></li>';
                                }
                                else
                                {
                                    if($i<=8)
                                        echo '<li><img src="'.$row_f["Image"].'" alt="'.$row_f["Title"].'"></li>';
                                }
                            }
                         ?> 
                    </ul>                   
                </div>
            </div>
            <?php
                $gallery =  explode(", ", $row['gallery_id']);
            ?>
        </div>
    </section>
    <?php
        $qry_t = "select r.Id,  a.About_Activity_Title, a.Activity_Name, a.Activity_Summary, a.About_Activity_Title, a.Icon from resorts as r INNER JOIN activities as a ON (r.things_to_do_id REGEXP CONCAT(' ?', a.Id)) where r.Id = $id && a.Status = 1 order by t_order Asc";

        $result_t = $db->_query($qry_t);
    ?>
    
    <section class="container">
        <div class="row">
            <div class="col-sm-8 form-left-sec">
                <div class="sec-resort">
            
                    <?php
                        $gallery =  explode(", ", $row['gallery_id']);
                    ?>
                    <div class="about-container clearfix">
                        <div class="abt-sec">
                            <div class="abt-banner">
                                <img src="<?= $row['About_Image']; ?>" alt="<?= $row['About_Resort_Title']; ?>">
                            </div>
                            <div class="abt-txt">
                                <div class="abt-inner">
                                    <h2>About <?= $row['About_Resort_Title']; ?></h2>
                                    <?= $row['About_Resort_Description']; ?>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $qry_t = "select r.Id,  a.About_Activity_Title, a.Activity_Name, a.Activity_Summary, a.About_Activity_Title, a.Icon from resorts as r INNER JOIN activities as a ON (r.things_to_do_id REGEXP CONCAT(' ?', a.Id)) where r.Id = $id && a.Status = 1 order by t_order Asc";
                    $result_t = $db->_query($qry_t);
                ?>
                <!-- todo section starts -->
                <div class="sec-todo">
                    <div class="row">
                        <div class="col-sm-4" style="display:none">
                            <div class="brown-bg">
                                <div class="head"><h2>Things to do &nbsp;</h2><span><img src="../images/features-icons/things-to-do-icon.png" alt="Pura Stays"></span></div>
                                <div class="brown-container">
                                    <div class="brown-content">
                                        <ul>
                                            <?php
                                            while($row_t = mysqli_fetch_array($result_t))
                                            {
                                            ?>
                                            <li>
                                                <div class="todo">                                        	
                                                    <div class="up"><h3><span><img src="<?= $row_t['Icon']; ?>" alt="<?= $row_t['Activity_Name']; ?>"></span> <?= $row_t['Activity_Name']; ?></h3></div>
                                                    <div class="down"><?= substr($row_t['Activity_Summary'], 0, 100); ?></div>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $qry_nbp = "select n.*, n.Image, n.Title, n.Description from resorts as r INNER JOIN nearbyplaces as n ON (r.nearbyplaces_id REGEXP CONCAT(' ?', n.Id)) where r.Id = $id && n.Status = 1 order by p_order Asc";
                                $result_nbp = $db->_query($qry_nbp) ;
                        ?>
                        <div class="col-sm-6">
                            <div class="brown-bg">
                                <div class="head"><h2>Wander &nbsp;</h2><span><img src="../images/features-icons/near-by-places.png" alt="Pura Stays"></span></div>
                                <div class="brown-container">
                                    <div class="brown-content">
                                        <ul>
                                        <?php
                                            while($row_nbp = mysqli_fetch_array($result_nbp))
                                            {
                                            ?>
                                            <li>
                                                <div class="places clearfix">
                                                    <div class="left"><img src="<?= $row_nbp['Image']; ?>" alt="<?= $row_nbp['Title']; ?>"></div>
                                                    <div class="right"><h3><?= $row_nbp['Title']; ?></h3><p><?= $row_nbp['Description']; ?> </p></div>
                                                </div>
                                            </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="ideal">
                                <div class="head"><h2>How to reach</h2></div>
                                <div class="grey-container">
                                    <div class="content">
                                        
                                            <?php
                                                $qry1 = "select * from clusters where Resorts in ($id)";
                                                $result1 = $db->_query($qry1);
                                                $row1 = mysqli_fetch_array($result1);
                                            ?>
                                            
                                        
                                        <p>
                                        <?php if($row['Address']!=""){ echo $row['Address'].' '; } ?>
                                        <?php if($row['Area']!=""){ echo $row['Area'].' '; } ?>
                                        <?php if($row['City']!=""){ echo $row['City'].' '; } ?>
                                        <?php if($row['State']!=""){ echo $row['State'].' '; } ?>
                                        <?php if($row['Pin']!=""){ echo $row['Pin'].' '; } ?>
                                        </p>                                                    
                                        <div class="gap20"></div>
                                        <h4>By Road</h4>
                                        <p><?= $row['HTR_Description']; ?></p>                                
                                        <table>
                                            <tr>
                                                <td class="a">Nearest railway station</td>
                                                <td class="b"><?= $row['Hearest_Railway_Station']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="a">Nearest Airport</td>
                                                <td class="b"><?= $row['Nearest_Airport']; ?></td>
                                            </tr>
                                        </table>

                                        <div class="map" data-toggle="modal" data-target="#mapModal"><div id="map"></div></div>
                                        
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <!-- todo section ends -->

                <!-- gallery starts -->
                <?php
                    $gallery =  explode(", ", $row['gallery_id']);
                    $galleryalt =  explode(", ", $row['Alt']);
                ?>
                <?php
                    $qry="SELECT * from user_image where r_id='$id' order by i_order Asc";
                    $result = $db->_query($qry);
                    $x=0;
                    while($rows = $result->fetch_assoc()){
                        $resort_prority_image[]=$rows['r_img'];
                    }
                    // print_r($resort_prority_image);
                ?>
                <section class="sec gallery2 explore-gallery">
                    <h2>Quick Look</h2>
                    <div class="sec-container">
                        <div class="galleryNew">
                            <ul>
                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[0]; ?>" alt="<?= $galleryalt[0]; ?>"> 
                                        </figure>
                                        <div class="hoverImg">
                                        <a href="<?= $resort_prority_image[0]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[1]; ?>" alt="<?= $galleryalt[1]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[1]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[2]; ?>" alt="<?= $galleryalt[2]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[2]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>

                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[3]; ?>" alt="<?= $galleryalt[3]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[3]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[4]; ?>" alt="<?= $galleryalt[4]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[4]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[5]; ?>" alt="<?= $galleryalt[5]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[5]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>

                                <li class="col-sm-6">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[6]; ?>" alt="<?= $galleryalt[6]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[6]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6 resImgGal">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[7]; ?>" alt="<?= $galleryalt[7]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[7]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6 resImgGal">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[8]; ?>" alt="<?= $galleryalt[8]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[8]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li>
                                <li class="col-sm-6 resImgGal">
                                    <div class="imgCntnr">
                                        <figure>
                                            <img src="<?= $resort_prority_image[9]; ?>" alt="<?= $galleryalt[9]; ?>">
                                        </figure>
                                        <a href="<?= $resort_prority_image[9]; ?>" data-lightbox="gall2" class="hoverImg">
                                            <div class="txtBlk"> 
                                                <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                            </div>    
                                        </a>
                                    </div>
                                </li> 
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section> 
                <!-- gallery ends -->

            </div>
            <div class="col-sm-4 hidden-xs form-right-sec">
                <div class="floating-window">
                    <div class="floating-window-content">
                        <div class="floating-booking-form">
                            <div class="form-head">
                                <div><span class="glyphicon glyphicon-calendar"></span>Book your stay</div>
                            </div>
                            <div class="form-body">
                                <img class="window-loader" src="../images/loading.gif" width="30">
                                <div id="BEx4IDaY3bWD">
                                    <div id="BEx4IDaY3bWR" class="BEx4ZXaY3bWR"></div>
                                    <input type ="hidden" value="YYcDka7DAsWh4JBPKmq5Pg" id="BEx4ZXaPkNmGuid">
                                    <script type="text/javascript" onload="loaded=1">
                                        var debug = false;
                                        function ls(t,e,s){var c,n=t.getElementsByTagName(e)[0],r=/^http:/.test(t.location)?"http":"https";s&&(c=t.createElement(e),c.src=r+s,debug&&(c.src=s),n.parentNode.insertBefore(c,n))}ls(document,"script","://s3-ap-southeast-1.amazonaws.com/djubo-static/static/widget/js/widget.min.2.0.js");
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
            $('document').ready(function(){
                setTimeout(function(){
                    $('#BEx4IDaY3bWR').css({
                        "visibility": "visible"
                    })
                }, 2500);
               
            })
            
        </script>
    </section>


          
    
    
    
    <!-- stay section starts -->
    <?php include_once("stay_section_web.php") ?> 
    <!-- stay section ends -->


    <section class="sec package">
        <div class="container">
            <h2>Explore</h2>
        </div>    
        <div class="two-block">  
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt">
                        <div class="actual-txt">
                            <p><?= $row['Cafe_Description']?> </p>
                            
                            <?php
                                if(!$db->is_mobile())
                                {
                            ?>
                            <h3>Food</h3>
                            <ul>
                                <?php
                                    $Cafe_Features =  explode("\n", $row['Cafe_Features']);
                                    foreach ($Cafe_Features as $key => $value) {
                                        echo '<li>'.$value.' </li>';        
                                    }
                                ?>
                            </ul>
                            <?php
                                if($row['Cafe_Speciality']!="")
                                {
                                    ?>
                                    <h3>Spaces</h3>
                                    <ul>
                                        <?php
                                            $Cafe_Speciality =  explode("\n", $row['Cafe_Speciality']);
                                            foreach ($Cafe_Speciality as $key => $value) {
                                                echo '<li>'.$value.' </li>';        
                                            }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            ?>
                            
                            
                            <div class="btn-sec text-center">
                                <a href="http://purastays.com/booking/" class="btn btn-pura">Book Now</a>
                            </div>
                            <?php
                                }
                            ?>
                        </div>    
                    </div>
                    <div class="img-cntr">
                        <img src="../images/taste.jpg" alt="taste">
                    </div>
                </div>
            </div>
            <div class="resclearfix"></div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery2" class="gallery list-unstyled cS-hidden">
						<?php
                            $Our_Room_Gallery =  explode(", ", $row['Cafe_Gallery']);
							$Cafe_Galleryalt =  explode(", ", $row['Cafe_Galleryalt']);
                            foreach ($Our_Room_Gallery as $key => $value) {
                                if($value!="")
                                {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="<?= $img_alt_arr[$value]; ?>" />
                                </li>
                                <?php
                                }
                            }
                        ?>
                       	
                        </ul>
                    </div>
                </div>
            </div>       
            
            <div class="clearfix"></div>  
        </div>                
    </section>
    
    <section class="sec package">
    	<div class="container">
        	<h2>Experience</h2>
        </div>    
		<div class="package-container">
            
                <div class="package-inner">
                    <div class="step step1 step11 left pura-package">
                    	<div class="overlay_inn"></div> 
                        <div class="step-innner">
                            <h3><b>Start Exploring!</b></h3>
                            <p>The more you travel, the more you learn about the world and yourself. Take the chance to embrace rare experiences that help you unwind and uncover new territory. Discover the myriad manifestations of nature on wilderness walks, treks, hikes and nature picnics. Go on a village tour and witness the lives of the locals, their culture and tradition. </p>
							<p>Revive your soul with thrilling and daring adventure activities like paragliding, rappelling, kayaking or ATV driving. The stays have been enhanced for you, keeping in mind the indigenous beauty as well as diverse activities to partake in. There is no forced travel package because we know that you recurrently yearn for something out of the box, something rejuvenating accompanied by a wholesome stay.</p>
							<p>A journey replete with excitement and exploration is waiting for you! </p>                            
                            <div class="btn-sec"><a href="javascript:void(0);" id="getMood" class="btn btn-pura">What’s your travel mood?</a></div>	                        
                        </div>
                                                   
                    </div>
                    <div class="step step1 step12 right pura-moods">
                        <div class="step-innner"  id="mood">
                            <h3>What’s your travel mood?</h3>
                            <p>To travel is to take a journey into yourself and we strongly feel that your travel mood should get some recognition. That’s why, we identified some of the travel moods so that you swiftly book a thrilling experience along with a holiday stay. Pick a travel mood and live like you belong there.</p>
                            <div class="lnq-container">
                            <p>Select any one travel mood from below and get started:</p>
                                <ul></ul>
                            </div>
                        </div>

                        <a class="left resNav" href="javascript:void(0);" id="backToHome">Back</a>
                    </div>

                    <div class="step step2 step21 left pura-program">
                        <div class="step-innner" id="program">
                            <h3>Pick an experience for your travel mood: <span id="moodTitleStep2"></span></h3>
                            <p>We live to discover beauty in nature. Uncover the treasures of nature on a wilderness walk or be captivated by the charming insights of village life. When it comes to wandering and knowing the region, wilderness walk works superbly and visit to a local village is certainly one of the most fascinating options too.</p>
                            <div class="lnq-container">
                                <ul></ul>
							</div>
							<a href="javascript:void(0)" class="backlnk" id="backToMood"><< change mood</a>
                         <a class="left resNav" href="javascript:void(0);" id="backToMood1">Back</a>
                            </div>
                        </div>
					
                    <div class="step step2 step22 right pura-activity">
                        <div class="step-innner" id="programDetails">
                            <h3>Discover the unseen</h3>
							<span class="t t1">Min - <i>1</i> Hrs</span><span class="t t2">Max - <i>1</i> Hrs</span>
                            <p>Offers a selection of wilderness walk or village experience accompanied by a local guide. These trails/routes have been identified close to the holiday stay (at a short distance). A refreshment pack containing jumbo veg sandwich, cookies, wafers and canned juice will follow. Ideal time to start is 7 am to 10 am, however permissible start time is till 3 pm.</p>
                            <div class="lnq-container2">
                                <ul></ul>
                            </div>
                        </div>
                        <a class="left yellowbg resNav" id="prg2" href="javascript:void(0);">Back</a>
                    </div>


                    <div class="step step3 step31 left pura-activity">
                        <div class="step-innner" id="activityDetails">
                            <h3>Wilderness Walk</h3>
                            <p class="des">When it comes to wandering and knowing the region, wilderness walk works superbly. Wilderness walks or nature trails will be accompanied by a local guide. These trails/routes have been identified close to the holiday stay which will take you to the refreshing world of Kumaon. Moreover, a delicious refreshment pack would follow. Fresh breeze, tall trees and a few unseen cute little birds will come together and offer an unforgettable experience. The stays are set within the pristine peripheries of nature, where you can explore, connect and revive.</p>
                            
                        </div>
                         <a href="javascript:void(0)" class="backlnk2 backToAct"><< back to activity</a>
                         <a class="left yellowbg resNav" id="prg3" href="javascript:void(0);">Back</a>
                         <a class="right yellowbg resNav" id="seeGall" href="javascript:void(0);">See Gallery</a>
                    </div>

                    <div class="step step3 step32 right pura-gallery">
                        <div class="step-innner" id="activityGallery">
                            <h3>Wilderness Walk</h3>
                            <div class="lnq-container3 gal2">
                                <ul>
                                    
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <a class="left resNav" id="prg4" href="javascript:void(0);">Back</a>
                    </div>					
                       
                    </div>

                    

        </div>
            
                      
    </section>
    
    <section class="sec package">
    	<div class="container">

        	<h2>Reviews</h2>
            <div class="test-blk">
                    <?php
                        $qry_test = "select * from testimonials where resort_id = $id && Description ='' && Status = 1";
                        $result_test = $db->_query($qry_test);
                        $count = 0;
                        $test_arr = [];
                    ?>

                    <?php
                      while ($row_test = mysqli_Fetch_array($result_test)) {
                            $test_arr[] = $row_test;
                      }

                                ?>
                                    <div class="col-sm-6">
                                    <?php
                                    foreach ($test_arr as $key => $value) {
                                        if($key%2==0)
                                        {
                                        ?>
                                            <div class="testi clearfix">
                                                <div class="testi-inn">
                                                    <p><?= $value['Summary']; ?></p>
                                                </div>
                                                <div class="foot">
                                                    <div class="pic"><figure><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></figure></div>
                                                    <div class="details">
                                                        <div class="name"><?= $value['User_Name']; ?></div>
                                                        <div class="des"><?= $value['User_Designation']; ?></div>
                                                    </div>
                                                </div>
                                            </div>      
                                        <?php
                                    }
                                    }
                                    ?>
                                </div>
                                    <div class="col-sm-6">
                                    <?php
                                    foreach ($test_arr as $key => $value) {
                                        if($key%2==1)
                                        {
                                        ?>
                                            <div class="testi clearfix">
                                                <div class="testi-inn">
                                                    <p><?= $value['Summary']; ?></p>
                                                </div>
                                                <div class="foot">
                                                    <div class="pic"><figure><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></figure></div>
                                                    <div class="details">
                                                        <div class="name"><?= $value['User_Name']; ?></div>
                                                        <div class="des"><?= $value['User_Designation']; ?></div>
                                                    </div>
                                                </div>
                                            </div>      
                                        <?php
                                    }
                                    }
                                    ?>
                                </div>

                                <?php
                    ?>
                <div class="clearfix"></div>            
             </div>               
        </div>    		               
    </section>
    
    <?php include_once("../includes/social-sec.php");?>
	
    
    <!-- javascript body section-->
    <?php include_once("../partials/common/javascript-body.php") ?>
    <?php include_once("../partials/resorts/javascript-body.php") ?>
     
    
    
    <script>
        var resSlider = function(){
            var brWd = $(".two-block").width();
            if(brWd>769){  
                $(".customWd").width(brWd/2);
            }else{
                $(".customWd").width(brWd);                
            }    

            $(".sec-inner").each(function(){
                var hgt = $(this).height();
            })
        }

        $(document).resize(function(){
            resSlider();
        })

         $(document).ready(function() {         	

            resSlider();
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1500,
                auto:true,
                loop:true,
				pauseOnHover:true,
				onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
				
});
var timeout;
				$('#image-gallery').on('mouseenter', function () {
    $(this).pause();
    clearTimeout(timeout);
            });
            $('#image-gallery2').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1500,
                auto:true,
                loop:true,
				pauseOnHover:true,
                onSliderLoad: function() {
                    $('#image-gallery2').removeClass('cS-hidden');
                }  
            });
            $('.lSPager.lSGallery li:last-child, .gallery.lightSlider li:last-child').remove();			
        });
    </script>


    <?php include_once("../includes/footer.php");?>
    <?php include_once("../includes/map_modal.php");?>  <?php include_once("includes/map_modal.php");?>
    <script type="text/javascript">
        $(document).ready(function(){
        	//removing class from gallery for responsive
        	if($(document).width<=480){
	        	$('.resImgGal').find('.txtBlk a').removeAttr('data-lightbox');
	        }else{
	        	var attr = $(this).attr('name');
	        	if (typeof attr !== typeof undefined && attr !== false) {

	        	}else{
	        		$('.resImgGal').find('.txtBlk a').attr("data-lightbox","gall2");
	        	}
	        }

            $(".step.step2,.step.step3").hide(); 
            var totWid = $(window).width();
            if ( totWid > 768 ) {
                $(".gotoprogram").on('click', function(){
                    var currentPrgId = $(this).attr("data-id");
                    $(".step.step1").fadeOut(0);
                    $(".step.step2").fadeIn(500);
                })

                $("#backToMood").on("click", function(){
                    $(".step.step2").fadeOut(0);
                    $(".step.step1").fadeIn(500);
                })

                $(".changeProg").on("click", function(){
                    var currentPrgId = $(this).attr("data-id");
                })

                $(".goToDetails").on("click", function(){
                    var currentActId = $(this).attr("data-id");
                    $(".step.step2").fadeOut(0);
                    $(".step.step3").fadeIn(500);
                })

                $(".backToAct").on("click", function(){
                    $(".step.step3").fadeOut(0);
                    $(".step.step2").fadeIn(500);
                })

            } 
        })
    </script>
    
    <script type="text/javascript" src="../bower_components/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../libs/lightslider-master/dist/js/lightslider.min.js"></script>
    
    <script src="../js/common.js"></script>
    <script>
		$(document).ready(function() {			
            lightbox.option({
              'resizeDuration': 100,
              'wrapAround': true
            }) 
        }); 
        

        function setImageWidth(){
            $(".galleryNew li").each(function(index){
                var conHt = $(this).find('figure').height();
                var conWd = $(this).find('figure').width();

                var imgHt =  $(this).find('figure img').height();
                var imgWd = $(this).find('figure img').width();

                var widDiff = imgWd - conWd;
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
            })
        }
        

        $(window).load(function(){
           setImageWidth();
        });
        $(window).resize(function(){
            setImageWidth();
        });
    </script>
    
    <script type="text/javascript">
        var loadPackage = function(){
            $('.overlay').fadeIn(500);
            var link = 'http://api.purastays.com/packages/id/' + "<?= $id; ?>";
            $.ajax({
              url: link,
              type: "GET",
              dataType: "json",
              success: function (data, status, jqXHR) {
                var packageData;            
                var currMoodId;
                var currMoodIndex;
                var currMoodName;
                var programData;
                var currPrgId;
                var currPrgName;
                var currPrgIndex;
                var currPrgDes;
                var activityData;
                var activityIndex;


                packageData = data.moods;
                $.each(packageData, function(index, obj) {
                    var moodHtml = '<a href="javascript:void(0);" class="gotoprogram" data-id="'+obj.Id+'" data-index="'+index+'">'+obj.Title+'</a>';
                    $('#mood ul').append($('<li></li>').html(moodHtml));
                });
                //desktop
                if($(window).width() > 768){
                    $('.gotoprogram').on('click',function(){                                        
                        currMoodId = $(this).attr('data-id');
                        currMoodName = $(this).text();
                        currMoodIndex = $(this).attr('data-index');
                        $('.step.step1').hide();
                        $('.step.step2').fadeIn(500);
                        $('#moodTitleStep2').text(currMoodName);
                        programData = packageData[currMoodIndex].programs;
                        $('#program ul').empty();
                        $.each(programData, function(index, obj) {
                            var programHtml = '<a href="javascript:void(0);" class="changeProg" data-id="'+obj.Id+'" data-index="'+index+'" data-det="'+obj.Program_Details+obj.Program_Time_Min+'">'+obj.Program_Title+'</a>';
							$('#program ul').append($('<li></li>').html(programHtml));                                                       
                        });
                        $("#program p").text(packageData[currMoodIndex].Description);
                        $('#programDetails h3').text(programData[0].Program_Title);
                        $('#programDetails p').text(programData[0].Program_Details);  
                        $('#programDetails span.t.t1 i').text(programData[0].Program_Time_Min);  
                        $('#programDetails span.t.t2 i').text(programData[0].Program_Time_Max);  
                        $('#programDetails ul').empty();                      
                        $.each(programData[0].activities, function(index, obj) {
                            var programDetHtml = '<a href="javascript:void(0);" class="goToDetails" data-index="'+index+'">'+obj.Activity_Name+'</a>';
                            $('#programDetails ul').append($('<li></li>').html(programDetHtml));
                        });
                        currPrgIndex = 0;
                    })

                    $(document).on('click', '.changeProg', function(){ 
                        $('#programDetails ul').empty();                
                        currPrgId = $(this).attr('data-id');
                        currPrgName = $(this).text();
                        currPrgIndex = $(this).attr('data-index');                        
                        $('#programDetails h3').text(programData[currPrgIndex].Program_Title);
                        $('#programDetails p').text(programData[currPrgIndex].Program_Details); 
						 $('#programDetails span.t.t1 i').text(programData[currPrgIndex].Program_Time_Min);  
                        $('#programDetails span.t.t2 i').text(programData[currPrgIndex].Program_Time_Max);
                        $.each(programData[currPrgIndex].activities, function(index, obj) {
                            var programDetHtml = '<a href="javascript:void(0);" class="goToDetails" data-index="'+index+'">'+obj.Activity_Name+'</a>';
                            $('#programDetails ul').append($('<li></li>').html(programDetHtml));

                        });                        
                    });
                    $(document).on('click', '.goToDetails', function(){
                    	$('#activityGallery ul li').remove();
                        activityIndex = $(this).attr('data-index');
                        activityData = programData[currPrgIndex].activities[activityIndex];   
                        $('.step.step2').hide();
                        $('.step.step3').fadeIn(500);                        
                        $('#activityDetails h3').text(activityData.Activity_Name);
                        $('#activityDetails p.des').text(activityData.About_Activity_Description);
                        $('#activityDetails p .t.t1 i').text(activityData.Min_Time);
                        $('#activityDetails p .t.t2 i').text(activityData.Max_Time);
                        $('#activityGallery h3').text(activityData.Activity_Name);
                        $.each(activityData.gallery, function(index, obj) {                            
                            $('#activityGallery ul').append($('<li><a href="'+obj+'" data-lightbox="package"><img src="'+obj+'" alt=""></a></li>'));
                        });                           

                    });

                }else{ //mobile
                    $('.step12').hide();
                    $('#getMood').on('click', function(){                                              
                        $('.step11').hide();    
                        $('.step12').fadeIn(500);
                    })

                    $('.gotoprogram').on('click',function(){
                    	currMoodIndex = $(this).attr('data-index');
                        $('.step12').hide();    
                        $('.step21').fadeIn(500);  
                        currMoodId = $(this).attr('data-id');
                        currMoodIndex = $(this).attr('data-index');
                        programData = packageData[currMoodIndex].programs;
                         $('#program ul').empty();
                        $.each(programData, function(index, obj) {
                            var programHtml = '<a href="javascript:void(0);" class="changeProg" data-id="'+obj.Id+'" data-index="'+index+'" data-det="'+obj.Program_Details+'">'+obj.Program_Title+'</a>';
                            $('#program ul').append($('<li></li>').html(programHtml));
                        });
                        $("#program p").text(packageData[currMoodIndex].Description);
                    })

					
					$(document).on('click', '.changeProg', function(){	
						$(".step21").hide();
						$(".step22").fadeIn(500);
						$('#programDetails ul').empty();                
                        currPrgId = $(this).attr('data-id');
                        currPrgName = $(this).text();
                        currPrgIndex = $(this).attr('data-index');                        
                        $('#programDetails h3').text(programData[currPrgIndex].Program_Title);
                        $('#programDetails p').text(programData[currPrgIndex].Program_Details); 
                        $.each(programData[currPrgIndex].activities, function(index, obj) {
                            var programDetHtml = '<a href="javascript:void(0);" class="goToDetails" data-index="'+index+'">'+obj.Activity_Name+'</a>';
                            $('#programDetails ul').append($('<li></li>').html(programDetHtml));
                        });
					})

					$(document).on('click', '.goToDetails', function(){                    	
                        activityIndex = $(this).attr('data-index');
                        activityData = programData[currPrgIndex].activities[activityIndex];                               
                        $('.step22').hide();
                        $('.step31').fadeIn(500);                        
                        $('#activityDetails h3').text(activityData.Activity_Name);
                        $('#activityDetails p.des').text(activityData.About_Activity_Description);
                        $('#activityDetails p .t.t1 i').text(activityData.Min_Time);
                        $('#activityDetails p .t.t2 i').text(activityData.Max_Time);
                        $('#activityGallery h3').text(activityData.Activity_Name); 

                    });

					$(document).on('click', '#seeGall', function(){
						$('#activityGallery ul li').remove();
						$('.step31').hide();
                        $('.step32').fadeIn(500);   
						$.each(activityData.gallery, function(index, obj) {                            
                            $('#activityGallery ul').append($('<li><a href="'+obj+'" data-lightbox="package"><img src="'+obj+'" alt=""></a></li>'));
                        });  
					})                    	                    				

                    $('#backToHome').on('click', function(){
                        $('.step12').hide();    
                        $('.step11').fadeIn(500);                          
                    })					

                    $('#backToMood1').on('click', function(){                        
                        $('.step.step21').hide();
                        $('.step.step12').fadeIn(500);
                    })

                    $("#prg2").on('click', function(){
						$('.step.step22').hide();
                        $('.step.step21').fadeIn(500);
					})

					$("#prg3").on('click', function(){
						$('.step.step31').hide();
                        $('.step.step22').fadeIn(500);
					})

					$("#prg4").on('click', function(){
						$('.step.step32').hide();
                        $('.step.step31').fadeIn(500);
					})
                }   
              },
              error: function (jqXHR, status, err) {
                console.log(err);
              },
              complete: function (jqXHR, status) {
                $('.overlay').fadeOut(500);
              }
            })

        }
    </script>
    
    <script type="text/javascript" src="../libs/jquery.bxslider.min.js"></script>
    <script src="../resorts/resort.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9OLokmn9nhBuHYjk_v21oFNuF7tYys9Q&callback=initMap"></script>
    <?php
        include("../includes/bodyexit.php");
    ?>
  </body>
</html>

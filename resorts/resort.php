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
  <body>
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
    
    <?php include_once("resort_experience_section.php");?>
    
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
    <script type="text/javascript" src="../libs/jquery.bxslider.min.js"></script>
    <script src="../resorts/resort.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9OLokmn9nhBuHYjk_v21oFNuF7tYys9Q&callback=initMap"></script>
    <?php
        //include("../includes/bodyexit.php");
    ?>
  </body>
</html>

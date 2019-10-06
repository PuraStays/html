<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Stories | Holiday destinations | Adventure experiences by Pura Stays</title>
    <meta name="description" content="Read inspiring travel stories about unique travel experiences and adventure holidays by Pura Stays in Nainital, Uttarakhand.">
    <meta name="keywords" content="holiday destinations india, adventure travel experiences india">

    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">

    <script src="bower_components/jquery/dist/jquery.min.js"></script>  

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="Travel Stories | Holiday destinations, Adventure experiences">
    <meta name="twitter:description" content="Read inspiring travel stories about unique travel experiences and adventure holidays. Know about unexplored holiday destinations in India.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/travel-tales">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Travel Stories | Holiday destinations, Adventure experiences" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/travel-tales" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Read inspiring travel stories about unique travel experiences and adventure holidays. Know about unexplored holiday destinations in India." />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255" />
    <meta property="fb:app_id" content="1152657561422465" />
    <?php include_once("includes/taghead.php") ?>
  </head>
  <body>
  <?php include_once("includes/tagbody.php") ?>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>

    	<div class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav2.php");?>
            
            <div class="bann-txt-container inner">
            	<div class="container">
                    
                </div>
            </div>
            <div class="pura-slider">
            	<img src="images/banner/travel-testimonial.jpg" alt="Pura Stays Travel Testimonials">
            </div>
        </div>
    </header>
    
    <section class="sec exp">
    	<div class="container">
        	<h1 class="head1">Travel Tales</h1>
            <div class="sec-container2">
            	<p></p>              
            </div>
        </div>
    </section> 
    
    <section class="sec exp">
    	<div class="container">
            <div class="sec-container2">
            	<?php
                    $qry = "select * from testimonials where ";
                        if ($Default_Id!="") {$qry .= "(find_in_set ('".$Default_Id."', `Tags`) > 0 || find_in_set (' ".$Default_Id."', `Tags`) > 0) && ";}
                        $qry .= "Status = 1 && Description != '' order by Id ASC limit 8";
                    $result = $db->_query($qry);
                    $i=0;
                    $row2 = array();
                    while($row = mysqli_fetch_array($result))
                    {

                        $i++;
                        ?>
                         <div class="exp-block">
                            <div class="img-bg-cont"><img src="<?= $row['Banner_Image']; ?>" alt="Pura Stays experience"></div>                    
                            <div class="exp-container">
                                <?php
                                    if($i%2!=0)
                                    {
                                        echo '<div class="col-sm-6"></div>';        
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <div class="exp-act-block">                             
                                        <div class="exp-act-title"><h4><?= $row['Title']; ?></h4></div>
                                        <div class="exp-act-pics clearfix">
                                            <div class="col-sm-6 usr1">
                                                <div class="pic">
                                                    <img src="<?= $row['User_Image']?>" alt="<?= $row['User_Name']?>">
                                                </div>
                                                <p class="name"><?= $row['User_Name']?></p>
                                            </div>
                                            <div class="col-sm-6 usr2">
                                                <div class="pic">
                                                    <img src="<?= $row['Testimonial_For_Image']?>" alt="<?= $row['Testimonial_For_Name']?>">
                                                </div>
                                                <p class="name"><?= $row['Testimonial_For_Name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="exp-txt">
                                            <p><?= $row['Summary']?></p>
                                        </div>
                                        <div class="btn-blk">
                                            <?php
                                                $url = "http://www.purastays.com/stories/story-details.php?stroy=".$row['Id'];
                                                $url = $arr_url[$url];
                                            ?>
                                            <a href="<?= $url; ?>" class="btn btn-pura2">Read More</a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                   
                <div class="btn-sec">
                	<a href="travel-tales" class="btn btn-lg btn-pura">Read More</a>
                </div>             
            </div>
        </div>
    </section>    
    
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>

     
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {
        	$('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});    
        });    	
    </script>
    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>
  </body>
</html>
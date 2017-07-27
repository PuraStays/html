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
    <link rel="stylesheet" media="screen and (min-width: 45em)" href="/css/widescreen.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<section class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav.php");?>
            
            <?php
                $Id = $_REQUEST['stroy'];
                $qry = "select t.*, r.gallery_id from testimonials as t, resorts as r where t.resort_id = r.Id && t.Id = $Id";
                $row = mysqli_fetch_array($db->_query($qry));
            ?>

            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1><?= $row['Banner_Title']; ?></h1>
                    <p><?= $row['Banner_Description']; ?></p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="<?= $row['Banner_Image']; ?>" alt="<?= $row['Banner_Title']; ?>">
            </div>
        </section>
    </header>    
    
    <section class="sec exp">
    	<div class="container">
            <div class="sec-container3">
            	 <div class="intro-bx">
                 	<div class="intro-bx-inner">
                        <div class="exp-act-pics clearfix">
                            <div class="col-sm-6">
                                <div class="pic">
                                    <img src="<?= $row['User_Image']; ?>" alt="user">
                                </div>
                                <p class="name"><?= $row['User_Name']; ?></p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pic">
                                    <img src="<?= $row['Testimonial_For_Image']; ?>" alt="user">
                                </div>
                                <p class="name"><?= $row['Testimonial_For_Name']; ?></p>
                            </div>
                        </div>    
                    </div>
                 </div>             
                 <div class="intro-remain">
                 	<div class="intro-remain-inner">
                    	<h3><?= $row['Title']; ?></h3>
                        <div class="quote">
                        	<?= $row['Summary']; ?>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="remain-stry">
            	<p><?= $row['Description']; ?></p>
                
                <div class="gallery-blk clearfix">
                	<?php
                        $resort = $row['resort_id'];
                        $qry1 = "select r.Id, i.Image, i.Title, i.Alt, i.Meta, i.Description from resorts as r INNER JOIN images as i ON (r.gallery_id REGEXP CONCAT(' ?', i.Id)) where r.Id = $resort  limit 3";
                        $result1 = $db->_query($qry1);
                        while($row1 = mysqli_fetch_array($result1))
                        {
                            ?>
                            <div class="col-sm-4">
                                <div class="gall-img"><img src="<?= $row1['Image']; ?>" alt="<?= $row1['Alt']; ?>"></div>
                            </div>        
                            <?php
                        }
                    ?>
                </div>
                
                    <?php
                    /*
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> 
                    */
                    ?>
            </div>
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

    

    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
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
  </body>
</html>
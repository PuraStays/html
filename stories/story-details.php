<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include("../includes/db.inc.php");
//        ini_set('display_errors', '1');

        $db = new DB();
        $Id = $_REQUEST['stroy'];
        $qry = "select t.*, t.gallery_id from testimonials as t, resorts as r where t.resort_id = r.Id && t.Id = $Id";
        $row_story = mysqli_fetch_array($db->_query($qry));
    header('Content-type: text/html; charset=utf-8');
    ?>
    <title><?= $row_story['Meta_Title']; ?></title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="description" content="<?= $row_story['Meta_Description']; ?>">
    <meta name="keywords" content="<?= $row_story['Meta_Keyword']; ?>">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap-social.css">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/jquery.bxslider.css" rel="stylesheet">

    <script src="../bower_components/jquery/dist/jquery.min.js"></script> 

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="<?= $row_story['Meta_Title']; ?>">
    <meta name="twitter:description" content="<?= $row_story['Meta_Description']; ?>">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="<?= $row_story['Banner_Image']; ?>">
    <meta name="twitter:url" content="<?= $actual_link;?>">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="<?= $row_story['Meta_Title']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= $actual_link;?>" />
    <meta property="og:image" content="<?= $row_story['Banner_Image']; ?>" />
    <meta property="og:description" content="<?= $row_story['Meta_Description']; ?>" />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255" />
    <meta property="fb:app_id" content="1152657561422465" />
    <?php include_once("../includes/taghead.php") ?>
  </head>
  <body>
    <?php include_once("../includes/tagbody.php") ?>
    <header>
        <!-- Login Modal -->
        <?php require_once("../src/Facebook/autoload.php"); ?>
        <?php include_once("../includes/login-modal.php");?>
    	<section class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php  include_once("../includes/nav2.php");?>
            

            <div class="bann-txt-container inner">
            	<div class="container">
                    <!--<h1><?= $row_story['Banner_Title']; ?></h1>-->
                    <p><?= $row_story['Banner_Description']; ?></p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="<?= $row_story['Banner_Image']; ?>" alt="<?= $row_story['Banner_Title']; ?>">
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
                                    <img src="<?= $row_story['User_Image']; ?>" alt="user">
                                </div>
                                <p class="name"><?= $row_story['User_Name']; ?></p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pic">
                                    <img src="<?= $row_story['Testimonial_For_Image']; ?>" alt="user">
                                </div>
                                <p class="name"><?= $row_story['Testimonial_For_Name']; ?></p>
                            </div>
                        </div>    
                    </div>
                 </div>             
                 <div class="intro-remain">
                 	<div class="intro-remain-inner">
                    	<h1><?= $row_story['Title']; ?></h1>
                        <div class="quote">
                        	<?= $row_story['Summary']; ?>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="remain-stry">
            	<p><?= $row_story['Description']; ?></p>
                
                
                	<?php
                        $gallery = $row_story['gallery_id'];
                        $arr1 = explode(', ', $gallery);
                        if($gallery!='')
                        {
                        ?><div class="gallery-blk clearfix"><?php
                        foreach ($arr1 as $key => $value) {
                            ?>
                            <div class="col-sm-4">
                                	<div class="gall-img"><img src="<?= $value;?>" alt="<?= $value;?>"></div>
                            </div>
                            <?php
                        }
                        
                    }
                    ?>
                </div>
          
            </div>
        </div>
    </section> 
    
    <?php include_once("../includes/social-sec.php");?>
    
    <?php include_once("../includes/footer.php");?>

          
    <script src="../libs/jquery.bxslider.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../libs/jquery.validate.min.js"></script>
    <script src="../js/common.js"></script>
    <script>
		$(document).ready(function() {
        	$('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});    
        });    	
    </script>
  </body>
</html>

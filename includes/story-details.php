<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 45em)" href="/css/widescreen.css">
    
  </head>
  <body>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<div class="pura-banner-inner">
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
        </div>
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
                    ?>
            </div>
        </div>
    </section> 
    
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>

    

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
<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel experiences, Holiday homes, Nature resorts in India</title>
    <meta name="description" content="Discover unique weekend getaways, amazing holiday packages at Pura Stays collection of Holiday stays and resorts. Add local experiences per your travel mood.">
    <meta name="keywords" content="travel experiences in india, holiday homes in india, nature resorts in india">
    <link rel="shortcut icon" href="../images/favicon.ico">
    
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="libs/lightslider-master/dist/css/lightslider.min.css" rel="stylesheet">

    <script src="bower_components/jquery/dist/jquery.min.js"></script> 
    <script type="text/javascript" src="libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="Travel experiences, Holiday homes, Nature resorts in India">
    <meta name="twitter:description" content="Discover unique weekend getaways, amazing holiday packages at Pura Stays collection of Holiday stays and resorts. Add local experiences per your travel mood.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/pura-stays-insight">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Travel experiences, Holiday homes, Nature resorts in India" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/pura-stays-insight" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Discover unique weekend getaways, amazing holiday packages at Pura Stays collection of Holiday stays and resorts. Add local experiences per your travel mood." />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255" />
    <meta property="fb:app_id" content="1152657561422465" />

    <script>
        $(document).ready(function() {
            
            $("a.page-scroll").click(function() {
                var targetDiv = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(targetDiv).offset().top 
                }, 2500, 'easeOutCubic');
            });  
            
            var stickyScrollBtn = $('.sec-resort .tab-container').offset().top+100;
            var stickyNav = function(){
                var scrollTop = $(window).scrollTop();  
                 if($( window ).width()>640){     
                    if (scrollTop > stickyScrollBtn) {                         
                        $('.floatingLnk').fadeIn(500);
                    } else {
                        $('.floatingLnk').fadeOut(500);                        
                    }
                }else{
                    $('.floatingLnk').show();
                }    
            };           
            
            $('.floatingLnk ul li a').on('click', function(e){
               $('.floatingLnk ul li a').removeClass('active');
               $(this).addClass('active'); 
            })
            var currentTabSelected;
            $('.sec-resort .nav-tabs li').each(function(i){
                var _this = this;
                $(this).find('a').on('click', function(){
                    currentTabSelected = $(_this).index();
                    $(".floatingLnk ul li a").removeClass('active');
                    $(".floatingLnk ul li a.fl"+currentTabSelected).addClass('active');
                })
            })

             
            $(window).scroll(function() {
                stickyNav();
            });
            stickyNav();

            $(window).resize(function(){
                stickyNav();                
            })
        });     
    </script>
	 <style>
        ul{list-style: none outside none; padding-left: 0; margin: 0;}
        .demo .item{margin-bottom: 60px;}
        .content-slider li{background-color: #ed3020; text-align: center; color: #FFF;}
        .content-slider h3 {margin: 0; padding: 70px 0;}
        .demo{width: 800px;}
    </style>

      <?php include_once("includes/taghead.php") ?>
  </head>
  <body>
  <?php include_once("includes/tagbody.php") ?>  
    <header>
       
        <?php include_once("includes/login-modal.php");?>
    	<div class="pura-banner-inner" id="home">
        	
            <?php 
                include_once("includes/nav.php");
                $db = new DB();
                $qry = "select * from explorepuras where Id = '1'";
                $row = $db->_query($qry)->fetch_assoc();
            ?>
             
            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1><?= $row['Banner_Title']; ?></h1>
                    <p><?= $row['Banner_Description']; ?></p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="<?= $row['Banner_Image']; ?>" alt="pura resort">
            </div>
        </div>
    </header>
    
    <div class="sec-resort concept">
    	<a href="#home" class="closeblk page-scroll"></a>
    	<div class="container">
            <div class="tab-container">
            	<div class="row">
                	<ul class="nav nav-tabs">
                    	<li class="active"><a href="#stay" data-toggle="tab"><img src="images/features-icons/WANDER.png" alt="icon"><div class="title"><?= $row['Stay_Title']; ?></div></a></li>
                        <li><a href="#cafe" data-toggle="tab"><img src="images/features-icons/STAY.png" alt="cafe"><div class="title"><?= $row['Cafe_Title']; ?></div></a></li>
                        <li><a href="#exp" data-toggle="tab"><img src="images/features-icons/Taste-icon.png" alt="exp"><div class="title"><?= $row['Experiences_Title']; ?></div></a></li>
                        <li><a href="#op" data-toggle="tab"><img src="images/features-icons/Experience-Icon.png" alt="operation"><div class="title"><?= $row['Operations_Title']; ?></div></a></li>
                    </ul>                   
                </div>
                <div class="tab-content">
                	<div class="tab-pane fade in active" id="stay">
                        <div class="btn-sec">
                            <a href="#section1" class="btn btn-pura btn-blk page-scroll">Click to <?= $row['Stay_Title']; ?></a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Stay_Feature1']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Stay_Feature2']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Stay_Feature3']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Stay_Feature4']; ?>
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="cafe">
                        <div class="btn-sec">
                            <a href="#section2" class="btn btn-pura btn-blk page-scroll">Click to <?= $row['Cafe_Title']; ?></a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Cafe_Feature1']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Cafe_Feature2']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Cafe_Feature3']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Cafe_Feature4']; ?>
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="exp">
                        <div class="btn-sec">
                            <a href="#section3" class="btn btn-pura btn-blk page-scroll">Click to <?= $row['Experiences_Title']; ?></a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	 <?= $row['Experiences_Feature1']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Experiences_Feature2']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Experiences_Feature3']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Experiences_Feature4']; ?>
                        </div>
                    </div>
                </div>
                	</div>
                    
                    <div class="tab-pane fade in" id="op">
                        <div class="btn-sec">
                            <a href="#section4" class="btn btn-pura btn-blk page-scroll">Click to <?= $row['Operations_Title']; ?></a>
                        </div>
                        <div class="row txt-grp">
                	<div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Operations_Feature1']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Operations_Feature2']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Operations_Feature3']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="txt-blk">
                        	<?= $row['Operations_Feature4']; ?>
                        </div>
                    </div>
                </div>
                	</div>
                </div>                
            </div>            
        </div>
    </div>   

     <section class="sec package" id="section1">
        <div class="container">
            <h2><?= $row['Stay_Title']; ?></h2>
        </div>    
        <div class="two-block">         
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt no-trans">
                        <div class="actual-txt">
                            <?= $row['Stay_Description']?> 
                        </div>    
                    </div>
                    <div class="img-cntr">
                        
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                        
                        <?php
                            ini_set("display_errors", 1);
                            $Stay_Gallery =  explode(", ", $row['Stay_Gallery']);
                          
                            foreach ($Stay_Gallery as  $value) {
                                
                                if($value!="")
                                {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="puraimages"/>
                                </li>
                                <?php
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>                
    </section>

     <section class="sec package" id="section2">
        <div class="container">
            <h2><?= $row['Cafe_Title']; ?></h2>
        </div>    
        <div class="two-block slider-left">         
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt no-trans">
                        <div class="actual-txt">
                            <?= $row['Cafe_Description']?>
                          
                        </div>    
                    </div>
                    <div class="img-cntr">
                        
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery2" class="gallery list-unstyled cS-hidden">
                        
                        <?php
                            $Cafe_Gallery =  explode(", ", $row['Cafe_Gallery']);
                            foreach ($Cafe_Gallery as  $value) {
                                
                                if($value!="")
                                {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="img"/>
                                </li>
                                <?php
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>                
    </section>

     
     <section class="sec package" id="section3">
        <div class="container">
            <h2><?= $row['Experiences_Title']; ?></h2>
        </div>    
        <div class="two-block">         
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt no-trans">
                        <div class="actual-txt">
                            <?= $row['Experiences_Description']?>
                      
                        </div>    
                    </div>
                    <div class="img-cntr">
                        
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery3" class="gallery list-unstyled cS-hidden">
                        
                        <?php
                            $Experiences_Gallery =  explode(", ", $row['Experiences_Gallery']);
                            foreach ($Experiences_Gallery as  $value) {
                                
                                if($value!="")
                                {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="Pura Stays"/>
                                </li>
                                <?php
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>                
    </section>


     <section class="sec package" id="section4">
        <div class="container">
            <h2><?= $row['Operations_Title']; ?></h2>
        </div>    
        <div class="two-block slider-left">         
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt no-trans">
                        <div class="actual-txt">
                            <?= $row['Operations_Description']?>
                        
                        </div>    
                    </div>
                    <div class="img-cntr">
                        
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery4" class="gallery list-unstyled cS-hidden">
                        
                        <?php
                            $Operations_Gallery =  explode(", ", $row['Operations_Gallery']);
                            foreach ($Operations_Gallery as  $value) {
                                
                                if($value!="")
                                {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="images"/>
                                </li>
                                <?php
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>                
    </section>
    
    
    <?php include_once("includes/social-sec.php");?>
    <?php include_once("includes/footer.php");?>
   
    <div class="floatingLnk">
        <div class="inn">
            <ul>
                <li><a href="#section1" class="page-scroll fl0"><img src="images/features-icons/WANDER.png" alt="Pura Stays"></a></li>
                <li><a href="#section2" class="page-scroll fl1"><img src="images/features-icons/STAY.png" alt="Pura Stays"></a></li>
                <li><a href="#section3" class="page-scroll fl2"><img src="images/features-icons/Taste-icon.png" alt="Pura Stays"></a></li>
                <li><a href="#section4" class="page-scroll fl3"><img src="images/features-icons/Experience-Icon.png" alt="Pura Stays"></a></li>
            </ul>
        </div>   
    </div>
   

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
                $(this).find(".img-cntr img").height(hgt+300);
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
                speed:1510,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
            $('#image-gallery2').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1520,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery2').removeClass('cS-hidden');
                }  
            });
            $('#image-gallery3').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1530,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery3').removeClass('cS-hidden');
                }  
            });
            $('#image-gallery4').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1540,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery4').removeClass('cS-hidden');
                }  
            });
        });
    </script>  
    
    <script type="text/javascript" src="libs/lightslider-master/dist/js/lightslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>

    <script src="js/common.js"></script>    
	<link href="css/elements.css" rel="stylesheet">
	
	

    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>
  </body>
  
</html>
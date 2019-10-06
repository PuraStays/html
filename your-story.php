<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share stories about your Experiences and joyful stay at our best resort now near Delhi, Nainital, Jaipur, Sariska and Ramgarh Shekhawat | Pura Stays</title>
    <meta name="description" content="Share your travel story with Pura Stays and let your travel experience be an inspiration for travel lovers.">
    <meta name="keywords" content=""> 

    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">

    <script src="bower_components/jquery/dist/jquery.min.js"></script> 

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="Share Your Travel Photos and Experiences | PuraStays.com">
    <meta name="twitter:description" content="Share your travel story and let your travel experience be an inspiration for travel lovers. Explore India's first travel mood collection of holiday stays.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/post-your-story">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Share Your Travel Photos and Experiences | PuraStays.com" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/post-your-story" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Share your travel story and let your travel experience be an inspiration for travel lovers. Explore India's first travel mood collection of holiday stays." />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255" />
    <meta property="fb:app_id" content="1152657561422465" />
    <?php include_once("includes/taghead.php") ?>
  </head>
  <body>
  <?php include_once("includes/tagbody.php") ?>
    <div class="overlay"><img src="images/loading.gif" alt="Pura Stays" width="120px" height="10px"></div>
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
                <img src="images/banner/your-story.jpg" alt="Pura Stays your stories">
            </div>
        </div>
    </header>    
    
    <section class="sec contact">
    	<div class="container">
            <div id="general" class="other-form">
                <h1 class="head1">Post Your Story / Review</h1>
                <form id="generalForm">
                    <div class="alert alert-success"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label>First name</label>
                                <input type="text" name="FirstName" placeholder="First Name" class="form-control" required="required" />
                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset class="form-group">
                                <label>Last name</label>
                                <input type="text" name="LastName" placeholder="Last Name" class="form-control" required="required" />
                            </fieldset>
                        </div>    
                    </div>
                    <fieldset class="form-group">
                        <label>Email Id</label>
                        <input type="email" name="Email" placeholder="Email Id" class="form-control" required="required" />
                    </fieldset>                    
                    <fieldset class="form-group">
                        <label>Story / Review</label>
                        <textarea rows="5" name="Address" placeholder="Story / Review" class="form-control"></textarea>
                    </fieldset>
                    <fieldset class="form-group">
                        <input type="submit" name="submit" id="general_btn" value="Submit"  class="btn btn-pura">
                    </fieldset>
                </form>
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
     $("#generalForm .alert.alert-success").fadeOut(0);    
	 
     $("#general_btn").on("click", function(e){
       if($("#generalForm").valid())
         {
            $('.overlay').fadeIn(500);
            var form = $("#generalForm");
             $.ajax({
                contentType: "application/json; charset=utf-8",
                type: "POST",
                dataType: 'json',
                data: JSON.stringify(form.serializeArray()),
                crossDomain: true,
                url: 'http://api.purastays.com/contactus/your-stroy',
                success: function(msg){
                    $('.overlay').fadeOut(500);
                    $("#general .alert.alert-success").fadeIn(300);    
                    $("#general .alert.alert-success").text(msg.message);
                    $('#generalForm')[0].reset();
                },error: function(res){
                    console.log(res);
                    alert('ajax post failed');  
                }
             });
             return false;
         } 
    });
  	
    </script>
    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>
  </body>
</html>

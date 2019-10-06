<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Now you can list your Property at Pura Stays for your Business Growth  | Pura Stays near delhi and Nainital</title>
    <meta name="description" content="Share your property details with Pura Stays - India's first travel mood based holiday stays around Uttarakhand, Delhi">
    <meta name="keywords" content="">
    
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">

    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="Be a part of our exclusive collection of holiday stays">
    <meta name="twitter:description" content="Share your property details with Pura Stays - India's first travel mood based holiday stays. Reach us at  +91 90 1551 1551 or email us at info@purastays.com">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/post-your-property">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Be a part of our exclusive collection of holiday stays" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/post-your-property" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Share your property details with Pura Stays - India's first travel mood based holiday stays. Reach us at  +91 90 1551 1551 or email us at info@purastays.com" />
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
                <img src="images/banner/post-your-property.jpg" alt="Pura Stays Post your property">
            </div>
        </div>
    </header>    
    
    <section class="sec contact">
    	<div class="type clearfix">
            <div class="container">
                <div class="other-form">
                    <h1 class="head1">Post Your Property</h1>
                    <form  id="generalForm">
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
                            <label>Phone</label>
                            <input type="number" name="mobile" placeholder="Phone" class="form-control" required="required" />
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Property Name (if any)</label>
                            <input type="text" name="Prop_Name" placeholder="Property Name" class="form-control" />
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Property website (if any)</label>
                            <input type="text" name="Prop_Website" placeholder="Property website" class="form-control" />
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Number of rooms</label>
                            <input type="number" name="Rooms" placeholder="Number of rooms" class="form-control"/>
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Address</label>
                            <textarea rows="5" name="Address" placeholder="Address" class="form-control"></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="button" id="general_btn" value="Submit" class="btn btn-pura">
                        </fieldset>
                    </form>
                </div>                                    
            </div>
        </div>                   
    </section>
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
    
    <?php include_once("includes/social-sec.php");?>
    <?php include_once("includes/footer.php");?>
    
    <script>
        $("#generalForm .alert.alert-success").fadeOut(0);    
        $(document).ready(function() {
            $('.slider1').bxSlider({
              pagerCustom: '#bx-pager', controls: false
            });  
            $("#general_btn").on("click",function(){
               $('.overlay').fadeIn(500);
                var form=$("#generalForm");
                console.log(form.serialize());
                 $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: form.serialize(),
                    crossDomain: true,
                    url: 'http://api.purastays.com/contactus/post-your-property',
                    success: function(msg){
                        $('#generalForm')[0].reset();       
                        console.log(msg);
                        console.log(msg.message);
                        $('.overlay').fadeOut(500);
                        $("#generalForm .alert.alert-success").fadeIn(0);    
                        $("#generalForm .alert.alert-success").text(msg.message);
                                    
                    },error: function(res){
                        alert('ajax post failed');  
                    }
                 }); 
            })
            
        });  
    </script>
    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>
  </body>
</html>

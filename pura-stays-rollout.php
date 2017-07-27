<?php header('Content-type: text/html; charset=utf-8');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get associated to promote your property | Pura Stays</title>
    <meta name="description" content="All ardent property owners are invited to have a central management system via Pura Stays - a travel mood based portal. Make property known to travellers.">
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
    <meta name="twitter:title" content="Get associated to promote your property | Pura Stays">
    <meta name="twitter:description" content="All ardent property owners are invited to have a central management system via Pura Stays - a travel mood based portal. Make property known to travellers.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/pura-stays-rollout">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Get associated to promote your property | Pura Stays" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/pura-stays-rollout" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="All ardent property owners are invited to have a central management system via Pura Stays - a travel mood based portal. Make property known to travellers." />
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
                <img src="images/banner/pura-rollout.jpg" alt="Pura Rollout">
            </div>
        </div>
    </header>    
    
    <section class="sec contact">
    	<div class="container">
        	<h1 class="head1">Pura Stays Rollout</h1>
        </div>    
        <div class="type clearfix">
        	<div class="container">
                <div class="policy-sec">

                    <p>Structured in 2016, Pura Stays started roll out of its concept to provide experience led accommodation for leisure travel. Given the rising weekend culture and the
need for quality holiday accommodation for quick getaways, Pura Stays curates a
selection of holiday stays around a leisure travel destination or a cluster as we call
it, with ‘Around Nainital’ being the first cluster to be rolled out. The handpicked
collection comprises of thoughtfully designed living spaces like boutique resorts,
holiday homes, lodges and villas with standardised guest room features and
reliable service quality.</p>

                    <p>Pura Stays doorway is for small inventory holiday stays having less than 30
accommodation units, thus differentiating form large resorts and hotels, for a
unique stay experience. Focussed at improving the guest satisfaction levels, it
provides a centrally managed marketing system and a cluster level operating
system for its collection of holiday stays.
Pura Stays is here for passionate travellers who want to explore, connect and
revive in their own style, who look forward to make their own travel itinerary from
discovering quick getaways with quality holiday accommodation to experiencing
local activities and tempting food. The search for a refreshing holiday break, is
further simplified as travellers and customers of all kinds can select their stays as
per some well recognised moods to travel.</p>

                    <p>Furthermore, local experience sets and enriched menu to savour upon were
introduced at each property, to accompany the guests at every step. From
breakfast to All-Day Snacks Menu, from Celebration Dinner to Nature trails and
Local Adventure Sport; there is plenty to choose from, for a memorable holiday.
Forced package? No, you won’t find that here on this website. Pick and pay for
what you actually want on a holiday and that’s how, we are different from each
holiday stay, out there!</p>

                    <p>Our <u>cluster wise roll out</u> ensures greater choice of holiday accommodation across
midscale, upscale and luxury properties. Our aim is to grow tremendously across
India and offer a greater choice of getaways to fervent globe trotters. An
experience led holiday matters and will always be our priority.</p>

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
            $("#general_btn").on("click",function(){
                var form=$("#generalForm");
                console.log(form.serialize());
                 $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: form.serialize(),
                    crossDomain: true,
                    url: 'localhost/purastays.com/api/contactus/general',
                    success: function(msg){       
                        if(msg.registered_user == 0){
                            
                        }else{
                            regUser(JSON.stringify(msg));
                        }
                                        
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

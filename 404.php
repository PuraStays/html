<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page not found | 404</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">

    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="<Page not found | 404">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Page not found | 404" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="" />
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="1125962897414339" />
    <meta property="fb:app_id" content="1152657561422465" />
    
    <?php include_once("includes/taghead.php") ?>
  </head>
  <body>
  <?php include_once("includes/tagbody.php") ?>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
        <section class="pura-banner-inner">
            <div class="top-shadow"></div>
            
            <?php include_once("includes/nav2.php");?>
            
            <div class="bann-txt-container">
                <div class="container">
                    <h1>Oops!</h1>
                    <h3>Looks like you're lost...</h3>
                </div>
            </div>
            <div class="pura-slider">
                <img src="images/banner/Error404.jpg" alt="404 Page not found">
            </div>
        </section>
    </header>    
    
    <section class="sec contact">
        <div class="container">
            <div class="other-form">
                <h1 class="head1">Follow the links below or <a href="http://purastays.com"> GO BACK HOME >> </a></h1>
                <div class="sitemap">
                    <ul>
                        <li><a href="index.php">Home</a>
                        <ul>
                            <li><a href="about-pura-stays">About Pura Stays</a></li>
                            <li><a href="http://purastays.com/booking/">Book a Stay</a></li>
                            <li><a href="pura-stays-insight.php">Insight</a></li>
                            <li>Holiday Stays
                               <ul>                                 
                                    <?php
                                        $db = new DB();
                                        $qry_f = "select Id, Resort_Name from resorts where Status = 1 order by Id DESC";
                                        $result_f = $db->_query($qry_f);
                                        while($row_f = mysqli_fetch_array($result_f))
                                        {
                                            $url = 'http://www.purastays.com/resorts/resort.php?id='.$row_f['Id'];
                                            $url = $arr_url[$url];
                                            ?>
                                                <li><a href="<?= $url; ?>" title="<?= $row_f['Resort_Name']; ?>"><?= $row_f['Resort_Name'] ;?></a></li>
                                            <?php        
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="http://blog.purastays.com">Blog</a></li>
                            <li><a href="http://purastays.com/travel-tips">Travel Tips</a></li>
                            <li><a href="http://purastays.com/help-faqs">Help/FAQs</a></li>
                            <li><a href="http://purastays.com/pura-stays-rollout">Pura Stays Rollout</a></li>
                            <li><a href="http://purastays.com/contact-us">Contact Us</a></li>
                            <li><a href="http://purastays.com/travel-tales">Travel Tales</a></li>
                            <li><a href="http://purastays.com/your-story">Post Your Story / Review</a></li>
                            <li><a href="http://purastays.com/post-your-property">Post Your Property</a></li>
                            <li><a href="http://purastays.com/guest-policy">Guest Policy</a></li>
                            <li><a href="http://purastays.com/terms-conditions">Terms & Conditions</a></li>
                        </ul>
                        </li>
                    </ul>
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

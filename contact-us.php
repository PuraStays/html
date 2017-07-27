<?php header('Content-type: text/html; charset=utf-8');
    function convert_email($email) {
    $pieces = str_split(trim($email));
    $new_mail = '';
    foreach ($pieces as $val) {
    $new_mail .= '&#'.ord($val).';';
    }
    return $new_mail;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get all inclusive travel deals on a holiday stay collection</title>
    <meta name="description" content="Looking for all inclusive travel deals for special occasion? PuraStays customized package includes exclusive stay with meals and experiences on best price.">
    <meta name="keywords" content="">
    
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link href="libs/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet" />

        <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@purastays">
    <meta name="twitter:title" content="Get all inclusive travel deals on a holiday stay collection">
    <meta name="twitter:description" content="Looking for all inclusive travel deals for special occasion? PuraStays customized package includes exclusive stay with meals and experiences on best price.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/contact-us">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Get all inclusive travel deals on a holiday stay collection" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/contact-us" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Looking for all inclusive travel deals for special occasion? PuraStays customized package includes exclusive stay with meals and experiences on best price." />
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
            	<img src="images/banner/contact-us.jpg" alt="Pura Stays contact">
            </div>
        </div>
    </header>    

    <section class="sec contact">
    	<div class="container">
        	<h1 class="head1">Contact Us</h1>
        </div>    
        <div class="type clearfix">
        	<div class="container">
                <ul class="type-container nav nav-tabs">
                    <li class="blk active"><a data-toggle="tab" href="#general">General</a></li>
                    <li class="blk"><a data-toggle="tab" href="#group">Group Booking</a></li>
                    <li class="blk"><a data-toggle="tab" href="#join">Join Our Team</a></li>
                    <li class="blk"><a data-toggle="tab" href="#rollout">Reach Us</a></li>
                </ul>            
            
                <div class="tab-content tab-section">

                   <div id="general" class="tab-pane fade in active">
                        <h3>Any Questions?</h3>
                        <form id="generalForm">
                            <div class="alert alert-success"></div>
                            <fieldset class="form-group">
                                <label>First name</label>
                                <input type="text" name="FirstName" placeholder="First Name" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Last name</label>
                                <input type="text" name="LastName" placeholder="Last Name" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Email Id</label>
                                <input type="email" name="Email" placeholder="Email Id" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Query</label>
                                <textarea rows="5" name="Query" placeholder="Query" class="form-control"></textarea>
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="button" id="general_btn" value="Send" class="btn btn-pura">
                            </fieldset>
                        </form>
                      </div>
                      
                   <div id="group" class="tab-pane fade">
                        <h3>Pura Stays for Group</h3>
                        <form  id="groupForm">
                            <div class="alert alert-success"></div>
                            <fieldset class="form-group">
                                <label>First name</label>
                                <input type="text" name="FirstName" placeholder="First Name" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Last name</label>
                                <input type="text" name="LastName" placeholder="Last Name" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Email Id</label>
                                <input type="email" name="EmailId" placeholder="Email Id" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="CompanyName" placeholder="Company Name" class="form-control" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Company Location</label>
                                <input type="text" name="CompanyLocation" placeholder="Company Location" class="form-control" />
                            </fieldset>                                        
                            <fieldset class="form-group">
                                <label>Phone</label>
                                <input type="text" name="Phone" placeholder="Phone" class="form-control" required="required" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label>How many rooms do you need?</label>
                                <input type="number" class="form-control">
                            </fieldset>
                            <div class="row">
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <label>From</label>
                                        <input type="text" id="datepicker1" name="start" placeholder="Start Date" class="form-control" />
                                    </fieldset>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <label>To</label>
                                        <input type="text" id="datepicker2" name="to" placeholder="End Date" class="form-control"/>
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <label>Notes</label>
                                <textarea rows="5" name="Notes" placeholder="Notes" class="form-control" ></textarea>
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="button" id="group_btn" value="Send" class="btn btn-pura">
                            </fieldset>
                        </form>
                        <p>Alternatively, you may contact us at <a href="mailto:<?php echo convert_email('info@purastays.com'); ?>"> <?php echo convert_email('info@purastays.com'); ?></a> or call us at <span><a href="tel:+919015511551">+91 90 1551 1551</a></span> anytime between 10am to 6pm for further information.</p>
                                            
                      </div>
                      
                   <div id="join" class="tab-pane fade">
                        <h3>Join Our Team</h3>
                        <p>To be a part of our team, please send your application at <a href="mailto:<?php echo convert_email('info@purastays.com'); ?>"> <?php echo convert_email('info@purastays.com'); ?></a>. We will connect with you.</p>
                      </div>
                      
                   <div id="rollout" class="tab-pane fade">
                        <h3>Reach Us</h3>
                        <p>For further information and clarifications, please email us at <a href="mailto:<?php echo convert_email('info@purastays.com'); ?>"> <?php echo convert_email('info@purastays.com'); ?></a> or call us at <span><a href="tel:+919015511551">+91 90 1551 1551</a></span> anytime between 10am to 6pm.</p>
                      </div>           
                </div>
            </div>
        </div>        
    </section>
    

    <?php include_once("includes/social-sec.php");?>


    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script type="text/javascript" src="libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>

    <script src="js/common.js"></script>
        
    <?php include_once("includes/footer.php");?>
    

    <script>
		$(document).ready(function() {
            $( "#datepicker1" ).datepicker({
                minDate: 0,
                onSelect: function(selected) {
                  $("#datepicker2").datepicker("option","minDate", selected)
                }

            });
            $( "#datepicker2" ).datepicker({
                minDate: 0, 
                onSelect: function(selected) {                   
                  $("#datepicker1").datepicker("option","maxDate", selected)
                }
            });

        	$('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});  

            //upload general form
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
                                url: 'http://api.purastays.com/contactus/general',
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

                   //upload group
                    $("#groupForm .alert.alert-success").fadeOut(0);    
                    $(document).ready(function() {
                        $('.slider1').bxSlider({
                          pagerCustom: '#bx-pager', controls: false
                        });  
                        $("#group_btn").on("click",function(){
                           $('.overlay').fadeIn(500);
                            var form=$("#groupForm");
                            console.log(form.serialize());
                             $.ajax({
                                contentType: "application/json; charset=utf-8",
                                type: "POST",
                                dataType: 'json',
                                data: form.serialize(),
                                crossDomain: true,
                                url: 'http://api.purastays.com/contactus/group',
                                success: function(msg){
                                    $('#groupForm')[0].reset();       
                                    console.log(msg);
                                    console.log(msg.message);
                                    $('.overlay').fadeOut(500);
                                    $("#groupForm .alert.alert-success").fadeIn(0);    
                                    $("#groupForm .alert.alert-success").text(msg.message);
                                                
                                },error: function(res){
                                    alert('ajax post failed');  
                                }
                             }); 
                        })
                        
                    });  


        });  
        
    </script>
    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>
  </body>
</html>

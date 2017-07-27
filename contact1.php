<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
  <div class="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<section class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav.php");?>
            
            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1>Sample banner txt</h1>
                    <p>aslf asdfj adlsfj adslkfjasff fsd sdf sfsa</p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="images/contact-us.jpg" alt="pura contact">
            </div>
        </section>
    </header>    
    
    <section class="sec contact">
    	<div class="container">
        	<h2>Contact Us</h2>
        </div>    
        <div class="type clearfix">
        	<div class="container">
                <ul class="type-container nav nav-tabs">
                    <li class="blk active"><a data-toggle="tab" href="#general">General</a></li>
                    <li class="blk"><a data-toggle="tab" href="#group">Group Booking</a></li>
                    <li class="blk"><a data-toggle="tab" href="#join">Join Our Team</a></li>
                    <li class="blk"><a data-toggle="tab" href="#rollout">Pura rollout</a></li>
                </ul>            
            
                <div class="tab-content tab-section">

                   <div id="general" class="tab-pane fade in active">
                        <h3>Any Questions?</h3>
                        <form role="form" id="generalForm">
                            <div class="alert alert-success"></div>
                            <fieldset class="form-group">
                                <label><span class="badge badge-success">1</span> What's your name?</label>
                                <input type="text" name="name" placeholder="Your name" class="form-control"/>
                            </fieldset>
                            <fieldset class="form-group">
                                <label><span class="badge badge-success">2</span> What's Email Id?</label>
                                <input type="email" name="email" placeholder="Your email id" class="form-control"/>
                            </fieldset>
                            <fieldset class="form-group">
                                <label><span class="badge badge-success">3</span> Your Query</label>
                                <textarea rows="5" name="query" placeholder="Your name" class="form-control" ></textarea>
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="button" id="general_btn" value="send query" class="btn btn-pura">
                            </fieldset>
                        </form>
                      </div>
                      
                   <div id="group" class="tab-pane fade">
                        <h3>Pura for Corporate</h3>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Corporate Rates</a>
                                </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                	<form role="form" id="groupForm">
                                        <div class="alert alert-success"></div>
                                        <fieldset class="form-group">
                                            <label>First name</label>
                                            <input type="text" name="first_name" placeholder="First Name" value="Sangh" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Last name</label>
                                            <input type="text" name="last_name" placeholder="Last Name" value="Deep" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Email Id?</label>
                                            <input type="email" name="email" placeholder="Email id" value="sanghdeep1988@gmail.com" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" placeholder="Company Name" value="Samrt Act" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Company Location</label>
                                            <input type="text" name="company_loc" placeholder="Company Location" value="Dwarka" class="form-control"/>
                                        </fieldset>                                        
                                        <fieldset class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="Phone" value="8750724589" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>I am interested in following stay type</label>
                                            <div class="checkbox">
                                              <input type="checkbox" class="styled" id="stay_type1" name="stay_type1" value="Hotel Stays" aria-label="Single checkbox One">
                                              <label for="singleCheckbox1">Hotel Stays</label>
                                            </div>
                                            <div class="checkbox">
                                              <input type="checkbox" class="checkbox-warning" id="stay_type2" name="stay_type2" value="Extended Stays" aria-label="Single checkbox One">
                                              <label for="singleCheckbox2">Extended Stays</label>
                                            </div>
                                        </fieldset>
                                        
                                        <fieldset class="form-group">
                                            <label>Please tell me also more about group and event options</label>
                                            <div class="radio">
                                              <input type="radio" name="event_options" id="radio1" value="Yes">
                                              <label for="radio1">Yes</label>
                                            </div>
                                            <div class="radio">
                                              <input type="radio" name="event_options" id="radio1" value="No">
                                              <label for="radio2">No</label>
                                            </div>
                                        </fieldset>
                                        
                                        <fieldset class="form-group">
                                            <label>Notes</label>
                                            <textarea rows="5" name="Notes" placeholder="Notes" class="form-control" ></textarea>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="button" id="group_btn" value="Send" class="btn btn-pura">
                                        </fieldset>
                                    </form>
                                </div>
                              </div>
                            </div>
                            <div id="event" class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Hosting an event</a>
                                </h4>
                              </div>
                              <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form role="form" id="eventForm">
                                        <div class="alert alert-success"></div>
                                        <fieldset class="form-group">
                                            <label>First name</label>
                                            <input type="text" name="first_name" placeholder="First Name" value="Sangh" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Last name</label>
                                            <input type="text" name="last_name" placeholder="Last Name" value="Deep" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Email Id?</label>
                                            <input type="email" name="email" placeholder="Email id" value="sanghdeep1988@gmail.com" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" placeholder="Company Name" value="Smart Act" class="form-control"/>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Company Location</label>
                                            <input type="text" name="company_loc" placeholder="Company Location" value="Dwarka" class="form-control"/>
                                        </fieldset>                                        
                                        <fieldset class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="Phone" value="8750724589" class="form-control" />
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>I am interested in following stay type</label>
                                            <div class="checkbox">
                                              <input type="checkbox" class="styled" name="stay_type1" id="singleCheckbox1" value="Hotel Stays" aria-label="Single checkbox One">
                                              <label>Hotel Stays</label>
                                            </div>
                                            <div class="checkbox">
                                              <input type="checkbox" class="checkbox-warning" name="stay_type2" id="singleCheckbox2" value="Extended Stays" aria-label="Single checkbox One">
                                              <label>Extended Stays</label>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label>Notes</label>
                                            <textarea rows="5" name="Notes" placeholder="Notes" class="form-control" >df sdsd sdf sfsd</textarea>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="button" id="event_btn" value="Send" class="btn btn-pura">
                                        </fieldset>
                                    </form>
                                </div>
                              </div>
                            </div>                            
                          </div>                      
                      </div>
                      
                   <div id="join" class="tab-pane fade">
                        <h3>want to join our team?</h3>
                        <p>Check out our <a href="#">open positions</a>. You can e-mail us for more information or to send your application at <a href="mailto:info@purastays.com">info@purastays.com</a>.</p>
                      </div>
                      
                   <div id="rollout" class="tab-pane fade">
                        <h3>Pura Rollout</h3>
                        <p>Read all about our expansion <a href="#">plans here</a>.<br>For further information and clarifications, please e-mail us at <a href="mailto:info@purastays.com">info@purastays.com</a></p>
                      </div>           
                </div>
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

            //upload general form
            $("#general_btn").on("click",function(){
                $('.overlay').fadeIn(500);
                var form=$("#generalForm");
                //data: JSON.stringify(form.serializeArray()),
                 $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: JSON.stringify(form.serializeArray()),
                    crossDomain: true,
                    url: '../../purastays.com/api/contactus/general',
                    success: function(msg){
                        $('.overlay').fadeOut(500);
                        $("#general .alert.alert-success").fadeIn(300);    
                        $("#general .alert.alert-success").text(msg.message);   
                    },error: function(res){
                    	console.log(res);
                        alert('ajax post failed');  
                    }
                 }); 
            });

            //upload group booking
            $("#group_btn").on("click",function(){
                $('.overlay').fadeIn(500);
                var form = $("#groupForm");
               // console.log(JSON.stringify(form.serializeArray()));
                $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: JSON.stringify(form.serializeArray()),
                    crossDomain: true,
                    url: '../../purastays.com/api/contactus/group',
                    success: function(msg){
                        $('.overlay').fadeOut(500);
                        $("#group .alert.alert-success").fadeIn(300);    
                        $("#group .alert.alert-success").text(msg.message);   

                       // console.log(msg);
                    },error: function(res){
                        alert('ajax post failed');  
                    }
                 }); 
            });

            //upload event booking
            $("#event_btn").on("click",function(){
                $('.overlay').fadeIn(500);
                var form = $("#eventForm");
               
                $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: JSON.stringify(form.serializeArray()),
                    crossDomain: true,
                    url: '../../purastays.com/api/contactus/event',
                    success: function(msg){
                        $('.overlay').fadeOut(500);
                        $("#event .alert.alert-success").fadeIn(300);    
                        $("#event .alert.alert-success").text(msg.message);
                        console.log(msg);
                    },error: function(res){
                        alert('ajax post failed');  
                        console.log(res);
                    }
                 }); 
            });

        });  
        
    </script>
  </body>
</html>

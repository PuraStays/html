<?php
	ini_set('display_errors', '0');
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
	
	$username = '';
	$calledFrom = '';
	$class = '';
	$successURL = '';

	$actual_link_incoming_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	if( isset($_POST) )
	{
	    $userid = $_POST['userid'];
	    $calledFrom = $_POST['from'];   //web or mobile
	    $class = $_POST['class'];	    
	    if($calledFrom == 'web'){
			$successURL = "http://localhost/PaytmKit/pgResponse.php"; // localhost
	 	}else if($calledFrom == 'mobile'){
	 		$successURL = "http://mobile";
	 	}
	}
?>

<!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8">
<title>Pricing :: Pura Stays</title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link  href="css/style.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!--[if lt IE 9]>
<script src="js/css3-mediaqueries.js"></script>
<script src="js/modernizr.js"></script>
<![endif]-->

<script type="text/javascript">
	var getUserDetails = function(id){			
		if(id==''){
			window.location="http://localhost/PaytmKit/";
		}else{
			var userid = id;
			var profileData = {};

			$.ajax({
	            url : "http://testapi.flygrades.com/profile/"+id,
	            type: "GET",                        
	            success: function(data, textStatus, jqXHR){    
	            	console.log(data);            
	                profileData = data.profile.personal_details;                
	                $('#user').text(profileData.name);
	                //call another ajax request
	                $.ajax({
	                	url : "data/package.json",
	                	type : "get",
	                	success : function(res){
	                		if(profileData.class == 'Class VIII'){		                	
			                	$( ".plan-box" ).each(function( index ) {
								  $(this).find('.plan-head h4').text(res.packages[0].package[index].packageName);
								  $(this).find('.price del').text(res.packages[0].package[index].normalPrice);
								  $(this).find('.price big').text(res.packages[0].package[index].discountPrice);
								  $(this).find('a.btn').on('click', function(){
								  	payNow(res.packages[0].package[index].discountPrice, 8);
								  })							  							 
								});
			                }else if(profileData.class == 'Class IX'){
			                	$( ".plan-box" ).each(function( index ) {
								  $(this).find('.plan-head h4').text(res.packages[1].package[index].packageName);
								  $(this).find('.price del').text(res.packages[1].package[index].normalPrice);
								  $(this).find('.price big').text(res.packages[1].package[index].discountPrice);
								  $(this).find('a.btn').on('click', function(){
								  	payNow(res.packages[1].package[index].discountPrice, 9);							  
								  });	
								});
			                }else if(profileData.class == 'Class X'){
			                	$( ".plan-box" ).each(function( index ) {
								  $(this).find('.plan-head h4').text(res.packages[2].package[index].packageName);
								  $(this).find('.price del').text(res.packages[2].package[index].normalPrice);
								  $(this).find('.price big').text(res.packages[2].package[index].discountPrice);
								  $(this).find('a.btn').on('click', function(){	
								  	payNow(res.packages[2].package[index].discountPrice, 10);							  
								  })	
								});

			                }    
			                $('.overlay').fadeOut(500);            		
	                	},
	                	error : function(err){

	                	}
	                })
	            },
	            error: function (jqXHR, textStatus, errorThrown){
	                
	            }  
	        });

			var payNow = function(amt, cls){			
				$('#inputprice').val(amt);
				document.f1.submit();
			}
		}	
	}
		
</script>    
 
</head>
<body onload="getUserDetails('<?php echo $userid; ?>');">
<div class="overlay"><img src="images/loading.gif" alt="loader"></div>
<form method="post" action="pgRedirect.php" name="f1">
	<input type="hidden" name="successURL" value="<?php echo $successURL; ?>">
	<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" value="<?php echo substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>">
	<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" value="<?php echo $userid;?>">
	<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" value="Education">
	<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
	<input type="hidden" id="inputprice" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="0">								
</form>
	<section class="nobanner" id="slide0">    	
    	<header>
        	<div class="wrapper">
	            <div class="wrapper-inner">
                	<div class="logo">
                    	<a href="http://www.flygrades.com/"><img src="images/flygrades-logo.png" alt="flygrades"></a>
                    </div>
                    <div class="logo logoblue">
                    	<a href="http://www.flygrades.com/"><img src="images/flygrades-logo-blue.png" alt="flygrades"></a>
                    </div>                    
                </div>
            </div> 
        </header>   
            

            
        <div class="wrapper">
            <div class="wrapper-inner">				                    
                <div class="banner-content terms">
                	<div class="msg" id="msg">
                    	<div class="white-txt head1">&nbsp;</div>                                                
                    </div>
                </div>            
            </div>
        </div>
    </section>
    

    <section class="features2 segment pricing">
    	<div class="wrapper">
        	<div class="wrapper-inner">
            	<h3>Hi! <span id="user"></span>, please choose the package below</h3>                                                                     
                    <div class="tab-content paynowpage">
                          
		              <div id="tabs-1">
		                  <div class="plan-container">
		                	<div class="plan-content">
		                    	<div class="plan-box">
		                        	<div class="plan">
		                            	<div class="plan-head">
		                                	<h4>Monthly</h4>
		                                    <div class="price">
		                                    	<i>&#x20B9;</i><big>000</big><span></span>
		                                    </div>
		                                    <a href="javascript:void(0);" class="btn loginlink" id="class8m">Pay Now</a>
		                                </div>
		                                <div class="plan-body">                                            	
		                                	<ul>
		                                    	<li><strong>Concept Notes</strong><span>Notes in form of digestive nuggets for all chapters</span></li>
		                                        <li><strong>Adaptive videos for all subtopics</strong><span>Personalise your videos as per you learning skills</span></li>
		                                        <li><strong>Interactive practice</strong><span>Subtopic wise practice tests with hints</span></li>
		                                        <li><strong>Adaptive Tests</strong><span>Questions from different books with detailed solutions</span></li>
		                                        <li><strong>Real time reports</strong><span>Receive instant reports to track progress and pain point</span></li>
		                                        <li><strong>Ask doubts</strong><span>Get your doubts addressed by experts</span></li>
		                                        <li><strong>Sample papers</strong><span>Sample papers designed as per SA1 and SA2</span></li>                                                    
		                                    </ul>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        <div class="plan-box">
		                        	<div class="plan">
		                            	<div class="plan-head">
		                                	<h4>Quarterly</h4>
		                                    <div class="price">
		                                    	<i>&#x20B9;</i><del>000</del><big>000</big><span></span>
		                                    </div>
		                                    <a href="javascript:void(0);" class="btn loginlink" id="class8q">Pay Now</a>
		                                </div>
		                                <div class="plan-body">                                            	
		                                	<ul>
		                                    	<li><strong>Concept Notes</strong><span>Notes in form of digestive nuggets for all chapters</span></li>
		                                        <li><strong>Adaptive videos for all subtopics</strong><span>Personalise your videos as per you learning skills</span></li>
		                                        <li><strong>Interactive practice</strong><span>Subtopic wise practice tests with hints</span></li>
		                                        <li><strong>Adaptive Tests</strong><span>Questions from different books with detailed solutions</span></li>
		                                        <li><strong>Real time reports</strong><span>Receive instant reports to track progress and pain point</span></li>
		                                        <li><strong>Ask doubts</strong><span>Get your doubts addressed by experts</span></li>
		                                        <li><strong>Sample papers</strong><span>Sample papers designed as per SA1 and SA2</span></li>                                                    
		                                    </ul>
		                                </div>
		                            </div>
		                        </div>
		                        
		                        <div class="plan-box">
		                        	<div class="plan">
		                            	<div class="plan-head">
		                                	<h4>Yearly</h4>
		                                    <div class="price">
		                                    	<i>&#x20B9;</i><del>000</del><big>000</big><span></span>
		                                    </div>
		                                    <a href="javascript:void(0);" class="btn loginlink" id="class8y">Pay Now</a>
		                                </div>
		                                <div class="plan-body">                                            	
		                                	<ul>
		                                    	<li><strong>Concept Notes</strong><span>Notes in form of digestive nuggets for all chapters</span></li>
		                                        <li><strong>Adaptive videos for all subtopics</strong><span>Personalise your videos as per you learning skills</span></li>
		                                        <li><strong>Interactive practice</strong><span>Subtopic wise practice tests with hints</span></li>
		                                        <li><strong>Adaptive Tests</strong><span>Questions from different books with detailed solutions</span></li>
		                                        <li><strong>Real time reports</strong><span>Receive instant reports to track progress and pain point</span></li>
		                                        <li><strong>Ask doubts</strong><span>Get your doubts addressed by experts</span></li>
		                                        <li><strong>Sample papers</strong><span>Sample papers designed as per SA1 and SA2</span></li>                                                    
		                                    </ul>
		                                </div>
		                            </div>
		                        </div>                                    
		                    </div>
		                </div>
		              </div>
	            </div>
            </div>
        </div>
    </section>    
  	
    
    <section class="features2 segment faq">
    	<div class="wrapper">
        	<div class="wrapper-inner clearfix">
            	<h3>FAQ's </h3>
                <div class="faqone">
                	<a href="javascript:void(0);" class="toggle"><span>+</span></a>
                    <h4>How can I pay?</h4>
                    <p>You can buy a subscription of Flygrades using credit cards, debit cards and net banking facility for all leading banks. We do not accept payments through cash or demand drafts.</p>
                </div>
				
                <div class="faqone">
                	<a href="javascript:void(0);" class="toggle"><span>+</span></a>
                    <h4>What are your terms of service?</h4>
                    <p>go to <a href="terms-of-services.html">Term of services</a></p>
                </div>    
				
                <div class="faqone">
                	<a href="javascript:void(0);" class="toggle"><span>+</span></a>
                    <h4>Cancellation and Refund Policy</h4>
                    <p>All purchases and payments made will be final and will not be applicable for any form of refund or cancellation. Please go through the demo content before your purchase.</p>
                </div>    

				<p><br/></p>
                
    		</div>
        </div>
    </section>
    
    
    
    <footer>
    	<div class="upper">
        	<div class="wrapper">
	        	<div class="wrapper-inner clearfix">
                    <div class="to-top">
                        <a href="#slide0" class="link"><img src="images/to-top.png" alt="to-top"></a>
                    </div>
                	<div class="links pull-left">
                        <div class="cust">
                        	<span><img src="images/customer_icon_footer.png" alt="customer-care">Customer Care:</span><div><a href="tel:+919599588124">+91 959 958 8124</a></div>
                        </div>
                	</div>
                </div>   
            </div>     
        </div>
        <div class="lower">        
        	<div class="wrapper">	
                <div class="wrapper-inner clearfix">      
                	<div class="copy pull-left">
                    	&copy; 2015 Gradiator Solutions Pvt. Ltd. | <a href="terms-of-use.html">Terms of use</a> | <a href="http://blog.flygrades.com" target="_blank">Blog</a> 
                    </div>          
                	<div class="social-link pull-right">
                        <ul>	                        
	                        <!--li><a href="mailto:info@flygrades.com" class="mail"><span>mail</span></a></li-->
                            <li><a href="https://twitter.com/flygrades" class="twitter"><span>twitter</span></a></li>
                            <li><a href="https://www.facebook.com/flygrades" target="_blank" class="facebook"><span>facebook</span></a></li>                            <li><a href="https://www.linkedin.com/company/flygrades" target="_blank" class="linkedin"><span>linkedin</span></a></li>
                            <li><a href="https://www.youtube.com/channel/UCXenZqh3sbNlfqm4MY3sEoA" target="_blank" class="video"><span>video</span></a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>        
    </footer>        
        
           	             
</body>

<script>

$("#res-menu").on('click',function(){
			if(($(this)).hasClass('active')){
				$(this).removeClass('active');		
				$(this).find('img.light').css('display', 'none');
				$(this).find('img.dark').css('display', 'block');
				$('.menu').slideUp(400);	
				
			}else{
				$(this).addClass('active');	
				$('.menu').slideDown(400);	
				$(this).find('img.dark').css('display', 'block');
				$(this).find('img.light').css('display', 'none');
			}
	})


</script>

<script>
$(window).on("scroll", function(e){
	$('.menu.menuDrop').slideUp(400);	
	$('#res-menu').removeClass('active');
	var distanceY = window.pageYOffset || document.documentElement.scrollTop,
		shrinkOn = 50;

		
		if(distanceY > shrinkOn){
			$('header').addClass('smaller');
			$('header .logo').show();
			$('header .logo.logoblue').css('display','none');
			$('.nobanner .res-menu-btn .light').css('display', 'block');
			$('.nobanner .res-menu-btn .dark').css('display', 'none');
			
		}else{
			if($('header').hasClass('smaller'))	{
				$('header').removeClass('smaller');
				$('header .logo').hide();					
				$('header .logo.logoblue').css('display','block');
				$('.nobanner .res-menu-btn .light').css('display', 'none');
				$('.nobanner .res-menu-btn .dark').css('display', 'block');
			}
		}
})

 
$(function () {
 
	/*$('a.link').click(function(event) {
		var id = $(this).attr("href");
		var offset = 60;
		var target = $(id).offset().top - offset;
		 
		$('html, body').animate({scrollTop:target}, 600);
			event.preventDefault();
		});*/ 
	 
	});	  
</script>
<script>
$(function() {
    $( "#tabs" ).tabs();
	 $( ".faqone" ).each( function( index, element ){		
		 var _this = this;
		 $( this ).find('a.toggle').on('click',  function(){
			if ($( this ).hasClass('open')){
				alert("Hello");	
			} else {
				$(_this).find('p').fadeIn(500);	
				$(this).text('-').addClass('open'); 
			}
		 });
	});	 
	
	
	
});
</script>

</html>

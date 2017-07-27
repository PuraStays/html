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
    <title>Find answers on booking, refund & more | PuraStays Help Desk</title>
    <meta name="description" content="Find answers to all your travel related questions like booking a stay etc. Pura Stays offers quick online booking of holiday stays and experiences.">
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
    <meta name="twitter:title" content="Find answers on booking, refund & more | PuraStays Help Desk">
    <meta name="twitter:description" content="Find answers to all your travel related questions like booking a stay etc. Pura Stays offers quick online booking of holiday stays and experiences.">
    <meta name="twitter:creator" content="@purastays">
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png">
    <meta name="twitter:url" content="http://www.purastays.com/help-faqs">

    <!-- Open Graph Card data -->
    <meta property="og:title" content="Find answers on booking, refund & more | PuraStays Help Desk" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.purastays.com/help-faqs" />
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png" />
    <meta property="og:description" content="Find answers to all your travel related questions like booking a stay etc. Pura Stays offers quick online booking of holiday stays and experiences." />
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
                <img src="images/banner/help-faq.jpg" alt="Pura Stays Help Faq">
            </div>
        </div>
    </header>    

    <section class="sec contact">
    	<div class="container">
        	<h1 class="head1">Help / FAQs</h1>
        </div>    
        <div class="type clearfix">
        	<div class="container">
        		<div class="policy-sec">
        			<h3>Questions before you book</h3>	
        		</div>

                <div class="policy-sec">
                	<h4><strong>01. </strong>Can more than two adults stay in one room? </h4>
                    <p><strong>Answer: </strong>Please check the description of the room type before selecting the room as it clearly specifies the number of adults and children permissible in that room type.</p>
                </div>

                <div class="policy-sec">
                	<h4><strong>02. </strong>Will the child stay for free?</h4>
                    <p><strong>Answer: </strong>As per our child policy, children below five years can stay for free.</p>
                </div>               

                <div class="policy-sec">
                	<h4><strong>03. </strong>What if I need a specific type of stay (non-smoking, wheelchair friendly, etc.)?</h4>
                    <p><strong>Answer: </strong>Yes, all properties have non-smoking rooms. For wheel chair access or any other special request, call us on <a href="tel:+919015511551">+91 90 1551 1551</a> anytime between 10 am to 6 pm.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>04. </strong>Will my credit card be charged when I book my stay?</h4>
                    <p><strong>Answer: </strong>Yes, we facilitate payment through credit cards, net banking, paytm wallet and same shall be charged for the booking amount.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>05. </strong>How do I modify a stay booking?</h4>
                    <p><strong>Answer: </strong>Please reach us at <a href="tel:+919015511551">+91 90 1551 1551</a> anytime between 10 am to 6 pm and we shall assist you.</p>
                </div> 


                <div class="policy-sec">
                	<h3>Questions after you book</h3>
                </div>   

                <div class="policy-sec">
                	<h4><strong>01. </strong>Can I make changes to a confirmed reservation?</h4>
                    <p><strong>Answer: </strong>Yes we can make changes, subject to the availability. Please reach us at <a href="tel:+919015511551">+91 90 1551 1551</a> anytime between 10 am to 6 pm and we shall assist you.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>02. </strong>How will I know that my booking is confirmed?</h4>
                    <p><strong>Answer: </strong>After the payment has been processed, you shall receive a confirmation e-mail from us on your e-mail used for booking your stay.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>03. </strong>What will be the charges if I want to cancel my booking?</h4>
                    <p><strong>Answer: </strong>There will be 100% refund for accommodation and experiences booked if you are cancelling your booking before 20 days or more prior to check-in time. Between 10-20 days prior to check-in time, there will be 50% refund for accommodation and 100% refund on experiences booked. And, before 10 days or less prior to check-in time, there is no refund for accommodation or experiences booked. For more clarity, please check our guest policy.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>04. </strong>What's the ideal check-in and check-out time at the stay?</h4>
                    <p><strong>Answer: </strong>Standard check-in time is 1230 hours whereas standard check-out time is 1030 hours.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>05. </strong>What if I reach the stay early?</h4>
                    <p><strong>Answer: </strong>If you reach before 0600 hours, you are required to pay 100% charges for one day, payable as per room rates of the previous day. If you reach between 0600 hours and 0900 hours, then you have to pay 30% charges payable as per room rates of the previous day, which does not include breakfast. Between 0900 hours and 1230 hours, there are no charges, and breakfast is not included.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>06. </strong>Will the stay hold my room if I'm arriving late?</h4>
                    <p><strong>Answer: </strong>Room will be held up till 1800 hours on the day of arrival unless prior information for late check-in is provided. We shall also get in touch with you to confirm late check-in time.</p>
                </div>   

                <div class="policy-sec">
                	<h4><strong>07. </strong>Do I have to show ID proof at the time of check-in?</h4>
                    <p><strong>Answer: </strong>Yes, you are required to present valid Govt. photo Id at the time of check-in. Driving license, voter ID card, Aadhaar card and Passport are acceptable.</p>
                </div>  


                <div class="policy-sec">
                	<h4><strong>08. </strong>I didn't get an email confirmation. What should I do?</h4>
                    <p><strong>Answer: </strong>Kindly write to us at <a href="mailto:<?php echo convert_email('reservations@purastays.com'); ?>"> <?php echo convert_email('reservations@purastays.com'); ?> </a> with the following details: E-mail, phone number and the details of the booking or call us with above details on <a href="tel:+919015511551">+91 90 1551 1551</a> anytime between 10 am to 6 pm.</p>
                </div>  


                <div class="policy-sec">
                	<h3>Questions on Cancellations &amp; Refunds</h3>
                </div>  

                <div class="policy-sec">
                	<h4><strong>01. </strong>How do I cancel my stay booking?</h4>
                    <p><strong>Answer: </strong>Please call us at <a href="tel:+919015511551">+91 90 1551 1551</a> anytime between 10 am to 6 pm and we shall assist you with the cancellation.</p>
                </div>  

                <div class="policy-sec">
                	<h4><strong>02. </strong>What are the cancellation charges?</h4>
                    <p><strong>Answer: </strong>There will be 100% refund for accommodation and experiences booked if you are cancelling your booking before 20 days or more prior to check-in time. Between 10-20 days prior to check-in time, there will be 50% refund for accommodation and 100% refund for experiences booked. And, before 10 days or less prior to check-in time, there is no refund for accommodation or experiences booked. For more clarity, please check our guest policy.</p>
                </div>  

                <div class="policy-sec">
                	<h4><strong>03. </strong>How will I get my money back after cancelling my stay booking?</h4>
                    <p><strong>Answer: </strong>After you have cancelled the booking from your profile page, as per the cancellation policy, the refund shall be processed through your net banking/credit card account/paytm wallet within 10-15 days.</p>
                </div>  

                <div class="policy-sec">
                	<h4><strong>04. </strong>How long does it take to process the refund?</h4>
                    <p><strong>Answer: </strong>Estimated time is 10-15 days to process the refund, depending upon the processing time taken by your bank.</p>
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

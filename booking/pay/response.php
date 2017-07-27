<?php

include_once('../../includes/db.inc.php');
include_once("../../PHPMailer_5.2.1/class.phpmailer.php");

ini_set("display_errors", "0");

function loadcart($m, $requestStr, $accesssecret)
{
	$db = new DB();
	$actionUrl = 'https://staygrid.com/ws/web/'. $m;			
		$signature = hash_hmac("sha1", $requestStr, $accesssecret);
		$extHeader = array(
		"Content-Type: text/xml"
		,"X-HAPI-Signature: $signature"
		);
		
		$request = curl_init($actionUrl);

		curl_setopt($request,CURLOPT_HTTPHEADER,$extHeader);
		curl_setopt($request, CURLOPT_HEADER, 0);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_REFERER, 'http://www.hotelogix.com');
		curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
		$post_response = curl_exec($request);
		$xml = simplexml_load_string($post_response);
	 	$post_response  = substr($post_response, 39);
	 	$json = $db->XML2JSON($post_response);
		$cart =  json_decode($json);
		return($cart);

}

//ini_set("display_errors", "1");
if (session_status() == PHP_SESSION_NONE) {
   session_start();
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
<script src="js/jquery-1.11.3.min.js"></script>
<!--[if lt IE 9]>
<script src="js/css3-mediaqueries.js"></script>
<script src="js/modernizr.js"></script>
<![endif]-->
<style>
 .searchsubmit
    {    
        visibility: hidden;
    }
</style>
  <?php include_once("../../includes/taghead.php") ?>
</head>
<body onload="paymentSuccess();">
<?php include_once("../../includes/tagbody.php") ?>

<form action="mail_test.php" method="post" name="reg_form">
    <section class="features2 segment pricing">
    	<div class="wrapper">
        	<div class="wrapper-inner">

<?php

if($_POST)
{

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.

$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
?>


         	<?php
					if($isValidChecksum == "TRUE") {						
						
						if ($_POST["STATUS"] == "TXN_SUCCESS") {
					       
					       //we will update in existing record
							$orderid = $_POST['ORDERID'];	                            
							$db = new DB();
							$qry1 = "select * from hotelogix_details where orderid = '$orderid'";
							$result = $db->_query($qry1);
							$row = mysqli_fetch_array($result);
							$accesskey = $row['accesskey'];
							$accesssecret = $row['accesssecret'];
							$room_price = $row['room_price'];
							
							$userid = $row['userid'];
							
							$qry2 = "select * from customers where id = '$userid'";
							$result2 = $db->_query($qry2);

							$user_email = "amit.mahajan@purastays.com";
							if($result2)
							{
								$row2 = mysqli_fetch_array($result2);
								//var_dump($row2);
								$_SESSION['Name'] = $row2['Name'];
								$_SESSION["login_status"] = 'login';
								$_SESSION["userid"] = $row2['id'];
								$_SESSION["name"] = $row2['Name'];
								$_SESSION["mobile"] = $row2['Mobile'];
								$_SESSION["email"] = $row2['email'];
								$user_email = $row2['email'];
							}

							$current_time = $db->response_utc_time();
							$qry = "update hotelogix_details set status = 1, dou = NOW() where orderid = '$orderid'";
							if($db->_query($qry))
							{
								$m = "confirmbooking";
								$requestStr = '<?xml version="1.0"?>
										<hotelogix version="1.0" datetime="'.$current_time.'">
										<request method="confirmbooking" key="'.$accesskey.'">
										<payment amount="'.$room_price.'"/>
										<orderId value="'.$orderid.'"/>
										</request>
										</hotelogix>';

								//print_r($requestStr);
								$actionUrl = 'https://staygrid.com/ws/web/'. $m;			
								$signature = hash_hmac("sha1", $requestStr, $accesssecret);
								$extHeader = array(
								"Content-Type: text/xml"
								,"X-HAPI-Signature: $signature"
								);
								
								$request = curl_init($actionUrl);
								curl_setopt($request,CURLOPT_HTTPHEADER,$extHeader);
								curl_setopt($request, CURLOPT_HEADER, 0);
								curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($request, CURLOPT_REFERER, 'http://www.hotelogix.com');
								curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
								curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
								$post_response = curl_exec($request);
								
								//print_r($post_response);
								$xml = simplexml_load_string($post_response);

							 	$post_response  = substr($post_response, 39);
							 	$json = $db->XML2JSON($post_response);
								$confirm =  json_decode($json);
								$confirm->response->status->code;
								if($confirm->response->status->code==1602)
									{
										$data['status'] = 1;
										$data['message'] = "success";
									}
									else
									{
										$data['status'] = $confirm->response->status->code;
										$data['message'] = $confirm->response->status->message;
									}

									    
									    $Message = file_get_contents('http://www.purastays.com/mailler/booking-confirmation.php?id='.$accesskey, FILE_USE_INCLUDE_PATH);
										
										$actionUrl = 'http://www.purastays.com/mailler/booking-confirmation.php?id='.$accesskey;
									    $request = curl_init($actionUrl);
									    curl_setopt($request, CURLOPT_HEADER, 0);
									    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
									    curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
									    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
									    $Message = curl_exec($request);


									//mail send starts here
										
										$Email = 'info@purastays.com';
										$Email = $user_email;
							            //$Email = "sanghdeep1988@gmail.com";
							            $name = 'Pura Stays';
													            
							            //$Message = "test message";
							    		$mail = new PHPMailer();
							            $mail->SMTPDebug = 1;
							            
							            $mail->IsSMTP();
							            $mail->SMTPAuth = true;
							        	
							            $mail->SMTPSecure = 'ssl';
							            
							            $mail->Host = 'lnx9.cloudhostdns.net';
							            $mail->Port = '465';
							            $mail->Encoding = '7bit';
							            $Email_Sender = "test@gautambuddhainfotech.com";
							            $mail->Username = 'test@gautambuddhainfotech.com';
							            $mail->Password = '9410270880';
							        	

							            $mail->SetFrom($Email_Sender, $name);	
							            $mail->AddReplyTo($Email, $name);
							        
							            $mail->Subject = "Booking Confirmation : Pura Stays";
							            $mail->MsgHTML($Message);
							            $mail->AddAddress($Email, 'Pura Stays');
							          
							            if($mail->Send())
							            {
							              $data['status'] = '1';
							              $data['message'] = 'Pura Stays: Booking Confirmation';
							            }
							            else
							            {
							              $data['status'] = '0';
							              $data['message'] = 'Something went wrong. Please try again !';
							            }
							            
							          //  var_dump($data);
							            //mail send ends here
							}
                    	?>
							<div class="alert alert-success" style="width:80%; margin:100px auto; max-width:500px;">
								
								<!--
								<textarea style="height: 400px; width: 700px;"><?php 
								echo $requestStr;
								//echo '<br />';
								print_r($post_response);
								?></textarea>
								-->
								<?php echo "<b style='text-align:center'>Transaction status is success</b>" . "<br/>"; ?>
								<?php echo "Room Confirm Status ".$data['message'].", Code : " . $data['status']." <br />"; ?>
								<?php echo "<b>Your Transaction ID: </b>" . $_POST["ORDERID"] . " <br/>"; ?>
                                <?php echo "Please do not refresh web "; ?>
								<!--
								<input type="hidden" name="varemail" value="<?php echo $_SESSION['email']; ?>">
								<input type="hidden" name="varprice" value="<?php echo $room_price; ?>">
								<input type="hidden" name="varaccesssecret" value="<?php echo $_SESSION['$accesssecret']; ?>">
								<input type="hidden" name="varname" value="<?php echo $_SESSION['Name'] ?>">
								-->
								<a href="http://www.purastays.com" class="btn btn-success">Back</a>
						    
						 
							</div>													
						<?php	
						}
						else {  

							?>
							<div class="alert alert-danger" style="width:80%; margin:100px auto; max-width:500px;">
								<?php echo "<b style='text-align:center'>Transaction status is failure</b>" . "<br/>"; ?>
								<?php echo "<b>Your Transaction ID: </b>" . $_POST["ORDERID"] . " <br/>"; ?>
                               	
								
								<div><a href="http://www.purastays.com/"><button type="button" class="btn" style="background: #eaa62d;border: 1px solid #e19e28;color: #ffffff;">GO tO home page</button></a></div>
								<script>
								window.setTimeout(function(){
								//window.location.href = "http://purastays.com/";
									//window.location.href = "http://purastays.com/booking/#/booking/rooms";
								//}, 5000);
								</script>
								</div>
	


						
							<?php
						}

						if (isset($_POST) && count($_POST)>0 )
						{ 
							foreach($_POST as $paramName => $paramValue) {
								//echo "<br/>" . $paramName . " = " . $paramValue;
							}
						}
					}
					else {
						//echo "<b>Checksum mismatched.</b>";
						//Process transaction as suspicious.
					}
		}
        else
        {
            echo 'unauthorized access';
        }
    ?>
            </div>
        </div>
		</form>
    </section> 
	
    <script type="text/javascript">
    	function paymentSuccess(){
			setTimeout(function() { 
		//		window.location.href = "http://purastays.com/hermes2/profile.php";
			}, 5000);
		}
		//document.reg_form.submit(); // SUBMIT FORM
		
    </script>

</body>
</html>
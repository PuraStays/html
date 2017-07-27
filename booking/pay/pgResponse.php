<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$user_id = $_SESSION['user'];
$from = $_SESSION['from'];

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.

$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

?>


<!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8">
<title>Pricing :: Flygrades</title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<script src="js/jquery-1.11.3.min.js"></script>
<!--[if lt IE 9]>
<script src="js/css3-mediaqueries.js"></script>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<body onload="paymentSuccess();">
    <section class="features2 segment pricing">
    	<div class="wrapper">
        	<div class="wrapper-inner">
        		

            	<?php
					if($isValidChecksum == "TRUE") {						
						if ($_POST["STATUS"] == "TXN_SUCCESS") {
						?>
							<div class="alert alert-success" style="width:80%; margin:100px auto; max-width:500px;">
								<?php echo "<b style='text-align:center'>Transaction status is success</b>" . "<br/>"; ?>
								<?php echo "<b>Your Transaction ID: </b>" . $_POST["ORDERID"] . " <br/>"; ?>
                                <?php echo "Please do not refresh web page"; ?>
							</div>													
						<?php	
						}
						else {

							?>
							<div class="alert alert-danger" style="width:80%; margin:100px auto; max-width:500px;">
								<?php echo "<b style='text-align:center'>Transaction status is failure</b>" . "<br/>"; ?>
								<?php echo "<b>Your Transaction ID: </b>" . $_POST["ORDERID"] . " <br/>"; ?>
                                <?php echo "Please do not refresh web page"; ?>
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
				?>                                                                   
                    
            </div>
        </div>
    </section> 
      
    <script type="text/javascript">
    	var paymentSuccess = function(){
    		var reqData = {
                            "from_where": "<?php echo $from ?>",
                            "transaction_id": "<?php echo $_POST["ORDERID"] ?>",
                            "payu_params": {
	                            <?php	
	                            	foreach($_POST as $paramName => $paramValue) {
	                            ?>		
									"<?php echo $paramName; ?>" : "<?php echo $paramValue; ?>",
								<?php
									}
								?>	
                            }
                        };

            if("<?php echo $_POST["STATUS"] ?>"=="TXN_SUCCESS"){
            	reqData.payu_params.status = "success";				    			
            }else if("<?php echo $_POST["STATUS"] ?>" =="TXN_FAILURE"){
            	reqData.payu_params.status = "failure";
            }

                        

            console.log(reqData);

    		$.ajax({
                url : "http://testapi.flygrades.com/payment_completed",
                type: "POST",
                dataType: "json",
                contentType: "application/json",                        
                data : JSON.stringify(reqData),
                //data : reqData,
                dataType: 'json',
                crossDomain: true,
                //data: reqData,
                success: function(data, textStatus, jqXHR){
                    console.log(data);
                    if(data.message_code==0){
                    	console.log("ajax success");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }  
            });


          
    	}
    </script>            	             
</body>
</html>
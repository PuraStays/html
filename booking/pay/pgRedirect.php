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



$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
$SUCCESS_URL = $_POST["successURL"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = $SUCCESS_URL;

/*
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/


$_SESSION['user'] = $CUST_ID;
$_SESSION['from'] = $CHANNEL_ID;



//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h3 style="font-family: sans-serif; font-weight: 100;">redirecting...</h3></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">

			<?php
				foreach($paramList as $name => $value) {
					echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
					//echo $name . ' - ';
					//echo $value . '<br/><br/>';
				}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
	</form>
	<script src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript">
			var reqData = {
                            "user_id": "<?php echo $paramList['CUST_ID']; ?>",
                            "transaction_id": "<?php echo $paramList['ORDER_ID']; ?>"
                        }
            //console.log(JSON.stringify(reqData));            
            $.ajax({
                url : "http://testapi.flygrades.com/payment_initiated",
                type: "POST",
                dataType: "json",
                contentType: "application/json",                        
                data : JSON.stringify(reqData),
                //data : reqData,
                dataType: 'json',
                crossDomain: true,
                //data: reqData,
                success: function(data, textStatus, jqXHR){
                    if(data.message_code==0){
                    	//document.f1.submit();
                    }else if(data.message_code==1){

                    }else if(data.message_code==2){                    	
                    	alert(data.message);
                    	//window.location.href = 'http://localhost/PaytmKit/';
                    }


                },
                error: function (jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }  
            })

			//
		</script>		
</body>
</html>
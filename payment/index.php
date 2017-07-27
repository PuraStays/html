<?php
	$successURL = "http://purastays.com/hermes/payment/pgResponse.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Confirm Your Booking</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script type="text/javascript">
			var submitForm = function(){
				document.f1.submit();
			}
		</script>
	</head>
	<body onload="submitForm()">
		<div class="loader">Loading...</div>
		<form method="post" action="pgRedirect.php" name="f1">
			<input type="hidden" name="successURL" value="<?php echo $successURL; ?>">
			<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" value="<?php echo substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>">
			<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" value="<?php echo $_GET["userid"] ?>">
			<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" value="Retail">
			<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
			<input type="hidden" id="inputprice" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="399">	
		</form>
	</body>
	<style type="text/css">
  		.loader:before,	.loader:after,.loader {border-radius: 50%; width: 2.5em; height: 2.5em; -webkit-animation-fill-mode: both; animation-fill-mode: both; -webkit-animation: load7 1.8s infinite ease-in-out; animation: load7 1.8s infinite ease-in-out; top: 120px;}
		.loader {color: #42B4D6; font-size: 10px; margin: 80px auto; position: relative;text-indent: -9999em;-webkit-transform: translateZ(0); -ms-transform: translateZ(0); transform: translateZ(0); -webkit-animation-delay: -0.16s; animation-delay: -0.16s;}
		.loader:before {left: -3.5em; -webkit-animation-delay: -0.32s; animation-delay: -0.32s;}
		.loader:after {left: 3.5em;}
		.loader:before,	.loader:after { content: ''; position: absolute; top: 0;}

		@-webkit-keyframes load7 {
			0%,
			80%,
			100% {
		    	box-shadow: 0 2.5em 0 -1.3em;
			}
			40% {
				box-shadow: 0 2.5em 0 0;
			}
		}

		@keyframes load7 {
			0%,
			80%,
			100% {
				box-shadow: 0 2.5em 0 -1.3em;
			}
			40% {
				box-shadow: 0 2.5em 0 0;
			}
		}
	</style>
</html>

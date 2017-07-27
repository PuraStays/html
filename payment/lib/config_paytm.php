<?php
	define('PAYTM_ENVIRONMENT', 'TEST'); 
	define('PAYTM_MERCHANT_KEY', 'U4xHF!gpdaGWlhho'); 
	define('PAYTM_MERCHANT_MID', 'PuraHo98686709779356'); 
	define('PAYTM_MERCHANT_WEBSITE', 'purastays.com');

	$PAYTM_DOMAIN = "pguat.paytm.com";

	if (PAYTM_ENVIRONMENT == 'PROD') {
		$PAYTM_DOMAIN = 'secure.paytm.in';
	}

	define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
	define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
	define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');
?>


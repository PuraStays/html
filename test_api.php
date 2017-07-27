<?php
function loadcart($m, $requestStr, $accesssecret)
{

	$orderid = 'CRS-1406344153';
	$m = "getorder";
	$requestStr = '<?xml version="1.0"?>
	<hotelogix version="1.0" datetime="'.$current_time.'">
	 <request method="getorder" key="6rv27BHNuOjkY3B" languagecode="en">
	 <orderId value="orderid"/>
	 </request>
	</hotelogix>';

	$actionUrl = 'https://staygrid.com/ws/web/'. $m;			
	$signature = hash_hmac("sha1", $requestStr, $accesssecret);
	$extHeader = array(
	"Content-Type: text/xml"
	,"X-HAPI-Signature: $signature"
	);
								
		$request = curl_init($actionUrl);
		curl_setopt($request,CURLOPT_HTTPHEADER,$ext);
		curl_setopt($request, CURLOPT_HEADER, 0);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_REFERER, 'http://www.hotelogix.com');
		curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
		$post_response = curl_exec($request);
		$xml = simplexml_load_string($post_response);

			$post_response  = substr($post_response, 21);
			$json = $db->XML2JSON($post_response);
		$confirm =  json_decode($json);
		$confirm->response->status->code;
		</body>
</html>
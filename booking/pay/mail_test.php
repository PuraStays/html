<?php
$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
		
		$request = json_decode($postdata);
		echo($request);
		
		
		$sign = $request->user->sign;
		$userid = $request->user->userid;
?>
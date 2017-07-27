<?php
	session_start();
	include_once("db.inc.php");
	$gid = $_REQUEST['gid'];
	$fid = $_REQUEST['fid'];

	$db = new DB();

	if($fid !="" OR $gid!="")
	{
	$qry = "select * from customers where ";
	if($fid!='')
	{
		$qry = $qry . "fid = '$fid' ";	
	}
	
	if($gid!='')
	{
		$qry = $qry . "gid = '$gid' ";	
	}

	$result = $db->_query($qry);
	if(mysqli_num_rows($result)>0)
	{
		 $row = mysqli_fetch_array($result);
	     $_SESSION["userid"] = $row['id'];
         $_SESSION["login_status"] = 'login';
         $_SESSION["name"] = $row['Name'];
         $_SESSION["mobile"] = $row['Mobile'];
         $_SESSION["email"] = $row['email'];
		 $data['status'] = 1;
		 $data['message'] = 'session created successfully';
	}
	else
	{
		$data['status'] = 2;
		$data['message'] = 'invalid social id';
	}
}
else
{
		$data['status'] = 2;
		$data['message'] = 'social id not found';

}
	$response = json_encode($data, JSON_PRETTY_PRINT);
	echo $response = str_replace( '\/', '/', $response);
?>
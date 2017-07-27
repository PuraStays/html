<?php
session_start();
include('../../includes/db.inc.php');
ini_set("display_errors", "1");
$db = new DB();

//check txn id is valid or not 
if(1==1)
{

$userid = $_REQUEST['uid'];
$id = $_REQUEST['id'];

//$start_date= $_REQUEST['start_date'];
//$end_date= $_REQUEST['end_date'];

$qry1 = "select * from hotelogix_details where orderid = '$id'";
$result1 = $db->_query($qry1);
if($result1)
{
	$row1 = mysqli_fetch_array($result1);
	//var_dump($row1);
	$data['status'] = 0;
	$data['message'] = 'order id is correct';
	$userid = $row1['userid'];
	$Booking_Id = $row1['orderid'];
	$amount = $row1['total_price'];

// acount form api
$qry = "select * from customers where id = '$userid'";
$result = $db->_query($qry);
if($result)
{
	
	$row = mysqli_fetch_array($result);

	$username = $row['Name'];
	$mobile = $row['Mobile'];
	$email = $row['email'];
	
	if($row['password']!="")
	{
		$_SESSION["userid"] = $userid;
		$_SESSION["login_status"] = 'login';
		$_SESSION["Name"] = $username;
	}
}
else
{
	$data['status'] = 0;
	$data['message'] = 'user in not found';
}

//$amount = 1;
//$userid = 1;

//echo 'oks';

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Origin: *");

// following files need to be included
require_once("lib/config_paytm.php");
require_once("lib/encdec_paytm.php");

//temp data
$_POST["ORDER_ID"] = $Booking_Id;
$_POST["CUST_ID"] = $userid;
$_POST["INDUSTRY_TYPE_ID"] = "Retail92";
$_POST['CHANNEL_ID'] = "WEB";
$_POST['successURL'] = "http://www.purastays.com/booking/pay/response.php";
$_POST["TXN_AMOUNT"] = $amount;


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
$paramList["userid"] = $_REQUEST['userid'];
$paramList["txn"] = $_REQUEST['t']; 
$paramList["order_id"] = $_REQUEST['oid']; 
$paramList["resort_id"] = $_REQUEST['rid']; 
*/
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
			document.f1.submit();
		</script>		
</body>

</html>
<?php
}
else
	{
		echo 'unable to insert into record';
	}
}
?>
<?php
include_once("../includes/db.inc.php");
$id = 215;
$db = new DB();
$qry = "select * from hotelogix_details where Id = '$id'";
$result = $db->_query($qry);
$row = mysqli_fetch_array($result);
var_dump($row);
?>
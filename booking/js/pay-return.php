<?php
include_once("includes/db.inc.php");
//ini_set('display_errors', 2);

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="9iXzRJhMf2";

$Mode= $_POST["mode"];
$Unmapped_Status= $_POST["unmappedstatus"];
$Addedon= $_POST["addedon"];
$Product_Info= $_POST["productinfo"];
$First_Name= $_POST["firstname"];
$Last_Name= $_POST["lastname"];
$Email= $_POST["email"];
$Phone= $_POST["phone"];
$Pg_Type= $_POST["PG_TYPE"];
$Bank_code= $_POST["bankcode"];
$Error= $_POST["error"];
$Error_Message= $_POST["error_Message"];
$Cardtoken= $_POST["cardToken"];
$Payumoneyid= $_POST["payuMoneyId"];
$Net_Amount_Debit= $_POST["net_amount_debit"];




If (isset($_POST["additionalCharges"])) 
      {
        $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;        
      }
  else
     {    
         $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
     }


    $hash = hash("sha512", $retHashSeq);
    $message = "";
      
      if ($hash != $posted_hash) {
            
            echo '<script>alert("Invalid Transaction. Please try again");</script>';
            print('<script>location.href="error.php?p=not-found";</script>');
           }
       else {

            //
            $db = new DB();
            $qry = "update registration set Status = 1, DOU = NOW() where txn =  '$txnid'";
            if($db->_query($qry))
            {
              $message = "Payment Success ! <br />";
            }
            else
            {
              $message = "Payment Fail ! Please contact AHPI<br />";
            }
           // var_dump($_POST);
            $qry1 = "update transaction set 
                      `posted_hash` = '$_POST[posted_hash]', 
                      `key` = '$_POST[key]', 
                      `productinfo` = '$_POST[productinfo]', 
                      `mode` = '$_POST[mode]', 
                      `unmappedstatus` = '$_POST[unmappedstatus]', 
                      `addedon` = '$_POST[addedon]', 
                      `PG_TYPE` = '$_POST[PG_TYPE]', 
                      `bankcode` = '$_POST[bankcode]', 
                      `error` = '$_POST[error]', 
                      `error_Message` = '$_POST[error_Message]', 
                      `cardToken` = '$_POST[cardToken]', 
                      `payuMoneyId` = '$_POST[payuMoneyId]', 
                      `Net_Amount_Debit` = '$_POST[net_amount_debit]',
                      `amount` = '$_POST[net_amount_debit]', 
                      `DOU` = NOW() 
                  where `Txn` =  '$txnid'";
              
            if($db->_query($qry1))
            {
              $qry2 = "UPDATE `registration` SET `pay` = '1' WHERE `txn` = 1";
              $db->_query($qry2);
            }
            else
            {
              $message = "some error found Please contact 8750724589 !<br />";
            }


            if(isset($_REQUEST['success']))
            {
                    $message = '<h5 style="color:green;">Your Payment submit status is '. $status .'</h5>';
                
            }
            else
            {
                    $message = '<h5 style="color:red;">Your transaction was unsuccessful ! Please try again</h5>';
            }

         } 
?>
<script>
function myFunction() {
    window.print();
}
</script>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="imagetoolbar" content="false" />
<meta name="viewport" content="user-scalable = yes" />
<meta content='width=device-width, minimum-scale=1' name='viewport'>

    

<title>Apply Online | IIAE, Delhi</title>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<!-- Typekit fonts -->
<script type="text/javascript" src="https://use.typekit.net/gog6dck.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<!-- Core CSS -->
<link rel="stylesheet" href="iiae-theme/core/css/iiae.css" />
<link rel="stylesheet" href="iiae-theme/css/style41ab.css?ver=20150901" />
<link rel="stylesheet" href="iiae-theme/css/printafad.css?ver=20141121" />
<!--[if lt IE 9]>
<link href="/iiae-theme/core/css/ie.css" rel="stylesheet" />
<script src="/iiae-theme/core/js/lib/selectivizr.js"></script>
<link href="/iiae-theme/core/css/ie8down.css" rel="stylesheet" />
<![endif]-->
<!--[if gte IE 9]>
<link href="/iiae-theme/core/css/ie9up.css" rel="stylesheet" />
<![endif]-->


    
<!-- <link rel="stylesheet" href="/iiae-theme/main.css"> -->
<!-- Emergency banner -->

<script src="js/OWC-emergency-banner.js" type="text/javascript"> </script>



<script src="iiae-theme/core/js/lib/modernizr.js"></script>
</head>


<body class="iiae-page">



<nav id="skip-link" role="navigation">
    <a href="#main" tabindex="1" data-click-category="header" data-click-action="skip to content">Skip to content</a>
</nav>
<!-- Begin Header -->
<!-- Begin Header -->
  <?php include_once("includes/header.php");?>
<!-- End Header -->

<!-- Main Content -->
<div id="main" role="main" class="full">
  <div class="container">
    <div class="iiae-main">
      <h1 class="page-title">Registration Status</h1>   
   <div class="container">
   <form action="#" method="post" enctype="multipart/form-data">
    <div class="iiae-tower1 about-tower1">
          <table  class="admission-form">
            <tr>
              <td><?= $message; ?></td>
            </tr>
          </table>  
        </div>
      </form>
  </div>
        
        

      </div>
    </div>
    </div>
  </div>
</body>




<!-- Begin Footer -->
<?php include_once("includes/footer.php"); ?>
<!-- End Footer -->



<link href="_includes/footer-map/footer-map.css" type="text/css" rel="stylesheet" />
<link href="css/style.css" type="text/css" rel="stylesheet" />

<script src="_includes/footer-map/mapdata.js"></script>
<script src="_includes/footer-map/worldmap.js"></script> 

<!-- Overlay for modals and to provide better focus -->
<div id="iiae-overlay"></div>

<script src="js/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="iiae-theme/core/js/lib/jquery.js"><\/script>')</script>
<script src="iiae-theme/js/iiaeedu.js"></script>
<script src="iiae-theme/core/js/lib/plugins.js"></script>
<script src="iiae-theme/core/js/lib/equalize.min.js"></script>
<script src="iiae-theme/core/js/iiae.js"></script>
<script src="iiae-theme/js/date.js"></script>



</body>
</html>
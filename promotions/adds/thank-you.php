<?php
if(isset($_POST['name']))
{
  include_once("../../includes/db.inc.php");
  $db = new DB();

  $timezone = new DateTimeZone("Asia/Kolkata" );
  $date = new DateTime();
  $date->setTimezone($timezone);
  $DOC = $date->format('Y-m-d H:i:s');
  $Curr_Time = $date->format('d-m-Y H:i:s');


  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $package = $_POST['package'];
  $message = $_POST['message'];

  $sms = "Query from purastays.com Campaign: ".$package.", Name: ".$name." , Mobile: ".$mobile." , Email Id:".$email." , Message:".$message." Dated:".$Curr_Time;

  $Mobile = "9999350646,9999906603,8750724589,9015511551";
  //$Mobile = "8750724589,8750724589,8750724589";

  $db->_sms($sms,$Mobile);

  $qry = "INSERT INTO customers (Name, Mobile, email, DOC, DOU) VALUES ('$name', '$mobile', '$email', '$DOC', '$DOC')";
  if(!$db->_query($qry))
    {
      echo 'success';
    }
}
else
{
  printf("<script>location.href='http://www.purastays.com'</script>");  
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thank You | Pura Stays</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="shortcut icon" href="images/favicon.ico">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="libs/bxslider/jquery.bxslider.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <?php include_once("../../includes/taghead.php") ?>
</head>

<body class="n1">
<?php include_once("../../includes/tagbody.php") ?>
  <div class="banner-container thankyou">
    <header>
      <div class="container n1">
        <div class="nav clearfix">
          <div class="logo pull-left">
            <a href="javascript:void(0);">
              <img src="images/purastays-logo.png" alt="pura stays" />
            </a>
          </div>
          <div class="header-mobile pull-right">
            <span><img src="images/pura-phone-icon-pura.png" alt="" /></span>999 999 9999
          </div>
        </div>

      </div>
      <div class="container">

      </div>
    </header>

    <div class="banner-image">
      <img src="images/banner01.jpg" alt="purastays banner" />
    </div>
  </div>

  <div class="main-container">
    <div class="container clearfix">
      <div class="left-section-block text-center">
        <h3>Thank you</h3>
        <div class="width60">
          <p>Thank you for contacting Pura Stays! We have received your message and shall get in touch with you at the earliest. Feel free to reach us at <a href="tel:09015511551">+91 90 1551 1551</a>. Happy Holidays</p>
          <div class="linkToWeb"><a href="http://purastays.com">Go to Purastays</a></div>
        </div>


      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <p class="footer-txt text-center">powered by @<a href="javascript:void(0);">Pura Stays</a></p>
    </div>
  </footer>

  <!-- script file includes -->
  <script src="js/jquery.min.js"></script>
  <script src="libs/bxslider/jquery.bxslider.min.js"></script>
</body>
</html>

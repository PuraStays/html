<?php
include_once('../includes/db.inc.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en" ng-app="pura">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Book Online from a collection of Holiday Stays - Pura Stays</title>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/ngGallery/src/css/ngGallery.css">
    <link href="css/custom.css" rel="stylesheet" />
    <link href="css/animate.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="libs/angular-bootstrap-scrolling-tabs-master/scrolling-tabs.css"> -->
    <link rel="stylesheet" type="text/css" href="libs/jquery-ui-1.11.4/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-social.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body ng-controller="AppCtrl">
    <?php include_once("js/analyticstracking-booking.php") ?>
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PPPZMT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-PPPZMT');</script>
    <!-- End Google Tag Manager -->


    <div class="overlay" ng-if="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
    
    <div ui-view></div>            

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/fingerprint.js"></script>
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>

    <script src="bower_components/angular/angular.min.js"></script>    
    <script type="text/javascript" src="bower_components/angular-animate/angular-animate.min.js"></script>
    <script type="text/javascript" src="js/x2js.js"></script>
    <script src="bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
    <script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="bower_components/ngstorage/ngStorage.min.js"></script>

    
    <script type="text/javascript" src="bower_components/ngGallery/src/js/ngGallery.js"></script>
    <script type="text/javascript" src="bower_components/ng-facebook/ngFacebook.js"></script>
        
    <script type="text/javascript">
	  (function() {
	   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	   po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
	   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	 })();
	</script>
	<style>
	  .ng-scope .ui-widget-content {
    z-index: 1200 !important;
    
}
span.ui-button-icon-primary.ui-icon.ui-icon-closethick {
    top: 0% !important;
    left: 0%;
}
	</style>
     <script type="text/javascript">
           function OpenModal1() {
                $("#divModal1").dialog({
                    autoOpen: false, modal: true, title:'' , width: 'auto', height: 'auto'
                    , 
                }).dialog('open');
                return false;
            }
        </script>
		<script type="text/javascript">
           function OpenModal2() {
                $("#divModal2").dialog({
                    autoOpen: false, modal: true, title: '', width: 'auto', height: 'auto'
                    , 
                }).dialog('open');
                return false;
            }
        </script>

    <script src="js/app.js"></script>
    <script src="js/services.js"></script>
    <script src="js/controller.js"></script>
    <script type="text/javascript">
        var fingerprint = new Fingerprint().get();     
        localStorage.setItem('sign', fingerprint);   
        <?php 
            if($_SESSION["login_status"]=='login'){
        ?>	
            localStorage.setItem('loginStatus', '1');  //already loggedin 
            localStorage.setItem('email', '<?= $_SESSION["email"]?>')
            localStorage.setItem('userid', '<?= $_SESSION["userid"]?>')
            localStorage.setItem('mobile', '<?= $_SESSION["mobile"]?>')
            localStorage.setItem('name', '<?= $_SESSION["name"]?>')

        <?php          
           }else{
        ?>   
            if(localStorage.getItem('loginStatus')!=1){
            	localStorage.setItem('loginStatus', '0'); //not logged in
            }
            
       <?php      
        }        
         ?>   
    </script>
 
    
  </body>
</html>
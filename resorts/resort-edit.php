<?php   header('Content-type: text/html; charset=utf-8'); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        ini_set("display_errors", '1');
        /*
		$id = $_REQUEST['id'];
        if($id=="")
        {
        printf("<script>location.href='../index.php'</script>");       
        exit();
        }
		*/

        //$id = 27;

        include("../includes/db.inc.php");
        $db = new DB();
        $id = $_REQUEST['id'];
        $qry = "select * from resorts where id= $id && Status = 1";
        $result = $db->_query($qry);
        $row = mysqli_Fetch_array($result);
  
    ?>
    
    <title><?= $row['Meta_Title']; ?></title>
    <meta name="description" content="<?= $row['Meta_Description']; ?>">
    <meta name="keywords" content="<?= $row['Meta_Keyword']; ?>">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap-social.css">
    <link href="../css/custom.css" rel="stylesheet">    
    

    
    <link href="../libs/lightslider-master/dist/css/lightslider.min.css" rel="stylesheet">
    <link href="../bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">

    <link href="../css/jquery.bxslider.css" rel="stylesheet">
    <script src="../bower_components/jquery/dist/jquery.min.js"></script> 
    
	<style>
        ul{
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
        }
        .demo .item{
            margin-bottom: 60px;
        }
        .content-slider li{
            background-color: #ed3020;
            text-align: center;
            color: #FFF;
        }
        .content-slider h3 {
            margin: 0;
            padding: 70px 0;
        }
        .demo{
            width: 800px;
        }
    </style>
	

    
  </head>
  <body>

<div class="overlay"><img src="../images/loading.gif" alt="pura"></div>
    

  
    
    
    <!-- stay section starts -->
    <?php include_once("stay_section_web.php") ?> 
    <!-- stay section ends -->

 
    
   
    
   
	
    

     
    <script type="text/javascript" src="../bower_components/lightbox2/dist/js/lightbox.min.js"></script>
    <script type="text/javascript" src="../libs/lightslider-master/dist/js/lightslider.min.js"></script>

    
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../libs/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="resort.js"></script>
    
    
    
    

  </body>
</html>

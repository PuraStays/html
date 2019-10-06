<?php
include_once("../../includes/db.inc.php");
$db = new DB();

if(!isset($_REQUEST['u']))
  {
     exit();
  }

$url = $_REQUEST['u'];

$qry = "select * from landingpages where url = '$url'";
$resort = $db->_query($qry);
$row = mysqli_fetch_array($resort);
//var_dump($row);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pura Stays</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="shortcut icon" href="images/favicon.ico">
  <meta charset="utf-8">
  <!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-MCKZKCF');</script> <!-- End Google Tag Manager -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="libs/bxslider/jquery.bxslider.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="libs/lightbox2/dist/css/lightbox.min.css" rel="stylesheet" />
  <?php include_once("../../includes/taghead.php") ?>
</head>

<body class="n1">
<!-- Google Tag Manager (noscript) --> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCKZKCF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->
<?php include_once("../../includes/tagbody.php") ?>
  <div class="banner-container">
    <header>
      <div class="container">
        <div class="nav clearfix">
          <div class="logo pull-left">
            <a href="javascript:void(0);">
              <img src="images/purastays-logo.png" alt="pura stays" />
            </a>
          </div>
          <div class="header-mobile pull-right">
            <a class="link" href="tel:<?= $row['Contact']; ?>"><span><img src="images/pura-phone-icon-pura.png" alt="" /></span><?= $row['Contact']; ?></a>
          </div>
        </div>

      </div>
      <div class="container">
        <div class="row">  
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="banner-content style1">
                <div class="line1"><?= $row['Banner_Title']; ?></div>
                <div class="line2"><?= $row['Banner_Details']; ?></div>
                <div class="price"><div class="price-inner"><span>only at</span>&#8377;<?= $row['Offer_Amount']; ?></div></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-0 float-form-container">
                <div class="form-float">
                <div class="form-container">
                    <div class="form-header form-padding">
                        <h3><img src="images/purastays-enquiry.png" />Enquiry</h3>
                    </div>
                    <div class="form-body form-padding">
                        <p><?= $row['enquiry_details']; ?></p>
                        <form method="post" action="thank-you.php">
                            <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email Id" required/>
                            </div>
                            <div class="form-group">
                            <input type="hidden" class="form-control" name="package" value="<?= $row['Package_Title']; ?>" />
                            </div>

                            <div class="form-group">
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required/>
                            </div>
                            <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Message (optional)"></textarea>
                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-block btn-pura" value="Send" />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        <div>
      </div>
    </header>

    <div class="banner-image">
      <img src="<?= $row['Banner_Image']; ?>" alt="purastays banner" />
    </div>
  </div>

  <div class="main-container">
    <div class="container clearfix">
      <div class="col-lg-8 col-md-8 col-sm-12">
            
        <div class="left-section-block res-form">
            <div class="form-container">
                <div class="form-header form-padding">
                <h3><img src="images/purastays-enquiry.png" />Enquiry</h3>
                </div>
                <div class="form-body form-padding">
                <p><?= $row['enquiry_details']; ?></p>
                <form method="post" action="thank-you.php">
                    <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Your Name" required/>
                    </div>
                    <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email Id" required/>
                    </div>
                    <div class="form-group">
                    <input type="hidden" class="form-control" name="package" value="<?= $row['Package_Title']; ?>" />
                    </div>

                    <div class="form-group">
                    <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required/>
                    </div>
                    <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Message (optional)"></textarea>
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-block btn-pura" value="Send" />
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="left-section-block">
            <h3><?= $row['Package_Title'];?></h3>
            <p><?= $row['Package_Description']; ?></p>

            <h4>Features</h4>
            <ul>
                <?php
                    $Package_Features =  explode("\n", $row['Package_Features']);
                    foreach ($Package_Features as $key => $value) {
                        echo '<li>'.$value.' </li>';        
                    }
                ?>
            </ul>
        </div>

        <div class="left-section-block">
            <h3>Quick Look</h3>
            <p><?= $row['Gallery_Details']; ?></p>
            <div class="gallery">
                <div class="gallery-container clearfix bxslider desk">

                <?php
                for($i=1; $i<=6; $i++)
                {
                ?>
                <div class="gall">
                    <div class="gall-inner">
                        <img src="<?= $row['Gallery'.$i.'_Image']; ?>" alt="<?= $row['Gallery'.$i.'_Title']; ?>" />
                        <div class="des">
                            <div class="des-container">
                                <h5><?= $row['Gallery'.$i.'_Title']; ?></h5>
                                <p><?= $row['Gallery'.$i.'_Description']; ?></p>
                            </div>
                        </div>
                        <a href="<?= $row['Gallery'.$i.'_Image']; ?>" data-lightbox="gall"></a>
                    </div>    
                </div>
                <?php
                }
                ?>

                </div>
            </div>
        </div>

        <div class="left-section-block">
            <?= $row['Description'];?>
        </div>
      <div class="col-lg-4 col-md-4 col-sm-0"></div>

      <!-- <aside>
        <div class="form-float">
          <div class="form-container">
            <div class="form-header form-padding">
              <h3><img src="images/purastays-enquiry.png" />Enquiry</h3>
            </div>
            <div class="form-body form-padding">
              <p><?= $row['enquiry_details']; ?></p>
              <form method="post" action="thank-you.php">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Your Name" required/>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email Id" required/>
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control" name="package" value="<?= $row['Package_Title']; ?>" />
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required/>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-block btn-pura" value="Send" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </aside> -->
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
  <script src="libs/lightbox2/dist/js/lightbox.min.js"></script>
  <script>
    $(document).ready(function(){
      lightbox.option({
        'resizeDuration': 100,
        'wrapAround': true
      })
    })

  </script>
  <script src="js/common.js"></script>
</body>
</html>

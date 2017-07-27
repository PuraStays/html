<?php
include_once("vendor/S3/S3.php");
include_once("includes/db.inc.php");
session_start();


//upload password
if(isset($_POST['pass_btn']))
  {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1!="" && $password2 !="")
    {
        if ($password1 == $password2)
        {
          $userid = $_SESSION['userid'];
          $qry = "update customers set password = '$password1' where id = '$userid'";
          $db = new DB();
          if($db->_query($qry))
          {
            $message = "Password updated successfully.";
          }
        }
    }
  }

//upload pic
  if(isset($_POST['pic_btn']))
    {
          //use S3;
          //AWS access info
          if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJXWJX4EXE3ZZPGMQ');
          if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        
          //instantiate the class
          $s3 = new S3(awsAccessKey, awsSecretKey);

          //retreive post variables
          $fileName = $_FILES["Image"]['name'];
          $fileTempName = $_FILES["Image"]['tmp_name'];

          //create a new bucket
          $s3->putBucket("mybuccketsfdfsdfs", S3::ACL_PUBLIC_READ);
                        
          $file = $_FILES['Image']; 
          $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
          
          $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
          $setNewFileName = time() . "_" . rand(000000, 999999);                
          
          $fileName = $setNewFileName.'.'.$ext;
          if (in_array($ext, $arr_ext)) {
              //move the file
              if ($s3->putObjectFile($fileTempName, "mybuccketsfdfsdfs", $fileName, S3::ACL_PUBLIC_READ)) {
                  
                    $userid = $_SESSION["userid"];
                    //echo "<strong>We successfully uploaded your file.</strong>";
                    $Customer_Image = "http://mybuccketsfdfsdfs.s3.amazonaws.com/".$fileName;

                    $qry = "update customers set Customer_Image = '$Customer_Image' where id = '$userid'";
                    $db = new DB();
                    if($db->_query($qry))
                    {
                      $message = "Image updated successfully.";
                    }
                  }
                  else
                  {
                      echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
                  }
          }
          
    }


?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script src="bower_components/jquery/dist/jquery.min.js"></script>
  </head>
  <body>
  <div class="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<section class="pura-banner-inner profile-banner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav.php");?>
            <div class="pura-slider">
            	<img src="images/profile-banner.jpg" alt="pura profile">
            </div>
        </section>
    </header>    
    <?php
      if($_SESSION["login_status"] !="login")
        {
          $_SESSION["login_status"] = 'logout';
          printf("<script>location.href='index.php?logout'</script>");       
          exit();
        }
        $Id = $_SESSION["userid"];
        $db = new DB();
        $qry = "select * from customers where id  = $Id";
        $result = $db->_query($qry);
        $row =  $result->fetch_assoc();
    ?>    
    <section class="profile-details">
        <div class="strip">
            <div class="container">
                <div class="prof-pic">
                    <figure>
                        <img src="<?= $row['Customer_Image']?>" alt="<?= $row['Name']; ?>"/>
                    </figure>
                    <div class="edt-btn" data-toggle="modal" data-target="#updatePic"><i class="fa fa-pencil" aria-hidden="true"></i></div>                                        
                </div>
                <div class="name">Welcome <span><?= $row['Name']; ?></span></div>
            </div>
        </div>
        <div class="other-details">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <div class="rht"><?= $row['email']; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <div class="rht"><?= $row['Mobile']; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-key" aria-hidden="true"></i></div>
                                <div class="rht">************ <div class="lnkIn" data-toggle="modal" data-target="#updatePass"><i class="fa fa-pencil" aria-hidden="true"></i></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <section class="sec history">
    	<div class="container">
        	<h2>Booking History</h2>
        </div>    

        <?php
        $requestStr = '{"userid":"'.$_SESSION['userid'].'"}';

        $actionUrl = "http://api.purastays.com/booking-history-user-profile";
        $request = curl_init($actionUrl);
        curl_setopt($request, CURLOPT_HEADER, 0);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
        $post_response = curl_exec($request);

        
        $data = json_decode($post_response);
        if(!$data)
        {
          $data = json_decode($post_response.']}');
        }

        curl_close ($request);
        ?>
        <div class="type clearfix">
        	<div class="container">
                <div class="panel-group booking-history" id="accordion">
                  <?php
                  $count = 0;
                  foreach ($data->bookings as $bookings) {
                    $count++;
                    $status=0;

                    foreach ($bookings as $booking) {
                      $status++;
                      if($status==1)
                      {
                    ?>
                      <div class="panel panel-success">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $count; ?>">
                            Jim Corbett - <?= $booking->where->resort_name; ?>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse<?= $count; ?>" class="panel-collapse collapse<?php if($count== count($data->bookings)){ echo ' in';} ?>">
                        <div class="panel-body">
                          <?php // print_r($booking); ?>
                          <table class="table table-condensed custom">
                          	<caption>Your Booking Details</caption>						    
						    <tbody>
						      <tr>
						        <td colspan="2"><?= $booking->where->resort_name; ?></td>	
						        <td><a href="javascript:void(0);" data-booking='<?= $booking->savebooking->response->order->id; ?>' class="btn btn-danger brn-block">Cancel</a></td>
						      </tr>
						      <tr>
						        <td><?= $booking->when->start_date; ?></td>
						        <td><?= $booking->when->end_date; ?></td>
						        <td><?= $booking->when->duration; ?></td>
						      </tr>
						      <tr>
						        <td><?= $booking->person->adult; ?></td>
						        <td><?= $booking->person->child; ?></td>
						        <td><?= $booking->person->adult + $booking->person->child; ?></td>
						      </tr>						      
						    </tbody>
						  </table>

              <table class="table table-bordered custom">
                <caption>Your Stays</caption>
						    <thead>
						      <tr>
						        <th>Room Type</th>
						        <th>Unit</th>
                    <th>Rate</th>
                    <th>Tax</th>
						        <th align="right">Price</th>
						      </tr>
						    </thead>
						    <tbody>
                  <?php
                    foreach ($booking->rooms as $key => $value) {
                      ?>
                        <tr>
                          <td><?= $value->room_name; ?></td>
                          <td><?= $value->room_count; ?></td>
                          <td><?= $value->rate->price; ?></td>
                          <td><?= $value->rate->tax; ?></td>
                          <td><?= ($value->rate->price + $value->rate->tax)*$value->room_count; ?></td>
                        </tr>    
                      <?php
                    }
                  ?>
						      
						    </tbody>
						  </table>

						  <table class="table table-bordered custom">
                  	<caption>Programs</caption>
              </table>
						     <?php
                    $package_price = 0;
                    
                    foreach ($booking->package as $key => $value) {
                      $package_price = $package_price + $value->totalPrice;
                      ?>
                      <table class="table table-bordered custom">
                      <thead>
                        <tr>
                            <th>Adventure Level</th>
                            <th>Min (Time)</th>
                            <th>Unit</th>
                            <th align="right">Price</th>
                            <th>Activities</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php

                      $act_count = 0;
                      ?>
                        <tr>
                          <td rowspan="5"><?= $value->title; ?></td>
                          <td rowspan="5"><?= $value->min_time; ?></td>
                          <td rowspan="5"><?= $value->forPerson; ?></td>
                          <td rowspan="5"><?= $value->totalPrice; ?></td>
                        </tr>    
                      <?php
                      if(is_object($value->selectedActivity))
                      {
                        $value->selectedActivity = json_decode(json_encode($value->selectedActivity), true);
                      }
                      
                      foreach ($value->groups as  $group) {
                        foreach ($group as $subgroup) {
                          foreach ($subgroup->activities as $activity) {
                            if(isset($activity->seqId))
                            {
         //                     echo 'multiple choice';
                              if($value->selectedActivity[$activity->seqId]==1)
                              {
                                $act_count++;
                                ?>
                                <tr>
                                  <td><?= $activity->Activity_Name; ?></td>
                                </tr>
                                <?php
                              }
                            }
                            else
                            {
                                  $act_count++;
                            ?>
                                <tr>
                                  <td><?= $activity->Activity_Name; ?></td>
                                </tr>      
                              <?php 
                            }
                          }
                        }
                      }
                      ?>
                      </tbody>
                      </table>
                      <?php
                    }
                  ?>
        		    </tbody>
						  </table>

						  <table class="table table-bordered">                          
						    <tbody>						     
						      <tr>
						        <td colspan="3" align="right"><?php echo $price =  $package_price + $booking->user->room_price; ?></td>						        
						      </tr>
						    </tbody>
						  </table>

                        </div>
                      </div>
                    </div>
                    <?php
                    }
                  }
                  }
                  ?>
                  <!--
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Jim Corbett - Corbett New Resort
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          Cluster 2 - Resort 3
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          Cluster 2 - Resort 3
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  -->
                </div>

            </div>
        </div>        
    </section>
    
    <section class="social-sec">
    	<div class="container">
        	<ul>
            	<li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-google-plus"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
            </ul>
        </div>
    </section>
    
    <?php include_once("includes/footer.php");?>

<div id="updatePic" class="modal fade signing" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Profile Pic</h4>
          </div>
          <div class="modal-body">              
             <form action="" method="post" id="picForm" enctype="multipart/form-data">  
                <div class="form-group">
                    <label for="exampleInputFile">Update Profile pic</label>
                    <input type="file" name="Image" id="Image" class="btn btn-default btn-block" required="required">
                    <p class="help-block">browse images from your local computer.</p>
                  </div>
                <div class="row">   
                    <div class="col-sm-12">    
                        <fieldset class="form-group">                           
                            <input type="submit" id="pic_btn" name="pic_btn" value="Update" class="btn btn-pura pull-right" required="required">
                        </fieldset>
                    </div>                      
                </div>               
             </form>  
          </div>
       </div>       
    </div>
  </div>
</div>

<div id="updatePass" class="modal fade signing" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body">              
             <form action="" method="post" id="passForm" >   
                <div class="form-group">
                    <label for="password1">Enter New Password</label>
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter new Password" required="required">
                  </div>
                  <div class="form-group">
                    <label for="password2">Confirm New Password</label>
                    <input type="password" class="form-control" id="password2"  name="password2" placeholder="Confirm new Password" required="required">
                  </div>
                <div class="row">   
                    <div class="col-sm-12">    
                        <fieldset class="form-group">                           
                            <input type="submit" id="btn_pass" name="pass_btn" value="Update" class="btn btn-pura pull-right">
                        </fieldset>
                    </div>                      
                </div>               
             </form>  
          </div>
       </div>       
    </div>
  </div>
</div>
    

      
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {
      $('.booking-history .panel').each(function(){
        console.log("hello");
      })

      $('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});  
            $("#general_btn").on("click",function(){
                $('.overlay').fadeIn(500);
                var form=$("#generalForm");
                //data: JSON.stringify(form.serializeArray()),
                 $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: JSON.stringify(form.serializeArray()),
                    crossDomain: true,
                    url: '../api/contactus/general',
                    success: function(msg){
                        $('.overlay').fadeOut(500);
                        $("#general .alert.alert-success").fadeIn(300);    
                        $("#general .alert.alert-success").text(msg.message);   

                        console.log(msg);
                    },error: function(res){
                        alert('ajax post failed');  
                    }
                 }); 
            })
        });  
    </script>   
  </body>
</html>
